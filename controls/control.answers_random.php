<?

class Control_Answers_Random {

	function run() {
		
		global $data, $gamo, $dbh;

		$sql = "SELECT question_id, (SELECT count(*) FROM " . GAMO_DB . ".quiz_answers AS a WHERE a.question_id = " . GAMO_DB . ".quiz_questions.question_id) AS answer_qty FROM " . GAMO_DB . ".quiz_questions";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$sql_answer = "SELECT answer_id FROM " . GAMO_DB . ".quiz_answers WHERE question_id = :question_id";
		$answer_sth = $dbh->prepare($sql_answer);

		while($row = $sth->fetch()) {

			Core::remove_numeric_keys($row);

			Core::print_r($row);

			$sort = array();

			for($i = 1; $i <= $row['answer_qty']; $i++) {

				array_push($sort, $i);

			}

			shuffle($sort);

			$answer_sth->execute(array(
					':question_id' => $row['question_id']
				)
			);

			$n = 0;

			while($answer_row = $answer_sth->fetch()) {

				echo 'question id: ' . $row['question_id'] . '<br>';
				$update = array(
					'table' => GAMO_DB . '.quiz_answers',
					'values' => array(
						'sort_order' => $sort[$n++]
					),
					'where' => array(
						'answer_id' => $answer_row['answer_id']
					)
				);

				Core::db_update($update);

				Core::print_r($update);

			}

			echo "-----------------------<br>";

		}

	}

}
?>