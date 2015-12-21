var admin_actions = new function() {

	this.action_id = '';

	this.get_filters = function() {

		var filters = {};

		if(Core.trim($('#filter_name').val()) != '') { // Add the user name to the filters list

			filters['user_name'] = $('#filter_name').val();

		}

		if($('#filter_action_type').val() != 'none') { // Add the action type to the filters list

			filters['action_types'] = Array($('#filter_action_type').val());

		}

		filters['active'] = ($('#filter_show_inactive').prop('checked')) ? 2 : 1;

		return filters;

	};

	this.get = function(options) {

		$.get('/?a=get_actions&v=json&page='+options['page']+'&filters='+escape(Core.serialize(admin_actions.get_filters())), function(data) {
			
			data = $.parseJSON(data);
			
			admin_actions.render(data);
			
			pager.set({
				holder: options['pager'],
				current: data['actions_history']['current_page'],
				last: data['actions_history']['last_page'],
				getter_id: options['getter_id']
			});

		});

	};

	this.render = function(data, getter_id) { // Render html
		
		if(data != null
		&& data['actions_history'] != null
		&& data['actions_history']['actions'][0] != null
		&& data['actions_history']['actions'][0]['action_id'] != null) { // These are valid users
			
			var html = '<table cellspacing="0" cellpadding="0" border="0">';
			var use = '';

			for(k in data['actions_history']['actions']) {

				use = data['actions_history']['actions'][k];

				html += 
				'<tr>'
					+ '<td style="font-size:12px;width:160px"><div class="action-date">'+Core.local_time(use['time']) + '</div></td>'
					+ '<td style="width:170px">' + use['user_display_name'] + '</td>'
					+ '<td style="padding:10px">'+Core.points({points:use['point_value_use']})+'</td>'
					+ '<td><div style="width:220px;font-size:13px;overflow:hidden;margin-right:10px">' + use['action_name_display'] + '</div></td>'
					+ '<td><div class="btn" style="margin-right:10px" onclick="admin_actions.remove_points({step:1, action_id:'+use['action_id']+'})">Remove Points</div></td>'
					+ '<td><div class="btn btn-danger" onclick="admin_actions.delete_action({step:1, action_id:'+use['action_id']+'})">Delete</div></td>'
				+ '</tr>'

				Core.log(data['actions_history']['actions'][k]);

				if(use['action_key'] == 'send_invite' || use['action_key'] == 'submit_referral' || use['action_key'] == 'share_resource') {
					
					for(k in use['other_info']) {

						html += 
						'<tr>'
							+ '<td style="font-size:12px;width:160px"><div class="action-date"></div></td>'
							+ '<td style="width:170px;text-align:right">'+Core.ucwords( (use['other_info'][k]['info_type']+'').replace("_", " ") )+':</td>'
							+ '<td style="padding:10px"></td>'
							+ '<td><div style="width:220px;font-size:13px;overflow:hidden;margin-right:10px">'+Core.safe_echo(use['other_info'][k]['info'])+'</div></td>'
							+ '<td></td>'
							+ '<td></td>'
						+ '</tr>'

					}

				}

			}

			html += '</table>';

			$('#actions-holder').html(html);

		} else {

			$('#actions-holder').html("No actions found matching this criteria")

		}

	};

	this.remove_points = function(options) {

		options = Core.ensure_defaults({
			step: 1,
			action_id: -1
		}, options);

		if(options['step'] == 1) {

			Core.modal({
				msg: "Are you sure that you want to remove the points for this activity?",
				header: 0,
				footer: '<button class="btn btn-danger" onclick="admin_actions.remove_points({step:2, action_id:'+options['action_id']+'})">Yes, remove points</div>'
						+ '<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>'
			});

		} else {

			$.get('/?a=modify_actions&v=json&action_id='+options['action_id']+'&point_value_use=0', function(data) {

				var result = $.parseJSON(data);

				if(result['valid'] == 1) {
					
					Core.modal({
						msg: "Your changes have been saved",
						alert: 'success',
						close: 1200
					});

					pager.get({
						holder: '#actions-holder-pager'
					});

				} else {

					Core.modal({
						msg: "There was an error while updating this activity. Your changes might not have been saved",
						alert: 'error'
					});

				}

			});

		}

	}

	this.delete_action = function(options) {

		options = Core.ensure_defaults({
			step: 1,
			action_id: -1
		}, options);

		if(options['step'] == 1) {

			Core.modal({
				msg: "Are you sure that you want to delete this activity?",
				header: 0,
				footer: '<button class="btn btn-danger" delete-id="'+options['action_id']+'">Yes, delete activity</div>'
						+ '<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>'
			});

		} else {

			$.get('/?a=modify_actions&v=json&action_id='+options['action_id']+'&point_value_use=0&active=0', function(data) {

				var result = $.parseJSON(data);

				if(result['valid'] == 1) {
					
					Core.modal({
						msg: "Your changes have been saved",
						alert: 'success',
						close: 1200
					});

					pager.get({
						holder: '#actions-holder-pager'
					});

				} else {

					Core.modal({
						msg: "There was an error while updating this activity. Your changes might not have been saved",
						alert: 'error'
					});

				}

			});

		}

	}

};

$(document).ready(function() {

	$('[delete-id]').live('click', function() {

		admin_actions.delete_action({
			step:2,
			action_id: $(this).attr('delete-id')
		});

	});

	Core.anchor_based.push({
		selector: "filter_name",
		param: "filter_name"
	});

	Core.anchor_based.push({
		selector: "filter_action_type",
		param: "filter_action_type"
	});

	Core.anchor_based_run(Core.anchor_params()['params']);

	Core.reference["admin_actions"] = Core.unique_id();

	Core.functions[Core.reference["admin_actions"]] = function(page, getter_id) {

		admin_actions.get({
			pager: "#actions-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};

	Core.functions[Core.reference["admin_actions"]](1, Core.reference["admin_actions"]);

	$("#get_actions_submit").click(function() {

		Core.functions[Core.reference["admin_actions"]](1, Core.reference["admin_actions"]);

	});

});
