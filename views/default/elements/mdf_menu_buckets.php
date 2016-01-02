<? $view_output .= '
<div class="panel panel-info" style="margin-top:1.5em">
	<div class="panel-heading">
		<h3 class="panel-title">Line of Business</h3> 
	</div>
	<div class="panel-body">
'; ?>
<? foreach($data['mdf']['wallet']['buckets'] as $k => $bucket) { ?>
<? $view_output .= '
		<div class="check-bind" style="margin:5px 0px">
			<input class="mdf-menu-option" type="checkbox" data-mdf-bucket-category-id="' . $bucket['bucket_category_id'] . '" checked> <span style="position:relative;top:-3px">' . $bucket['bucket_name'] . '</span>
		</div>
'; ?>
<? } ?>
<? $view_output .= '
	</div>
</div>
'; ?>