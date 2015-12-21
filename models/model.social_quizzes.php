<?
class Model_Social_Quizzes {

	function run($options = array()) {

		global $data;
		
		$result['quiz_list'] = array(
			array(
				'title' => 'Monday',
				'unlocked' => 1,
				'quiz_taken' => 0,
				'quiz_id' => '60'
			),
			array(
				'title' => 'Tuesday',
				'unlocked' => 1,
				'quiz_taken' => 0,
				'quiz_id' => '61'
			),
			array(
				'title' => 'Wednesday',
				'unlocked' => 1,
				'quiz_taken' => 0,
				'quiz_id' => '62'
			),
			array(
				'title' => 'Thursday',
				'unlocked' => 1,
				'quiz_taken' => 0,
				'quiz_id' => '63'
			)
		);

		require_once(DIR_MODELS . "/model.quiz.php");
		
		foreach($result['quiz_list'] as $k => $v) {

			$quiz = new Model_Quiz();
			$quiz = $quiz->run(array(
					'user_id' => $data['user_id'],
					'quiz_id' => $v['quiz_id']
				)
			);

			$use_list[$k]['quiz_taken'] = 0;

			if($quiz['allow_quiz'] == 1) {

				if($quiz['next_question_key'] == -1) {
				
					$result['quiz_list'][$k]['quiz_taken'] = 1;

				} else if($quiz['next_question_key'] != -1) {

					$use_list[$k]['quiz_taken'] = 0;

				}

			}

		}

		return $result;

	}

}

?>