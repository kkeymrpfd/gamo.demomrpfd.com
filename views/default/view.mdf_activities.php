<?

$data['mdf']['wallet'] = Core::r('mdf')->get_wallet(array(
        'wallet_id' => 2
    )
);

$data['mdf']['vendors'] = Core::r('mdf')->get_entities(array(
		'type' => 'vendor'
	)
);

$data['mdf']['partners'] = Core::r('mdf')->get_entities(array(
		'type' => 'partner'
	)
);

$data['mdf']['packages'] = Core::r('mdf')->get_packages();

$data['mdf']['quarters'] = Core::r('mdf')->get_quarters();

$data['mdf']['categories'] = Core::r('categories')->get_categories(array(
		'category_type' => 'mdf_package_type'
	)
);

Core::get_element('game_header');
?>
<? $view_output .= '
<link rel="stylesheet" type="text/css" href="/css/datepicker.css">
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/gamo/mdf.js?t=' . time() . '"></script>
<script src="/js/pager.js?t=1"></script>
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
'; ?>
<? Core::get_element('game_nav'); ?>
<? Core::get_element('mdf_menu_buckets'); ?>
<? Core::get_element('mdf_menu_vendors'); ?>
<? Core::get_element('mdf_menu_categories'); ?>
<? $view_output .= '
</div>
<div class="col-md-9 col-sm-9 col-xs-12 content2">

	<div>
		<div class="module-title" style="display:inline-block">MDF Activities</div>
		<div style="display:inline-block" class="pull-right">
			<a href="/?p=mdf" class="btn btn-primary">Return to order screen</a>
			<a href="#" class="btn btn-primary" style="margin-left:20px">Export</a>
		</div>
	</div>
'; ?>
<? if(Core::get_input('admin', 'get') == 1) { ?>
<? $view_output .= '
<div style="margin:20px 0px">
	<div class="form-group">
		<label for="redirect_url" style="width:100px;text-align:right">Quarter</label>
		<select class="form-control" style="width:400px;display:inline-block;margin-left:20px">
			<option value="">All Quarters</option>
'; ?>
<? foreach($data['mdf']['quarters'] as $k => $quarter) { ?>
<? $view_output .= '
			<option value="">' . $quarter['name'] . '</option>
'; ?>
<? } ?>
<? $view_output .= '
		</select>
	</div>
	<div class="form-group">
		<label for="redirect_url" style="width:100px;text-align:right">Vendor</label>
		<select class="form-control" style="width:400px;display:inline-block;margin-left:20px">
			<option value="">All Vendors</option>
'; ?>
<? foreach($data['mdf']['vendors'] as $k => $vendor) { ?>
<? $view_output .= '
			<option value="">' . $vendor['name'] . '</option>
'; ?>
<? } ?>
<? $view_output .= '
		</select>
	</div>
	<div class="form-group">
		<label for="redirect_url" style="width:100px;text-align:right">Partner</label>
		<select class="form-control" style="width:400px;display:inline-block;margin-left:20px">
			<option value="">All Partners</option>
'; ?>
<? foreach($data['mdf']['partners'] as $k => $partner) { ?>
<? $view_output .= '
			<option value="">' . $partner['name'] . '</option>
'; ?>
<? } ?>
<? $view_output .= '
		</select>
	</div>
	<div class="form-group">
		<label for="redirect_url" style="width:100px;text-align:right">Search</label>
		<input type="text" class="form-control" style="display:inline-block;width:400px;margin-left:20px;color:#000" placeholder="Search for a specific activity">
	</div>
</div>
'; ?>
<? } ?>
<? $view_output .= '
	<div id="mdf_result_h" style="margin:20px 0px;display:none"></div>
	<div id="mdf-activities-list" style="margin-top:30px"></div>
</div>
			
			
			
		</div>
		<!-- InstanceEndEditable -->
<script language="javascript">
$(document).ready(function() {

	gamo.page_two_cols();
	mdf.get_activities();

});

</script>
'; ?>
<?
Core::get_element('page_footer');
$session->remove('mdf_saved');
?>
