<?
// Make a locale entry for all action types and badges
require('config.' . GAMO_DB . '.php');

// Retrieve all locales
$sql = 'SELECT locale_id FROM ' . GAMO_DB . '.locales';

$sth = $dbh->prepare($sql);
$sth->execute();

$locales = array();

while($row = $sth->fetch()) {

	array_push($locales, $row['locale_id']);

}

$sql = 'SELECT
	action_name
	FROM ' . GAMO_DB . '.action_types';

$sth = $dbh->prepare($sql);
$sth->execute();

while($row = $sth->fetch()) {

	foreach($locales as $k => $locale_id) {

		$result = Core::r('locale')->create_text(array(
				'text_name' => $row['action_name'],
				'locale_id' => $locale_id,
				'info' => ($locale_id != Core::r('locale')->english) ? '' : $row['action_name']
			)
		);

		Core::print_r($result);

	}

}

$sql = 'SELECT
	badge_name
	FROM ' . GAMO_DB . '.badges';

$sth = $dbh->prepare($sql);
$sth->execute();

while($row = $sth->fetch()) {

	foreach($locales as $k => $locale_id) {

		$result = Core::r('locale')->create_text(array(
				'text_name' => $row['badge_name'],
				'locale_id' => $locale_id,
				'info' => ($locale_id != Core::r('locale')->english) ? '' : $row['badge_name']
			)
		);

		Core::print_r($result);

	}

}
?>
