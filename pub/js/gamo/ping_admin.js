var ping_admin = new function() {
	
	this.running = 0;

	this.create = function(options) {

		if(ping_admin.running == 0) {

			ping_admin.running = 1;

			options = Core.ensure_defaults({
				msg: $('#ping-admin-msg').val()
			}, options);

			$.post('/?a=create_ping_admin&v=json', options, function(data) {
				
				ping_admin.running = 0;

				var result = $.parseJSON(data);

				if(result['msg'] != 1) {

					Core.modal({
						msg: result['msg'],
						alert: 'error'
					});

				} else {

					Core.modal({
						msg: "Your message has been sent to an administrator. You should receive a response within the next 24 to 48 hours",
						alert: 'success',
						close: 1500
					});

					$('#ping-admin-msg').val('');

				}

			});

		}

	};

	this.get = function(options) {

		options = Core.ensure_defaults({
			submissions_only: 0,
			holder: '#ping-msgs-holder'
		}, options);

		$.get('/?a=admin_get_pings&v=json&page='+options['page']+'&submissions_only='+options['submissions_only'], function(data) {
			
			data = $.parseJSON(data);
			data['holder'] = options['holder'];

			ping_admin.render(data);
			
			pager.set({
				holder: (options['holder']).replace('-holder', '-pager'),
				current: data['ping_msgs']['current_page'],
				last: data['ping_msgs']['last_page'],
				getter_id: options['getter_id']
			});
			
			$('.tabs').height($('.tab.curr').outerHeight());

		});

	};

	this.render = function(data, getter_id) { // Render html
		
		if(data != null
		&& data['ping_msgs'] != null
		&& data['ping_msgs']['msgs'] != null
		&& data['ping_msgs']['msgs'][0] != null
		&& data['ping_msgs']['msgs'][0]['msg_id'] != null) { // These are valid users
			
			var status = '';
			var status_class = '';

			var html = '<div class="listRow title">'
                +'<div class="listCell user">User</div>'
                +'<div class="listCell message">Message</div>'
                +'<div class="listCell dismiss">&nbsp;</div>'
                +'<div class="listCell jump">&nbsp;</div>'
            +'</div>';
			
			for(k in data['ping_msgs']['msgs']) {

				html += '<div class="listRow">'
                    +'<div class="listCell user">'+data['ping_msgs']['msgs'][k]['display_name']+'</div>'
                    +'<div class="listCell message">'+Core.escape_html(data['ping_msgs']['msgs'][k]['msg'])+'</div>'
                    +'<div class="listCell dismiss"><a href="#" class="button red centered xsmall" onclick="ping_admin.dismiss({step: 1, msg_id: '+data['ping_msgs']['msgs'][k]['msg_id']+' })">Dismiss</a></div>'
                    +'<div class="listCell jump"><a href="/?a=admin_user_page&user_id='+data['ping_msgs']['msgs'][k]['user_id']+'" class="button centered xsmall">Jump to User</a></div>'
                +'</div>';

			}

			$(data['holder']).html(html);

		} else {

			$(data['holder']).html("No pending messages");

		}

	};

	this.dismiss = function(options) {

		Core.ensure_defaults({
			msg_id: -1,
			step: 1
		});

		if(options['step'] == 1) {

			Core.modal({
				msg: "Are you sure that you want to dismiss this message?",
				header: 0,
				footer: '<button class="btn btn-danger" onclick="ping_admin.dismiss({step:2, msg_id:'+options['msg_id']+'})">Yes, dismiss message</div>'
						+ '<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>'
			});

		} else {

			if(ping_admin.running == 0) {

				ping_admin.running = 1;

				$.post('/?a=admin_dismiss_ping&v=json', options, function(data) {
					
					ping_admin.running = 0;

					var result = $.parseJSON(data);

					if(result['msg'] != 1) {

						Core.modal({
							msg: "There was an error while processing your request. Please refresh the page and try again.",
							alert: 'error'
						});

	 				} else {

	 					Core.modal({
							msg: "Message has been dismissed!",
							alert: 'success',
							close: 2000
						});

						Core.functions[Core.reference["ping_msgs"]](1, "ping_msgs");
						Core.functions[Core.reference["ping_msgs_actions"]](1, "ping_msgs");

	 				}

				});

			}

		}

	};

};

$(document).ready(function() {
	
	$('#ping-admin-create').click(function() {
		
		ping_admin.create();

	});

});
