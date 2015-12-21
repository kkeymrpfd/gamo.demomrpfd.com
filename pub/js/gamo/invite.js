var gamo_invite = new function() {

	this.use_event = -1;

	/*
	Preview the invite
	*/
	this.get_events = function(options){
		
		$.get("/?a=get_vevents_new&page="+options['page'])
		.done(function(data){
			
			var result = $.parseJSON(data);
			
			if(result['actions_history']['actions'].length > 0) {
				
				var html = '';
				
				for(k in result['actions_history']['actions']){
					html += '<div class="item">'
                            	+'<div class="fadeHeader">'
                                	+'<h5>' + result['actions_history']['actions'][k]['title'] + '</h5>'
                                	+'<h6>' + Core.local_time(result['actions_history']['actions'][k]['date_time'], 'dddd, MMMM D, YYYY @ h:mm a') + '</h6>'
                                +'</div>'
                                +'<p>' + result['actions_history']['actions'][k]['description'] + '</p>'
                                +'<a href="#" select-vevent="' + result['actions_history']['actions'][k]['id'] + '" onclick="return false" class="button thirdLeft">Select</a>'
                               +'</div>';
				}
				
				pager.set({
					holder: options['pager'],
					current: result['actions_history']['current_page'],
					last: result['actions_history']['last_page'],
					getter_id: options['getter_id']
				});
				
				
			}else {

				var html = 'There are no events.';

			}

			$('#events-list-holder').html(html).show();

		})
		.fail(function(){
			
		});
	};
	
	
	this.preview = function() {

		$('#invite-result').hide();

		var settings = {
			to_name: $('#invite_name').val(),
			to_company: $('#invite_company').val(),
			to_title: $('#invite_title').val(),
			to_email: $('#invite_email').val(),
			event_id: gamo_invite.use_event
		};

		var error = '';

		if(settings['event_id'] == -1) {

			error = "Please select an event to invite this person to";

		} else if(settings['to_name'] == '') {

			error = "Please enter the name of the person you wish to invite";

		} else if(settings['to_title'] == '') {

			error = "Please enter the title of the person you wish to invite";

		} else if(settings['to_company'] == '') {

			error = "Please enter the company of the person you wish to invite";

		} else if(settings['to_email'] == '') {

			error = "Please enter the email of the person you wish to invite";

		} else {
			
			if(settings['to_email'].indexOf('@gmail.') != -1
	    		|| settings['to_email'].indexOf('@hotmail.') != -1
	    		|| settings['to_email'].indexOf('@yahoo.') != -1
	    		|| settings['to_email'].indexOf('@aol.') != -1
	    		|| settings['to_email'].indexOf('@msn.') != -1) {

	    		error = "Personal e-mail addresses are not eligible to receive invites";

	    	}

		}

		if(error != '') {

			$('#invite-result').hide().html('<div class="alert alert-error">'+error+'</div>').fadeIn(250);

		    return false;

		}

		// Get invite message
		$.post('/?a=invite&p=preview&v=json', settings, function(data) {
			
			var msg = '<div style="color:#333">This is the message that will be sent:';
			
			try {

				var result = $.parseJSON(data);
				
				msg += '<br><br>'+result['preview']+'</div>';

			} catch(e) {

				Core.process_error();

			    return false;

			}
			
			Core.modal({
		        msg: msg,
		        footer: '<button class="button" aria-hidden="true" id="send-invite">Send Invite</button>'
		    });

		});

	};

	/*
	Send the invite
	*/
	this.send_invite = function() {

		$('#invite-result').hide();

		var settings = {
			to_name: $('#invite_name').val(),
			to_company: $('#invite_company').val(),
			to_title: $('#invite_title').val(),
			to_email: $('#invite_email').val(),
			event_id: gamo_invite.use_event
		};

		// Get invite message
		$.post('/?a=invite&p=send&v=json', settings, function(data) {
			
			try {

				var result = $.parseJSON(data);

				if(result['success'] == null && result['error'] == null) {

					Core.process_error();

				} else if(result['error'] != null) {

					Core.modal({
				        msg: result['error'],
				        alert: 'error',
				        footer: '<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>'
				    });

				} else {

					Core.modal({
				        msg: "Your invite has been sent!",
				        alert: 'success',
				        footer: '<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>'
				    });
					
					$('#invite_name').val('');
					$('#invite_company').val('');
					$('#invite_title').val('');
					$('#invite_email').val('');

				    setTimeout(function() {

				    	$('#result-modal').modal('hide');

				    }, 2000);

				    Core.functions[Core.reference["gamo_get_invited"]](1, Core.reference["gamo_get_invited"]);
				    $('#invite-result').hide();

				    gamo.update_dash();

				}

			} catch(e) {

				Core.process_error();

			    return false;

			}

		});

	};

	/*
	Retrieve a list of people that this user invited
	*/
	this.get_invited = function(options) {

		$.get('/?a=invite&p=get_invited&v=json&page='+options['page'], function(data) {

			var result = $.parseJSON(data);
			
			if(result['actions_history']['invites'].length > 0) {

				var html = '<div class="list">'
                    +'<div class="listRow title">'
                        +'<div class="listCell width25">Name</div>'
                        +'<div class="listCell width20">Company</div>'
                        +'<div class="listCell width15">Status</div>'
                        +'<div class="listCell width15">Points</div>'
                        +'<div class="listCell width25">&nbsp;</div>'
                    +'</div>';

				var resend = '';

				for(k in result['actions_history']['invites']) {

					if(result['actions_history']['invites'][k]['status'] != 'Invited') {

						resend = '';

					} else if(result['actions_history']['invites'][k]['allow_resend'] == 1) {

						resend = '<a href="#" onclick="gamo_invite.resend(\''+Core.safe_echo( result['actions_history']['invites'][k]['email'] )+'\');return false" class="button xsmall noMargin">Resend Invite</a>';

					}

					html += '<div class="listRow">'
	                            +'<div class="listCell width25">'+Core.safe_echo( result['actions_history']['invites'][k]['to_name'] )+'</div>'
	                            +'<div class="listCell width20">'+Core.safe_echo( result['actions_history']['invites'][k]['to_company'] )+'</div>'
	                            +'<div class="listCell width15">'+Core.safe_echo( result['actions_history']['invites'][k]['status'] )+'</div>'
	                            +'<div class="listCell width15 highlight">'+result['actions_history']['invites'][k]['points']+'</div>'
	                            +'<div class="listCell width25">'+resend+'</div>'
	                        +'</div>';

				}

				html += '</div>';
				
				pager.set({
					holder: options['pager'],
					current: result['actions_history']['current_page'],
					last: result['actions_history']['last_page'],
					getter_id: options['getter_id']
				});

			} else {

				var html = 'You have not invited anyone yet.';

			}

			$('#invite-list-holder').html(html);

		});

	};

	// Resend an invite
	this.resend = function(email) {
		
		var info = {
			to_email: email
		};

		$.post('/?a=resend_invite&v=json', info, function(data) {
			
			var result = $.parseJSON(data);

			if(result['error'] != null && result['error'] != '') {

				Core.modal({
			        msg: result['error'],
			        alert: 'error',
			        footer: '<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>'
			    });

			} else {

				Core.modal({
			        msg: "Your invite has been resent!",
			        alert: 'success',
			        footer: '<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>'
			    });

			    setTimeout(function() {

			    	$('#result-modal').modal('hide');

			    }, 2000);

			}

		});

	};

};

