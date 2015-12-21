<?
Core::get_element('game_header');
?>
<? $view_output .= '
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
			<!-- InstanceBeginEditable name="content" -->
		<div class="row">
			<div class="col-md-4 col-sm-12 col-xs-12 submenu">
				<ul class="nav nav-pills nav-stacked sidebar">
					<li> <a href="whatsnew.htm"> <img src="img/Sidebar_WhatsNew_Unselected.png"> What&#39;s New? </a> </li>
				</ul>
				<ul class="nav nav-pills nav-stacked sidebar">
					<li> <a href="training.htm"> <img src="img/Sidebar_Training_Unselected.png"> Training </a> </li>
				</ul>
				<ul class="nav nav-pills nav-stacked sidebar">
					<li class="current"> <a href="trivia.htm"> <img src="img/Sidebar_Trivia_Selected.png"> Trivia </a> </li>
				</ul>
				<ul class="nav nav-pills nav-stacked sidebar">
					<li> <a href="demandgen.htm"> <img src="img/Sidebar_DemandGen_Unselected.png"> Demand Gen </a> </li>
				</ul>
				<ul class="nav nav-pills nav-stacked sidebar">
					<li> <a href="meetings.htm"> <img src="img/Sidebar_Meeting_Unselected.png"> Meetings </a> </li>
				</ul>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12 content2">
				<h1><img src="img/Header_Trivia.png">Trivia</h1>
				<h4>Periodically Bluecoat will be releasing trivia sessions you can participate in that puts the knowledge you gain from the training materials to the test! Earn big points for answering correctly!</h4>
				<div class="bluebackground widget">
					<div class="media">
						<div class="pull-left">
							<div class="media-object">
								<h2>1pt/sec</h2>
							</div>
						</div>
						<div class="media-body">
							Earn 1 pt. for each second left on the clock for each question when you answer correctly!
						</div>
					</div>
				</div>
				<div class="content widget">
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<br>
							<h1>Your Points</h1>
							<div class="pointbox greenbackground">
								235
							</div>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="center-block">
							<input class="knob" value="88" data-width="150" data-height="150" data-displayPrevious=true data-fgColor="#ca0813" data-bgColor="#000" data-skin="tron" data-thickness=".2" value="75">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 question">
							<h2>Question</h2>
							<h4>Who invented the first floppy disk storage?</h4>
							<a href="" class="btn bluebackground btn-block">Answer 1</a>
							<a href="" class="btn bluebackground btn-block">Answer 2</a>
							<a href="" class="btn bluebackground btn-block">Answer 3</a>										
							<a href="" class="btn bluebackground btn-block">Answer 4</a>
						</div>
					</div>
				</div>

				
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<form role="form">
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" id="email">
							</div>
							<div class="form-group">
								<label for="message">Message</label>
								<textarea class="form-control" id="message"></textarea>
							</div>
							<p class="pull-right">
								<button type="button" class="btn bluebackground">Send</button>
							</p>
						</form>
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		<!-- InstanceEndEditable -->
	</div>
</div>
'; ?>
<?
Core::get_element('game_footer');
?>
		