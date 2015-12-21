<?
$pin = (isset($_GET['pin'])) ? $_GET['pin'] : '';
$slot_id = (isset($_GET['slot_id'])) ? $_GET['slot_id'] : '';
$result = file_get_contents('http://192.168.128.53/?a=reserve_slot_meeting&slot_id=' . $slot_id . '&pin=' . $pin);
echo $result;
?>