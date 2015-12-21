<?
class Model_Home {

	function run($options = array()) {
		
		/*
		arguments:
		{
			user_id: the user to retrieve info for
		}
		*/

		global $gamo, $dbh, $session;

		// Ensure defaults
		Core::ensure_defaults(array(
				'user_id' => -1,
				'msg' => Core::get_input('msg', 'get'),
				'leaders_has' => 1
			)
		, $options);

		// Retrieve user info
		$user = Core::r('users')->get_user(array(
				'user_id' => $options['user_id']
			)
		);

		$data['user'] = $user;
		
		if(Core::multi_find($user['has'], 'info_type', 'visited') == -1) {

			$data['first_visit'] = 1;

			$result = Core::r('users')->create_user_info(array(
					'user_id' => $options['user_id'],
					'info_type' => 'visited',
					'int_info' => 1
				)
			);

		} else {

			$data['first_visit'] = 0;

		}

		// Retrieve total number of badges
		$data['badge_qty'] = Core::db_count(array(
				'table' => '' . GAMO_DB . '.badges',
				'values' => array(
					'rank' => 0
				)
			)
		);
		
		$data['badges'] = Core::r('reward_manager')->get_badges(array(
				'user_id' => $options['user_id']
			)
		);

		$has_qty = 0;

		foreach($data['badges'] as $k => $v) {

			$find = Core::multi_find($data['user']['has'], 'badge_id', $v['badge_id']);

			if($v['user_has'] > 0) {

				++$has_qty;

			}

		}

		$data['user_has_qty'] = $has_qty;

		// What percentage of badges this user has earned
		$data['badge_pct'] = ($data['badge_qty'] > 0) ? floor($data['user']['badge_qty'] / $data['badge_qty'] * 100) : 0;


		$data['leaders'] = Core::r('users')->get_users(array(
				'start' => 0,
				'records' => 15,
				'get_has' => $options['leaders_has']
			)
		);
		
		$data['mini_leaders'] = $data['leaders'];

		if($data['user']['rank'] > 4) {

			$data['mini_leaders']['users'][3] = $data['user'];

		}

		$user_group = Core::multi_get($data['user']['has'], 'info_type', 'user_group', 'info');

		$data['mini_leaders']['users'] = array_splice($data['mini_leaders']['users'], 0, 4);

		$data['next_level'] = array();
		$user_level = 1;

		// Determine current user level
		foreach($data['user']['has'] as $k => $has) {

			if($has['rank'] > $user_level) {

				$user_level = $has['rank'];

			}

		}
		
		//$data['badges'] = Core::multi_sort($data['badges'], 'rank');

		// Determine next level
		foreach($data['badges'] as $k => $badge) {

			if($badge['rank'] > $user_level) {

				$data['next_level'] = $badge;
				break;

			}

		}

		if(isset($data['next_level']['rank'])) {

			$sql = "SELECT
				points
				FROM " . GAMO_DB . ".badges_info
				WHERE badge_id = :badge_id
				AND info_type = 'min_points'";

			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':badge_id' => $data['next_level']['badge_id']
				)
			);

			$points = $sth->fetchColumn();
			
			if(!is_numeric($points)) {

				$points = 9999999;

			}

