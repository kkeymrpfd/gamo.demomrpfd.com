<?
class Model_Badges {

	function run($options = array()) {

		/*
		arguments:
		{
			user_id
		}

		returns:
			Returns:
			if successful:
			{
				user data
				has
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/
		global $gamo, $dbh, $session;

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		global $gamo;

		$result = array();

		$result['user'] = Core::r('users')->get_user(array(
				'user_id' => $options['user_id']
			)
		);

		$result['badges'] = Core::r('reward_manager')->get_badges();

		foreach($result['badges'] as $k => $v) {

			$find = Core::multi_find($result['user']['has'], 'badge_id', $v['badge_id']);

			$result['badges'][$k]['player_has'] = ($find != -1) ? 1 : 0;

		}

		$key = GAMO_DB . '.actions_log.user_id';

		$actions = Core::r('stats')->action_stats(array(
				'filters' => array(
					$key => $options['user_id']
				)
			)
		);

		// Retrieve all social actions
		$sql = "SELECT
			DISTINCT(action_types_id) AS action_types_id
			FROM " . GAMO_DB . ".badges_info
			WHERE
			badge_id = 10
			AND info_type = 'min_action_qty'";

		$sth = $dbh->prepare($sql);

		$sth->execute();

		$social_actions = array();

		while($row = $sth->fetch()) {

			array_push($social_actions, $row['action_types_id']);

		}

		$data['social_action_total_qty'] = count($social_actions);

		// Determine number of social actions this user has taken
		$sql = "SELECT
		count(DISTINCT action_types_id)
		FROM
		" . GAMO_DB . ".actions_log
		WHERE
		user_id = :user_id
		AND active = 1
		AND action_types_id IN (" . implode(', ', $social_actions) . ")
		";

		$sth = $dbh->prepare($sql);

		$sth->execute(array(
				':user_id' => $session->get('user_id')
			)
		);

		$data['social_action_done_qty'] = $sth->fetchColumn();

		$result['badges_output'] = array(
	        array(
	            'title' => 'Perfect Attendance',
	            'description' => 'Earned when you attend the event',
	            'prize' => 'Earn this badge and win a $5 Gift Card!',
	            'earned' => (Core::multi_find($result['badges'], array(
						'player_has' => 1,
						'badge_id' => 8
					)
				) != -1) ? true : false,
	            'progress' => min(1, $actions[Core::multi_find($actions, 'action_types_id', 12)]['action_qty']),
	            'total' => 1,
	            'badge_id' => 8,
	            'user_has' => (Core::multi_find($result['user']['has'], 'badge_id', 8) == -1) ? 0 : 1
	        ),
	        array(
	            'title' => 'Well Connected',
	            'description' => 'Earned when 10 people you invite RSVP',
	            'prize' => 'Earn this badge and win a $25 Gift Card!',
	            'earned' => (Core::multi_find($result['badges'], array(
						'player_has' => 1,
						'badge_id' => 9
					)
				) != -1) ? true : false,
	            'progress' => min(10, $actions[Core::multi_find($actions, 'action_types_id', 14)]['action_qty']),
	            'total' => 10,
	            'badge_id' => 9,
	            'user_has' => (Core::multi_find($result['user']['has'], 'badge_id', 9) == -1) ? 0 : 1
	        ),
	        array(
	            'title' => 'Mingler',
	            'description' => 'Earned when you scan at least 5 QR Codes',
	            'prize' => 'Earn this badge and win a $25 Gift Card!',
	            'earned' => (Core::multi_find($result['badges'], array(
						'player_has' => 1,
						'badge_id' => 12
					)
				) != -1) ? true : false,
	            'progress' => min(5, $actions[Core::multi_find($actions, 'action_types_id', 10)]['action_qty']),
	            'total' => 5,
	            'badge_id' => 12,
	            'user_has' => (Core::multi_find($result['user']['has'], 'badge_id', 12) == -1) ? 0 : 1
	        ),
	        array(
	            'title' => 'Social Power',
	            'description' => 'Earned when you earn at least 1 point in all social media activities',
	            'prize' => 'Earn this badge and win a $25 Gift Card!',
	            'earned' => (Core::multi_find($result['badges'], array(
						'player_has' => 1,
						'badge_id' => 10
					)
				) != -1) ? true : false,
	            'progress' => min($data['social_action_total_qty'], $data['social_action_done_qty']),
	            'total' => $data['social_action_total_qty'],
	            'badge_id' => 10,
	            'user_has' => (Core::multi_find($result['user']['has'], 'badge_id', 10) == -1) ? 0 : 1
	        )
	    );

		return $result;

	}

}

?>
