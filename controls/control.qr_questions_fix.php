<?

class Control_Qr_Questions_Fix {

	function run() {
		
		global $data, $gamo, $dbh;

		$sql = "SELECT quiz_id, quiz_name, (SELECT count(*) FROM " . GAMO_DB . ".quiz_questions AS a WHERE a.quiz_id = " . GAMO_DB . ".quizzes.quiz_id) AS question_qty FROM " . GAMO_DB . ".quizzes HAVING question_qty < 3";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		$missing = array();

		while($row = $sth->fetch()) {

			$row['raw_questions'] = array();

			array_push($missing, Core::remove_numeric_keys($row));

		}

		$raw = file_get_contents(DIR_STORE . '/questions/questions.csv');

		$lines = explode("\n", $raw);

		$set_id = 46;
		$question_sort_order = 0;
		$answer_sort_order = 0;

		$last_quiz = '';

		foreach($lines as $k => $line) {

			$line = str_getcsv($line, ',', '"');

			foreach($line as $k2 => $v) {

				$line[$k2] = ltrim(rtrim($v));

			}

			if(isset($line[2]) && $line[2] != '' && $line[3] != '') {

				if($line['2'] == 'Correct Answer') { // Header

				} else if($line[1] != '' && $line[2] != '' && $line[3] != '') {

					if($line[0] != '') {

						$last_quiz = $line[0];

					}

					$quiz_id = Core::fetch_column(
						"SELECT quiz_id FROM " . GAMO_DB . ".quizzes WHERE quiz_name LIKE :quiz_name",
						array(
							':quiz_name' => '%' . $last_quiz . '%'
						)
					);
					echo $last_quiz . ' | ' . $quiz_id . '<br>';
					if($quiz_id !== FALSE) {

						$find_k = Core::multi_find($missing, 'quiz_id', $quiz_id);
						
						if($find_k != -1) {

							/*
							Core::db_update(array(
									'table' => GAMO_DB . '.quizzes',
									'values' => array(
										'quiz_name' => $last_quiz
									),
									'where' => array(
										'quiz_id' => $quiz_id
									)
								)
							);
							*/

							array_push($missing[$find_k]['raw_questions'], $line);

						}

					}

				}

			}

		}

		foreach($missing as $quiz_k => $quiz) {

			if(count($quiz['raw_questions']) >= 1) {

				foreach($quiz['raw_questions'] as $raw_k => $question) {

					$c = Core::db_count(array(
							'table' => GAMO_DB . '.quiz_questions',
							'values' => array(
								'question' => $question[1],
								'quiz_id' => $quiz['quiz_id']
							)
						)
					);

					$missing[$quiz_k]['raw_questions'][$raw_k]['exists'] = $c;

					if($c == 0) {

						$question_id = Core::db_insert(array(
								'table' => GAMO_DB . '.quiz_questions',
								'values' => array(
									'question' => $question[1],
									'sort_order' => 3,
									'points' => 100,
									'quiz_id' => $quiz['quiz_id'],
									'timer_seconds' => 30
								)
							)
						);

						Core::db_insert(array(
								'table' => GAMO_DB . '.quiz_answers',
								'values' => array(
									'question_id' => $question_id,
									'answer' => $question[2],
									'correct' => 1,
									'sort_order' => 1
								)
							)
						);

						Core::db_insert(array(
								'table' => GAMO_DB . '.quiz_answers',
								'values' => array(
									'question_id' => $question_id,
									'answer' => $question[3],
									'correct' => 0,
									'sort_order' => 2
								)
							)
						);

						Core::db_insert(array(
								'table' => GAMO_DB . '.quiz_answers',
								'values' => array(
									'question_id' => $question_id,
									'answer' => $question[4],
									'correct' => 0,
									'sort_order' => 3
								)
							)
						);

						Core::db_insert(array(
								'table' => GAMO_DB . '.quiz_answers',
								'values' => array(
									'question_id' => $question_id,
									'answer' => $question[5],
									'correct' => 0,
									'sort_order' => 4
								)
							)
						);

					}

				}

			}

		}

		Core::print_r($missing);

	}

}
?>