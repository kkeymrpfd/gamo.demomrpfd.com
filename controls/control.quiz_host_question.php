<?
// Get the next question to display on the host large screen
class Control_Quiz_Host_Question {

	function run($options = array()) {

		global $page_settings, $data, $gamo, $dbh;

		Core::ensure_defaults(array(
				'quiz_id' => Core::get_input('quiz_id', 'get')
			)
		, $options);

		$page_settings['allow_json'] = 1;

		$data['unlocked_c'] = Core::db_count(array(
				'table' => GAMO_DB . '.quiz_questions',
				'values' => array(
					'quiz_id' => $options['quiz_id'],
					'locked' => 2
				)
			)
		);

		if($data['unlocked_c'] == 0) { // No questions unlocked yet
			
			return $data;

		}

		// Get first question for this quiz that has not yet been broadcast
		$sql = "SELECT
		question_id,
		question
		FROM " . GAMO_DB . ".quiz_questions
		WHERE
		quiz_id = :quiz_id
		AND locked = 2
		ORDER BY sort_order DESC LIMIT 0, 1";

		$sth = $dbh->prepare($sql);

		$sth->execute(array(
				':quiz_id' => $options['quiz_id']
			)
		);

		$question = $sth->fetch();

		Core::shift_data($question);

		return $data;

	}

}
?>