<?
class Control_Quiz_Pin_Unlock {

	function run($options = array()) {

		global $page_settings, $data, $gamo;

		Core::authorize();

		$page_settings['allow_json'] = 1;

		Core::ensure_defaults(array(
				'quiz_id' => Core::get_input('quiz_id'),
				'pin' => Core::get_input('pin')
			)
		, $options);
		
		// Determine if quiz id and pin is valid
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.quizzes_info',
				'values' => array(
					'quiz_id' => $options['quiz_id'],
					'info_type' => 'require_pin',
					'info' => $options['pin']
				)
			)
		);

		$data['error'] = '';
		$data['success'] = 0;

		if($c == 0) {

			$data['error'] = "The pin you entered is not valid. Please try again.";
			return $data;

		}

		$action_type = Core::r('actions')->action_types_id('quiz_pin_unlock');

		/*
		// Determine if user has already unlocked a quiz
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.actions_log',
				'values' => array(
					'action_types_id' => $action_type,
					'user_id' => $data['user_id']
				)
			)
		);

		if($c > 0) {

			$data['error'] = "You have already played a live trivia round! Thank you for playing!";
			return $data;

		}
		*/

		Core::r('actions')->create_action(array(
				'user_id' => $data['user_id'],
				'action_types_id' => $action_type,
				'int_other' => $options['quiz_id'],
				'other' => $options['pin']
			)
		);

		$data['success'] = 1;

		return $data;

	}

}
?>