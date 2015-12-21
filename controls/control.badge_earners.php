<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Badge_Earners {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		$sql = "SELECT
		user_id,
		(
			SELECT
			badge_name
			FROM " . GAMO_DB . ".badges AS a
			WHERE
			a.badge_id = " . GAMO_DB . ".users_info.badge_id
		) AS badge_name
		FROM " . GAMO_DB . ".users_info
		WHERE badge_id IN (29, 30, 31, 32)";

		$sth = $dbh->prepare($sql);
		$sth->execute();;

		echo "Badge Earners: <br><br>";

		while($row = $sth->fetch()) {

			$user = Core::r('users')->get_user(array(
					'user_id' => $row['user_id']
				)
			);

			echo $user['first_name'] . ' ' . $user['last_name'] . ' | ' . $user['email'] . ' | ' . $row['badge_name'] . '<br><br>';

		}

		return $data;

	}

}
?>
