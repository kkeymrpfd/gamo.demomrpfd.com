<?php
    $question = array(
        'number' => 1,
        'text' => 'Who invented the first floppy disc storage?',
    );
    
    $response = array(
        'answer' => '[Your answer]',
        'points' => 37
    );
?>
<? $view_output .= '
<div class="response">
    <h3 class="textBlue noMargin">Question ' . $question['number'] . '</h3>
    <h3 class="textBold">' . $question['text'] . '</h3>
    <div class="textCentered">
        <h5 class="textBold">Your Answer: ' . $response['answer'] . '</h5>
        <h2 class="textBlue">CORRECT!</h2>
        <h2><span class="textGreen large">' . $response['points'] . '</span> pts</h2>
        <a href="#" class="button blue lg"><span>Next Question</span></a>
    </div>
</div>
'; ?>