<?
Core::get_element('game_header');
?>
/start_view
<div style="margin:20px">
	<div style="color:#fff;font-size:1.5em;margin:1.5em;text-align:center">In-Person Meetings</div>
	/end_view
<? foreach($data['slots'] as $k => $slot) { ?>
/start_view
<div class="panel panel-default">
  <div class="panel-heading" style="text-align:center">
    <h3 class="panel-title" style="font-weight:bold">
    	<div style="font-weight:bold;font-size:1.1em">' . $slot['display_time_range'] . '</div>
	</h3>
  </div>
  <div class="panel-body" style="align:center;color:#000">
/end_view
<?

$meeting_c = 0;

foreach($data['reservations'] as $k => $reserve) {

	if($reserve['slot_id'] == $slot['slot_id']) {

		++$meeting_c;

		if($meeting_c > 1) {
		?>
			/start_view
			<div style="height:1px;width:100%;background-color:#ccc;margin:1em 0em"></div>
			/end_view
		<?
		}
?>
/start_view
<b>' . Core::safe_echo($reserve['user']['first_name']) . ' ' . Core::safe_echo($reserve['user']['last_name']) . '</b> <a href="/?p=user_responses&user_id=' . $reserve['user']['user_id'] . '" target="_blank" class="btn btn-default" style="border:none;margin-left:1em">View Responses</a>
<br>' . Core::safe_echo($reserve['user']['title']) . ', ' . Core::safe_echo($reserve['user']['company']) . '
<br>' . Core::safe_echo($reserve['user']['phone']) . '
<br>' . Core::safe_echo($reserve['user']['email']) . '
/end_view
<?
	}

}

if($meeting_c == 0) {
?>
/start_view
<div style="color:#888">(No meetings have been booked for this slot yet)</div>
/end_view
<?
}
?>
/start_view
  </div>
</div>
/end_view
<? } ?>
/start_view
</div>
<script language="javascript">
$(document).ready(function() {

	$(".navbar").hide();

});
</script>
/end_view
<?
Core::get_element('game_footer');