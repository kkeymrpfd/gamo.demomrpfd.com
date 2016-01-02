<? $view_output .= '
<div class="panel panel-info" style="margin-top:1.5em">
	<div class="panel-heading">
		<h3 class="panel-title">Program Types</h3> 
	</div>
	<div class="panel-body">
'; ?>
<? foreach($data['mdf']['categories'] as $k => $category) { ?>
<? $view_output .= '
		<div class="check-toggle" style="margin:5px 0px">
			<input type="checkbox"> <span style="position:relative;top:-3px">' . $category['category_name'] . '</span>
		</div>
'; ?>
<? } ?>
<? $view_output .= '
	</div>
</div>
'; ?>
