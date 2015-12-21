<?
Core::get_element('game_header');
?>
/start_view
/js: /js/gamo/badge_check.js
<div class="bluemask spacer">
	<div class="container">
		<div class="row">
/end_view
<? if($data['quiz_taken'] == 0) { ?>
/start_view
			<div class="col-xs-12 text-center" style="font-size:0.6em">
				<h1 class="title">You have unlocked a trivia game!</h1>
				<div style="font-size:1.5em">Get ready! You\'ll have 10 seconds to answer each question. Answer quickly, because the quicker you answer correctly, the more points you\'ll earn!</div>
				<a href="/?p=live_trivia&quiz_id=' . $data['quiz_id'] . '" class="btn btn-default" style="margin-top:1.3em">Play Now</a>
				<br>
			</div>
/end_view
<? } else { ?>
/start_view
			<div class="col-xs-12 text-center" style="font-size:0.6em">
				<div style="font-size:2em">You have already played this QR trivia game! There are 3 QR trivia games available - play them all to win the Booth Boss Badge!</div>
				<br>
			</div>
/end_view
<? } ?>
/start_view
		</div>
	</div>
</div>
/end_view
<?
Core::get_element('game_footer');