<?
Core::get_element('game_header');
?>
<? $view_output .= '
<div style="margin:20px">
	<div style="color:#000;font-size:1.5em;margin:1.5em;text-align:center">User Responses and Resources
		<div style="font-size:0.8em"><br>' . Core::safe_echo($data['user']['first_name'] . ' ' . $data['user']['last_name']) . '
		<br>' . Core::safe_echo($data['user']['title'] . ', ' . $data['user']['company']) . '
		<br>Phone: ' . Core::safe_echo($data['user']['phone']) . '
		<br>' . Core::safe_echo($data['user']['email']) . '
		</div>
	</div>
	'; ?>
<? foreach($data['quizzes'] as $k => $quiz) { ?>
<? $view_output .= '
<div class="panel panel-default">
  <div class="panel-heading" style="text-align:center">
    <h3 class="panel-title" style="font-weight:bold">
    	<div style="font-weight:bold;font-size:1.1em">' . $quiz['quiz_name'] . '</div>
	</h3>
  </div>
  <div class="panel-body" style="align:center;color:#000">
'; ?>
<? foreach($quiz['questions'] as $k => $question) { ?>
<? $view_output .= '
<br><b>Q:</b> ' . $question['question'] . '
<br><b>A:</b> ' . $question['answer_text'] . '<br>
'; ?>
<? } ?>
<? $view_output .= '
  </div>
</div>
'; ?>
<? } ?>
<? $view_output .= '
<div style="color:#000;font-size:1.3em">Resources:</div>
<div style="color:#000">
'; ?>
<? if(count($data['resources']) == 0) { ?>
<? $view_output .= '
(This user has not downloaded any resources yet)
'; ?>
<? } else {

	foreach($data['resources'] as $k => $resource) {
?>
<? $view_output .= '
<a href="resources/' . $resource['resource_name'] . '" target="_blank" class="btn btn-primary" style="border:none;font-size:1.1em;margin-top:0.5em">' . $resource['resource_name'] . '</a><br>
'; ?>
<?
	}
}
?>
<? $view_output .= '
</div>
<br><br><br>
</div>
<script language="javascript">
$(document).ready(function() {

	$(".navbar").hide();

});
</script>
'; ?>
<?
Core::get_element('game_footer');