$(document).ready(function() {

	$(document).on('click', '[select-vevent]', function() {

		if($(this).attr('vevent-selected') == 1) {

			$(this).attr('vevent-selected', 0).css('opacity', 1);
			gamo_invite.use_event = -1;

		} else {

			$('[select-vevent]').css('opacity', 1);

			$(this).css('opacity', 0.4).attr('vevent-selected', 1);

			gamo_invite.use_event = $(this).attr('select-vevent');

		}

	});

    $("#approve-invite").click(function() {

        gamo_invite.preview();

    });

    $(document).on("click", "#send-invite", function() {
        
        gamo_invite.send_invite();

    });
    
    Core.reference["gamo_get_invited"] = Core.unique_id();

	Core.functions[Core.reference["gamo_get_invited"]] = function(page, getter_id) {

		gamo_invite.get_invited({
			pager: "#invite-list-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};

	Core.functions[Core.reference["gamo_get_invited"]](1, Core.reference["gamo_get_invited"]);
	
	
	Core.reference["gamo_get_events"] = Core.unique_id();

	Core.functions[Core.reference["gamo_get_events"]] = function(page, getter_id) {

		gamo_invite.get_events({
			pager: "#events-list-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};


	Core.functions[Core.reference["gamo_get_events"]](1, Core.reference["gamo_get_events"]);

});
