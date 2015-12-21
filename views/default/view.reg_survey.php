<? $view_output .= '
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<title>Trivia Fever</title>
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:,200,400,700" rel="stylesheet" type="text/css">
<link href="css/triviafever.css?t=4" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript" src="/js/core.js"></script>
<script type="text/javascript" src="/js/impromptu.js"></script>
<script type="text/javascript" src="/js/gamo/survey_quiz.js"></script>
<link rel="stylesheet" href="/css/impromptu.css">

<style>

.alert {
    font-size: 1.5em;
    text-align: center;
    padding: 1em;
    border: solid 1px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
}

.alert-danger {
    color: #990000;
    border-color: #cc0000;
    background-color: #ffaaaa;
}

.alert-success {
    color: #3acc00;
}
</style>

</head>

<body>
<div id="header">
  <div class="center"> <img src="img/banner.png" /> </div>
</div>
<div id="register" style="display:block">
  <div class="center">
    <div class="main_content">
      <div class="reg_content" style="margin-top:140px">
        <div class="reg_survey_title">PLEASE ANSWER THE<br>FOLLOWING QUESTIONS TO<br>COMPLETE YOUR REGISTRATION<br /></div>
        <div class="reg_area">
          <form id="quiz-form">
            <div class="row">
              <div id="quiz-result-h" style="margin:0em 2em 1em 2em;display:none;font-size:0.7em"></div>
            </div>
            <div id="quiz-h"></div>
            <div class="row">
              <input class="button" type="submit" value="REGISTER" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="footer"><div class="center"><img src="img/lexisnexis" /><br />
<p class="footer_txt">LexisNexis, and the Knowledge Burst logo are registered trademarks of Reed Elsevier Properties Inc., used under license. Other products and services may be trademarks or registered trademarks of their respective companies. Copyright © 2014 LexisNexis. All rights reserved.</p></div></div>
<script language="javascript">
$(document).ready(function() {

  survey_quiz.quiz_id = 2;
  survey_quiz.get_state();

});
</script>
<script>
  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

  ga(\'create\', \'UA-40512712-14\', \'gettriviafever.com\');
  ga(\'send\', \'pageview\');

</script>
</body>
</html>
'; ?>