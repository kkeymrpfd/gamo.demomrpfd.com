<?
class Control_Quiz_State {

	function run() {

		global $data, $page_settings, $gamo, $session;

		Core::authorize();
		
		$page_settings['allow_json'] = 1;

		require_once(DIR_MODELS . "/model.quiz.php");
		$quiz = new Model_Quiz();

		$result = $quiz->run(array(
				'user_id' => $data['user_id'],
				'quiz_id' => Core::get_input('quiz_id', 'get'),
				'results' => 1
			)
		);
		
		$user = Core::r('users')->get_user(array(
				'user_id' => $data['user_id']
			)
		);

		$result['user_points'] = $user['points'];
		$result['meeting_scheduled'] = Core::r('slots')->slot_reserved(array('user_id' => $data['user_id']));

		if($result['meeting_scheduled'] == 0) {

			$result['meeting_scheduled'] = Core::r('meeting')->meeting_scheduled(array('user_id' => $data['user_id']));

		}
			
		Core::shift_data($result);

		return $data;

	}

}
?>