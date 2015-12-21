var gamo_resources = new function() {
	

	this.delete_resource_html = '';
	this.delete_resource_id = -1;
	
	
	this.created = function() {

		$("#new-resource-holder").hide();

		Core.modal({
			msg: "Your resource has been saved!",
			alert: "success"
		});

		$("#new-resource-holder").find(':input').val('');

		gamo_resources.admin_resources();

	};

	/*
	Display a video
	*/
	this.show_video = function(options) {

		options = Core.ensure_defaults({
			resource_id: -1
		}, options);

		Core.log(options);

		$.get('?a=resource_video&v=json&resource_id='+options['resource_id'], function(data) {

			var result = $.parseJSON(data);
			var html = '<iframe width="100%" height="315" src="/?a=load_video&src='+result['location']+'&resource_id='+options['resource_id']+'" frameborder="0" allowfullscreen autoplay="true"></iframe>';
			
			if(result['location'] != null && result['location'] != '') {

				$("#resource-show-"+options['resource_id']).html(html).css('margin', '0px 0px 10px 0px').show();

			} else {

				Core.modal({
					msg: "There was an error while processing your request. Please refresh the page and try again.",
					alert: 'error'
				});

			}

		})

	};

	/*
	Retrieve a list of people that this user scheduled meetings for
	*/
	this.get_resources = function(options) {

		$.get('/?a=get_resources&v=json&category='+$("#resource_category").val()+'&page='+options['page'], function(data) {

			var result = $.parseJSON(data);
			
			if(result['resources'].length > 0) {

				var html = '';
				var display = {};

				for(k in result['resources']) {
					
					if(result['resources'][k]['type'] != 'video') {

						display = {
							get_text: 'Download',
							get_url: '/?a=download_resource&resource_id='+result['resources'][k]['resource_id'],
							get_action: ''
						};

					} else {

						display = {
							get_text: 'Watch',
							get_url: '#',
							get_action: "gamo_resources.show_video({ resource_id: "+result['resources'][k]['resource_id']+" });"
						};

					}

					html += '<div class="imageBox item resource">'
							+'<a class="sectionAnchor" name="resource-'+result['resources'][k]['resource_id']+'">&nbsp;</a>'
                            +'<div class="image stretchImg">'
                                +'<img src="/resource_img.php?image='+result['resources'][k]['type']+'" alt="" />'
                            +'</div>'
                            +'<div class="info">'
                                +'<h5>'+result['resources'][k]['title']+'</h5>'
                                +'<p>'+result['resources'][k]['descrip']+'</p>'
                            +'</div>'
                            +'<div class="clearer">&nbsp;</div>'
                            +'<div id="resource-show-'+result['resources'][k]['resource_id']+'"></div>'
                            +'<div class="buttons">'
                                +'<a href="'+display['get_url']+'" target="_blank" onclick="'+display['get_action']+'setTimeout(function() { gamo_resources.refresh_history(); }, 1000 );return false" class="button small">'+display['get_text']+'</a>'
                                +'<a href="#" class="button openBubble small" data-bubble="#bubble-share-'+result['resources'][k]['resource_id']+'">Share</a>'
                                +'<div class="clearer">&nbsp;</div>'
                            +'</div>'
                            +'<div id="bubble-share-'+result['resources'][k]['resource_id']+'" class="bubble share col2">'
                               +' <div class="inner">'
                                    +'<form id="resource-share-'+result['resources'][k]['resource_id']+'" onsubmit="gamo_resources.share({resource_id: '+result['resources'][k]['resource_id']+'});return false">'
                                        +'<div class="input">'
                                            +'<label for="name">Name</label>'
                                            +'<input type="text" id="name" />'
                                        +'</div>'
                                        +'<div class="input">'
                                            +'<label for="title">Title</label>'
                                            +'<input type="text" id="title" />'
                                        +'</div>'
                                        +'<div class="input">'
                                            +'<label for="email">Email</label>'
                                            +'<input type="text" id="email" />'
                                        +'</div>'
                                        +'<div class="input">'
                                            +'<label for="message">Message</label>'
                                            +'<textarea id="message"></textarea>'
                                        +'</div>'
                                        +'<div class="input">'
                                            +'<button class="button thirdLeft" type="submit">Send</button>'
                                        +'</div>'
                                    +'</form>'
                                +'</div>'
                            +'</div>'
                        +'</div>';

				}

				html += '</div>';
				
				pager.set({
					holder: options['pager'],
					current: result['current_page'],
					last: result['last_page'],
					getter_id: options['getter_id']
				});

			} 
            /*else {

				var html = '<div style="font-size:1.5em;margin-bottom:1em">Resources to download and share coming soon!</div>';

			}*/
			
			$('#resources-list-holder').html(html);

		});

	};

	this.refresh_history = function() {
		
		Core.functions[Core.reference["gamo_resources_get_actions"]](1, Core.reference["gamo_resources_get_actions"]);
		gamo.update_dash();

	};

	this.delete_resource = function(options) {

		options = Core.ensure_defaults({
			step: 1,
			resource_id: gamo_resources.delete_resource_id
		}, options);

		if(options['step'] == 1) {

			gamo_resources.delete_resource_id = options['resource_id'];

			if(gamo_resources.delete_resource_html == '') {

				gamo_resources.delete_resource_html = $('#delete-resource-modal').html();
				$('#delete-resource-modal').remove();

			}

			Core.modal({
				msg: gamo_resources.delete_resource_html,
				footer: '<button class="btn btn-danger" onclick="gamo_resources.delete_resource({step: 2, resource_id: '+options['resource_id']+'})">Delete</div>'
						+ '<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>'
			});

		} else if(options['step'] == 2) {

			var inputs = {
				resource_id: options['resource_id'],
				delete_awards: ($('input[name=delete-resource-type]:checked').val() == 'all') ? 1 : 0
			};

			$.post('/?a=admin_delete_resource&v=json', inputs, function(data) {
				
				var result = $.parseJSON(data);
				
				if(result['error'] != 0) {

					Core.modal({
						msg: "There was an error while processing your request. Please refresh the page and try again.",
						alert: 'error'
					});

				} else {

					Core.modal({
						msg: "The resource has been deleted!",
						alert: 'success'
					});

				}

				gamo_resources.admin_resources();

			});

		}

	};

	this.admin_resources = function(options) {

		$.get('/?a=get_resources&v=json', function(data) {

			var html = '';
			var result = $.parseJSON(data);
			var bg_color = 'f3f3f3';

			if(result['resources'].length > 0) {

				html = '<table border="0" cellspacing="0" cellpadding="0" style="margin-top:20px">';

				html += '<tr style="background-color:#eee;color:#777">'
						+'<td style="padding:8px">ID</td>'
						+'<td style="padding:8px">Name</td>'
						+'<td style="padding:8px">Type</td>'
						+'<td style="padding:8px">Downloaded</td>'
						+'<td style="padding:8px">Shared</td>'
						+'<td style="padding:8px"></td>'
						+'</tr>';

				for(k in result['resources']) {

					bg_color = (bg_color == 'f3f3f3') ? 'fff' : 'f3f3f3';

					html += '<tr style="background-color:#'+bg_color+'">'
						+'<td style="padding:8px">'+result['resources'][k]['resource_id']+'</td>'
						+'<td style="padding:8px"><a href="/?a=download_resource&admin=1&resource_id='+result['resources'][k]['resource_id']+'">'+result['resources'][k]['title']+'</a></td>'
						+'<td style="padding:8px">'+result['resources'][k]['type']+'</td>'
						+'<td style="padding:8px">'+result['resources'][k]['download_qty']+'</td>'
						+'<td style="padding:8px">'+result['resources'][k]['share_qty']+'</td>'
						+'<td style="padding:8px"><button class="btn btn-danger" delete-resource="'+result['resources'][k]['resource_id']+'"><i class="icon-remove icon-white"></i></button></td>'
						+'</tr>';

				}

				html += '</table>';

			}

			$('#resources-list-holder').hide().html(html).fadeIn(250);

		});

	};

	this.share = function(options) {

		options = Core.ensure_defaults({
			resource_id: -1,
			replace_holder: "#"
		}, options);
		
		options = Core.ensure_defaults({
			holder: '#resource-share-'+options['resource_id']
		}, options);

		var inputs = Core.get_inputs({
			holder: options['holder']
		});
		
		inputs['resource_id'] = options['resource_id'];

		$.post('/?a=share_resource&v=json', inputs, function(data) {
			
			
			var result = $.parseJSON(data);

			
			if( options['replace_holder'] != "#" ){
				
				if( result['error'] != '' ) {
					
					$( '#share_error' ).html(result['error']);
	
				} else {
					
					$( options['replace_holder'] ).html("Thanks for sharing this resource!");
	
				}
				
			} else {
			
				if(result['error'] != '') {
	
					Core.modal({
						msg: result['error'],
						alert: 'error'
					});
	
				} else {
	
					Core.modal({
						msg: "Thanks for sharing this resource!",
						alert: 'success'
					});
	
					$("[id^='resource-share-']").find(':input').val('');
	
					$("[id^='bubble-share-']", '#resources-list-holder').hide();
					$(".openBubble", '#resources-list-holder').removeClass('depressed');
	
					gamo_resources.refresh_history();
	
				}
				
			}
			
			

		});

	};

	this.get_actions = function(options) {

		options = Core.ensure_defaults({
			page: 1
		}, options);

		$.get('/?a=get_resource_actions&v=json&page='+options['page'], function(data) {

			var results = $.parseJSON(data);

			if(results['actions'].length > 0) {

				var html = '<div class="list">'
                    +'<div class="listRow title">'
                        +'<div class="listCell width35">Date &amp; Time</div>'
                        +'<div class="listCell width25">Resources</div>'
                        +'<div class="listCell width25">Status</div>'
                        +'<div class="listCell width15">Points</div>'
                    +'</div>';

				for(k in results['actions']) {

					html += '<div class="listRow">'
                            +'<div class="listCell entry width35">'+Core.local_time(results['actions'][k]['time'])+'</div>'
                            +'<div class="listCell entry width25">'+results['actions'][k]['resource_title']+'</div>'
                            +'<div class="listCell entry width25">'+results['actions'][k]['resource_user_status']+'</div>'
                            +'<div class="listCell entry width15 highlight">'+results['actions'][k]['point_value_use']+'</div>'
                        +'</div>';

				}

				html += '</div>';
				
				pager.set({
					holder: options['pager'],
					current: results['current_page'],
					last: results['last_page'],
					getter_id: options['getter_id']
				});

			} else {

				var html = 'You have not downloaded or shared any resource yet.';

			}

			$('#resource-action-list').html(html);

		});

	};
	
	
	this.set_played_full = function(options){
		
		options = Core.ensure_defaults({
			src: "",
			video_id:""
		}, options);
		
		for(var i=0; i<$(opotions.video_id).played.length; i++){
			
			alert('here');
			
		}
		
		
	};

};

