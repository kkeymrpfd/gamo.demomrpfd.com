var simulator = new function() {
	
	this.total_pts = 0; // How many total points have been added

	this.simulate = function(options) {

		options = Core.ensure_defaults({
			user_id: -1,
			action_types_id: -1
		}, options);
		
		$.get('/?a=simulate_action&v=json&admin=eee111&user_id='+options['user_id']+'&action_types_id='+options['action_types_id'], function(data) {
			
			var result = $.parseJSON(data);
			
			if(result['points'] == null || result['error'] != null) {

				Core.modal({
					msg: "<center>There was an error while processing this request:<br><br>"+result['error_msg']+'</center>',
					alert: 'error'
				});

				return false;

			}

			simulator.total_pts += result['points']*1;

			simulator.set_points(simulator.total_pts);

		});

	};

	this.set_points = function(points) {

		simulator.total_pts = points;
		
		$('#total-points').hide().html(simulator.total_pts+' total points').fadeIn(200);

	};

};
