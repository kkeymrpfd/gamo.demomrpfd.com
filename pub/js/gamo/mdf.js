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

	}

};

$(document).ready(function() {

	mdf.get_packages();

	$(".mdf-menu-option").on('change', function() {
		
		mdf.get_packages();

	});

});