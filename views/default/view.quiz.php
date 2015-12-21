<?php 
    Core::get_element('header', array('title' => 'Quiz', 'bodyClasses' => 'quiz'));
    $element = (isset($_GET['element']) && !empty($_GET['element'])) ? $_GET['element'] : 'question';
    $element = (!in_array($element, array('question', 'response_correct', 'response_incorrect', 'resource', 'video', 'meeting'))) ?  'element' : $element;
    $untimed = (isset($_GET['untimed']) && $_GET['untimed']) ? true : false;
?>
<? $view_output .= '
<script type="text/javascript" src="/js/timer.js"></script>
<script type="text/javascript" src="/js/gamo/quiz.js?t=' . time() . '"></script>
<div id="pageQuiz">
    <section class="section padding minHeight cubesBG styles">
        <div class="videoBackground">
            <div class="videoBackgroundInner">
                <video id="video-cubes" autoplay loop muted>
                    <source src="/video/cubes.mp4" type="video/mp4" />
                    <source src="/video/cubes.ogv" type="video/ogg" />	
                </video>
            </div>
        </div>
        <div class="inner">
            <div class="logoWrap">
                <div class="logo techTrivia">TechTrivia</div>
                <div class="sponsored">
                    <span>Sponsored by:</span>
                    <div class="logo emc">EMC</div>
                </div>
            </div>
            <div class="narrow">
                <div id="quizHeader" class="row' . sprintf('%s', ($untimed) ? ' untimed' : null) . '">
                    <div class="column six textCentered">
                        <h2 class="textLight">Your Points</h2>
                        <div class="points"><span id="points"></span></div>
                    </div>
                    <div class="timerCol column six textRight">
                        <div class="timer" data-time-total="90" data-time="90">
                            <div class="time">
                                <span class="timeNum">90</span>
                            </div>
                            <div class="fill"><div class="filler">&nbsp;</div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="quizContent" class="narrow">
'; ?>
<?php
//Core::get_element(sprintf('quiz.%s', $element));
?>
<? $view_output .= '
            </div>
        </div>
    </section>
</div>
'; ?>
<?php Core::get_element('footer'); ?>