var admin_users = new function() {

	this.get_filters = function() {

		var filters = {};

		if(Core.trim($('#filter_name').val()) != '') { // Add the user name to the filters list

			filters['name'] = $('#filter_name').val();

		}

		if($('#filter_action_type').val() != 'none') { // Add the action type to the filters list

			filters['action_types'] = Array();

			filters['action_types'].push({
				action_types_id: $('#filter_action_type').val(),
				qty: $('#filter_action_type_qty').val()
			});

		}

		if($('#filter_badge').val() != 'none') { // Add the action type to the filters list

			filters['badges'] = Array($('#filter_badge').val());

		}

		return filters;

	};

	this.get = function(options) {

		$.get('/?a=get_users&v=json&page='+options['page']+'&filters='+escape(Core.serialize(admin_users.get_filters())), function(data) {

			data = $.parseJSON(data);
			
			admin_users.render(data);
			
			pager.set({
				holder: options['pager'],
				current: data['current_page'],
				last: data['last_page'],
				getter_id: options['getter_id']
			});

		});

	};

	this.render = function(data, getter_id) { // Render html

		if(data != null
		&& data['users'] != null
		&& data['users'][0] != null
		&& data['users'][0]['user_id'] != null) { // These are valid users

			var html = '';

			for(k in data['users']) {

				html += '<div class="board board-hover" style="display:inline-block;padding:10px;width:380px;margin:8px" onclick="window.location=\'/?a=view_admin&p=admin_user&user_id='+data['users'][k]['user_id']+'\'">'
					+ '<table border="0" cellspacing="0" cellpadding="0">'
					+ '<tr>'
						+ '<td valign="top"><div class="user-img-mid"><img src="/get_user_img/'+data['users'][k]['user_id']+'.png" class="img-fit"></div></td>'
						+ '<td width="10"></td>'
						+ '<td valign="top" style="text-align:left">'
						+ '<b>'+data['users'][k]['display_name']+'</b>'
						+ '<br>'+data['users'][k]['company']+''
						+ '<br>'+data['users'][k]['email']+''
						+ '<br><div class="points-up" style="margin:7px">'+data['users'][k]['points']+' pts</div>'
						+ '<br>Rank: <b>'+data['users'][k]['rank']+'</b>'
						+ '<br>Level: '+data['users'][k]['level']+''
						+ '</td>'
					+ '</tr>'
					+ '</table>'
					+ '</div>'

			}

			$('#users-holder').html(html);

		} else {

			$('#users-holder').html("No users found matching this criteria")

		}

	};

};

$(document).ready(function() {

	Core.anchor_based.push({
		selector: "filter_name",
		param: "filter_name"
	});

	Core.anchor_based.push({
		selector: "filter_badge",
		param: "filter_badge"
	});

	Core.anchor_based_run(Core.anchor_params()['params']);
	
	$("#get_users_submit").click(function() {

		Core.functions[Core.reference[1]](1, Core.reference[1]);

	});

	Core.reference[1] = Core.unique_id();

	Core.functions[Core.reference[1]] = function(page, getter_id) {

		admin_users.get({
			pager: "#users-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};

	Core.functions[Core.reference[1]](1, Core.reference[1]);

});
