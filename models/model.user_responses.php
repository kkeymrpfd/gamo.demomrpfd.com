<?
class Model_User_Responses {

	function run($options = array()) {

		global $dbh, $gamo;

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		$result = array();

		$action_type = Core::r('actions')->action_types_id('answer_quiz');

		$sql = "SELECT
		int_other AS question_id,
		other AS answer,
		other_b AS quiz_id,
		point_value_used AS points
		FROM " . GAMO_DB . ".actions_log
		WHERE
		action_types_id = :action_types_id
		AND user_id = :user_id";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $action_type,
				':user_id' => $options['user_id']
			)
		);

		$quizzes = array();

		while($row = $sth->fetch()) {

			Core::remove_numeric_keys($row);
			
			$row['question'] = Core::fetch_column(
				"SELECT question FROM " . GAMO_DB . ".quiz_questions WHERE question_id = :question_id",
				array(
					':question_id' => $row['question_id']
				)
			);

			if(is_numeric($row['answer'])) {

				$row['answer_text'] = Core::fetch_column(
					"SELECT answer FROM " . GAMO_DB . ".quiz_answers WHERE answer_id = :answer_id",
					array(
						':answer_id' => $row['answer']
					)
				);

			} else {

				$row['answer_text'] = '';

				$answers = explode("-", $row['answer']);

				foreach($answers as $k => $answer) {

					if($k > 0) {

						$row['answer_text'] .= ', ';

					}

					$row['answer_text'] .= Core::fetch_column(
						"SELECT answer FROM " . GAMO_DB . ".quiz_answers WHERE answer_id = :answer_id",
						array(
							':answer_id' => $answer
						)
					);

				}

			}

			if(!isset($quizzes[ $row['quiz_id'] ])) {

				$quizzes[ $row['quiz_id'] ] = array(
					'quiz_name' => Core::fetch_column(
						"SELECT quiz_name FROM " . GAMO_DB . ".quizzes WHERE quiz_id = :quiz_id",
						array(
							':quiz_id' => $row['quiz_id']
						)
					),
					'questions' => array()
				);

			}

			array_push($quizzes[ $row['quiz_id'] ]['questions'], $row);

		}

		//Core::print_r($quizzes);

		$result['quizzes'] = $quizzes;
		$result['user'] = Core::r('users')->get_user(array(
				'user_id' => $options['user_id']
			)
		);

		$action_type = Core::r('actions')->action_types_id('download_resource');

		// Retrieve resources
		$sql = "SELECT
		int_other AS resource_id,
		(
			SELECT
			title
			FROM " . GAMO_DB . ".resources AS a
			WHERE
			a.resource_id = " . GAMO_DB . ".actions_log.int_other
			LIMIT 0, 1
		) AS resource_name
		FROM " . GAMO_DB . ".actions_log
		WHERE
		action_types_id = :action_types_id
		AND user_id = :user_id";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $action_type,
				':user_id' => $options['user_id']
			)
		);

		$result['resources'] = array();

		while($row = $sth->fetch()) {

			Core::remove_numeric_keys($row);

			array_push($result['resources'], $row);

		}

		return $result;

	}

}
?>