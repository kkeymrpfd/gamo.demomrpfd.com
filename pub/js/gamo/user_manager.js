var user_manager = new function() {

	this.running = 0;

	this.create_user = function(options) {

		/*
		args:
		{
			holder: the selector for the element holding the input items
		}
		*/

		if(user_manager.running == 0) {

			user_manager.running = 1;

			Core.ensure_defaults({
				holder: ''
			});

			var inputs = Core.get_inputs({
				holder: options['holder']
			});
			
			$.post('/?a=admin_create_user&v=json', inputs, function(data) {

				user_manager.running = 0;
				
				var result = $.parseJSON(data);
				
				if(result['error'] != null && result['error'] != '') {

					Core.modal({
				        msg: result['error'],
				        alert: 'error',
				        footer: '<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>'
				    });

				} else {

					Core.modal({
				        msg: 'User has been created!',
				        alert: 'success',
				        footer: '<button class="btn" data-dismiss="modal" aria-hidden="true">Okay</button>'
				    });

					$('#create_user_form').find(':input').val('');
					$('#create_user_group').val('company');
					
				}

			});

		}

	};
	
	this.get = function(options) {
		
		//We are always getting startign from page #2 - and we have only 7 per page
		var page = options['page']+1;
		$.get('/?a=get_users&v=json&page='+options['page']+'&caller=leaderboard', function(data) {

			data = $.parseJSON(data);
			
			user_manager.render(data);
			
			pager.set({
				holder: options['pager'],
				current: data['current_page']-1,
				last: data['last_page']-1,
				getter_id: options['getter_id']
			});

		});

	};

	this.render = function(data, getter_id) { // Render html

		if(data != null
		&& data['users'] != null
		&& data['users'][0] != null
		&& data['users'][0]['user_id'] != null) { // These are valid users

			var html = '<div class="listRow title">'
							+ '<div class="listCell rank">Rank</div>'
							+ '<div class="listCell name">Name</div>'
							+ '<div class="listCell achievement">Achievement Level</div>'
							+ '<div class="listCell points">Points</div>'
						+ '</div>';

			for(k in data['users']) {

				html += '<div class="listRow">'
                    		+ '<div class="listCell rank">#' + data['users'][k]['rank'] + '</div>'
                    		+ '<div class="listCell name">' + data['users'][k]['display_name'] + '</div>'
                    		+ '<div class="listCell achievement">' + data['users'][k]['level'] + '</div>'
                    		+ '<div class="listCell points">' + data['users'][k]['points'] + '</div>'
                    		+ '</div>';

			}

			$('#users-holder').html(html);

		} else {

			$('#users-holder').html("No users found matching this criteria")

		}

	};

};


$(document).ready(function() {

	Core.reference[1] = Core.unique_id();

	Core.functions[Core.reference[1]] = function(page, getter_id) {

		user_manager.get({
			pager: "#users-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};

	Core.functions[Core.reference[1]](1, Core.reference[1]);

});
