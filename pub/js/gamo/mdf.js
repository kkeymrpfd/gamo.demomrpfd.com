var mdf = new function() {
	
	this.get_packages = function() {

		var params = {
			bucket_category_ids: [],
			vendor_entity_ids: [],
			category_ids: [],
			quarter_ids: [1]
		};

		$("[data-mdf-bucket-category-id]").each(function() {

			if($(this).prop('checked')) {

				params.bucket_category_ids.push($(this).attr('data-mdf-bucket-category-id'));

			}

		});

		$("[data-mdf-vendor-entity-id]").each(function() {

			if($(this).prop('checked')) {

				params.vendor_entity_ids.push($(this).attr('data-mdf-vendor-entity-id'));

			}

		});

		$("[data-mdf-category-id]").each(function() {

			if($(this).prop('checked')) {

				params.category_ids.push($(this).attr('data-mdf-category-id'));

			}

		});

		$.get('/?a=get_mdf_packages&v=json', params, function(data) {

			data = $.parseJSON(data);
						var html = '';
			var categories = '';
			var packages = data['mdf']['packages']['packages'];

			for(var k in packages) {
				
				categories = ('category_names' in packages[k]) ? '<br>'+packages[k]['category_names'].join(", ") : '';

				html += '<div class="row">'
					+'<div class="col-lg-12">'
						+'<div class="panel panel-default">'
							+'<div class="panel-heading">'
								+'<h3 class="panel-title">'+packages[k]['vendor_name']+' - '+packages[k]['name']+' <div class="pull-right">'+packages[k]['display_price']+'</div></h3>'
							+'</div>'
							+'<div class="panel-body" style="font-size:1em">'
								+'<div class="row">'
									+'<div class="col-lg-3">'
										+'<b>Program Type</b>'
										+categories
										+'<br><br><b>Line of Business</b>'
										+'<br>'+packages[k]['bucket_name']
									+'</div>'
									+'<div class="col-lg-9">'
										+'<b>Deliverables</b><br>'
										+packages[k]['description']
									+'</div>'
								+'</div>'
								+'<a href="/?p=mdf_order&package_id='+packages[k]['package_id']+'" class="btn btn-primary pull-right" style="margin-top:12px">Order</a>'
							+'</div>'
						+'</div>'
					+'</div>'
				+'</div>';

			}

			$("#mdf-packages-list").hide().html(html).fadeIn(250);
			

		});

	};

	this.get_activities = function() {

		var params = {
			bucket_category_ids: [],
			vendor_entity_ids: [],
			category_ids: [],
			quarter_ids: [1]
		};

		$("[data-mdf-bucket-category-id]").each(function() {

			if($(this).prop('checked')) {

				params.bucket_category_ids.push($(this).attr('data-mdf-bucket-category-id'));

			}

		});

		$("[data-mdf-vendor-entity-id]").each(function() {

			if($(this).prop('checked')) {

				params.vendor_entity_ids.push($(this).attr('data-mdf-vendor-entity-id'));

			}

		});

		$("[data-mdf-category-id]").each(function() {

			if($(this).prop('checked')) {

				params.category_ids.push($(this).attr('data-mdf-category-id'));

			}

		});

		$.get('/?a=get_mdf_activities&v=json', params, function(data) {

			data = $.parseJSON(data);
						var html = '';
			var categories = '';
			var activities = data['mdf']['activities']['activities'];

			Core.log(activities);

			for(var k in activities) {
				
				categories = ('category_names' in activities[k]['package']) ? '<br>'+activities[k]['package']['category_names'].join(", ") : '';

				html += '<div class="row">'
					+'<div class="col-lg-12">'
						+'<div class="panel panel-default">'
							+'<div class="panel-heading">'
								+'<h3 class="panel-title"><span style="color:#777">'+activities[k]['display_order_date']+ '&nbsp;&nbsp;&nbsp;&nbsp;</span> '+activities[k]['package']['vendor_name']+' - '+activities[k]['package']['name']+' <div class="pull-right">$'+activities[k]['price']+'</div></h3>'
							+'</div>'
							+'<div class="panel-body" style="font-size:1em">'
								+'<div class="row">'
									+'<div class="col-lg-3">'
										+'<b>Program Type</b>'
										+categories
										+'<br><br><b>Line of Business</b>'
										+'<br>'+activities[k]['package']['bucket_name']
									+'</div>'
									+'<div class="col-lg-9">'
										+'<b>Deliverables</b><br>'
										+activities[k]['package_option']['description']
									+'</div>'
								+'</div>'
								+'<div class="pull-right" style="margin-top:20px">'
								+'<button class="btn btn-default" data-mdf-delete="'+activities[k]['mdf_activity_id']+'" style="color:#444;margin-right:20px">Delete</button>'
								+'<a href="/?p=mdf_order&package_id='+activities[k]['package']['package_id']+'" class="btn btn-default" style="color:#444;margin-right:20px">Proof of Execution</a>'
								+'<a href="/?p=mdf_order&mdf_activity_id='+activities[k]['mdf_activity_id']+'" class="btn btn-default" style="color:#444">Edit</a>'
								+'<a href="http://mrpfd.com/dm" target="_blank" class="btn btn-primary" style="margin-left:50px">View Campaign</a>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'
				+'</div>';

			}

			if(html == '') {

				html = '<center>There are currently no activities to display.</center>'

			}

			$("#mdf-activities-list").hide().html(html).fadeIn(250);
			

		});

	};

	this.use_package_id = -1;
	this.use_quarter_id = -1;

	this.submit_order = function() {

		var params = Core.get_inputs({
			holder: '#mdf-order-form',
			visible_only: true
		});

		params = {
			package_id: mdf.use_package_id,
			packages_option_id: $('#packages_option_id').val(),
			quarter_id: mdf.use_quarter_id,
			mdf_activity_id: mdf.mdf_activity_id,
			mdf_form: params
		};

		Core.log(params);

		$("#mdf_order_result_h").hide();

		$.get('/?a=mdf_save_activity&v=json', params, function(data) {

			try {

				data = $.parseJSON(data);

			} catch(e) {

				data['result']['error_msg'] = 'There was an error while processing your request. Please refresh the page and try again.';

			}

			if( !('result' in data) ) {

				data['result']['error_msg'] = 'There was an error while processing your request. Please refresh the page and try again.';

			}

			if('error_msg' in data['result']) {

				var html = '<div class="alert alert-danger">'+data['result']['error_msg']+'</div>';
				$("#mdf_order_result_h").html(html).fadeIn(300);

				$('html,body').animate({
				   scrollTop: $("#mdf_order_result_h").offset().top - 10
				});

				return false;

			}

			window.location = '/?p=mdf';

		});

	};

	this.mdf_activity_id = -1;

	this.delete_activity = function(options) {

		if(options == 0) {

			Core.modal({
				msg: 'Are you sure that you want to delete this marketing activity?',
				footer: '<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button> <button onclick="mdf.delete_activity(1)" class="btn btn-danger" style="margin-left:20px" aria-hidden="true">Delete Activity</button>'
			});

		} else if(options == 1) {

			Core.modal({
				msg: 'Once you delete a marketing activity, it cannot be undone. Are you sure that you want to delete this activity?',
				footer: '<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Cancel</button> <button onclick="mdf.delete_activity(2)" class="btn btn-danger" style="margin-left:20px" aria-hidden="true">I\'m, sure, delete this activity</button>'
			});

		} else if(options == 2) {

			var params = {
				mdf_activity_id: mdf.mdf_activity_id
			};

			$.get('/?a=delete_mdf_activity&v=json', params, function(data) {
				Core.log(data);
				try {

					data = $.parseJSON(data);

				} catch(e) {

					data = {
						error_code: 0,
						error_msg: 'There was an error while processing your request. Please refresh the page and try again.'
					};

				}

				if(data['deleted'] != 1 && data['error_msg'] == undefined) {

					data = {
						error_code: 0,
						error_msg: 'There was an error while processing your request. Please refresh the page and try again.'
					};

				}

				if(Core.has_error(data)) {

					Core.modal({
						msg: data['error_msg'],
						alert: 'danger'
					});

				} else {

					Core.modal({
						msg: "Your activity has been successfully deleted.",
						alert: 'success'
					});

					mdf.get_activities();

				}

			});

		}

	};

	this.prefill = function(fields) {

		fields = $.parseJSON(fields);

		var el = '';

		for(var id in fields) {

			el = $('#'+id);

			if(el.is(':checkbox')) {

				el.prop('checked', (fields[id] == 0) ? false : true);

			} else {
				Core.log(fields[id]);
				el.val(fields[id]).trigger('change');

			}

		}

	}

};

$(document).ready(function() {

	if( (window.location['search']).indexOf('mdf_activities') != -1) {

		$(".mdf-menu-option").on('change', function() {

			mdf.get_activities();

		});

	} else {

		$(".mdf-menu-option").on('change', function() {

			mdf.get_packages();

		});

	}

	$("#mdf-order-form").on('submit', function(e) {

		e.preventDefault();

		mdf.submit_order();

	});

	$("body").on('click', '[data-mdf-delete]', function(e) {

		e.preventDefault();
		mdf.mdf_activity_id = $(this).attr('data-mdf-delete');
		mdf.delete_activity(0);

	});

});