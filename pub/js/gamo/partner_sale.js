var partner_sale = new function() {
	
	this.running = 0;

	this.create = function(options) {

		if(partner_sale.running == 0) {

			partner_sale.running = 1;

			options = Core.ensure_defaults({
				partner_id: $('#new_sale_partner').val(),
				first_type:  $('#new_sale_type').val(),
				product:  $('#new_sale_product').val(),
				amount:  $('#new_sale_amount').val(),
				opp_id:  $('#new_sale_opp_id').val()
			}, options);

			$.post('/?a=create_partner_sale&v=json', options, function(data) {

				partner_sale.running = 0;

				var result = $.parseJSON(data);

				if(result['msg'] != 1) {

					Core.modal({
						msg: result['msg'],
						alert: 'error'
					});

				} else {

					Core.modal({
						msg: "Your sale has been submitted! An administrator will review it within the next 48 hours.",
						alert: 'success',
						close: 4000
					});

					$('#partner-sale-form').find(':input').val('');

					Core.functions[Core.reference["partner_sale"]](1, 'partner_sale');

				}

			});

		}

	};

	this.get = function(options) {

		options = Core.ensure_defaults({
			user_id: $('#admin_user_id').val()
		}, options);

		if(options['user_id'] == '' || options['user_id'] == null) {

			options['user_id'] = Core.user_id;

		}
		
		$.get('/?a=get_partner_sales&v=json&user_id='+options['user_id']+'&page='+options['page'], function(data) {
			
			data = $.parseJSON(data);
			
			partner_sale.render(data);
			
			pager.set({
				holder: options['pager'],
				current: data['partner_sales']['current_page'],
				last: data['partner_sales']['last_page'],
				getter_id: options['getter_id']
			});

			$('.tabs').height($('.tab.curr').outerHeight());

		});

	};

	this.render = function(data, getter_id) { // Render html
		
		if(data != null
		&& data['partner_sales'] != null
		&& data['partner_sales']['sales'][0] != null
		&& data['partner_sales']['sales'][0]['sale_id'] != null) { // These are valid users
			
			var status = '';
			var status_class = '';

			var html = '<table border="0" cellspacing="0" cellpadding="0">'
				+'<tr>'
				+'<td style="width:300px;font-weight:bold;padding:8px">Partner Name</td>'
				+'<td style="width:120px;font-weight:bold;padding:8px">First Type</td>'
				+'<td style="width:200px;font-weight:bold;padding:8px">Product</td>'
				+'<td style="width:120px;font-weight:bold;padding:8px">Amount ($)</td>'
				+'<td style="width:200px;font-weight:bold;padding:8px"></td>'
				+'</tr>';
			
			var is_admin = ($('#admin_user_id').length == 0) ? 0 : 1;
			var first_type = '';
			var bg_color = 'eee';

			for(k in data['partner_sales']['sales']) {

				if(is_admin) {

					if(data['partner_sales']['sales'][k]['status'] == 0) {

						status = '<a href="#" class="button xsmall centered" onclick="return false" partner-sale-accept="'+data['partner_sales']['sales'][k]['sale_id']+'">Approve</a>'
						+'<a href="#" class="button xsmall red centered noMargin" onclick="return false" partner-sale-decline="'+data['partner_sales']['sales'][k]['sale_id']+'">Decline</a>';

					} else if(data['partner_sales']['sales'][k]['status'] == 1) {

						status = 'Approved';
						status_class = ' accepted';

					} else if(data['partner_sales']['sales'][k]['status'] == 2) {

						status = 'Declined';
						status_class = ' declined';

					}

				} else {

					if(data['partner_sales']['sales'][k]['status'] == 0) {

						status = 'Pending Approval';
						status_class = ' accepted';

					} else if(data['partner_sales']['sales'][k]['status'] == 1) {

						status = 'Approved';
						status_class = ' accepted';

					} else if(data['partner_sales']['sales'][k]['status'] == 2) {

						status = 'Declined';
						status_class = ' declined';

					}

				}

				first_type = (data['partner_sales']['sales'][k]['first_type'] == 1) ? "First Sale" : "New Product";
				bg_color = (bg_color == 'eee') ? 'fff' : 'eee';

				html += '<tr style="background-color:#'+bg_color+'">'
                        + '<td style="padding:8px">'+data['partner_sales']['sales'][k]['company']+'</td>'
                        + '<td style="padding:8px">'+first_type+'</td>'
                        + '<td style="padding:8px">'+Core.escape_html(data['partner_sales']['sales'][k]['product'])+'</td>'
                        + '<td style="padding:8px">'+Core.escape_html(data['partner_sales']['sales'][k]['amount'])+'</td>'
                        + '<td style="padding:8px">'+status+'</div>'
                   + '</tr>';

			}

			$('#partner-sales-holder').html(html+'</table>');

		} else {

			$('#partner-sales-holder').html("No actions found matching this criteria")

		}

	};

	this.approve = function(options) {

		options = Core.ensure_defaults({
			sale_id: -1,
			step: 1
		}, options);

		if(options['step'] == 1) {

			Core.modal({
				msg: "Are you sure that you want to approve this sale",
				header: 0,
				footer: '<button class="btn btn-success" onclick="partner_sale.approve({step:2, sale_id:'+options['sale_id']+'})">Yes, approve sale</div>'
						+ '<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>'
			});

		} else {

			if(partner_sale.running == 0) {

				partner_sale.running = 1;

				var input = {
					sale_id: options['sale_id'],
					status: 1
				};

				$.post('/?a=admin_partner_sale_status&v=json', input, function(data) {
					
					partner_sale.running = 0;

					var result = $.parseJSON(data);

					if(result['msg'] != 1) {

						Core.modal({
							msg: result['msg'],
							alert: 'error',
						});

					} else {

						Core.modal({
							msg: "Sale has been approved!",
							alert: 'success',
							close: 1200
						});

						Core.functions[Core.reference["partner_sale"]](1, 'partner_sale');

					}

				});

			}

		}

	};

	this.decline = function(options) {

		options = Core.ensure_defaults({
			sale_id: -1,
			step: 1
		}, options);

		if(options['step'] == 1) {

			Core.modal({
				msg: "Are you sure that you want to decline this sale",
				header: 0,
				footer: '<button class="btn btn-danger" onclick="partner_sale.decline({step:2, sale_id:'+options['sale_id']+'})">Decline sale</div>'
						+ '<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>'
			});

		} else {

			if(partner_sale.running == 0) {

				partner_sale.running = 1;

				var input = {
					sale_id: options['sale_id'],
					status: 2
				};

				$.post('/?a=admin_partner_sale_status&v=json', input, function(data) {

					partner_sale.running = 0;

					var result = $.parseJSON(data);

					if(result['msg'] != 1) {

						Core.modal({
							msg: result['msg'],
							alert: 'error',
						});

					} else {

						Core.modal({
							msg: "Sale has been declined",
							alert: 'success',
							close: 1200
						});

						Core.functions[Core.reference["partner_sale"]](1, 'partner_sale');

					}

				});

			}

		}

	};

};

$(document).ready(function() {

	Core.reference["partner_sale"] = 'partner_sale';

	Core.functions[Core.reference["partner_sale"]] = function(page, getter_id) {

		partner_sale.get({
			pager: "#partner-sale-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};

	Core.functions[Core.reference["partner_sale"]](1, 'partner_sale');

	$(document).on('click', '[partner-sale-accept]', function(data) {

		partner_sale.approve({
			sale_id: $(this).attr('partner-sale-accept'),
			step: 1
		});

	});

	$(document).on('click', '[partner-sale-decline]', function(data) {

		partner_sale.decline({
			sale_id: $(this).attr('partner-sale-decline'),
			step: 1
		});

	});

});
