<?php
    $question = array(
        'number' => 1,
        'text' => 'Who invented the first floppy disc storage?',
        'answers' => array(
            'Answer 1',
            'Answer 2',
            'Answer 3',
            'Answer 4',
        ),
    );
?>
/start_view
<div class="question">
    <h3 class="textBlue noMargin">Question ' . $question['number'] . '</h3>
    <h3 class="textBold">' . $question['text'] . '</h3>
    <div class="answers">
/end_view
<?php
        foreach ($question['answers'] as $key => $answer) :
            $id = sprintf('question-%s-%s', $question['number'], $key);
?>
/start_view
        <div class="answer">
            <input type="radio" class="inputCheckbox" id="answer-' . $id .'" name="question[' . $question['number'] . ']" value="' . $answer .'" />
            <label for="' . $id . '">' . $answer . '</label>
        </div>
/end_view
<?php
        endforeach;
?>
/start_view
    </div>
</div>
/end_view