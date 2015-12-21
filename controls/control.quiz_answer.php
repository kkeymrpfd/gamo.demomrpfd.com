<?
// Answer a quiz question
class Control_Quiz_Answer {

	function run($options = array()) {
		
		global $data, $page_settings, $models, $session, $gamo;
		
		if(!isset($_COOKIE['allow']) || $_COOKIE['allow'] != 1) {

        	//echo 'No access';
        	//die();

        }
        
        
		Core::authorize(array(
				'user_id' => $data['user_id']
			)
		);
		

		Core::ensure_defaults(array(
				'question_id' => Core::get_input('question_id', 'get'),
				'answer_id' => Core::get_input('answer_id', 'get'),
				'poll_answers' => Core::get_input('poll_answers', 'get')
			)
		, $options);

		$quiz_id = Core::fetch_column(
			"SELECT quiz_id FROM " . GAMO_DB . ".quiz_questions WHERE question_id = :question_id",
			array(
				':question_id' => $options['question_id']
			)
		);

		$result['next_question'] = Core::r('quiz')->user_next_question(array(
				'user_id' => $data['user_id'],
				'quiz_id' => $quiz_id
			)
		);
		
		if($result['next_question']['next_question_id'] != $options['question_id'] || $result['next_question']['allowed'] == 0) {

			echo 'Not allowed';
			die();

		}

		$result = Core::r('quiz')->answer_question(array(
				'user_id' => $data['user_id'],
				'question_id' => $options['question_id'],
				'answer_id' => $options['answer_id'],
				'points_countdown' => 1,
				'poll_answers' => $options['poll_answers']
			)
		);

		$result['next_question'] = Core::r('quiz')->user_next_question(array(
				'user_id' => $data['user_id'],
				'quiz_id' => $quiz_id
			)
		);

		if($result['next_question'] == $options['question_id']) {

			$result['next_question'] = -1;

		}

		$user = Core::r('users')->get_user(array(
				'user_id' => $data['user_id'],
				'get_has' => 0
			)
		);

		$result['user_points'] = $user['points'];
		
		Core::shift_data($result);

		$page_settings['allow_json'] = 1;

		return $data;

	}

}
?>
