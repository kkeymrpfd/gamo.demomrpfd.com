var submit_action = new function() {

	this.completed = function(options) {

		/*
		args:
		{
			action_types_id:
			user_id:
		}
		*/

		Core.ensure_defaults({
			action_types_id: '',
			user_id: '',
			oncomplete: function() { }
		});

		var inputs = {
			user_id: options['user_id'],
			action_types_id: options['action_types_id']
		};

		$.post('/?a=submit_action&v=json', inputs, function(data) {
			
			var result = $.parseJSON(data);
			
			if(result['error_msg'] != null && result['error_msg'] != '') {

				Core.modal({
			        msg: result['error_msg'],
			        alert: 'error',
			        footer: '<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>'
			    });

			} else {

				Core.modal({
			        msg: 'Step has been marked as completed!',
			        alert: 'success',
			        footer: '<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>'
			    });

			    options['oncomplete']();

			}

		})

	};

};