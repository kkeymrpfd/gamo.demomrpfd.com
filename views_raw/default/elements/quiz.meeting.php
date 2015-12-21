<?php
    $meeting = array(
        'points' => 50,
        'gift' => '[gift]',
    );
?>
/start_view
<div class="response">
    <div class="textCentered">
        <h3 class="textBlue noMargin">BONUS ROUND!</h3>
        <h3 class="textBold">Schedule a phone meeting to earn</h3>
        <h2 class="textCentered"><span class="textGreen large">' . $meeting['points'] . '</span> pts</h2>
        <h6 class="textBold"><span class="textBlue">Double Bonus:</span> When you attend the meeting you\'ll receive ' . $meeting['gift'] . '</h6>
        <h6 class="textBold">Enter a suggested date and time below:</h6>
        <div class="row marginBottom">
            <div class="column two alignMiddle">
                <label for="date" class="textRight textBold noMargin">Date:</label>
            </div>
            <div class="column four">
                <input type="text" name="date" class="dateInput noMargin" id="date" />
            </div>
            <div class="column two alignMiddle">
                <label for="time" class="textRight textBold noMargin">Time:</label>
            </div>
            <div class="column four">
                <select name="time" id="time" class="noMargin">
                    <option value="9:00am">9:00am</option>
                    <option value="10:00am">10:00am</option>
                    <option value="11:00am">11:00am</option>
                    <option value="12:00pm">12:00pm</option>
                    <option value="1:00pm">1:00pm</option>
                    <option value="2:00pm">2:00pm</option>
                    <option value="3:00pm">3:00pm</option>
                    <option value="4:00pm">4:00pm</option>
                </select>
            </div>
        </div>
        <a href="#" class="button blue lg full marginBottomSM"><span>Submit</span></a>
        <a href="#">Skip</a>
    </div>
</div>
/end_view