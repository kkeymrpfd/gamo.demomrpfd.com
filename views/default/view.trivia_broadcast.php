<?
Core::get_element('game_header');
?>
<? $view_output .= '
<script type="text/javascript" src="/js/gamo/quiz_broadcast.js"></script>
<script type="text/javascript" src="http://dfdbz2tdq3k01.cloudfront.net/js/2.1.0/ortc.js"></script>
<div style="padding:20px">
	<div id="broadcast-h">
		<button class="btn btn-primary btn-large" style="width:100%;border:none;font-size:2em;font-weight:bold" id="broadcast-b">Broadcast</button>
	</div>
	<div id="broadcast-list-h">
		<button class="btn btn-info" style="width:100%;border:none;font-size:2em;font-weight:bold;margin-top:1em" broadcast-copy="Live Trivia will begin soon!" broadcast-sound="game_complete" id="broadcast-b"></button>
		<button class="btn btn-info" style="width:100%;border:none;font-size:2em;font-weight:bold;margin-top:1em" broadcast-copy="To join the game, visit: www.gettriviafever.com Your password is \'trivia\'" broadcast-sound="game_description" id="broadcast-b"></button>
		<button class="btn btn-info" style="width:100%;border:none;font-size:2em;font-weight:bold;margin-top:1em" broadcast-copy="Pin Code: ' . strtoupper($data['quiz_pin']) . '" broadcast-sound="game_description" id="broadcast-b"></button>
		<button class="btn btn-info" style="width:100%;border:none;font-size:2em;font-weight:bold;margin-top:1em" broadcast-copy="Show Badges" broadcast-sound="game_complete" id="broadcast-b"></button>
		<button class="btn btn-info" style="width:100%;border:none;font-size:2em;font-weight:bold;margin-top:1em" broadcast-copy="Extra bonus: 100 points! Set a meeting with a LexisNexis representative" broadcast-sound="game_complete" id="broadcast-b"></button>
		<button class="btn btn-info" style="width:100%;border:none;font-size:2em;font-weight:bold;margin-top:1em" broadcast-copy="Congratulations! You\'re now a part of the Max D\'Ductible Elite!" broadcast-sound="game_complete" id="broadcast-b"></button>
		<button class="btn btn-info" style="width:100%;border:none;font-size:1em;font-weight:bold;margin-top:1em" id="broadcast-winner">Show Winner(s)</button>
		<button class="btn btn-info" style="width:100%;border:none;font-size:2em;font-weight:bold;margin-top:1em" broadcast-copy="" broadcast-sound="0" id="broadcast-b"></button>
	</div>
	<div id="questions-h" style="margin-top:100px"></div>
</div>
<script language="javascript">
$(document).ready(function() {

	quiz_broadcast.quiz_id = ' . ($data['quiz_id']) . ';	
	quiz_broadcast.get_state();

});
</script>
'; ?>
<?
Core::get_element('game_footer');