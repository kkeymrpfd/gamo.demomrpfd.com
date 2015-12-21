<?
// Handle submission of all answers to a quiz at once
class Control_Quiz_Full_Submit {

	function run() {

		global $data, $page_settings, $gamo, $session, $dbh;

		Core::authorize();

		$page_settings['allow_json'] = 1;

		$quiz_id = Core::get_input('quiz_id');

		// Determine if the quiz is valid
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.quizzes',
				'values' => array(
					'quiz_id' => $quiz_id
				)
			)
		);

		$data['error'] = '';

		if($c == 0) {

			$data['error'] = "Invalid quiz";
			return $data;

		}

		// Determine # of questions
		$real_questions = array();

		$sql = "SELECT question_id FROM " . GAMO_DB . ".quiz_questions WHERE quiz_id = :quiz_id";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':quiz_id' => $quiz_id
			)
		);

		while($row = $sth->fetch()) {

			array_push($real_questions, $row['question_id']);

		}

		$question_answers = array();

		foreach($real_questions as $k => $question_id) {

			$answer_id = Core::get_input('question_' . $question_id);

			if(!is_numeric($answer_id)) {

				$data['error'] = "Please answer all of the questions to continue";
				return $data;

			}

			// Determine if answer is a valid option
			$c = Core::db_count(array(
					'table' => GAMO_DB . '.quiz_answers',
					'values' => array(
						'question_id' => $question_id,
						'answer_id' => $answer_id
					)
				)
			);

			if($c == 0) {

				$data['error'] = "There was an error while processing your request. Please refresh the page and try again.";
				return $data;

			}

			$question_answers[$question_id] = $answer_id;

		}

		$action_type = Core::r('actions')->action_types_id(array('action_key' => 'answer_quiz'));

		foreach($question_answers as $question_id => $answer_id) {

			// Determine if user has already answered this questions. If they have, then delete them
			$action_id = Core::fetch_column("SELECT action_id FROM " . GAMO_DB . ".actions_log
				WHERE
				action_types_id = :action_types_id
				AND user_id = :user_id
				AND int_other = :int_other",
				array(
					':action_types_id' => $action_type,
					':user_id' => $data['user_id'],
					':int_other' => $question_id
				)
			);

			if($action_id !== FALSE) { // This question was already answered. Delete that action

				Core::r('actions')->modify_action(array(
						'action_id' => $action_id,
						'values' => 'delete'
					)
				);

				Core::db_delete(array(
						'table' => GAMO_DB . '.actions_log',
						'values' => array(
							'action_id' => $action_id
						)
					)
				);

				Core::db_delete(array(
						'table' => GAMO_DB . '.actions_info',
						'values' => array(
							'action_id' => $action_id
						)
					)
				);

			}

			// Answer question
			$result = Core::r('quiz')->answer_question(array(
					'user_id' => $data['user_id'],
					'question_id' => $question_id,
					'answer_id' => $answer_id,
					'text_field' => ltrim(rtrim(Core::get_input('answer_field_' . $answer_id)))
				)
			);

		}

		return $data;

	}

}
?>