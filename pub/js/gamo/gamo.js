var gamo = new function() {
	
	this.notify_to = '';
	this.leaders_done = false;

	/*
	Retrieve and display notifications
	*/
	this.notify = function(options) {

		clearTimeout(gamo.notify_to);

		options = Core.ensure_defaults({
			badge_only: 0
		}, options);

		$.get('/?a=get_notify&v=json&badge_only='+options['badge_only'], function(data) {
			
			try {

				var notify = $.parseJSON(data);
				notify = notify['notify'];
				
				if(notify['records'].length > 0) {

					var html = '';

					for(k in notify['records']) {

						html += notify['records'][k]['msg']+'<br>';

					}

					Core.modal({
						msg: html,
						alert: 'success'
					});

					// Mark notifications as seen
					$.get('/?a=notify_seen&v=json', function(data) {

					});

				}

			} catch(e) {

			}

			gamo.notify_to = setTimeout(function() {

				gamo.notify();

			}, 3000);

		});

	};

	/*
	Display an about page
	*/
	this.about = function(options) {

		gamo.poll({
			timeout: 30000
		});

		var html = '<span style="color:#000">Thanks for registering, you will soon receive an invite from contact@netech.entermarketing.com with your unique link to attend the event. Please make sure accept this to your calendar.'
		+'<br><br><b>Bonus!</b> You have just earned your first 25 points in the Netech portal!'
		+'<br><br>This portal is your one stop shop for anything Netech. You will earn points and badges for every activity completed in the portal, such as downloading resources, attending events, using the #netech hashtag, even inviting your colleagues to the portal gets you points. Then those points turn in to quarterly prizes ranging up to $1000!'
		+'<br><br>What are you waiting for? Start earning points now!</span>';

		Core.modal({
			header: 1,
			title: '<span style="color:#666">Welcome!</span>',
			msg: html,
			footer: '<button class="btn btn-success" data-dismiss="modal" aria-hidden="true">Okay</button>'
		});

	};

	this.update_dash_to = '';
	this.dash_string = '';

	this.update_dash = function(options) {

		if($("[user-img]").length == 0) {

			return false;

		}

		clearTimeout(gamo.update_dash_to);

		options = Core.ensure_defaults({
			preload: 0
		}, options);

		if(options['preload'] >= 0) {

			$.get('/?a=get_user_dash&v=json', function(data) {

				if(data != gamo.dash_string) {

					gamo.dash_string = data;
					
					gamo.render_dash($.parseJSON(data));

				}

				var dash_data = $.parseJSON(data);

			});

		}

		gamo.update_dash_to = setTimeout(function() {

			gamo.update_dash();

		}, 60000);

	};

	this.render_dash = function(options) {
		
		if(options['user'] != null) {

			var user_id = options['user']['user_id'];

			$("[user-display-name='"+user_id+"']").html(options['user']['display_name']);
			$("[user-title='"+user_id+"']").html(options['user']['title']);
			$("[user-company='"+user_id+"']").html(options['user']['company']);
			$("[user-phone='"+user_id+"']").html(options['user']['phone']);
			$("[user-email='"+user_id+"']").html(options['user']['email']);
			$("[user-points='"+user_id+"']").html(options['user']['points']+'');
			$("[user-level='"+user_id+"']").html(options['user']['level']);
			if(options['next_level']['min_points'] != null && options['next_level']['min_points'] > 0) {
				Core.log('here');
				$("[user-level-min='"+user_id+"']").html('Next level: '+options['next_level']['min_points']);

			} else {

				$("[user-level-min='"+user_id+"']").hide();				

			}

		}

		if(options['leaders'] != null) {

			var leaders_html = '';
			var qty = $(this).attr('mini-leaders');

			for(k in options['leaders']['users']) {

				if(k < qty) {

					leaders_html += '<div class="leader">'
                        +'<div class="rank">#'+options['leaders']['users'][k]['rank']+'</div>'
                        +'<div class="name">'+options['leaders']['users'][k]['display_name']+'</div>'
                        +'<div class="points">'+options['leaders']['users'][k]['points']+'</div>'
                    +'</div>';

				}

			}

			$(this).html(leaders_html);

		}

	};

	this.recent_activity_to = '';
	this.recent_activity_string = '';

	this.recent_activity = function(options) {

		clearTimeout(gamo.recent_activity_to);

		options = Core.ensure_defaults({
			holder: "#recent-activity-holder"
		}, options);

		if($(options['holder']).length > 0) {

			$.get('/?a=get_recent_activity&v=json', function(data) {

				if(data != gamo.recent_activity_string) {

					var result = $.parseJSON(data);
					var html = '';
					var descrip = '';

					for(k in result['recent_activity']) {

						descrip = (result['recent_activity'][k]['activity_display']+"")
								.replace('[display-name]', '<strong>'+Core.safe_echo(result['recent_activity'][k]['display_name'])+'</strong>')
								.replace('[points]', '<strong>'+result['recent_activity'][k]['point_value_use']+'</strong>');

						if(k > 0) {

							html += '<div style="background-color:#aaa;height:1px"></div>';

						}

						html += '<div class="media" style="padding:1em">'
		                    		+'<div class="pull-left">'
		                        		+'<img src="/user_img.php?size=small&image='+result['recent_activity'][k]['user_id']+'" class="border-curved" alt="" />'
		                        	+'</div>'
		                        	+'<div class="media-body">'+descrip+'</div>'
		                        +'</div>';

					}

					$(options['holder']).html(html);

					gamo.recent_activity_string = data;

				}

				gamo.recent_activity_to = setTimeout(function() {

					gamo.recent_activity();

				}, 3000);

			});

		}

	};
	
	this.get_dashlets_to = '';
	
	this.get_dashlets = function(options) {

		clearTimeout(gamo.get_dashlets_to);
		


		$.get('/?a=get_dashlets&v=json', function(data) {
		
		try {
			var result = $.parseJSON(data);
			
			gamo.fill_badges(result['user']['has'],result['badges']);
			
			gamo.fill_points(result['user']['points']);
			
			gamo.fill_leaders(result['mini_leaders']['users'],result['user']);
			
			$('#leaderboard-holder.borderless>tbody>tr>td:eq(1)').css({width:  '63%'});

			gamo.get_dashlets_to = setTimeout(function() {

				//gamo.get_dashlets();

			}, 3000);
			
		}catch(e){
			result = '';
		}

		});


	};
	
	this.fill_leaders = function(mini_leaders,user){
		
		var found_self = false;
		var html = '';
		var count = 0;
		
		for(k in mini_leaders) {
			
			if( user['user_id'] == mini_leaders[k]['user_id'] ){
				
				found_self = true;
				
			}

			if( count < 3 ){
				
				html += '<tr>'
							+'<td><strong>#'+mini_leaders[k]['rank']+'</strong></td>'
							+'<td>'+mini_leaders[k]['display_name']+'</td>'
							+'<td class="align-right leaderboard-points"><strong>'+mini_leaders[k]['points']+'</strong></td>'
						+'</tr>';	
				
			}else if( found_self ){
				
				html += '<tr class="self">'
					+'<td><strong>#'+mini_leaders[3]['rank']+'</strong></td>'
					+'<td>'+mini_leaders[3]['display_name']+'</td>'
					+'<td class="align-right leaderboard-points"><strong>'+mini_leaders[3]['points']+'</strong></td>'
				+'</tr>';
				
			}
			if( count == 3){
				
				break;
				
			}
			
			count++;
			
		}
		
		if( found_self == false){
			
			html += '<tr>'
				+'<td><strong>#'+user['rank']+'</strong></td>'
				+'<td>'+user['first_name']+' '+user['last_name']+'</td>'
				+'<td><strong>'+user['points']+'</strong></td>'
			+'</tr>';
			
		}	
		
		$('#leaderboard-holder').html(html);
		
		this.leaders_done = true;
		
	};
	
	this.fill_points = function(points){
		
		$('#points_dash').html(points);
		
	};
	
	this.fill_badges = function(has,all){
		
		var has_badges_ids = new Array();
		
		for(k in has) {
			
			has_badges_ids.push(has[k]['badge_id']);
			
		}
		
		for(k in all) {
			
			if( $.inArray( all[k]['badge_id'], has_badges_ids ) > -1 ){
				
				$('#badge-'+all[k]['badge_id']).attr('src','/img/badges/'+all[k]['badge_id']+'-active.png');
				
			}
			
		}
		
	};

	this.poll_to = '';

	this.poll = function(options) {

		options = Core.ensure_defaults({
			timeout: 3000
		}, options);

		clearTimeout(gamo.poll_to);
		clearTimeout(gamo.notify_to);
		clearTimeout(gamo.update_dash_to);
		
		gamo.poll_to = setTimeout(function() {

			gamo.notify();

		}, options['timeout']);

	};
	
	this.set_top_height_to = '';
	this.height_set = false;

	this.set_top_height = function(options) {

		options = Core.ensure_defaults({
			timeout: 1000
		}, options);

		
		
		gamo.set_top_height_to= setTimeout(function() {

			
			if(gamo.leaders_done && !gamo.height_set){
				var max = 0;
				$(".eqh1").each(function(i, e){ 
					var h = $(e).height();
					if(max == 0){
						max = h;
					}
					else{
						if(h > max)
							max = h;
					}
					console.log(h);
				});
				
				$(".eqh1").each(function(i, e){
					$(e).height(max);
				});
				gamo.height_set=true;
				
				
			}

		}, options['timeout']);

	};
	
	this.page_two_cols = function() {

		$("#page-cols").removeClass("col-md-8").removeClass("col-sm-8").addClass("col-md-12 cold-sm-12");
		$(".submenu").removeClass("col-md-4").removeClass("col-sm-4").addClass("col-md-3 cold-sm-3");

	};

};

$(document).ready(function() {

	gamo.set_top_height();
	gamo.recent_activity();
	gamo.get_dashlets();

	$("button[href!='']").on('click', function() {

		if($(this).hasAttr('href')) {

			window.location = $(this).attr('href');

		}

	});

	$(".support_widget").on('click', function() {
		$('#support-modal').modal('show');
		Core.log('here');
	});

	document.title = 'Dell Overdrive';

	$('body').on('click', '.check-toggle', function(e) {

		e.preventDefault();
		e.stopPropagation();
				
		var checked = $(this).find('input').prop('checked');

		$(this).find('input').prop('checked', !checked);
		$(this).find('span').css('font-weight', ((!checked) ? 'bold' : 'normal') );

		return false;
		
	});


});
