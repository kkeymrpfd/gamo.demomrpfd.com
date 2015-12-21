var pager = new function() {

	this.set = function(options) {

		/*
		arguments:
			holder: where to store the generated html
			current: the current page
			last: the last page
			getter_id: the getter function to use for retrieving pages,
		*/

		if(options == null) {

			options = Array();

		}
		
		if(options['current'] < options['last']) {

			var next_page = 'Core.functions['+options['getter_id']+']('+(options['current']*1+1)+','+options['getter_id']+')';

		} else {

			var next_page = 'return false';

		}

		var html = 
			'<form class="form-inline" onsubmit="Core.functions['+options['getter_id']+']($(this).find(\'input\').val(),'+options['getter_id']+');return false;">'
				+ '<div onclick="Core.functions['+options['getter_id']+']('+(options['current']*1-1)+','+options['getter_id']+')" class="btn orangebackground" style="display:inline-block;margin-right:8px"><</div>'
				+ '<input type="text" class="input-small" placeholder="#" style="width:35px;height:30px;font-size:13px;display:inline-block;margin-top:12px" value="'+options['current']+'"> of '
				+ '<div class="page-num" style="display:inline-block">'+options['last']+'</div>'
				+ '<div onclick="'+next_page+'" class="btn orangebackground" style="display:inline-block;margin-left:8px">></div>'
			+ '</form>';

		$(options['holder']).html(html).attr('pager-getter', options['getter_id']);

		if(options['last'] > 0) {

			$(options['holder']).fadeIn(200);

			var cont_id = ($(options['holder']).attr('id')+'').replace(/-pager/, '');
			
			$('#'+cont_id).hide().fadeIn(300);

		} else {

			$(options['holder']).hide();

		}

		if(options['last'] <= 1) {

			$(options['holder']).hide();

		}

	};

	/*
	Get a page for a pager
	*/
	this.get = function(options) {

		/*
		arguments:
			pager: selector for the pager
			page: which page to go to (if set to "get", will retrieve the page from the pager input field)
		*/
		
		options = Core.ensure_defaults({
			holder: "",
			page: "get"
		}, options);

		if(options['holder'] != '') {

			var holder = $(options['holder']);
			
			if(options['page'] == 'get') {

				options['page'] = holder.find(':input').val();

			}

			Core.functions[holder.attr('pager-getter')](options['page'], holder.attr('pager-getter'));

		}

	};

};