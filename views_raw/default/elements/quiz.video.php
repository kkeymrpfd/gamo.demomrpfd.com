<?php
    $video = array(
        'points' => 50,
        'title' => 'Video Title Here',
        'description' => 'This will be where you put several sentences of a description',
        'embed' => '<iframe width="420" height="315" src="//www.youtube.com/embed/oHg5SJYRHA0" frameborder="0" allowfullscreen></iframe>',
    );
?>
/start_view
<div class="response">
    <h3 class="textBlue noMargin textCentered">BONUS ROUND!</h3>
    <h3 class="textBold textCentered">Watch the video below to earn</h3>
    <h2 class="textCentered"><span class="textGreen large">' . $video['points'] . '</span> pts</h2>
    <div class="videoWrap">' . $video['embed'] . '</div>
    <h4 class="textBlue noMargin">' . $video['title'] . '</h4>
    <h6>' . $video['description'] . '</h6>
    <a href="#" class="button blue lg full"><span>Next Question</span></a>
</div>
/end_view