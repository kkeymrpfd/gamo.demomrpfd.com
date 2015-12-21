<?
Core::get_element('game_header');
?>
/start_view
<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
/end_view
			<? Core::get_element('game_nav'); ?>
/start_view
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12 content2 non-meetings">
				<div class="hidden-xs">
					<h1><img src="img/Header_Trivia.png">Trivia</h1>
					<h4 style="line-height: 24px;">Periodically, Sparkmotive Sales Enablement will be releasing trivia sessions you can participate in that puts the knowledge you gain from the Sales Resources to the test! Earn big points for answering correctly!</h4>
				</div>
				<div class="visible-xs">
					<div class="widget content">
						<h1><img src="img/Header_Trivia.png">Trivia</h1>
						<h5>Periodically, Sparkmotive Sales Enablement will be releasing trivia sessions you can participate in that puts the knowledge you gain from the Sales Resources to the test! Earn big points for answering correctly!</h5>
					</div>
				</div>
				<div class="bluebackground widget">
                <div class="table">
                    <div class="table-row">
                    	<div class="table-cell align-left" style="width:28%">
								<h2>1pt/sec</h2>
							</div>
						<div class="table-cell">Earn 1 pt. for each second left on the clock for each question when you answer correctly!</div>
						</div>
                       </div> 
                        
			
				</div>
				<div class="content widget"  >
					<div class="row">
						Coming Soon!
					</div>
				</div>
				<div class="content widget hide"  >
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<br>
							<h1>Your Points</h1>
							<div class="pointbox greenbackground">
								<span id="points"></span>
							</div>
						</div>
						
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="timer" data-time-total="0" data-time="0">
	                            <div class="time">
	                                <span class="timeNum"></span>
	                            </div>
	                            <div class="fill"><div class="filler">&nbsp;</div></div>
	                        </div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 question" id="quizContent">
							<h2>Question</h2>
							<h4>Who invented the first floppy disk storage?</h4>
							<a href="" class="btn bluebackground btn-block">Answer 1</a>
							<a href="" class="btn bluebackground btn-block">Answer 2</a>
							<a href="" class="btn bluebackground btn-block">Answer 3</a>										
							<a href="" class="btn bluebackground btn-block">Answer 4</a>
						</div>
					</div>
				</div>
		
		<!-- InstanceEndEditable -->
	</div>
</div>
<script language="javascript">
$(document).ready(function() {

	//quiz.quiz_id = ' . ($data['quiz_id']*1) . ';
	//quiz.get_state();

});
</script>
/end_view
<?
Core::get_element('game_footer');
?>
		
