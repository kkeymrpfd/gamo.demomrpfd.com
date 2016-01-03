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
		<div style="display:inline-block;margin-right:1em" class="pull-right"><a href="/?p=mdf" class="btn btn-primary">Return to order screen</a></div>
	</div>
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
