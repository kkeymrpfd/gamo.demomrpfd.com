<?php
    $question = array(
        'number' => 1,
        'text' => 'Who invented the first floppy disc storage?',
    );
    
    $response = array(
        'answer' => '[Your answer]',
        'correct_answer' => '[Correct answer]',
        'points' => 37
    );
?>
/start_view
<div class="response">
    <h3 class="textBlue noMargin">Question ' . $question['number'] . '</h3>
    <h3 class="textBold">' . $question['text'] . '</h3>
    <div class="textCentered">
        <h5 class="textBold">Your Answer: ' . $response['answer'] . '</h5>
        <h2 class="textBlue">Sorry, You Are Incorrect</h2>
        <h5 class="textBold">The Correct Answer is:<br />' . $response['correct_answer'] . '</h5>
        <a href="#" class="button blue lg"><span>Next Question</span></a>
    </div>
</div>
/end_view