			$data['next_level']['min_points'] = $points;

		}

		$has_property = Core::r('users')->has_property(array(
				'user_id' => $options['user_id'],
				'values' => array(
					'info_type' => 'scan_prompt_closed'
				)
			)
		);

		$data['scan_prompt_closed'] = (!Core::has_error($has_property) && $has_property['has'] == 1) ? 1 : 0;

		if($data['scan_prompt_closed'] == 0 && $data['user']['points'] > 0) {

			$data['scan_prompt_closed'] = 1;

		}

		$answer_quiz = Core::r('actions')->action_types_id(array('action_key' => 'answer_quiz'));
		$qr_scan = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));
		$phone_meeting = Core::r('actions')->action_types_id(array('action_key' => 'schedule_meeting'));
		$inperson_meeting = Core::r('actions')->action_types_id(array('action_key' => 'reserve_slot_meeting'));
		$register = Core::r('actions')->action_types_id(array('action_key' => 'register_portal'));
		$preregister = Core::r('actions')->action_types_id(array('action_key' => 'preregister'));
		$complete_quiz = Core::r('actions')->action_types_id(array('action_key' => 'complete_quiz'));
		$bonus_points = Core::r('actions')->action_types_id(array('action_key' => 'bonus_points'));
		$download_resource = Core::r('actions')->action_types_id(array('action_key' => 'download_resource'));
		$share_resource = Core::r('actions')->action_types_id(array('action_key' => 'share_resource'));
		$social_action_ids = Core::r('actions')->get_action_types(array('category_tag' => 'social_media'));
		
		$schedule_meeting_clevel = Core::r('actions')->action_types_id(array('action_key' => 'schedule_meeting_clevel'));
		$schedule_meeting_manager = Core::r('actions')->action_types_id(array('action_key' => 'schedule_meeting_manager'));
		$transacted_meeting_manager = Core::r('actions')->action_types_id(array('action_key' => 'transacted_meeting_manager'));
		$transacted_meeting_clevel = Core::r('actions')->action_types_id(array('action_key' => 'transacted_meeting_clevel'));
		$won_meeting = Core::r('actions')->action_types_id(array('action_key' => 'won_meeting'));
		$poc_meeting = Core::r('actions')->action_types_id(array('action_key' => 'poc_meeting'));
		$register_portal = Core::r('actions')->action_types_id(array('action_key' => 'register_portal'));
		
		$sm_ids=array();
		$sm_names_ids=array();
		foreach($social_action_ids as $sm_id){
			
			$sm_ids[]=$sm_id['action_types_id'];
			$sm_names_ids[$sm_id['action_types_id']]=$sm_id['action_name'];
			
		}
		
		$sm_ids_str='';
		if(!empty($sm_ids)){
			$sm_ids_str=",".implode(",",$sm_ids);
		}

		
		// Retrieve recent quiz activity
		$sql = "SELECT
		point_value_used,
		action_types_id,
		(
			SELECT
			sort_order
			FROM " . GAMO_DB . ".quiz_questions AS a
			WHERE
			a.question_id = " . GAMO_DB . ".actions_log.int_other
			LIMIT 0, 1
		) AS question_number,
		(
			SELECT
			quiz_name
			FROM " . GAMO_DB . ".quizzes AS a
			WHERE
			a.quiz_id = " . GAMO_DB . ".actions_log.other_b
		) AS quiz_name,
		time,
		int_other,
		other_b
		FROM
		" . GAMO_DB . ".actions_log
		WHERE
		user_id = :user_id
		AND 
		(
			point_value_used > 0
			OR
			action_types_id = " . $answer_quiz. "
		)
		AND action_types_id IN (" . $download_resource . "," . $share_resource . "," . $answer_quiz . "," 
		
		. $inperson_meeting . ", "  . $register_portal . ", "
		
		. $schedule_meeting_clevel . ", " . $schedule_meeting_manager . ", " . $transacted_meeting_manager . ", " . $transacted_meeting_clevel . ", " . $won_meeting . ", " . $poc_meeting . ", "
		
		. $register . ", " . $preregister . ", " . $qr_scan . $sm_ids_str . ")
		
		
		";

		$sql = str_replace(', )', ')', $sql);
		$sql = str_replace(',,', ',', $sql);
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id']
			)
		);
		

		$quiz_activity = array();

		$quizzes_processed = array();

		while($row = $sth->fetch()) {

			$quiz_run = 0;

			if($row['action_types_id'] == $qr_scan) {

				$row['qr_name'] = Core::fetch_column(
					"SELECT qr_name FROM " . GAMO_DB . ".qr_codes WHERE qr_id = :qr_id",
					array(
						':qr_id' => $row['int_other']
					)
				);

				$row['type'] = 'qr';
				$row['display'] = 'Scanned QR Code: ' . strip_tags($row['qr_name']);

			} else if( in_array($row['action_types_id'], array($phone_meeting, $inperson_meeting, $register, $preregister,

				$schedule_meeting_clevel, $schedule_meeting_manager, $transacted_meeting_manager, $transacted_meeting_clevel, $won_meeting, $poc_meeting, $register_portal 
		
			) ) ) {
					
				$row['type'] = 'general';
				$row['display'] = Core::fetch_column(
					"SELECT action_name FROM " . GAMO_DB . ".action_types WHERE action_types_id = :action_types_id",
					array(
						':action_types_id' => $row['action_types_id']
					)
				);

			} else if( $row['action_types_id'] == $bonus_points ) {

				$row['type'] = 'general';
				$row['display'] = 'Bonus Points!';

			} else if( $row['action_types_id'] == $download_resource ) {

				$row['type'] = 'general';
				$row['display'] = 'Download Resource';

			} else if( $row['action_types_id'] == $share_resource ) {

				$row['type'] = 'general';
				$row['display'] = 'Share Resource';

			} else if($row['action_types_id'] == $answer_quiz) {
				
				if(!in_array($row['other_b'], $quizzes_processed)) {

					$row['type'] = 'answer';
					$row['display'] = '[' . strip_tags(str_replace('QR Survey - ', '', $row['quiz_name'])) . ']';
					$row['point_value_used'] = Core::fetch_column(
						"SELECT SUM(point_value_used) FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id = :action_types_id AND other_b = :other_b",
						array(
							':user_id' => $options['user_id'],
							':action_types_id' => $answer_quiz,
							':other_b' => $row['other_b']
						)
					);

					$quiz_run = 1;

					array_push($quizzes_processed, $row['other_b']);

				}

			} else {

				$row['type'] = 'social';
				$row['display'] = $sm_names_ids[$row['action_types_id']];
				
			}

			$row['sort'] = $row['quiz_name'] . '' . $row['time'];
			
			if($row['action_types_id'] != $answer_quiz || $quiz_run == 1) {

				array_push($quiz_activity, Core::remove_numeric_keys($row));

			}

		}


		$quiz_activity = Core::multi_sort($quiz_activity, 'time', 'desc');

		$data['event_activity'] = $quiz_activity;
		
		$badges = array();

		
		$sql = "SELECT
		badge_name AS title,
		badge_id,
		rank,
		(
			SELECT
			info
			FROM " . GAMO_DB . ".badges_info AS a
			WHERE a.badge_id = " . GAMO_DB . ".badges.badge_id
			AND info_type = 'description'
		) AS description,
		(
			SELECT
			info
			FROM " . GAMO_DB . ".badges_info AS a
			WHERE a.badge_id = " . GAMO_DB . ".badges.badge_id
			AND info_type = 'prize' LIMIT 0, 1
		) AS prize
		FROM " . GAMO_DB . ".badges
		WHERE
		(
			(
				SELECT
				count(*) FROM " . GAMO_DB . ".badges_info AS a
				WHERE
				a.badge_id = " . GAMO_DB . ".badges.badge_id
				AND info_type = 'user_group'
			) = 0
			OR
			(
				SELECT
				count(*) FROM " . GAMO_DB . ".badges_info AS a
				WHERE
				a.badge_id = " . GAMO_DB . ".badges.badge_id
				AND info_type = 'user_group'
				AND info = :info
			) = 1
		)
		ORDER BY
		ordered ASC, rank ASC, badge_name ASC";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':info' => $user_group
			)
		);
		
		

		while($row = $sth->fetch()) {

			$row['user_has'] = Core::multi_get($data['badges'], 'badge_id', $row['badge_id'], 'user_has');

			array_push($badges, Core::remove_numeric_keys($row));

		}
		
		

		$data['user_badges'] = $badges;

		return $data;

	}

}

?>
