<?php
    // TEMP DATA
    $data['user'] = array(
        'name' => 'Tim Freestone',
        'points' => 225,
        'rank' => 13,
    );
    
    $data['actions'] = array(
        array(
            'description' => '[Partner Name] QR Code',
            'points' => 100,
        ),
        array(
            'description' => '[Partner Name] Question 1',
            'points' => 0,
        ),
        array(
            'description' => '[Partner Name] Question 2',
            'points' => 100,
        ),
    );
    
    $data['showApp'] = true;
?>
<?php Core::get_element('header', array('title' => 'Profile', 'bodyClasses' => 'profile')); ?>
/start_view
<div id="profile">
    <section class="section blue styles">
        <div class="inner">
            <h1 class="noMargin textWhite">' . $data['user']['name'] . '</h1>
        </div>
    </section>
</div>
/end_view
<?php Core::get_element('footer'); ?>