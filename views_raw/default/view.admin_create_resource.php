/start_view
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
/end_view
<?
Core::print_r($data);
if(!isset($data['error_msg']) || $data['error_msg'] == '') {
?>
/start_view
<script language="javascript">
$(document).ready(function() {

	parent.gamo_resources.created();

});
</script>
/end_view
<?
} else {
?>
/start_view
<script language="javascript">
$(document).ready(function() {

	parent.Core.modal({
		msg: "' . $data['error_msg'] . '",
		alert: "error"
	});

});
</script>
/end_view
<?
}
?>