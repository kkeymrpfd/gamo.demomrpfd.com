<?
Core::get_element('game_header');
?>
<? $view_output .= '
<script type="text/javascript" src="/js/gamo/badge_check.js"></script>
<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center">
			<h1 class="title" style="font-size:1.4em">Daily Trivia Challenges</h1>
			<img src="img/badges/33.png" class="img-responsive center-block">
		</div>
	</div>
	<div class="spacer">
	</div>
</div>
<div class="bluemask spacer" style="padding:0.3em 0.3em 1em 0.3em;margin:0px">
	<div class="container">
		<div class="row" style="pad">
			<div class="col-xs-12 text-center" style="font-size:0.7em">
				<h1 class="title">The Daily Double</h1>
				<h2 style="font-size:1.4em">Play all three daily trivia challenges to earn the Daily Double badge!</h1>
			</div>
		</div>
	</div>
</div>
<div class="hr">
</div>
<div class="darkblue">
	<div class="container">
		'; ?>
<? foreach($data['quiz_list'] as $quiz) { ?>
<? $view_output .= '
			<div class="row white-block">
				<div class="col-xs-6">
					<h2>' . $quiz['title'] . '</h2>
				</div>
				<div class="col-xs-6">
					'; ?>
					<? if($quiz['quiz']['locked'] == 1) { ?>
					<? $view_output .= '
					<div class="btn btn-grey btn-lg btn-block">
						<img src="img/lock.png" height="20"> Locked
					</div>
					'; ?>
					<? } else if($quiz['quiz_taken'] == 1) { ?>
					<? $view_output .= '
						<div class="btn btn-green-stroke btn-lg btn-block" style="font-weight:bold">' . $quiz['quiz_points'] . ' Pts Earned</div>
					'; ?>
					<? } else {
						
						$play_url = ($quiz['quiz']['allow_quiz'] == 0 && $quiz['quiz']['require_pin'] == 1) ? '/?p=trivia_pin&quiz_id=' . $quiz['quiz_id'] : '/?p=live_trivia&quiz_id=' . $quiz['quiz_id'];
					
					?>
					<? $view_output .= '
					<a class="btn btn-red btn-lg btn-block" href="' . $play_url . '">Play Now</a>
					'; ?>
					<? } ?>
					<? $view_output .= '
				</div>
			</div>
'; ?>
<? } ?>
<? $view_output .= '
</div>
'; ?>
<? if($data['badge']['badge_id'] != -1) { ?>
<? $view_output .= '
<script language="javascript">
$(document).ready(function() {
	
	badge_check.render($.parseJSON(\'' . json_encode($data['badge']) . '\'));

});
</script>
'; ?>
<? }
Core::get_element('game_footer');