<?
/*
This class handles quizzes
*/
class Gamo_Quiz {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid question id specified'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid set specified'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Invalid user specified'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Invalid question/answer specified'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'User has already answered this question'
			)
		);

	}

	/*
	Retrieve question and answers
	*/
	function get_question($options) {

		/*
		args:
		{
			question_id: retrieve by question id
		}

		returns
		on error: std error
		on success:
		{
			question_id: unique id for this question
			question: the question text
			points: how many points this question is worth
			sort_order: the order for this question
			quiz_id: the set that this question belongs to
			answers: {
				{
					answer_id: unique id of the answer
					sort_order: sort order for this answer
					answer: the answer text
					correct: whether or not this is the correct answer
				},
				..
				..
			}
		}
		*/

		global $gamo, $dbh, $data;

		Core::ensure_defaults(array(
				'question_id' => -1
			)
		, $options);

		$sql = "SELECT
		question_id,
		question,
		sort_order,
		points,
		quiz_id,
		timer_seconds,
		locked,
		polling
		FROM " . GAMO_DB . ".quiz_questions
		WHERE question_id = :question_id";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':question_id' => $options['question_id']
			)
		);

		$question = $sth->fetch();

		if(!isset($question['question_id'])) { // Question not found

			return Core::error($this->errors, 1);

		}

		$question = Core::remove_numeric_keys($question);

		$question['remaining_seconds'] = $question['timer_seconds'];

		if(isset($data['user_id']) && is_numeric($data['user_id']) && $data['user_id'] > 0) {

			// Determine remaining time
			$start_time = Core::fetch_column(
				"SELECT start_time FROM " . GAMO_DB . ".quiz_answer_times WHERE user_id = :user_id AND question_id = :question_id",
				array(
					':user_id' => $data['user_id'],
					':question_id' => $options['question_id']
				)
			);

			if(Core::get_input('show', 'get') == 1) {

				echo 'start time: ' . $start_time;

			}

			if($start_time !== FALSE) {

				$question['remaining_seconds'] =  $question['timer_seconds'] - (time() - strtotime($start_time));
				
				$question['remaining_seconds'] = max($question['remaining_seconds'], 0);

			}

		}

		// Retrieve answers
		$answers = array();

		$sql = "SELECT
		answer_id,
		question_id,
		answer,
		correct,
		sort_order
		FROM " . GAMO_DB . ".quiz_answers
		WHERE question_id = :question_id
		ORDER BY sort_order ASC";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':question_id' => $question['question_id']
			)
		);

		$sth->execute(array(
				':question_id' => $options['question_id']
			)
		);

		$incorrect_qty = 0;

		while($row = $sth->fetch()) {

			array_push($answers, Core::remove_numeric_keys($row));

			if($row['correct'] == 0) {

				++$incorrect_qty;

			}

		}

		$question['answers'] = $answers;

		$question['all_correct'] = ($incorrect_qty == 0) ? 1 : 0;

		return $question;

	}

	function get_question_set($options) {

		/*
		args:
		{
			quiz_name: the name of the question set (name of the category with type = quiz_set)
			quiz_id: the id of the set (id of the category with type = quiz_set)
		}
		*/

		/*
		returns:
		on error: std error
		on success:
		{
			quiz_id: id of the set
			quiz_name: name of the set
			questions: {
				{
					question_id: unique id for this question
					question: the question text
					points: how many points this question is worth
					sort_order: the order for this question
					quiz_id: the set that this question belongs to
					answers: {
						{
							answer_id: unique id of the answer
							sort_order: sort order for this answer
							answer: the answer text
							correct: whether or not this is the correct answer
						},
						..
						..
					}
				},
				..
				..
			}
		}
		*/

		Core::ensure_defaults(array(
				'quiz_id' => '',
				'quiz_name' => ''
			)
		, $options);
		
		if($options['quiz_id'] == '') {

			$options['quiz_id'] = Core::fetch_column(
				"SELECT quiz_id FROM " . GAMO_DB . ".quizzes WHERE quiz_name = :quiz_name",
				array(
					':quiz_name' => $options['quiz_name']
				)
			);

		}

		if(!is_numeric($options['quiz_id'])) { // Invalid set specified

			return Core::error($this->errors, 2);

		}

		global $dbh;

		$sql = "SELECT
		quiz_id,
		quiz_name
		FROM " . GAMO_DB . ".quizzes
		WHERE quiz_id = :quiz_id";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':quiz_id' => $options['quiz_id']
			)
		);

		$category = $sth->fetch();

		if(!isset($category['quiz_id'])) { // Invalid set specified

			return Core::error($this->errors, 2);

		}

		// Retrieve all questions/answers in set
		$questions = array();

		$sql = "SELECT question_id
		FROM " . GAMO_DB . ".quiz_questions
		WHERE
		quiz_id = :quiz_id
		ORDER BY sort_order ASC";
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':quiz_id' => $options['quiz_id']
			)
		);

		global $gamo;

		$question_number = 0;

		while($row = $sth->fetch()) {

			$question = Core::r('quiz')->get_question(array(
					'question_id' => $row['question_id']
				)
			);

			$question['question_number'] = $question['sort_order'];

			array_push($questions, $question);

		}
		
		$result = array(
			'quiz_id' => $category['quiz_id'],
			'quiz_name' => $category['quiz_name'],
			'questions' => $questions
		);

		return $result;

	}

	/*
	Start the timer for a answer question
	*/
	function start_question_timer($options = array()) {

		Core::ensure_defaults(array(
				'question_id' => -1,
				'user_id' => -1
			)
		, $options);

		// Determine if record already exists
		$time_id = Core::fetch_column(
			"SELECT time_id FROM " . GAMO_DB . ".quiz_answer_times WHERE question_id = :question_id AND user_id = :user_id",
			array(
				':question_id' => $options['question_id'],
				':user_id' => $options['user_id']
			)
		);

		if(is_numeric($time_id)) { // Entry already exists

			if(Core::get_input('debug', 'get') == 1) {

				echo 'exists';
				Core::print_r($options);

			}

			return array(
				'time_id' => $time_id
			);

		}

		$time_id = Core::db_insert(array(
				'table' => GAMO_DB . '.quiz_answer_times',
				'values' => array(
					'question_id' => $options['question_id'],
					'user_id' => $options['user_id'],
					'start_time' => Core::date_string()			
				)
			)
		);

		if(Core::get_input('debug', 'get') == 1) {

			echo 'new';
			Core::print_r($options);

		}

		return array(
			'time_id' => $time_id
		);

	}

	/*
	Submits an answer for a question for a user
	*/
	function answer_question($options) {

		/*
		args:
		{
			question_id: the id of the question
			user_id: the id of the user answering the question
			answer_id: the answer that this user selected
		}

		returns:
		on error: std error
		on success: {
			correct: 1 = correct, 0 incorrect
			points: # of points earned for this answer,
			action_result: result of creating action
		}
		*/

		global $gamo, $dbh;

		Core::ensure_defaults(array(
				'user_id' => -1,
				'question_id' => -1,
				'answer_id' => -1,
				'points_countdown' => 1,
				'poll_answers' => ''
			)
		, $options);

		// Determine if user id is valid
		$user_valid = Core::r('users')->user_valid(array(
				'user_id' => $options['user_id']
			)
		);

		if($user_valid['valid'] != 1) { // User id is invalid

			return Core::error($this->errors, 3);

		}

		if($options['poll_answers'] == '') {

			$sql = "SELECT
			points,
			quiz_id,
			sort_order,
			polling,
			(
				SELECT
				count(*)
				FROM " . GAMO_DB . ".quiz_questions AS a
				WHERE
				a.quiz_id = " . GAMO_DB . ".quiz_questions.quiz_id
				AND a.sort_order > " . GAMO_DB . ".quiz_questions.sort_order
			) AS has_next_question
			FROM " . GAMO_DB . ".quiz_questions
			WHERE
			question_id = :question_id
			AND
			(
				SELECT
				count(*)
				FROM " . GAMO_DB . ".quiz_answers AS a
				WHERE a.question_id = " . GAMO_DB . ".quiz_questions.question_id
				AND answer_id = :answer_id
			) > 0
			";
		
			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':question_id' => $options['question_id'],
					':answer_id' => $options['answer_id']
				)
			);

			$question = $sth->fetch();

		} else {

			$sql = "SELECT
			points,
			quiz_id,
			sort_order,
			polling,
			(
				SELECT
				count(*)
				FROM " . GAMO_DB . ".quiz_questions AS a
				WHERE
				a.quiz_id = " . GAMO_DB . ".quiz_questions.quiz_id
				AND a.sort_order > " . GAMO_DB . ".quiz_questions.sort_order
			) AS has_next_question
			FROM " . GAMO_DB . ".quiz_questions
			WHERE
			question_id = :question_id
			";
		
			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':question_id' => $options['question_id']
				)
			);

			$question = $sth->fetch();

		}

		$full_question = $this->get_question(array(
				'question_id' => $options['question_id']
			)
		);

		/*
		if(!isset($question['points']) || !is_numeric($question['points'])) { // Invalid question/answer combination provided

				return Core::error($this->errors, 4);

		}
		*/

		$action_type = Core::r('actions')->action_types_id(array('action_key' => 'answer_quiz'));

		// Determine if user has already answered this question
		$c = Core::db_count(array(
				'table' => GAMO_DB . ".actions_log",
				'values' => array(
					'action_types_id' => $action_type,
					'user_id' => $options['user_id'],
					'int_other' => $options['question_id'],
				)
			)
		);

		if($c > 0) { // user has already answered this question

			return Core::error($this->errors, 5);

		}

		$correct = Core::db_count(array(
				'table' => GAMO_DB . ".quiz_answers",
				'values' => array(
					'question_id' => $options['question_id'],
					'answer_id' => $options['answer_id'],
					'correct' => 1
				)
			)
		);

		$use_points = $question['points'];

		if($options['points_countdown'] == 1) {

			if($full_question['timer_seconds'] == 0) {

				$use_points = $full_question['points'];

			} else {

				if($full_question['remaining_seconds'] > 0) {

					$full_question['remaining_seconds'] = min( ($full_question['remaining_seconds']*1+1.2), $full_question['timer_seconds']);

				}

				$percent = $full_question['remaining_seconds'] / $full_question['timer_seconds'];
				$use_points = $full_question['points'] * $percent;

				if($use_points < 1) {

					$use_points = 0;

				} else {

					$use_points = ceil($use_points);

				}

			}

		}

		$timelimit_hit = 0;

		if($use_points != 0 && $question['points'] != 0) {

			//$use_points = $question['points'];

		}

		if($use_points == 0 && $question['points'] != 0) {

			$timelimit_hit = 1;

		}

		$use_answer = ($options['poll_answers'] == '') ? $options['answer_id'] : $options['poll_answers'];

		if($options['question_id'] == -1) {

			return Core::error($this->errors, 4);

		}

		if($question['polling'] == 1 || $full_question['timer_seconds'] > 999) {

			$correct = 1;
			$use_points = $question['points'];

		}

		// Answer question
		$action_result = Core::r('actions')->create_action(array(
				'action_types_id' => $action_type,
				'user_id' => $options['user_id'],
				'int_other' => $options['question_id'],
				'other' => $use_answer,
				'other_b' => $question['quiz_id'],
				'point_value' => ($correct == 0) ? 0 : $use_points
			)
		);

		if(Core::has_error($result)) { // THere was an error

			return $result;

		}

		// Retriee correct answer text
		$answer_correct_text = Core::fetch_column(
			"SELECT answer FROM " . GAMO_DB . ".quiz_answers WHERE question_id = :question_id AND correct = 1",
			array(
				':question_id' => $options['question_id']
			)
		);

		// Retrieve given answer text
		$answer_given_text = Core::fetch_column(
			"SELECT answer FROM " . GAMO_DB . ".quiz_answers WHERE question_id = :question_id AND answer_id = :answer_id",
			array(
				':question_id' => $options['question_id'],
				':answer_id' => $options['answer_id']
			)
		);

		if($question['has_next_question'] == 0) { // All questions for this quiz have been answered. Trigger action to mark this

			Core::r('actions')->create_action(array(
					'action_types_id' => 'complete_quiz',
					'user_id' => $options['user_id'],
					'int_other' => $question['quiz_id']
				)
			);

		}

		$result = array(
			'correct' => $correct,
			'answer_correct_text' => $answer_correct_text,
			'answer_given_text' => $answer_given_text,
			'points' => $question['points'],
			'action_result' => $action_result,
			'timelimit_hit' => $timelimit_hit
		);

		return $result;

	}

	/*
	Determines the next question id in a question set (if one exists)
	*/
	function next_question($options) {

		/*
		args:
		{
			question_id: the current question id
		}

		returns:
		{
			question_id: -1 = no next question, other # = next question id
		}
		*/

		Core::ensure_defaults(array(
				'question_id' => -1,
				'user_id' => -1
			)
		, $options);

		global $gamo;

		$question = Core::r('quiz')->get_question(array(
				'question_id' => $options['question_id']
			)
		);

		if(Core::has_error($question)) { // Invalid question id

			return Core::error($this->errors, 1);

		}

		$user_group = Core::fetch_column(
			"SELECT info FROM " . GAMO_DB . ".users_info WHERE info_type = 'user_group' AND user_id = :user_id LIMIT 0, 1",
			array(
				':user_id' => $options['user_id']
			)
		);

		$next_id = Core::fetch_column(
			"SELECT
			question_id
			FROM " . GAMO_DB . ".quiz_questions
			WHERE
			quiz_id = :quiz_id
			AND sort_order > :sort_order
			AND
			(
				user_group = ''
				OR user_group = :user_group
			)
			ORDER BY sort_order ASC LIMIT 0, 1",
			array(
				':quiz_id' => $question['quiz_id'],
				':sort_order' => $question['sort_order'],
				':user_group' => $user_group
			)
		);

		$result = array(
			'question_id' => $options['question_id'],
			'next_question_id' => (is_numeric($next_id)) ? $next_id : -1
		);

		return $result;

	}

	/*
	The next question that a particular user should answer for a question set
	*/
	function user_next_question($options = array()) {

		/*
		args:
		{
			user_id
			quiz_id
		}
		*/

		Core::ensure_defaults(array(
				'user_id' => -1,
				'quiz_id' => -1
			)
		, $options);

		global $gamo, $dbh;

		$sql = "SELECT question_id FROM " . GAMO_DB . ".quiz_questions WHERE quiz_id = :quiz_id ORDER BY sort_order ASC";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':quiz_id' => $options['quiz_id']
			)
		);

		$question_ids = array();

		$first_question_id = -1;

		while($row = $sth->fetch()) {

			if($first_question_id == -1) { $first_question_id = $row['question_id']; }

			array_push($question_ids, $row['question_id']);

		}

		// Determine if QR code is required
		$required_qr_id = Core::fetch_column(
			"SELECT int_info FROM " . GAMO_DB . ".quizzes_info WHERE quiz_id = :quiz_id AND info_type = 'qr_required'",
			array(
				':quiz_id' => $options['quiz_id']
			)
		);

		$allowed = 1;

		if($required_qr_id !== FALSE && is_numeric($required_qr_id)) { // Determine if user has scanned QR code

			// Determine if user has scanned the code
			$c = Core::db_count(array(
					'table' => GAMO_DB . '.actions_log',
					'values' => array(
						'action_types_id' => Core::r('actions')->action_types_id(array('action_key' => 'qr_scan')),
						'user_id' => $options['user_id'],
						'int_other' => $required_qr_id
					)
				)
			);
			
			if($c == 0) {

				$allowed = 0;

			}

		}
		
		// Determine if QR code is required
		$required_action = Core::fetch_column(
			"SELECT int_info FROM " . GAMO_DB . ".quizzes_info WHERE quiz_id = :quiz_id AND info_type = 'action_required'",
			array(
				':quiz_id' => $options['quiz_id']
			)
		);

		if($required_action !== FALSE && is_numeric($required_action)) { // Determine if user has done action

			// Determine if user has scanned the code
			$c = Core::db_count(array(
					'table' => GAMO_DB . '.actions_log',
					'values' => array(
						'action_types_id' => $required_action,
						'user_id' => $options['user_id']
					)
				)
			);
			
			if($c == 0) {

				$allowed = 0;

			}

		}

		if($first_question_id == -1) {

			return array(
				'last_question_id' => -1,
				'next_question_id' => -1,
				'allowed' => $allowed
			);

		}

		$action_type = Core::r('actions')->action_types_id(array('action_key' => 'answer_quiz'));

		// Determine next question user should answer
		$question_id = Core::fetch_column(
			"SELECT int_other AS question_id
			FROM " . GAMO_DB . ".actions_log
			WHERE
			action_types_id = :action_types_id
			AND user_id = :user_id
			AND int_other IN (" . implode(",", $question_ids) . ")
			ORDER BY time DESC LIMIT 0, 1",
			array(
				':action_types_id' => $action_type,
				':user_id' => $options['user_id']
			)
		);
		
		$last_question_id = $question_id;

		if(!is_numeric($last_question_id)) { $last_question_id = $first_question_id; }

		if(!is_numeric($question_id)) { // User has not answered any questions yet. First question is the question id they need to answer
			
			$questions = Core::r('quiz')->get_question_set(array(
					'quiz_id' => $options['quiz_id']
				)
			);

			$question_id = (isset($questions['questions'])) ? $questions['questions'][0]['question_id'] : '';

		} else { // The user has answered a question already. Retrieve the next question they need to answer

			$next = Core::r('quiz')->next_question(array(
					'question_id' => $question_id,
					'user_id' => $options['user_id']
				)
			);

			$question_id = $next['next_question_id'];

		}

		return array(
			'last_question_id' => (!is_numeric($question_id)) ? -1 : $last_question_id,
			'next_question_id' => $question_id,
			'allowed' => $allowed
		);

	}

}
?>