$(document).ready(function() {
	
	$("#myModal").on("show.bs.modal", function (e) {
		
		$("#modal_resource_id").val(e.relatedTarget.dataset.other);
		
	});

	$("#myModal").on("hidden.bs.modal", function (e) {
		
		$( "#myModal .modal-dialog .modal-content .modal-body" ).html(
				'<form role="form" id="share-form">'
					+'<div class="form-group">'
						+'<div id="share_error"></div>'
					+'</div>'
					+'<div class="form-group">'
						+'<label for="name">Name of recipient</label>'
						+'<input type="text" class="form-control" id="name">'
					+'</div>'
					+'<div class="form-group">'
						+'<label for="title">Title</label>'
						+'<input type="text" class="form-control" id="title">'
					+'</div>'
					+'<div class="form-group">'
						+'<label for="email">Email</label>'
						+'<input type="email" class="form-control" id="email">'
						+'<input type="hidden" id="modal_resource_id" value="0" />'
					+'</div>'
					+'<div class="form-group">'
						+'<label for="message">Message</label>'
						+'<textarea class="form-control" id="message"></textarea>'
					+'</div>'
					+'<p class="pull-right">'
						+'<button type="button" class="btn bluebackground" id="send-form">Send</button>'
					+'</p>'
				+'</form>'
		);
		
	});

	$(document).on("click", "#send-form", function (e) {

		e.preventDefault();

		
		gamo_resources.share( {
			resource_id: $("#modal_resource_id").val(),
			replace_holder: "#myModal .modal-dialog .modal-content .modal-body",
			holder: "#share-form"
		});
		
	});
	
	
	$(document).on("play", "video", function (e) {
		
		alert('started');

		/*
		gamo_resources.set_played_full( {
			src: $(this).attr(src),
			video_id: this 
		});
		*/
		
		
	});

	

	/*
	 
	$('#resources-list-holder').on('click', "button[delete-resource]", function() {

		gamo_resources.delete_resource({
			step: 1,
			resource_id: $(this).attr('delete-resource')
		});

	});
	
	
	Core.reference["gamo_get_resource"] = Core.unique_id();

	Core.functions[Core.reference["gamo_get_resource"]] = function(page, getter_id) {

		gamo_resources.get_resources({
			pager: "#resources-list-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};


	Core.functions[Core.reference["gamo_get_resource"]](1, Core.reference["gamo_get_resource"]);
	
	Core.reference["gamo_resources_get_actions"] = Core.unique_id();

	Core.functions[Core.reference["gamo_resources_get_actions"]] = function(page, getter_id) {

		gamo_resources.get_actions({
			pager: "#resource-action-list-pager",
			page: page,
			getter_id: getter_id
		});

	};


	Core.functions[Core.reference["gamo_resources_get_actions"]](1, Core.reference["gamo_resources_get_actions"]);

	if($("#resource-type-holder").length > 0) {

		$("#resource_type").change(function() {

			if($(this).val() == 'video') {

				var hide = "#file-upload-holder";
				var show = "#video-embed-holder";

			} else {

				var hide = "#video-embed-holder";
				var show = "#file-upload-holder";

			}

			$(hide).hide();
			$(show).fadeIn(250);

		});

	}
	*/

	$("#resource_category").change(function() {

		window.location = '/?p=training&resource_category='+$(this).val()+'#r';

	});

});
