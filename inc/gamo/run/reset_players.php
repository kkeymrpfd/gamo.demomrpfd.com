<?
// Resets points and badges
require('config.gamo.php');

$result = '';

function reset_records() {

	global $dbh;

	$sql = 'TRUNCATE ' . GAMO_DB . '.actions_log';
	$sth = $dbh->prepare($sql);
	$sth->execute();

	$sql = "DELETE FROM " . GAMO_DB . ".users_info WHERE info_type != 'access_level'";
	$sth = $dbh->prepare($sql);
	$sth->execute();

	$sql = 'UPDATE ' . GAMO_DB . '.users SET points = 0';
	$sth = $dbh->prepare($sql);
	$sth->execute();

}

reset_records();

Core::print_r($result);


?>