<?
class Model_Community_Quizzes {

	function run($options = array()) {
		
		global $gamo, $data, $dbh;

		$result = array();

		// Retrieve quizzes
		$use_list = array();

		$sql = "SELECT
		quiz_id,
		quiz_name AS title,
		(
			SELECT
			int_info
			FROM " . GAMO_DB . ".quizzes_info AS a
			WHERE
			a.quiz_id = " . GAMO_DB . ".quizzes.quiz_id
			AND a.info_type = 'action_required'
		) AS action_required
		FROM " . GAMO_DB . ".quizzes
		WHERE
		quiz_name LIKE '@%'
		OR quiz_name LIKE '%facebook%'
		OR quiz_name LIKE '%twitter%'
		OR quiz_name LIKE '%linkedin%'
		OR quiz_name LIKE '%youtube%'
		OR quiz_name LIKE '%instagram%'";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		while($row = $sth->fetch()) {

			$row = Core::remove_numeric_keys($row);
			$row['action_key_required'] = Core::fetch_column(
				"SELECT action_key FROM " . GAMO_DB . ".action_types WHERE action_types_id = :action_types_id",
				array(
					':action_types_id' => $row['action_required']
				)
			);

			$row['allowed'] = 0;
			$row['quiz_taken'] = 0;

			array_push($use_list, $row);

		}
		
		require_once(DIR_MODELS . "/model.quiz.php");

		$action_types_id = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));
		$result['quiz_list'] = array();

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

				$use_list[$k]['allowed'] = 1;

				if($quiz['next_question_key'] == -1) {
				
					$use_list[$k]['quiz_taken'] = 1;

				} else if($quiz['next_question_key'] != -1) {

					$use_list[$k]['quiz_taken'] = 0;

				}

			}

			array_push($result['quiz_list'], $use_list[$k]);

		}

		return $result;

	}

}

?>
