<? $view_output .= '
<div class="panel panel-info" style="margin-top:1.5em">
	<div class="panel-heading">
		<h3 class="panel-title">Vendor</h3> 
	</div>
	<div class="panel-body">
'; ?>
<? foreach($data['mdf']['vendors'] as $k => $vendor) { ?>
<? $view_output .= '
		<div class="check-toggle" style="margin:5px 0px">
			<input type="checkbox"> <span style="position:relative;top:-3px">' . $vendor['name'] . '</span>
		</div>
'; ?>
<? } ?>
<? $view_output .= '
	</div>
</div>
'; ?>