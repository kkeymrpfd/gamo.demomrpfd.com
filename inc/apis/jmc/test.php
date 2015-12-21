<?
require('/www/sites/jmc/inc/config.php');
require('/www/sites/jmc/inc/loader.php');
require('/www/sites/jmc/inc/apis/jmc/class.Gamo_JMC_Api.php');

/*
// Remove points and badges
$sql = 'TRUNCATE ' . GAMO_DB . '.users_info';
$sth = $dbh->prepare($sql);
$sth->execute();

$sql = 'TRUNCATE ' . GAMO_DB . '.actions_log';
$sth = $dbh->prepare($sql);
$sth->execute();

$sql = 'TRUNCATE ' . GAMO_DB . '.users';
$sth = $dbh->prepare($sql);
$sth->execute();

$result = $jmc->pull_users();
$result = $jmc->make_request(array(
		'type' => 'GetActions'
	)
);

$result = $jmc->save_picture(array(
		'url' => 'http://jmc.averetek.com/UserData/5102/ProfilePictures/b1d22f19-631d-4520-afa7-57cd47e72dfb.jpg',
		'user_id' => 5
	)
);
*/

$result = $jmc->make_request(array(
		'type' => 'GetAllPartnersAndUsers'
	)
);

Core::print_r($result);

?>