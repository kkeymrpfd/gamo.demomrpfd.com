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
/start_view
<link rel="stylesheet" type="text/css" href="/css/datepicker.css">
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/gamo/mdf.js?t=' . time() . '"></script>
<script src="/js/pager.js?t=1"></script>
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
/end_view
<? Core::get_element('game_nav'); ?>
<? Core::get_element('mdf_menu_buckets'); ?>
<? Core::get_element('mdf_menu_vendors'); ?>
<? Core::get_element('mdf_menu_categories'); ?>
/start_view
</div>
<div class="col-md-9 col-sm-9 col-xs-12 content2">

	<div>
		<div class="module-title" style="display:inline-block">MDF</div>
		<div style="display:inline-block;margin-right:1em" class="pull-right"><a href="/?p=mdf_activities" class="btn btn-primary">View Order History / Marketing Activities</a></div>
	</div>
	<div id="mdf_result_h" style="margin:20px 0px;display:none"></div>
	<div class="row center" style="font-size:1.5em;margin:10px">
	Funding Available
	</div>
/end_view
<? Core::get_element('mdf_buckets'); ?>
/start_view
	<div id="mdf-packages-list"></div>
</div>
			
			
			
		</div>
		<!-- InstanceEndEditable -->
<script language="javascript">
$(document).ready(function() {

	gamo.page_two_cols();
	mdf.get_packages();

/end_view
<? if($session->get('mdf_saved') == 1) { ?>
/start_view
Core.modal({
	msg: "Your order has been saved!",
	alert: "success"
});
/end_view
<? } ?>
/start_view

});

</script>
/end_view
<?
Core::get_element('page_footer');
$session->remove('mdf_saved');
?>
