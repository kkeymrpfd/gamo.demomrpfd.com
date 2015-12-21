<?php
    $resource = array(
        'points' => 50,
        'title' => 'Resource Title Here',
        'description' => 'This will be where you put several sentences of a description',
        'thumb' => '/img/resource-thumb.gif',
    );
?>
<? $view_output .= '
<div class="response">
    <h3 class="textBlue noMargin textCentered">BONUS ROUND!</h3>
    <h3 class="textBold textCentered">Access the resource below to earn</h3>
    <h2 class="textCentered"><span class="textGreen large">' . $resource['points'] . '</span> pts</h2>
    <div class="row marginBottom">
        <div class="column five">
            <div class="stretchImg">
                <img src="' . $resource['thumb'] . '" alt="" />
            </div>
        </div>
        <div class="column seven">
            <h4 class="textBlue noMargin">' . $resource['title'] . '</h4>
            <h6>' . $resource['description'] . '</h6>
        </div>
    </div>
    <div class="row">
        <div class="column six">
            <a href="#" class="button blue lg full"><span>Download</span></a>
        </div>
        <div class="column six">
            <a href="#" class="button blue lg full"><span>Email To Me</span></a>
        </div>
    </div>
</div>
'; ?>