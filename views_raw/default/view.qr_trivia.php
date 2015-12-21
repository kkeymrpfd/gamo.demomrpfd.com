<?
Core::get_element('game_header');
?>
/start_view
/js: /js/gamo/badge_check.js
<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1 class="title" style="font-size:1.4em">Qr Code Trivia Challenges</h1>
			<img src="img/badges/30.png" class="img-responsive center-block">
		</div>
	</div>
	<div class="spacer">
	</div>
</div>
<div class="bluemask spacer" style="padding:0.3em 0.3em 1em 0.3em;margin:0px">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center" style="font-size:0.7em">
				<h1 class="title">The Booth Boss</h1>
				<h2 style="font-size:1.4em">Play all three QR Code Trivia Challenges at the LexisNexis booth (<span class="bold-font">#605</span>) to earn the Booth Boss badge!</h1>
			</div>
		</div>
	</div>
</div>
<div class="hr">
</div>
<div class="darkblue">
	<div class="container">
		/end_view
<? foreach($data['quiz_list'] as $quiz) { ?>
/start_view
			<div class="row white-block">
				<div class="col-xs-6">
					<h2>' . $quiz['title'] . '</h2>
				</div>
				<div class="col-xs-6">
					/end_view
					<? if(!isset($quiz['quiz']['question_set'])) { ?>
					/start_view
					<div class="btn btn-grey btn-lg btn-block">
						<img src="img/lock.png" height="20"> Locked
					</div>
					/end_view
					<? } else if($quiz['quiz_taken'] == 1) { ?>
					/start_view
						<div class="btn btn-green-stroke btn-lg btn-block" style="font-weight:bold">' . $quiz['quiz_points'] . ' Pts Earned</div>
					/end_view
					<? } else {
						
						$play_url = ($quiz['quiz']['allow_quiz'] == 0 && $quiz['quiz']['require_pin'] == 1) ? '/?p=trivia_pin&quiz_id=' . $quiz['quiz_id'] : '/?p=live_trivia&quiz_id=' . $quiz['quiz_id'];
					
					?>
					/start_view
					<a class="btn btn-red btn-lg btn-block" href="' . $play_url . '">Play Now</a>
					/end_view
					<? } ?>
					/start_view
				</div>
			</div>
/end_view
<? } ?>
/start_view
</div>
/end_view
<? if($data['badge']['badge_id'] != -1) { ?>
/start_view
<script language="javascript">
$(document).ready(function() {
	
	badge_check.render($.parseJSON(\'' . json_encode($data['badge']) . '\'));

});
</script>
/end_view
<? }
Core::get_element('game_footer');