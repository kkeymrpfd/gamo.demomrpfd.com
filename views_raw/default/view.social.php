<?
Core::get_element('game_header');
//$data['connected']['twitter'] = 1;
?>
/start_view
<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h1 class="title" style="font-size:1.4em">Social Butterfly</h1>
				<img src="img/badges/34.png" class="img-responsive center-block">
			</div>
		</div>
		<div class="spacer">
		</div>
	</div>
	<div class="bluemask spacer" style="padding:0.3em 0.3em 1em 0.3em;margin:0px">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 text-center" style="font-size:0.7em">
					<h2 style="font-size:1.4em">Spread the word about Trivia Fever to earn the Social Butterfly badge!</h1>
				</div>
			</div>
		</div>
	</div>

	<div class="container" style="margin-top:1em">
/end_view
<? if($data['connected']['twitter'] == 1) { ?>
/start_view
		<div class="row white-block" style="padding:0.5em;margin:0.5em">
			<div class="col-xs-12">
				<div class="btn btn-primary" style="border:none;margin-right:1em;font-size:1em" twitter-share="Expert Trivia player? Prove yourself! #TriviaFever http://gettriviafever.com">Tweet 1</div> +10 points
			</div>
		</div>
		<div class="row white-block" style="padding:0.5em;margin:0.5em">
			<div class="col-xs-12">
				<div class="btn btn-primary" style="border:none;margin-right:1em;font-size:1em" twitter-share="Think you know about facts about fraud? Then you’re ahead of the game with #TriviaFever #AHIPInstitute #LexisNexis http://gettriviafever.com">Tweet 2</div> +10 points
			</div>
		</div>
		<div class="row white-block" style="padding:0.5em;margin:0.5em">
			<div class="col-xs-12">
				<div class="btn btn-primary" style="border:none;margin-right:1em;font-size:1em" twitter-share="Are you an expert at fraud, clinical, and identity trivia questions? Find out with #TriviaFever #AHIP2014 http://gettriviafever.com">Tweet 3</div> +10 points
			</div>
		</div>
/end_view
<? } else { ?>
/start_view
		<div class="row white-block" style="margin:0.5em;padding:0.5em">
			<div class="col-xs-12">
				<table {table-normal}>
				<tr>
					<td valign="middle"><div onclick="connect_social(\'twitter\')" class="btn btn-primary" style="font-size:0.7em;border:none">Connect</div></td>
					<td><div style="width:10px"></div></td>
					<td valign="top"><span style="font-size:0.9em">Connect your Twitter account to start earning points</span></td>
				</tr>
				</table>
			</div>
		</div>
/end_view
<? } ?>
/start_view
	</div>	
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		  </div>
		  <div class="modal-body">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<div class="modal-control">
							Tweet
							<span class="label red-bg pull-right">10 pts</span>
						</div>
						<div class="modal-control">
							Share to Linkedin
						</div>
						<div class="modal-control">
							Share to Facebook
						</div>
						<div class="modal-control">
							<a href="#" data-dismiss="modal">Close</a>
						</div>
					</div>
				</div>
			</div>
		  </div>
		</div>
	  </div>
	</div>		
/end_view
<?
Core::get_element('game_footer');