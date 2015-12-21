<?
/*
Looks up a user based on e-mail address to see if they are already registered, needs a password, or can log in
*/
class Control_Quiz_Lock {

	function run() {

		global $gamo, $session, $dbh, $data, $page_settings;

		$page_settings['allow_json'] = 1;

		$result = Core::db_update(array(
				'table' => GAMO_DB . '.quizzes_info',
				'values' => array(
					'quiz_id' => Core::get_input('quiz_id', 'get'),
					'int_info' => (Core::get_input('locked', 'get') == 1) ? 1 : 0
				),
				'where' => array(
					'quiz_id' => Core::get_input('quiz_id', 'get'),
					'info_type' => 'locked'
				)
			)
		);

		echo "Update run: " . $result;

		return $data;

	}

}
?>