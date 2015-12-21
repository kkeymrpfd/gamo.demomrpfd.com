<?
class Model_Admin_User {

	function run($options = array()) {
		
		global $gamo;

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		if(!is_numeric($options['user_id'])) {

			$options['user_id'] = -1;

		}

		// Retrieve user info
		$data['user'] = Core::r('users')->get_user(array(
				'user_id' => $options['user_id']
			)
		);

		// Retrieve total number of badges
		$data['badge_qty'] = Core::db_count(array(
				'table' => '' . GAMO_DB . '.badges',
				'values' => array(
					'rank' => 0
				)
			)
		);

		// What percentage of badges this user has earned
		$data['badge_pct'] = floor($data['user']['badge_qty'] / $data['badge_qty'] * 100);

		$data['action_types'] = Core::r('actions')->get_action_types();
		$data['action_types'] = Core::multi_sort($data['action_types'], 'action_name');
		
		return $data;

	}

}

?>
