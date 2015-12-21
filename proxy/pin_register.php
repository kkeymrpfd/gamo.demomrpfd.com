<?
$pin = (isset($_GET['pin'])) ? $_GET['pin'] : '';
$result = file_get_contents('http://192.168.128.53/?a=pin_register&pin=' . $pin);
echo $result;
?>