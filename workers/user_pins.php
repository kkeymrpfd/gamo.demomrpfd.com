<?
// Ensure that all users have a pin
require(dirname(dirname(__FILE__)) . '/inc/config.php');
require(dirname(dirname(__FILE__)) . '/inc/loader.php');
require(DIR_INC . '/gamo/class.Gamo.php');

$gamo = new Gamo();

$sql = "SELECT user_id FROM " . GAMO_DB . ".users AS users
WHERE
(
	SELECT count(*) FROM " . GAMO_DB . ".users_info AS a
	WHERE a.user_id = users.user_id
	AND a.info_type = 'pin'
) = 0";

$sth = $dbh->prepare($sql);
$sth->execute();

while($row = $sth->fetch()) {

	Core::print_r($row);

	Core::r('users')->create_user_info(array(
			'user_id' => $row['user_id'],
			'info_type' => 'pin',
			'info' => Core::unique_string(5)
		)
	);

}

?>