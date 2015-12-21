<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Fix_Register {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		$sql = "SELECT
		user_id,
		email,
		(
			SELECT
			time
			FROM " . GAMO_DB . ".logins AS a
			WHERE
			a.user_id = " . GAMO_DB . ".users.user_id
			ORDER BY
			a.login_id ASC LIMIT 0, 1
		) AS login_time
		FROM
		" . GAMO_DB . ".users 
		WHERE
			(
				SELECT count(*)
				FROM " . GAMO_DB . ".users_info AS a 
				WHERE a.user_id = " . GAMO_DB . ".users.user_id AND info_type = 'register_datetime'
			) = 0
			AND (
			SELECT
			count(*)
			FROM " . GAMO_DB . ".logins AS a
			WHERE
			a.user_id = " . GAMO_DB . ".users.user_id
			) > 0
		LIMIT 0, 100";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		while($row = $sth->fetch()) {

			Core::print_r($row);
			Core::r('actions')->create_action(array(
					'user_id' => $row['user_id'],
					'action_types_id' => 'register_portal',
					'time' => $row['login_time']
				)
			);

			Core::r('users')->create_user_info(array(
					'user_id' => $row['user_id'],
					'info_type' => 'register_datetime',
					'time' => $row['login_time']
				)
			);

		}

		return $data;

	}

}
?>
