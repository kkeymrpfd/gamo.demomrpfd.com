<? $view_output .= '
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
'; ?>
<?
Core::print_r($data);
if(!isset($data['error_msg']) || $data['error_msg'] == '') {
?>
<? $view_output .= '
<script language="javascript">
$(document).ready(function() {

	parent.gamo_resources.created();

});
</script>
'; ?>
<?
} else {
?>
<? $view_output .= '
<script language="javascript">
$(document).ready(function() {

	parent.Core.modal({
		msg: "' . $data['error_msg'] . '",
		alert: "error"
	});

});
</script>
'; ?>
<?
}
?>