/*
Retrieves actions that need to be approved by an admin
*/
var admin_approve = new function() {

	this.get = function(options) {

		$.get('/?a=admin_get_pending&v=json&page='+options['start'], function(data) {

			data = $.parseJSON(data);

			if(options['holder'] != 0) {

				

			}

			return data;

		});

	};

	this.generate_html = function(options) {

		/*
		arguments:
			{
				raw: the raw html
			}
		*/
		
		options = Core.ensure_defaults({
			raw: {},
			admin: ($('#admin_user_id').length == 0) ? 0 : 1
		}, options);
		
		if(options['raw']['calls'] != null
		&& options['raw']['calls'][0] != null
		&& options['raw']['calls'][0]['time'] != null) { // The raw data is valid

			var html = '';
			var response_class = '';
			var response_label = '';
			var submit_string = '';

			for(k in options['raw']['calls']) {

				submit_string = 'entry-id="' + options['raw']['calls'][k]['entry_id'] + '" user-id="'+options['raw']['user_id']+'"';
				
				response_class = '';
				response_label = '<a href="#" class="button xsmall centered" attend-confirm="1" '+submit_string+' onclick="return false">Attended</a>'
				+'<a href="#" class="button xsmall red centered noMargin" noattend-confirm="1" '+submit_string+' onclick="return false">Did Not Attend</a>';

				if(options['raw']['calls'][k]['attended'] == 1) {

					response_class = ' attend attended';
					response_label = 'Attended';
			
				} else if(options['raw']['calls'][k]['attended'] == 2) {
					
					response_class = ' attend notAttended';
					response_label = 'Did Not Attend';

				} else if(options['admin'] == 0) {

					response_class = ' attend';
					response_label = 'Pending';

				}

				html += '<div class="listRow">'
				    +'<div class="listCell date">' + options['raw']['calls'][k]['display_time'] + '</div>'
				    +'<div class="listCell callTitle">' + options['raw']['calls'][k]['entry_title'] + '</div>'
				    +'<div class="listCell actions '+response_class+'">'+response_label+'</div>'
				+'</div>';

			}

		} else {
			
			html = 'No entries found';

		}

		return html;

	}

};

// Make it so the tabs work
$(document).ready(function() {

	Core.reference["admin_pending"] = Core.unique_id();

	Core.functions[Core.reference["admin_pending"]] = function(page, getter_id) {

		call_manager.get({
			start: page,
			holder: "#admin-pending",
			pager: "#admin-pending-pager",
			category_id: 'all',
			getter_id: getter_id
		});
		
	};

	//Core.functions[Core.reference[2]](1, Core.reference[2]);

	Core.functions[Core.reference['admin_pending']](1, Core.reference['admin_pending']);
	
});