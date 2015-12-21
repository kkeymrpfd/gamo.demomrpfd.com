<?php
    Core::get_element('header', array('title' => 'Profile', 'bodyClasses' => 'profile'));
    
    $user_id = 2;
    $leaders = array(
        array(
            'user_id' => 1,
            'rank' => 1,
            'name' => 'User 1',
            'points' => 99,
        ),
        array(
            'user_id' => 2,
            'rank' => 2,
            'name' => 'User 2',
            'points' => 85,
        ),
        array(
            'user_id' => 3,
            'rank' => 3,
            'name' => 'User 3',
            'points' => 80,
        ),
        array(
            'user_id' => 4,
            'rank' => 4,
            'name' => 'User 4',
            'points' => 78,
        ),
        array(
            'user_id' => 5,
            'rank' => 5,
            'name' => 'User 5',
            'points' => 70,
        ),
        array(
            'user_id' => 6,
            'rank' => 6,
            'name' => 'User 6',
            'points' => 66,
        ),
        array(
            'user_id' => 7,
            'rank' => 7,
            'name' => 'User 7',
            'points' => 64,
        ),
        array(
            'user_id' => 8,
            'rank' => 8,
            'name' => 'User 8',
            'points' => 62,
        ),
        array(
            'user_id' => 9,
            'rank' => 9,
            'name' => 'User 9',
            'points' => 58,
        ),
        array(
            'user_id' => 10,
            'rank' => 10,
            'name' => 'User 10',
            'points' => 50,
        ),
    );

if($data['quiz']['next_question_key'] != -1) {

    $play_now = '<h3 class="textCentered">
                    Remember to get ready, because each of the trivia questions are timed
                    and will begin when you hit Play Now below!
                </h3>
                <a href="/?p=quiz" class="button blue gigantic full"><span>Play Now!</span></a>';

} else {

    $play_now = '<h3 class="textCentered">
                    Thank you for completing the quiz!
                </h3>';

}
?>
<? $view_output .= '
<div id="pageDashboard">
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
                ' . $play_now . '
            </div>
        </div>
        <div class="divider blue">&nbsp;</div>
        <div class="inner">
            <div class="narrow">
                <h2 class="textBlue mobileTextCentered">Prizes</h2>
                <div class="row mobileBreakColumns textCentered">
                    <div class="column six">
                        <div class="row">
                            <div class="column six">
                                <h4 class="textBlue noMargin">1st Place</h5>
                                <h6 class="noMargin">Most Points</h6>
                                <h5>MacBook Pro!</h5>
                            </div>
                            <div class="column six">
                                <h4 class="textBlue noMargin">2nd Place</h5>
                                <h6 class="noMargin">2nd Most Points</h6>
                                <h5>[Prize]</h5>
                            </div>
                        </div>
                    </div>
                    <div class="column six">
                        <div class="row">
                            <div class="column six">
                                <h4 class="textBlue noMargin">3rd Place</h5>
                                <h6 class="noMargin">3rd Most Points</h6>
                                <h5>[Prize]</h5>
                            </div>
                            <div class="column six">
                                <h4 class="textBlue noMargin">4th Place</h5>
                                <h6 class="noMargin">4th Most Points</h6>
                                <h5>[Prize]</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mobileBreakColumns textCentered">
                    <div class="column six">
                        <div class="row">
                            <div class="column six">
                                <h4 class="textBlue noMargin">5th Place</h5>
                                <h6 class="noMargin">5th Most Points</h6>
                                <h5>[Prize]</h5>
                            </div>
                            <div class="column six">
                                <h4 class="textBlue noMargin">6th Place</h5>
                                <h6 class="noMargin">6th Most Points</h6>
                                <h5>[Prize]</h5>
                            </div>
                        </div>
                    </div>
                    <div class="column six">
                        <div class="row">
                            <div class="column six">
                                <h4 class="textBlue noMargin">7th Place</h5>
                                <h6 class="noMargin">7th Most Points</h6>
                                <h5>[Prize]</h5>
                            </div>
                            <div class="column six">
                                <h4 class="textBlue noMargin">8th Place</h5>
                                <h6 class="noMargin">8th Most Points</h6>
                                <h5>[Prize]</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider blue">&nbsp;</div>
        <div class="inner">
            <div class="narrow">
                <h2 class="textBlue mobileTextCentered">Leaderboard</h2>
                <div class="row mobileBreakColumns">
                    <div class="leaderboard column six">
'; ?>
<?php
                    $count = 1;
                    foreach ($data['leaders']['users'] as $leader) :
?>
<? $view_output .= '
                        <div class="leader row' . sprintf('%s', ($leader['user_id'] === $user_id) ? ' currentUser' : null) . '">
                            <div class="column two alignMiddle"><h4 class="textBlue noMargin">' . $leader['rank'] . '</h4></div>
                            <div class="column six alignMiddle"><h5 class="noMargin">' . $leader['display_name'] . '</h5></div>
                            <div class="column four alignMiddle"><h5 class="textLight noMargin"><span class="textBlue textBold">' . $leader['points'] . '</span> Points</h5></div>
                        </div>
'; ?>
<?php               if ($count == 5) : ?>
<? $view_output .= '
                    </div>
                    <div class="column six">
'; ?>
<?php               endif; ?>
<? $view_output .= '

'; ?>
<?php
                        $count++;
                    endforeach;
?>
<? $view_output .= '
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
'; ?>
<?php Core::get_element('footer'); ?>
