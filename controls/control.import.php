<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Import {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$raw = file_get_contents(DIR_STORE . '/questions/questions.csv');

		$lines = explode("\n", $raw);

		$set_id = -1;
		$question_sort_order = 0;
		$answer_sort_order = 0;

		foreach($lines as $k => $line) {

			$line = str_getcsv($line, ',', '"');

			foreach($line as $k2 => $v) {

				$line[$k2] = ltrim(rtrim($v));

			}

			if($line[2] != '' && $line[3] != '') {

				if($line['2'] == 'Correct Answer') { // Header

				} else if($line[0] != '') {

					echo "Set: " . $line[0] . "<br>";

					$set_id = Core::db_insert(array(
							'table' => GAMO_DB . '.categories',
							'values' => array(
								'category_name' => 'QR Survey - ' . $line[0],
								'category_type' => 'quiz_set'
							)
						)
					);

					$question_sort_order = 0;

				} else if($line[1] != '' && $line[2] != '' && $line[3] != '') {

					$question_id = Core::db_insert(array(
							'table' => GAMO_DB . '.quiz_questions',
							'values' => array(
								'question' => $line[1],
								'sort_order' => ++$question_sort_order,
								'points' => 100,
								'set_id' => $set_id,
								'timer_seconds' => 30
							)
						)
					);

					$answer_sort_order = 0;

					foreach($line as $k2 => $answer) {

						if($k2 >= 2) {

							Core::db_insert(array(
									'table' => GAMO_DB . '.quiz_answers',
									'values' => array(
										'question_id' => $question_id,
										'answer' => $answer,
										'correct' => ($k2 == 2) ? 1 : 0,
										'sort_order' => ++$answer_sort_order
									)
								)
							);

						}

					}

				}

				Core::print_r($line);

			}

		}

		echo $raw;

	}

}
?>
