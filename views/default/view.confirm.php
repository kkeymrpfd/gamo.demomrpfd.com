<?php
    Core::get_element('header', array('title' => 'Confirm', 'bodyClasses' => 'confirm'));
?>
<? $view_output .= '
<script src="js/gamo/confirmer.js?t=' . time() . '"></script>
<div id="pageConfirm">
    <section class="section paddingTop cubesBG styles">
        <div class="videoBackground">
            <div class="videoBackgroundInner">
                <video id="video-cubes" autoplay loop muted>
                    <source src="/video/cubes.mp4" type="video/mp4" />
                    <source src="/video/cubes.ogv" type="video/ogg" />	
                </video>
            </div>
        </div>
        <div class="inner">
            <div class="row mobileBreakColumns">
                <div class="column six">
                    <div class="logoWrap">
                        <div class="logo techTrivia">TechTrivia</div>
                        <div class="sponsored">
                            <span>Sponsored by:</span>
                            <div class="logo emc">EMC</div>
                        </div>
                    </div>
                    <h4>You\'ve been invited to play Tech Trivia!</h4>
                    <h4 class="textBlue noMargin">Who invented the first floppy disc storage?</h4>
                    <h6 class="textLight">Know the answer? Then you are well on your way to winning some great prizes!</h6>
                </div>
                <div class="column six alignBottom mobileHide">
                    <div class="stretchImg">
                        <img src="/img/screenshot-header.png" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section green padding styles">
        <div class="inner">
            <h2>Confirm Email to Play:</h2>
            <form confirm-form="1">
                <div class="row mobileBreakColumns">
                    <div class="column ten">
                        <input type="text" confirm-field="email" id="email" value="' . $data['user_email'] . '" />
                        <div>
                            <input type="checkbox" confirm-field="tnc" id="acceptTerms"' . $data['tnc_checked'] . ' />
                            <label for="acceptTerms">I accept the <a href="#">terms and conditions</a></label>
                        </div>
                    </div>
                    <div class="column two mobileTextRight">
                        <button type="submit" class="button blue full wide mobileInlineBlock"><span>Submit</span></button>
                    </div>
                </div>
                <input type="hidden" confirm-field="register_pin" id="register_pin" value="' . Core::safe_echo($data['register_pin']) . '" />
            </form>
        </div>
    </section>
    <section class="section white padding styles mobileTextCentered">
        <div class="inner">
            <h2 class="textBlue">Here\'s how it works:</h2>
            <div class="row mobileBreakColumns">
                <div class="column two alignMiddle alignCenter mobileHide">
                    <div class="textBlue textHuge">1</div>
                </div>
                <div class="column six alignMiddle alignCenter">
                    <div class="stretchImg">
                        <img src="/img/screenshot-step-1.png" alt="" />
                    </div>
                </div>
                <div class="column four alignMiddle">
                    <h3 class="noMargin textBlue">Start the Game!</h3>
                    <h6>You can access the game right from your mobile device or desktop. Play when it\'s convenient for you!</h6>
                </div>
            </div>
        </div>
        <div class="divider blue">&nbsp;</div>
        <div class="inner">
            <div class="row mobileBreakColumns">
                <div class="column two alignMiddle alignCenter mobileHide">
                    <div class="textGreen textHuge">2</div>
                </div>
                <div class="column six alignMiddle alignCenter">
                    <div class="stretchImg">
                        <img src="/img/screenshot-step-2.png" alt="" />
                    </div>
                </div>
                <div class="column four alignMiddle">
                    <h3 class="noMargin textGreen">Answer 10-20 Fun Tech Trivia Questions!</h3>
                    <h6>You\'ll also have the opportunity to access some great resources that can help you in your job for bonus points!</h6>
                </div>
            </div>
        </div>
        <div class="divider green">&nbsp;</div>
        <div class="inner">
            <div class="row mobileBreakColumns">
                <div class="column two alignMiddle alignCenter mobileHide">
                    <div class="textBlue textHuge">3</div>
                </div>
                <div class="column six alignMiddle alignCenter">
                    <div class="stretchImg">
                        <img src="/img/screenshot-step-3.png" alt="" />
                    </div>
                </div>
                <div class="column four alignMiddle">
                    <h3 class="noMargin textBlue">Take Your Place Amongst Your Peers on the Leaderboard!</h3>
                    <h6>Great prizes go to the top contestants and EVERYONE WHO PARTICIPATES WINS XXXX</h6>
                </div>
            </div>
        </div>
    </section>
    <section class="section green padding styles">
        <div class="inner">
            <h2>Confirm Email to Play:</h2>
            <form confirm-form="1">
                <div class="row mobileBreakColumns">
                    <div class="column ten">
                        <input type="text" confirm-field="email" value="' . $data['user_email'] . '" />
                        <div>
                            <input type="checkbox" confirm-field="tnc" id="acceptTerms"' . $data['tnc_checked'] . ' />
                            <label for="acceptTerms">I accept the <a href="#">terms and conditions</a></label>
                        </div>
                    </div>
                    <div class="column two mobileTextRight">
                        <button type="submit" class="button blue full wide mobileInlineBlock"><span>Submit</span></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
'; ?>
<?php Core::get_element('footer'); ?>
