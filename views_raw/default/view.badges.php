<?
Core::get_element('game_header');
?>
/start_view
<div class="visible-xs mtop15"></div>
		<div class="content widget">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<img src="img/grandprize.png">
					<div style="font-weight:bold;text-align:center;margin:10px">
					Grand prize winner is selected from a raffle at the end of the quarter. To enter:
					<br>
					&bull; For every approved registered deal you submit, get 1 entry into the grand prize
					<br>&bull; For every closed deal you submit, get 5 entries into the grand prize
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6">
					<h1>Badges</h1>
					<p>You will earn rewards for the activities and deals you record in this portal. See below for a list of the amounts! Your total earnings will be tallied up and verified at the end of each quarter.</p>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
					<p>&nbsp;</p>
					<img class="hidden-xs" src="img/PrizesPage_GiftCard.png" style="margin-left:15px;">
					<img class="visible-xs" src="img/PrizesPage_GiftCard.png" width="130">
				</div>
			</div>
			<div class="row">
/end_view
<? foreach($data['badges'] as $k => $badge) { ?>
/start_view
<div class="col-md-6 col-sm-12 col-xs-12">
	<br>
	<div class="media">
		<div class="pull-left">
			<img src="/img/badges/' . $badge['badge_id'] . '' . Core::condition_output($badge['user_has'], '-active', '-inactive') .'.png" id="badge-' . $badge['badge_id'] . '" class="media-object img-circle ' . Core::condition_output($badge['user_has'], 'active-badge', 'inactive-badge') .'" data-badge="' . $badge['badge_id'] . '" alt="">
		</div>
		<div class="media-body" style="margin-top: 25px;padding-left:10px">
			<p class="orange"><strong>' . $badge['badge_name'] . '</strong></p>
			<p>' . $badge['badge_description'] . '</p>
			<p class="f16"><strong>' . $badge['badge_prize'] . '</strong></p>
		</div>
	</div>									
</div>
/end_view
<? } ?>
/start_view
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px">
					<p>*Prizes will be distributed after the end of the game at the end of the quarter. All activity is subject to review and approval. If you have any questions please email contact@delloverdrive.com</p>
				</div>

			</div>
			<!-- placeholder to stretch body -->
			<div style="height:350px"></div>
		</div>
/end_view
<?
Core::get_element('game_footer');
?>
