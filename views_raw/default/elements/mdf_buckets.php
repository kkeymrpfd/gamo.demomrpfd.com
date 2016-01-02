<?php
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
?>
/start_view
<div>
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