<?
class Model_Quiz_Set {

	function run($options = array()) {

		global $data, $gamo;
		
		if($options['set'] == 'daily_trivia') {

			$result['quiz_list'] = array(
				array(
					'title' => 'Wednesday',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 75
				),
				array(
					'title' => 'Thursday',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 76
				),
				array(
					'title' => 'Friday',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 77
				)
			);

		} else if($options['set'] == 'qr_trivia') {

			$result['quiz_list'] = array(
				array(
					'title' => 'One',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 72
				),
				array(
					'title' => 'Two',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 73
				),
				array(
					'title' => 'Three',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 74
				)
			);

		} else if($options['set'] == 'live_trivia') {

			$result['quiz_list'] = array(
				array(
					'title' => 'Session One',
					'date' => 'Wednesday, June 11th',
					'time' => '12:45 PM',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 70
				),
				array(
					'title' => 'Session Two',
					'date' => 'Wednesday, June 11th',
					'time' => '6:30 PM',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 71
				),
				array(
					'title' => 'Session Three',
					'date' => 'Wednesday, June 12th',
					'time' => '12:45 PM',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 78
				),
				array(
					'title' => 'Session Four',
					'date' => 'Wednesday, June 12th',
					'time' => '6:30 PM',
					'locked' => 1,
					'quiz_taken' => 0,
					'quiz_id' => 79
				)
			);

		}

		require_once(DIR_MODELS . "/model.quiz.php");
		
		$answer_action_type = Core::r('actions')->action_types_id('answer_quiz');

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

					$result['quiz_list'][$k]['quiz_points'] = Core::fetch_column(
						"SELECT SUM(point_value_used) FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id = :action_types_id AND other_b = :other_b",
						array(
							':user_id' => $data['user_id'],
							':action_types_id' => $answer_action_type,
							':other_b' => $v['quiz_id']
						)
					);

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
