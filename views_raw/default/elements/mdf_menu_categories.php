/start_view
<div class="panel panel-info" style="margin-top:1.5em">
	<div class="panel-heading">
		<h3 class="panel-title">Program Types</h3> 
	</div>
	<div class="panel-body">
/end_view
<? foreach($data['mdf']['categories'] as $k => $category) { ?>
/start_view
		<div class="check-bind" style="margin:5px 0px">
			<input class="mdf-menu-option" type="checkbox" data-mdf-category-id="' . $category['category_id'] . '" checked> <span style="position:relative;top:-3px">' . $category['category_name'] . '</span>
		</div>
/end_view
<? } ?>
/start_view
	</div>
</div>
/end_view
