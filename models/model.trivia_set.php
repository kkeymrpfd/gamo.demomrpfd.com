<?
class Model_Quiz_Set {

	function run($options = array()) {

		global $data;
		
		if($options['set'] == 'daily_trivia') {

			$result['quiz_list'] = array(
				array(
					'title' => 'Wednesday',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 1
				),
				array(
					'title' => 'Thursday',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 2
				),
				array(
					'title' => 'Friday',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 3
				)
			);

		} else if($options['set'] == 'daily_trivia') {

			$result['quiz_list'] = array(
				array(
					'title' => 'Session One',
					'date' => 'Wednesday, June 11th',
					'time' => '11 AM',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 70
				),
				array(
					'title' => 'Session Two',
					'date' => 'Wednesday, June 11th',
					'time' => '2 PM',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 68
				),
				array(
					'title' => 'Session Three',
					'date' => 'Wednesday, June 12th',
					'time' => '11 AM',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 69
				),
				array(
					'title' => 'Session Four',
					'date' => 'Wednesday, June 12th',
					'time' => '2 PM',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 71
				)
			);

		}

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

			$result['quiz_list'][$k]['quiz'] = $quiz;

		}

		return $result;

	}

}

?>
