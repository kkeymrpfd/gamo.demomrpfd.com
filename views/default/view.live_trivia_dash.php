<?
Core::get_element('game_header');
?>
<? $view_output .= '
<script type="text/javascript" src="/js/gamo/badge_check.js"></script>
<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h1 class="title" style="font-size:1.4em">Live Trivia</h1>
				<img src="img/badges/29.png" class="img-responsive center-block">
			</div>
		</div>
		<div class="spacer">
		</div>
	</div>
	<div class="bluemask spacer" style="padding:0.3em 0.3em 1em 0.3em;margin:0px">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center" style="font-size:0.7em">
					<h1 class="title">The Max D\'Ductible Elite</h1>
					<h2 style="font-size:1.4em">Play <span class="bold-font">LIVE</span> trivia at booth #605 to instantly win the Max D\'Ductible Elite badge!</h1>
					<h2 style="font-size:1em">You must be physically present at the booth to play <span class="bold-font">LIVE</span> trivia</h2>
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
					<h4 class="bold-font">' . $quiz['title'] . ': <span class="pull-right">' . $quiz['time'] . '</span></h4> 
					<h4>' . $quiz['date'] . '</h4>
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
<!--
			<div class="row white-block">
				<div class="col-xs-6">
					<h4 class="bold-font">Session One: <span class="pull-right">11AM</span></h4> 
					<h4>Wednesday, June 11</h4>
				</div>
				<div class="col-xs-6">
					<a class="btn btn-green-stroke btn-lg btn-block" data-toggle="modal" data-target="#myModal">250 Pts Earned</a>
				</div>
			</div>
			<div class="row white-block">
				<div class="col-xs-6">
					<h4 class="bold-font">Session Two: <span class="pull-right">3PM</span></h4>
					<h4>Wednesday, June 11</h4>
				</div>
				<div class="col-xs-6">
					<a class="btn btn-red btn-lg btn-block" data-toggle="modal" data-target="#myModal">Play Now</a>
				</div>
			</div>
			<div class="row white-block">
				<div class="col-xs-6">
					<h4 class="bold-font">Session Three: <span class="pull-right">11AM</span></h4>
					<h4>Wednesday, June 12</h4>
				</div>
				<div class="col-xs-6">
					<a class="btn btn-grey btn-lg btn-block" data-toggle="modal" data-target="#myModal">
						<img src="img/lock.png" height="20"> Locked
					</a>
				</div>
			</div>
			//-->
		</div>
	</div>
<script language="javascript">
$(document).ready(function() {
	
	badge_check.check("30_31_32");


});
</script>
'; ?>
<?
Core::get_element('game_footer');
