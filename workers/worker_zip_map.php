<?
// Pull users and actions from Averetek
require(dirname(dirname(__FILE__)) . '/inc/config.php');
require(dirname(dirname(__FILE__)) . '/inc/loader.php');

$sql = "SELECT * FROM " . GAMO_DB . ".users where zip != '' AND state = ''";
$sth = $dbh->prepare($sql);

while($row = $sth->fetch()) {

	Core::print_r($row);

}