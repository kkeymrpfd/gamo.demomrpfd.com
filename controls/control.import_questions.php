<?

class Control_Import_Questions {

	function run() {

		$raw = file_get_contents(DIR_STORE . "/questions.csv");
		$lines = explode("\n", $raw);

		foreach($lines as $k => $v) {

			$lines[$k] = explode(";", str_replace('"', '', $v));

			foreach($lines[$k] as $k2 => $v2) {

				$lines[$k][$k2] = ltrim(rtrim($v2));

			}

		}

		function create_question($options = array()) {

			Core::ensure_defaults(array(
					'set_id' => -1,
					'question' => '',
					'answers' => array()
				)
			, $options);

			$shuffle = true;

			foreach($options['answers'] as $k => $answer) {

				if(stripos($answer['answer'], 'of the above') !== FALSE || strtolower($answer['answer']) == 'true') {

					$shuffle = false;
					break;

				}

			}

			if($shuffle) {

				shuffle($options['answers']);

			}

			$sort_order = Core::fetch_column(
				"SELECT
				MAX(sort_order) AS sort_order FROM " . GAMO_DB . ".quiz_questions WHERE set_id = :set_id",
				array(
					':set_id' => $options['set_id']
				)
			);

			$sort_order = (is_numeric($sort_order)) ? $sort_order+1 : 1;

			$question_id = Core::db_insert(array(
					'table' => GAMO_DB . '.quiz_questions',
					'values' => array(
						'question' => $options['question'],
						'sort_order' => $sort_order,
						'points' => 100,
						'set_id' => $options['set_id']
					)
				)
			);

			if(is_numeric($sort_order)) {

				$answer_qty = 0;

				foreach($options['answers'] as $k => $answer) {

					Core::db_insert(array(
							'table' => GAMO_DB . '.quiz_answers',
							'values' => array(
								'question_id' => $question_id,
								'answer' => $answer['answer'],
								'correct' => $answer['correct'],
								'sort_order' => ++$answer_qty
							)
						)
					);

				}

			}

		}

		$fields = $lines[0];

		foreach($lines as $k => $line) {

			if($k > 0 && isset($line[1])) {

				$set_id = Core::fetch_column(
					"SELECT category_id FROM " . GAMO_DB . ".categories WHERE category_name = :category_name",
					array(
						':category_name' => $line[1]
					)
				);

				if(!is_numeric($set_id)) {

					if(!is_numeric($set_id)) {

						$set_id = Core::db_insert(array(
								'table' => GAMO_DB . '.categories',
								'values' => array(
									'category_name' => $line[1],
									'category_type' => 'quiz_set'
								)
							)
						);

					}

					if(is_numeric($set_id)) {

						if(trim($line[4]) != '') { // Insert first question

							$answers = array();

							if($line[5] != '') { array_push($answers, array('answer' => $line[5], 'correct' => 1)); }
							if($line[6] != '') { array_push($answers, array('answer' => $line[6], 'correct' => 0)); }
							if($line[7] != '') { array_push($answers, array('answer' => $line[7], 'correct' => 0)); }
							if($line[8] != '') { array_push($answers, array('answer' => $line[8], 'correct' => 0)); }

							create_question(array(
									'set_id' => $set_id,
									'question' => $line[4],
									'correct_answer' => $line[5],
									'answers' => $answers
								)
							);

						}

						if(trim($line[9]) != '') { // Insert first question

							$answers = array();

							if($line[10] != '') { array_push($answers, array('answer' => $line[10], 'correct' => 1)); }
							if($line[11] != '') { array_push($answers, array('answer' => $line[11], 'correct' => 0)); }
							if($line[12] != '') { array_push($answers, array('answer' => $line[12], 'correct' => 0)); }
							if($line[13] != '') { array_push($answers, array('answer' => $line[13], 'correct' => 0)); }

							create_question(array(
									'set_id' => $set_id,
									'question' => $line[9],
									'answers' => $answers
								)
							);

						}

						if(trim($line[14]) != '') { // Insert first question

							$answers = array();

							if($line[15] != '') { array_push($answers, array('answer' => $line[15], 'correct' => 1)); }
							if($line[16] != '') { array_push($answers, array('answer' => $line[16], 'correct' => 0)); }
							if($line[17] != '') { array_push($answers, array('answer' => $line[17], 'correct' => 0)); }
							if($line[18] != '') { array_push($answers, array('answer' => $line[18], 'correct' => 0)); }

							create_question(array(
									'set_id' => $set_id,
									'question' => $line[14],
									'answers' => $answers
								)
							);

						}

					}

				}

			}

		}

		Core::print_r($lines);

	}

}
?>