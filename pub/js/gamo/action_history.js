/*
Retrieves a user's actions history
*/
var action_history = new function() {

	this.get = function(options) {

		/*
		arguments:
			start: the bth row to begin from
			category_id: the category for the actions
			holder: where to store the html records (by default set to -1, which means no holder and just the data should be retrieved)
			pager: where to store the pager (by default set to -1, which  means no pager)
			getter_id: which getter functon to use to retrieve a page (-1 means set a new getter)

		Returns:
			if successful:
			{
				records: the retrieved records
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/
		
		options = Core.ensure_defaults({
			start: 0,
			category_id: 0,
			holder: 0,
			pager: 0,
			getter_id: 0,
			page_jump: 1
		}, options);


		$.get('/?a=get_action_history&v=json&page='+options['start']+'&category_id='+options['category_id'], function(data) {
			
			data = $.parseJSON(data);

			if(options['holder'] != 0) {

				var html = action_history.generate_html({
					raw: data['actions_history']
				});
				
				$(options['holder']).html(html);

				$(options['holder']).attr('category-id', options['category_id']);
				$(options['holder']).attr('getter-id', options['category_id']);
				
				if(options['pager'] != 0) { // Create a pager

					pager.set({
						holder: options['pager'],
						current: data['actions_history']['current_page'],
						last: data['actions_history']['last_page'],
						getter_id: options['getter_id'],
						page_jump: options['page_jump']
					});

				}

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
			raw: {}
		}, options);
			
		if(options['raw']['actions'] != null
		&& options['raw']['actions'] != null
		&& options['raw']['actions'][0] != null
		&& options['raw']['actions'][0]['time'] != null) { // The raw data is valid

			var html = '<div class="listRow title">'
                        +'<div class="listCell width35">Date &amp; Time</div>'
                        +'<div class="listCell width50">Action</div>'
                        +'<div class="listCell width15">Points</div>'
                    +'</div>';

			var action_name = '';
			
			for(k in options['raw']['actions']) {
				
				/*
				action_name = (options['raw']['actions'][k]['action_name_display']+'').replace('Mention ', 'Mentioned ').replace('Like ', 'Liked ').replace('Follow ', 'Followed ').replace('QR Code', 'Scanned QR Code ');

				html += '<div class="listRow">'
                	+'<div class="description listCell"><strong>' + action_name + '</strong></div>'
                	+'<div class="points listCell green"><strong>+' + options['raw']['actions'][k]['point_value_use'] +  ' pts</strong></div>'
            	+'</div>';
            	*/

            	action_name = options['raw']['actions'][k]['action_name_display'];

            	html += '<div class="listRow">'
                        +'<div class="listCell width35">'+Core.local_time(options['raw']['actions'][k]['datetime'])+'</div>'
                        +'<div class="listCell width50">'+options['raw']['actions'][k]['action_name_display']+'</div>'
                        +'<div class="listCell width15 highlight">'+options['raw']['actions'][k]['point_value_use']+'</div>'
                    +'</div>';

			}

		} else {
			
			html = '(No actions taken yet)';

		}

		return html;

	}

};

// Make it so the tabs work
$(document).ready(function() {

	Core.reference["all_getter"] = Core.unique_id();

	Core.functions[Core.reference["all_getter"]] = function(page, getter_id) {

		action_history.get({
			start: page,
			holder: "#all-actions",
			pager: "#all-actions-pager",
			category_id: 'all',
			getter_id: getter_id,
			page_jump: 0
		});

	};

	//Core.functions[Core.reference[2]](1, Core.reference[2]);

	$("a[data-toggle=\"tab\"]").on("shown", function (e) {
		  
			var getter = $(e.target).attr("getter-id");

			if(getter != null) {

		  		Core.functions[Core.reference[getter]](1, Core.reference[getter]);

		  	}

	});
	
});