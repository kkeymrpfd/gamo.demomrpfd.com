<?


$data['mdf']['wallet'] = Core::r('mdf')->get_wallet(array(
        'wallet_id' => 2
    )
);

$data['mdf']['vendors'] = Core::r('mdf')->get_entities(array(
		'type' => 'vendor'
	)
);

$data['mdf']['packages'] = Core::r('mdf')->get_packages();

$data['mdf']['categories'] = Core::r('categories')->get_categories(array(
		'category_type' => 'mdf_package_type'
	)
);

switch(count($data['mdf']['wallet']['buckets'])) {
	case 2:
		$bucket_col_size = 6;
		break;
	case 3:
		$bucket_col_size = 4;
		break;
	default:
		$bucket_col_size = 12;
}

Core::get_element('game_header');
?>
/start_view
<link rel="stylesheet" type="text/css" href="/css/datepicker.css">
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/gamo/meeting.js?t=4"></script>
<script src="/js/pager.js?t=1"></script>
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
/end_view
	<? Core::get_element('game_nav'); ?>
/start_view
	<div class="panel panel-info" style="margin-top:1.5em">
		<div class="panel-heading">
			<h3 class="panel-title">Line of Business</h3> 
		</div>
		<div class="panel-body">
/end_view
<? foreach($data['mdf']['wallet']['buckets'] as $k => $bucket) { ?>
/start_view
			<div class="check-toggle" style="margin:5px 0px">
				<input type="checkbox"> <span style="position:relative;top:-3px">' . $bucket['bucket_name'] . '</span>
			</div>
/end_view
<? } ?>
/start_view
		</div>
	</div>
	<div class="panel panel-info" style="margin-top:1.5em">
		<div class="panel-heading">
			<h3 class="panel-title">Vendor</h3> 
		</div>
		<div class="panel-body">
/end_view
<? foreach($data['mdf']['vendors'] as $k => $vendor) { ?>
/start_view
			<div class="check-toggle" style="margin:5px 0px">
				<input type="checkbox"> <span style="position:relative;top:-3px">' . $vendor['name'] . '</span>
			</div>
/end_view
<? } ?>
/start_view
		</div>
	</div>
	<div class="panel panel-info" style="margin-top:1.5em">
		<div class="panel-heading">
			<h3 class="panel-title">Program Types</h3> 
		</div>
		<div class="panel-body">
/end_view
<? foreach($data['mdf']['categories'] as $k => $category) { ?>
/start_view
			<div class="check-toggle" style="margin:5px 0px">
				<input type="checkbox"> <span style="position:relative;top:-3px">' . $category['category_name'] . '</span>
			</div>
/end_view
<? } ?>
/start_view
		</div>
	</div>
</div>
<div class="col-md-9 col-sm-9 col-xs-12 content2">

	<div class="hidden-xs">
		<div class="module-title">MDF</div>
	</div>

	<div class="row center" style="font-size:1.5em;margin:10px">
	Funding Available
	</div>
	<div class="row">
/end_view
<? foreach($data['mdf']['wallet']['buckets']  as $k => $bucket) { ?>
/start_view
		<div class="col-sm-' . $bucket_col_size . ' col-md-' . $bucket_col_size . ' col-lg-' . $bucket_col_size . '">
			<div class="panel panel-info panel-fill">
				<div class="panel-heading center">
					<h3 class="panel-title">' . $bucket['bucket_name'] . '</h3> 
				</div>
				<div class="panel-body center funding-text"> $' . round($bucket['balance']) . ' </div>
			</div>
		</div>
/end_view
<? } ?>
/start_view
	</div>
/end_view
<? foreach($data['mdf']['packages']['packages'] as $k => $package) { ?>
/start_view
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">' . $package['vendor_name'] . ' - ' . $package['name'] . ' <div class="pull-right">' . $package['display_price'] . '</div></h3>
				</div>
				<div class="panel-body" style="font-size:1em">
					<div class="row">
						<div class="col-lg-3">
							<b>Program Type</b>
							<br>' . implode(',', $package['category_names']) . '
							<br><br><b>Line of Business</b>
							<br>' . $package['bucket_name'] . '
						</div>
						<div class="col-lg-9">
							<b>Deliverables</b><br>
							' . $package['description'] . '
						</div>
					</div>
					<button class="btn btn-primary pull-right" style="margin-top:12px">Order</button>
				</div>
			</div>
		</div>
	</div>
/end_view
<? } ?>
/start_view
</div>
			
			
			
		</div>
		<!-- InstanceEndEditable -->
<script language="javascript">
$(document).ready(function() {

	gamo.page_two_cols();

});

</script>
/end_view
<?
Core::get_element('page_footer');
?>
