<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Clear_Points {

	function run() {

		global $data, $page_settings, $models, $session, $gamo, $dbh;

		if(Core::get_input('clear', 'get') != 'go') {

			header("Location: /");
			die();

		}
		die();
		$sql = "DELETE FROM " . GAMO_DB . ".actions_log WHERE user_id IN (SELECT user_id FROM " . GAMO_DB . ".users WHERE email LIKE '%@entermarketing.com')";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$sql = "DELETE FROM " . GAMO_DB . ".actions_info WHERE action_id IN (SELECT action_id FROM " . GAMO_DB . ".actions_log AS a WHERE a.user_id IN (SELECT user_id FROM " . GAMO_DB . ".users WHERE email LIKE '%@entermarketing.com'))";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$sql = "DELETE FROM " . GAMO_DB . ".meetings WHERE user_id IN (SELECT user_id FROM " . GAMO_DB . ".users WHERE email LIKE '%@entermarketing.com')";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$sql = "DELETE FROM " . GAMO_DB . ".users_info WHERE (badge_id > 0 OR info_type = 'badge_seen') AND user_id IN (SELECT user_id FROM " . GAMO_DB . ".users WHERE email LIKE '%@entermarketing.com')";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$sql = "UPDATE " . GAMO_DB . ".users SET points = 0 WHERE email LIKE '%@entermarketing.com%'";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$sql = "DELETE FROM " . GAMO_DB . ".notify WHERE user_id IN (SELECT user_id FROM " . GAMO_DB . ".users WHERE email LIKE '%@entermarketing.com')";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$sql = "DELETE FROM " . GAMO_DB . ".quiz_answer_times WHERE user_id IN (SELECT user_id FROM " . GAMO_DB . ".users WHERE email LIKE '%@entermarketing.com')";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		Core::db_update(array(
				'table' => GAMO_DB . '.quiz_questions',
				'values' => array(
					'locked' => 1
				),
				'where' => array(
					'locked' => 2
				)
			)
		);

		echo "Points and awards have been reset!";
		die();

		return $data;

	}

}
?>
