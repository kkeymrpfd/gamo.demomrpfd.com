var gamo_vevents = new function(){
	
	this.action_id = '';
	
	this.create_event = function() {

		var inputs = Core.get_inputs({
			holder: "#new-vevent-form"
		});

		$.post('/?a=admin_create_vevent&v=json', inputs, function(data) {

			var result = $.parseJSON();

			if(result == null) { result = {}; }

			if(result['success'] != 1) {

				if(result['error'] != null && result['error'] != '') {

					var error_msg = result['error'];

				} else {

					error_msg = "There was an error while processing your request. Please refresh the page and try again.";

				}

				Core.modal({
					msg: error_msg,
					alert: 'error'
				});

			} else {

				Core.modal({
					msg: "Your virtual event has been saved!",
					alert: 'success'
				});

			}

		});

	};

	this.get_new = function(options){

		$.get('/?a=get_vevents_new&v=json&page='+options['page']).
		done( function(data) {
			
			data = $.parseJSON(data);

			gamo_vevents.render_new(data);
			
			pager.set({
				holder: options['pager'],
				current: data['actions_history']['current_page'],
				last: data['actions_history']['last_page'],
				getter_id: options['getter_id']
			});

		}).
		fail(function(){
			
		});

	};
	
	this.add_user = function(options){
		
		options = Core.ensure_defaults({
			step: 1,
			action_id: -1,
			location: ''
		}, options);


		$.get('/?a=add_user_vevent&v=json&event_id='+options['event_id']+'&location='+options['location'], function(data) {

			var result = $.parseJSON(data);

			if(result['valid'] == 1) {
				
				var ical_html = '<br><br><a href="/?a=vevent_ical&event_id='+options['event_id']+'" target="_blank" class="btn btn-primary btn-large">Download Invite</a>';

				Core.modal({
					msg: "<center>You have succesfully RSVP'd for this event!"+ical_html+"</center>",
					alert: 'success',
				});


				gamo_vevents.get_new({
					pager: "#vevent-new-holder-pager",
					page: 1,
					getter_id: 'vevent_actions_new'
				});

				Core.functions[Core.reference["gamo_vevents_user"]](1, Core.reference["gamo_vevents_user"]);
				gamo.update_dash();

			} else {
				Core.log(result);
				var msg = "There was an error while signing you up. Your changes might not have been saved";

				if(result['error_code'] == 9) {

					msg = "Please select the location you would like to attend for this event";

				}

				Core.modal({
					msg: msg,
					alert: 'error'
				});

			}

		});

	};
	
	this.get_user = function(options){

		$.get('/?a=get_vevents_user&v=json&page='+options['page']).
		
		done( function(data) {
			
				data = $.parseJSON(data);
				
				
				gamo_vevents.render_user(data);
				
				pager.set({
					holder: options['pager'],
					current: data['actions_history']['current_page'],
					last: data['actions_history']['last_page'],
					getter_id: options['getter_id']
				});
	
		}).
		fail(function(){
			
		});

	};
	
	this.render_new = function(data, getter_id) {
		
		var show_type = 'both';

		if($('#is_vevent').length > 0) {

			show_type = 1;

		} else if($('#is_face').length > 0) {

			show_type = 2;

		}

		if(data != null
				&& data['actions_history'] != null
				&& data['actions_history']['actions'][0] != null
				&& data['actions_history']['actions'][0]['id'] != null) { // These are valid users
					
					var html = '';
					var rsvp = '';

					var info = -1;
					var info2 = -1;
					var location = Array();
					var location_html = '';
					var location_key = '';
					var location_display = '';

					for(k in data['actions_history']['actions']) {

						if(show_type == 'both' || show_type == data['actions_history']['actions'][k]['event_type']) {

							// Determine if event is launched
							info = _.where(data['actions_history']['actions'][k]['has'], { info_type: 'launched', int_info: '1' });
							
							if(info[0] != null && info[0]['event_id'] != null) { // Event launched

								$.post("/?a=vevent_viewed&event_id="+data['actions_history']['actions'][k]['id'], { event_id: +data['actions_history']['actions'][k]['id'] });
								
								html += '<div class="item">'
											+'<a class="sectionAnchor" name="vevent-'+data['actions_history']['actions'][k]['id']+'">&nbsp;</a>'
		                            		+'<div class="fadeHeader">'
		                            			+'<h5>' + data['actions_history']['actions'][k]['title'] + '</h5>'
		                            			+'<h6>' + Core.local_time(data['actions_history']['actions'][k]['date_time'], 'dddd, MMMM D, YYYY @ h:mm a') + '</h6>'
		                            		+'</div>'
		                            		+'<img src="/img/vevent-full.jpg" style="margin:0em 0em 0.5em -0.2em">'
		                            		+'<iframe width="450" height="260" src="http://cdn.livestream.com/embed/syndicatedwebinar?layout=4&color=0xe7e7e7&autoPlay=false&mute=false&iconColorOver=0x888888&iconColor=0x777777&allowchat=false&height=260&width=450" style="border:0;outline:0" frameborder="0" scrolling="no"></iframe>'
		                            		+'<iframe src="http://www.coveritlive.com/index2.php/option=com_altcaster/task=viewaltcast/altcast_code=' + _.where(data['actions_history']['actions'][k]['has'], { info_type: 'coveritlive_id' })[0]['info'] + '/height=500/width=450" scrolling="no" height="500px" width="450px" frameBorder ="0" allowTransparency="true"  ><a href="http://www.coveritlive.com/mobile.php/option=com_mobile/task=viewaltcast/altcast_code=fb04232e5f" >' + data['actions_history']['actions'][k]['title'] + '</a></iframe>'
		                            	+'<div class="fadeHeader" style="margin-top:1em">'
		                            	+'<table border="0" cellspacing="0" cellpadding="0">'
		                            	+'<tr>'
		                            	+'<td style="width:60%;valign:top">'
		                            	+'<span style="font-size:1.3em;position:relative;top:-1em">Schedule and attend a phone meeting and earn the Meety Badge worth a $50 Gift Card Reward!</span>'
		                            	+'</td>'
		                            	+'<td><a href="/?p=meeting" target="_blank"><img src="/img/meeting-callout-btn.png" style="margin:1.5em 1em" border="0"></a></td>'
		                            	+'</tr>'
		                            	+'</table>'
		                            	+'</div>'
		                            	+'</div>';

							} else { // Event not launched
								
								info2 = _.where(data['actions_history']['actions'][k]['has'], { info_type: 'launched', int_info: '2' });
	                                                       
	                           if(info2[0] != null && info2[0]['event_id'] != null) {
	                                   
	                                   rsvp = '<a href="/?p=resources" class="button thirdLeft" style="font-size:1em">Watch Replay</a>';
	                                   
	                           } else {

									if( data['actions_history']['actions'][k]['signedup'] == false ){
										
										rsvp = '<a href="#" class="button thirdLeft" onclick="gamo_vevents.add_user({event_id:'+data['actions_history']['actions'][k]['id']+', user_id:'+data['actions_history']['user_id']+', location: $(\'#event_location_'+data['actions_history']['actions'][k]['id']+'\').val() });return false">RSVP Now</a>';

									} else {

										rsvp = '<a href="/?a=vevent_ical&event_id='+data['actions_history']['actions'][k]['id']+'" target="_blank" class="button thirdLeft" style="font-size:0.9em">Download Invite</a>';

									}

								}

								location_html = '';

								location = _.where(data['actions_history']['actions'][k]['has'], { info_type: 'event_location' });
								
								for(k in location) {

									location_html += '<option value="'+location[k]['info_b']+'">'+location[k]['info']+'</option>';

								}

								if(location_html != '') {

									if(data['actions_history']['actions'][k]['signedup']) { // user has signed up. Just display location selected

										location_key = data['actions_history']['actions'][k]['user_location_key'];
										location_display = '';
										Core.log(location_key);
										if(location_key != null
											&& location_key != undefined) {

											location = _.where(data['actions_history']['actions'][k]['has'], {
												info_type: 'event_location',
												info_b: location_key
											});

											for(k in location) {

												location_display = location[k]['info'];

											}

											if(location_display != '') {

												location_html = '<div style="font-style:italic;margin-bottom:1em">Location: '+location_display+'</div>';

											}

										}

									} else { // Generate location dropdown

										location_html = '<select id="event_location_'+data['actions_history']['actions'][k]['id']+'">'
														+'<option value="">Please select a location</option>'
														+location_html
														+'</select>';

									}

								}

								Core.log(location_html);

								html += '<div class="item">'
											+'<a class="sectionAnchor" name="vevent-'+data['actions_history']['actions'][k]['id']+'">&nbsp;</a>'
		                            		+'<div class="fadeHeader">'
		                            			+'<h5>' + data['actions_history']['actions'][k]['title'] + '</h5>'
		                            			+'<h6>' + Core.local_time(data['actions_history']['actions'][k]['date_time'], 'dddd, MMMM D, YYYY @ h:mm a') + '</h6>'
		                            		+'</div>'
		                            		+'<p>' + data['actions_history']['actions'][k]['description'] + '</p>'
		                            		+location_html
		                            		+rsvp
		                            	+'</div>';

							}

							html += '';

						}

					}

					$('#vevent-new-holder').html(html);

				}
		
	};
	
	
	this.render_user = function(data, getter_id) {

		var show_type = 'both';

		if($('#is_vevent').length > 0) {

			show_type = 1;

		} else if($('#is_face').length > 0) {

			show_type = 2;

		}

		var event_qty = 0;

		if(data != null
				&& data['actions_history'] != null
				&& data['actions_history']['actions'][0] != null
				&& data['actions_history']['actions'][0]['id'] != null) { // These are valid users
					
			var html = '<div class="listRow title">'
                			+'<div class="listCell width30">Name</div>'
                			+'<div class="listCell width30">Date</div>'
                			+'<div class="listCell width20">Points</div>'
                			+'<div class="listCell width20"></div>'
                		+'</div>';
			var replay = '';

			for(k in data['actions_history']['actions']) {

				if(show_type == 'both' || show_type == data['actions_history']['actions'][k]['event_type']) {

					if(data['actions_history']['actions'][k]['launched'] == 2) {

						replay = '<a href="/?p=resources" class="button xsmall noMargin">Watch Replay</a>';

					} else {

						replay = '';

					}
					
					html += 	'<div class="listRow">'
                        			+'<div class="listCell width30">' + data['actions_history']['actions'][k]['name'] + '</div>'
                        			+'<div class="listCell width30">' + Core.local_time(data['actions_history']['actions'][k]['date_time'], 'dddd, MMMM D, YYYY @ h:mm a') + '</div>'
                        			+'<div class="listCell width20 highlight">' + data['actions_history']['actions'][k]['points'] + '</div>'
                        			+'<div class="listCell width20">'+replay+'</div>'
                        		+'</div>';

                    ++event_qty;

                }

			}

			html += '';

			$('#vevent-user-holder').html(html);

		} else {

			$('#vevent-user-holder').html("No actions found matching this criteria");

		}

		if(event_qty == 0) { $('#vevent-user-holder').html("No actions found matching this criteria"); }

	};
	
};


$(document).ready(function() {

	Core.reference["vevent_actions_new"] = 'vevent_actions_new';
	Core.functions[Core.reference["gamo_vevents_new"]] = function(page, getter_id) {
		
		gamo_vevents.get_new({
			pager: "#vevent-new-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};
	
	Core.functions[Core.reference["gamo_vevents_new"]](1, Core.reference["gamo_vevents_new"]);

	Core.reference["vevent_actions_user"] = Core.unique_id();
	Core.functions[Core.reference["gamo_vevents_user"]] = function(page, getter_id) {

		gamo_vevents.get_user({
			pager: "#vevent-user-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};

	Core.functions[Core.reference["gamo_vevents_user"]](1, Core.reference["gamo_vevents_user"]);

});