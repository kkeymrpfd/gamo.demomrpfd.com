<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Broadcast_Winner {

	function run($options = array()) {

		global $data, $page_settings, $models, $session, $dbh, $gamo;

		$page_settings['allow_json'] = 1;

		Core::ensure_defaults(array(
				'quiz_id' => Core::get_input('quiz_id', 'get')
			)
		, $options);

		// Retrieve top 10 players
		$action_type = Core::r('actions')->action_types_id('answer_quiz');

		$sql = "SELECT
		user_id,
		SUM(point_value_used) AS total_points
		FROM
		" . GAMO_DB . ".actions_log
		WHERE
		action_types_id = :action_types_id
		AND other_b = :other_b
		GROUP BY user_id
		ORDER BY total_points DESC
		LIMIT 0, 20";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $action_type,
				':other_b' => $options['quiz_id']
			)
		);

		$top_points = -1;

		$users = array();

		while($row = $sth->fetch()) {

			if($top_points == -1 || $row['total_points'] >= $top_points) {

				$top_points = $row['total_points'];

				$user = Core::r('users')->get_user(array(
						'user_id' => $row['user_id'],
						'get_has' => 0
					)
				);
				$row['first_name'] = $user['first_name'];
				$row['last_name'] = $user['last_name'];
				array_push($users, Core::remove_numeric_keys($row));

			}

		}

		$data['winners'] = $users;

		return $data;

	}

}
?>
