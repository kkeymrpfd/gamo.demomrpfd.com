<?
class Model_Badge_Check {

	function run($options = array()) {

		global $data, $dbh, $gamo;

		Core::ensure_defaults(array(
				'badge_ids' => Core::get_input('badge_ids', 'get'),
				'user_id' => $data['user_id']
			)
		, $options);

		$result['badge_id'] = -1;

		if(count($options['badge_ids']) == 0) {

			$result['error'] = 'No badges defined';
			return $result;

		}

		$badge_ids = explode("_", $options['badge_ids']);
		
		foreach($badge_ids as $k => $v) {

			$badge_ids[$k] = (int)$v;

		}

		$badge_id = Core::fetch_column(
			"SELECT badge_id FROM " . GAMO_DB . ".users_info WHERE user_id = :user_id AND badge_id IN (" . implode(',', $badge_ids) . ")",
			array(
				':user_id' => $options['user_id']
			)
		);
		
		
		if($badge_id === FALSE) {

			return $result;

		}
		
		// Determine if user has already seen this badge
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.users_info',
				'values' => array(
					'user_id' => $data['user_id'],
					'info_type' => 'badge_seen',
					'int_info' => $badge_id
				)
			)
		);


		if($c > 0) { // User has already seen this badge

			return $result;

		}

		$result['badge_id'] = $badge_id;

		$sql = "SELECT
		badge_name,
		(
			SELECT
			info
			FROM " . GAMO_DB . ".badges_info
			WHERE
			badge_id = :badge_id
			AND info_type = 'display_earned'
			LIMIT 0, 1
		) AS display_earned,
		(
			SELECT
			info
			FROM " . GAMO_DB . ".badges_info
			WHERE
			badge_id = :badge_id
			AND info_type = 'social_share'
			LIMIT 0, 1
		) AS social_share
		FROM " . GAMO_DB . ".badges
		WHERE
		badge_id = :badge_id";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':badge_id' => $badge_id
			)
		);

		$row = $sth->fetch();

		if(is_array($row)) {

			Core::remove_numeric_keys($row);
			foreach($row as $k => $v) {

				$result[$k] = $v;

			}

		}
		
		// Record that the user has seen this badge
		Core::r('users')->create_user_info(array(
				'user_id' => $options['user_id'],
				'info_type' => 'badge_seen',
				'int_info' => $badge_id
			)
		);

		return $result;

	}

}

?>
