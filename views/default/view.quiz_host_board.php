<?
Core::get_element('game_header');
?>
<? $view_output .= '
<script type="text/javascript" src="http://dfdbz2tdq3k01.cloudfront.net/js/2.1.0/ortc.js"></script>
<script type="text/javascript" src="/js/gamo/quiz_host.js"></script>
<div style="color:#000;font-weight:bold;font-size:5.2em;margin:2.5em 1.1em;text-align:center" id="question-h"></div>
<audio id="audio-quiz-timer" style="display:none">
  <source src="audio/quiz_timer.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<audio id="audio-game-description" style="display:none">
  <source src="audio/game_description.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
<audio id="audio-game-complete" style="display:none">
  <source src="audio/game_complete.mp3" type="audio/mpeg">
Your browser does not support the audio element.
</audio>
'; ?>
<?
Core::get_element('game_footer');
?>