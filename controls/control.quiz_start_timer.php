<?
// Answer a quiz question
class Control_Quiz_Start_Timer {

	function run($options = array()) {
		
		global $data, $page_settings, $models, $session, $gamo;
		
		Core::authorize(array(
				'user_id' => $data['user_id']
			)
		);

		Core::ensure_defaults(array(
				'question_id' => Core::get_input('question_id', 'get')
			)
		, $options);

		$result = Core::r('quiz')->start_question_timer(array(
				'user_id' => $data['user_id'],
				'question_id' => $options['question_id']
			)
		);

		Core::shift_data($result);

		$page_settings['allow_json'] = 1;

		return $data;

	}

}
?>
