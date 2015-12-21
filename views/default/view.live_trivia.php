<?
Core::get_element('game_header');
?>
<? $view_output .= '
<link rel="stylesheet" type="text/css" href="/css/trivia.css">
<script type="text/javascript" src="/js/gamo/badge_check.js"></script>
<script type="text/javascript" src="/js/timer.js"></script>
<script type="text/javascript" src="http://dfdbz2tdq3k01.cloudfront.net/js/2.1.0/ortc.js"></script>
<script type="text/javascript" src="/js/timer.js"></script>
<script type="text/javascript" src="/js/gamo/quiz.js?t=13938726796"></script>
<div id="pageQuiz" style="font-size: 1.5em;font-face: \'Bariol Bold\'">
    <section class="section padding minHeight cubesBG styles" style="margin-top:-40px">
        <div class="inner">
            <div class="narrow">
                <div id="quizHeader" class="row" style="font-size:0.5em">
                    <div class="column textCentered">
                        <h2 class="textLight" style="font-weight:bold;margin-left:1.6em">Points</h2>
                        <div class="points"><span id="points"></span></div>
                    </div>
                    <div class="timerCol column six textRight" style="position:relative;top:3.5em">
                        <div class="timer" data-time-total="0" data-time="0">
                            <div class="time">
                                <span class="timeNum"></span>
                            </div>
                            <div class="fill"><div class="filler">&nbsp;</div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="quizContent" class="narrow">
                
            </div>
        </div>
    </section>
</div>
<script language="javascript">
$(document).ready(function() {

	quiz.quiz_id = ' . ($data['quiz_id']*1) . ';
	quiz.get_state();

});
</script>
'; ?>
<?
Core::get_element('game_footer');