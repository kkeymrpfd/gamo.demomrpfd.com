<?
class Model_Quiz {

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
		global $gamo, $dbh, $session, $data;

		Core::ensure_defaults(array(
				'user_id' => -1,
				'quiz_id' => -1,
				'results' => 0
			)
		, $options);

		global $gamo;

		$result['question_set'] = Core::r('quiz')->get_question_set(array(
				'quiz_id' => $options['quiz_id']
			)
		);

		$result['question_set']['quiz_id'] = $options['quiz_id'];

		$result['next_question'] = Core::r('quiz')->user_next_question(array(
				'user_id' => $options['user_id'],
				'quiz_id' => $options['quiz_id']
			)
		);
		
		$result['next_question_key'] = Core::multi_find($result['question_set']['questions'], 'question_id', $result['next_question']['next_question_id']);

		if($result['next_question_key'] != -1) {

			$result['question_number'] = $result['question_set']['questions'][$result['next_question_key']]['question_number'];

		}
		
		if($options['results'] == 1) {

			// Determine if last question answered was correct or not
			if($result['next_question']['last_question_id'] != $result['next_question']['next_question_id']) { // There were questions answered

				$action_type = Core::r('actions')->action_types_id(array('action_key' => 'answer_quiz'));

				// Retrieve if this question was correct or not, along with the correct answer and how many points were earned
				$sql = "SELECT
				point_value_used,
				other_b AS correct,
				(
					SELECT
					answer
					FROM " . GAMO_DB . ".quiz_answers AS a
					WHERE
					a.question_id = " . GAMO_DB . ".actions_log.int_other
					AND correct = 1
					LIMIT 0, 1
				) AS correct_answer
				FROM " . GAMO_DB . ".actions_log
				WHERE
				action_types_id = :action_types_id
				AND user_id = :user_id
				AND int_other = :int_other
				ORDER BY action_id ASC LIMIT 0, 1";

				$sth = $dbh->prepare($sql);
				$sth->execute(array(
						':action_types_id' => $action_type,
						':user_id' => $data['user_id'],
						':int_other' => $result['next_question']['last_question_id']
					)
				);

				$action = $sth->fetch();

				$result['answer_points'] = $action['point_value_used'];

				if($action['correct']) {

					$result['answered_correctly'] = 1;

				} else {

					$result['answered_correctly'] = 0;
					$result['correct_answer'] = $action['correct_answer'];

				}

			}

		}

		$result['allow_quiz'] = $result['next_question']['allowed'];
		
		if($result['allow_quiz'] == 0) {

			$result = array(
				'allow_quiz' => 0
			);

		}

		if(isset($result['question_set']['questions'][0]['points'])) {

			$result['question_qty'] = count($result['question_set']['questions']);
			$result['question_points'] = $result['question_set']['questions'][0]['points'];

		}

		// Determine if quiz requires a pin
		$pin = Core::fetch_column(
			"SELECT info FROM " . GAMO_DB . ".quizzes_info WHERE quiz_id = :quiz_id AND info_type = 'require_pin'",
			array(
				':quiz_id' => $options['quiz_id']
			)
		);

		$result['require_pin'] = 0;

		if($pin !== FALSE) { // Pin is required

			$result['require_pin'] = 1;

			// Determine if user has already unlocked this quiz
			$action_type = Core::r('actions')->action_types_id(array('action_key' => 'quiz_pin_unlock'));

			$c = Core::db_count(array(
					'table' => GAMO_DB . '.actions_log',
					'values' => array(
						'action_types_id' => $action_type,
						'user_id' => $options['user_id'],
						'int_other' => $options['quiz_id']
					)
				)
			);

			$result['allow_quiz'] = ($c == 0) ? 0 : 1;

		}

		$qr = Core::fetch_column(
			"SELECT info FROM " . GAMO_DB . ".quizzes_info WHERE quiz_id = :quiz_id AND info_type = 'qr_required'",
			array(
				':quiz_id' => $options['quiz_id']
			)
		);
		
		$c = Core::db_count(array(	
				'table' => GAMO_DB . '.quizzes_info',
				'values' => array(
					'quiz_id' => $options['quiz_id'],
					'info_type' => 'locked',
					'int_info' => 1
				)
			)
		);

		$result['locked'] = ($c > 0) ? 1 : 0;

		if($result['locked'] == 1) {

			$result['allow_quiz'] = 0;

		}

		$result['user_group'] = Core::fetch_column(
			"SELECT info FROM " . GAMO_DB . ".users_info WHERE user_id = :user_id AND info_type = 'user_group' LIMIT 0, 1",
			array(
				':user_id' => $options['user_id']
			)
		);
		
		return $result;

	}

}

?>
