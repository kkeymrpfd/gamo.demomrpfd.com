<?
class Model_Qr_Breakouts {

	function run($options = array()) {
		
		global $gamo, $data;

		$result = array();

		$use_list = array(
			array(
				'title' => 'Breakout 1',
				'quiz_id' => 47,
				'attended' => 0,
				'quiz_taken' => 0
			),
			array(
				'title' => 'Breakout 2',
				'quiz_id' => 48,
				'attended' => 0,
				'quiz_taken' => 0
			),
			array(
				'title' => 'Breakout 3',
				'quiz_id' => 49,
				'attended' => 0,
				'quiz_taken' => 0
			),
			array(
				'title' => 'Breakout 4',
				'quiz_id' => 50,
				'attended' => 0,
				'quiz_taken' => 0
			),
			array(
				'title' => 'Breakout 5',
				'quiz_id' => 51,
				'attended' => 0,
				'quiz_taken' => 0
			),
			array(
				'title' => 'Breakout 6',
				'quiz_id' => 52,
				'attended' => 0,
				'quiz_taken' => 0
			)
			,
			array(
				'title' => 'Breakout 7',
				'quiz_id' => 53,
				'attended' => 0,
				'quiz_taken' => 0
			)
			,
			array(
				'title' => 'Breakout 8',
				'quiz_id' => 54,
				'attended' => 0,
				'quiz_taken' => 0
			)
			,
			array(
				'title' => 'Breakout 9',
				'quiz_id' => 55,
				'attended' => 0,
				'quiz_taken' => 0
			)
			,
			array(
				'title' => 'Breakout 10',
				'quiz_id' => 56,
				'attended' => 0,
				'quiz_taken' => 0
			)
			,
			array(
				'title' => 'Breakout 11',
				'quiz_id' => 57,
				'attended' => 0,
				'quiz_taken' => 0
			)
			,
			array(
				'title' => 'Breakout 12',
				'quiz_id' => 58,
				'attended' => 0,
				'quiz_taken' => 0
			)
			,
			array(
				'title' => 'Breakout 13',
				'quiz_id' => 59,
				'attended' => 0,
				'quiz_taken' => 0
			)
		);
		
		require_once(DIR_MODELS . "/model.quiz.php");

		$action_types_id = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));
		$result['qr_list'] = array();

		foreach($use_list as $k => $code) {

			/*
			$c = Core::db_count(array(
					'table' => GAMO_DB . '.actions_log',
					'values' => array(
						'action_types_id' => $action_types_id,
						'int_other' => Core::fetch_column(
							"SELECT qr_id FROM " . GAMO_DB . ".qr_codes WHERE qr_code = :qr_code",
							array(
								':qr_code' => $code['qr_code']
							)
						)
					)
				)
			);

			$use_list[$k]['scanned'] = $c;
			*/
			$quiz = new Model_Quiz();
			$quiz = $quiz->run(array(
					'user_id' => $data['user_id'],
					'quiz_id' => $code['quiz_id']
				)
			);

			if($quiz['allow_quiz'] == 1) {

				$use_list[$k]['attended'] = 1;

				if($quiz['next_question_key'] == -1) {
				
					$use_list[$k]['quiz_taken'] = 1;

				} else if($quiz['next_question_key'] != -1) {

					$use_list[$k]['quiz_taken'] = 0;

				}

			}

			$use_list[$k]['scanned_time'] = 0;

			$required_qr_id = Core::fetch_column(
				"SELECT int_info FROM " . GAMO_DB . ".quizzes_info WHERE quiz_id = :quiz_id AND info_type = 'qr_required'",
				array(
					':quiz_id' => $code['quiz_id']
				)
			);

			if($required_qr_id !== FALSE && is_numeric($required_qr_id)) { // Determine if user has scanned QR code

				// Determine if user has scanned the code
				$scanned_time = Core::fetch_column(
					"SELECT time FROM " . GAMO_DB . ".actions_log WHERE action_types_id = :action_types_id AND user_id = :user_id AND int_other = :int_other ORDER BY time ASC LIMIT 0, 1",
					array(
						'action_types_id' => $action_types_id,
						'user_id' => $data['user_id'],
						'int_other' => $required_qr_id
					)
				);
				
				if($scanned_time !== FALSE) {

					$use_list[$k]['scanned_time'] = $scanned_time;

					array_push($result['qr_list'], $use_list[$k]);

				}

			}

		}

		$result['qr_list'] = Core::multi_sort($result['qr_list'], 'scanned_time', 'asc');

		foreach($result['qr_list'] as $k => $v) {

			$result['qr_list'][$k]['title'] = 'Breakout ' . ($k+1);

		}

		return $result;

	}

}

?>
