<?
class Control_Csv_Trivia {

	function run() {

		global $data, $page_settings, $models, $dbh, $gamo;

		if(Core::get_input('c', 'get') != '8aks8s87la0172') {

			header("Location: /");
			die();

		}

		$sales_users = array(
			'msoljacich@entermarketing.com',
			'mg@entermarketing.com',
			'kk@entermarketing.com',
			'jw@entermarketing.com',
			'mrj@entermarketing.com'
		);
		
		$sql = "SELECT category_id, category_name FROM " . GAMO_DB . ".categories
		WHERE
		(
			SELECT
			count(*)
			FROM " . GAMO_DB . ".actions_log AS a
			WHERE
			(
				SELECT
				count(*)
				FROM " . GAMO_DB . ".action_types_info AS b
				WHERE
				b.action_types_id = a.action_types_id
				AND b.info_type = 'category'
				AND b.int_info = " . GAMO_DB . ".categories.category_id
			)
		) > 0";


		$sth = $dbh->prepare($sql);
		$sth->execute();

		$categories = array();
		
		while($row = $sth->fetch()) {

			array_push($categories, Core::remove_numeric_keys($row));

		}

		$sql = "SELECT action_types_id, action_name FROM " . GAMO_DB . ".action_types WHERE
		action_key NOT IN ('quiz_pin_unlock', 'upload_profile_pic')
		AND (SELECT count(*) FROM " . GAMO_DB . ".actions_log AS a WHERE a.action_types_id = " . GAMO_DB . ".action_types.action_types_id) > 0
		";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		$action_types = array();

		while($row = $sth->fetch()) {

			array_push($action_types, Core::remove_numeric_keys($row));

		}

		$sql = "SELECT badge_id, badge_name FROM " . GAMO_DB . ".badges WHERE
		(SELECT count(*) FROM " . GAMO_DB . ".users_info AS a WHERE a.badge_id = " . GAMO_DB . ".badges.badge_id) > 0 ORDER BY rank ASC
		";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		$badges = array();

		while($row = $sth->fetch()) {

			array_push($badges, Core::remove_numeric_keys($row));

		}
		
		if(Core::get_input('users', 'get') == 'all') {

			$exclude_users = '';

		} else if(Core::get_input('users', 'get') == 'sales') {

			$sales_filter = "'" . implode("','", $sales_users) . "'";

			$exclude_users = " WHERE email IN (" . $sales_filter . ")";

		} else {

			$exclude_users = " WHERE email NOT LIKE '%@entermarketing.com' AND email NOT LIKE '%@test.%'";

		}

		$use = array(
			'user_id',
			'first_name',
			'last_name',
			'display_name',
			'title',
			'company',
			'email',
			'other',
			'points'
		);

		$csv = '';

		$csv .= '"' . str_replace('_', ' ', implode('","', $use) . '"');

		/*
		question IN 
		(
			'What is the state of your population health management process?',
			'Which of the following is most likely to influence your decision to purchase a pop health tool?',
			'How does your organization address fraud, waste and abuse detection?',
			'What’s your biggest hurdle to detecting fraud?',
			'Better member data would help my organization improve:',
			'Where does inaccurate provider data impact your organization the most?'
		)
		AND 
		*/

		// Retrieve all questions
		$sql_questions = "SELECT DISTINCT(question) AS question, user_group FROM " . GAMO_DB . ".quiz_questions
		WHERE
		(
			SELECT
			count(*)
			FROM " . GAMO_DB . ".actions_log AS a
			WHERE
			a.int_other = " . GAMO_DB . ".quiz_questions.question_id
			AND action_types_id = 27
			AND
			(
				SELECT
				count(*)
				FROM " . GAMO_DB . ".users AS b
				WHERE
				b.user_id = a.user_id
			) > 0
		) > 0
		ORDER BY question ASC";

		$sth_questions = $dbh->prepare($sql_questions);
		$sth_questions->execute();

		$quiz_questions = array();

		while($row = $sth_questions->fetch()) {

			Core::remove_numeric_keys($row);

			$sql_question_ids = "SELECT question_id FROM " . GAMO_DB . ".quiz_questions WHERE question LIKE :question AND
			(
				SELECT
				count(*)
				FROM " . GAMO_DB . ".actions_log AS a
				WHERE
				a.int_other = " . GAMO_DB . ".quiz_questions.question_id
				AND action_types_id = 27
			) > 0";
			$sth_question_ids = $dbh->prepare($sql_question_ids);

			$sth_question_ids->execute(array(
					':question' => $row['question']
				)
			);

			$row['question_ids'] = array();

			while($row2 = $sth_question_ids->fetch()) {
				
				array_push($row['question_ids'], $row2['question_id']);

			}

			$row['is_poll'] = 0;

			if(isset($row['question_ids'][0])) {

				$correct_c = Core::db_count(array(
						'table' => GAMO_DB . '.quiz_answers',
						'values' => array(
							'question_id' => $row['question_ids'][0],
							'correct' => 1
						)
					)
				);
				
				if($correct_c > 1) {

					$row['is_poll'] = 1;

				}

			}

			if(count($row['question_ids']) > 0) {

				array_push($quiz_questions, $row);

			}

		}

		$csv .= ',"Group","Registration Source","Register Date","Daily Trivia","Live Trivia","QR Trivia"';

		$quiz_questions = Core::multi_sort($quiz_questions, 'is_poll', 'desc');
		
		foreach($action_types as $k => $action_type) {

			$csv .= ',"' . $action_type['action_name'] . '"';

		}

		foreach($badges as $k => $badge) {

			$csv .= ',"' . $badge['badge_name'] . '"';

		}

		foreach($categories as $k => $category) {

			$csv .= ',"Category: ' . $category['category_name'] . '"';

		}

		foreach($quiz_questions as $k => $question) {

			$word = ($question['is_poll']) ? 'Poll' : 'Quiz';

			if($word == 'Poll' && $question['user_group'] != '') {

				$word = ucwords($question['user_group']) . ' Poll';

			}

			$csv .= ',"' . $word . " Question: " . str_replace(array('"', "\n"), array("'", ''), $question['question']) . '"';

		}
		
		$raw = file_get_contents(DIR_STORE . '/ct_leads.csv');
		$ct_lines = explode("\n", $raw);
		$impack_questions = array();

		foreach($ct_lines as $k => $v) {

			$ct_lines[$k] = explode('","', $v);

		}
		
		foreach($ct_lines[0] as $k => $v) {

			if(stripos($v, 'fraud:') === 0 || stripos($v, 'clinical:') === 0 || stripos($v, 'identity:') === 0) {

				array_push($impack_questions, array(
						'col' => $k,
						'question' => $v
					)
				);

			}

		}

		foreach($impack_questions as $k => $question) {

			$csv .= ',"' . $question['question'] . '"';

		}

		$csv .= "\n";

		$csv = str_replace('Poll Question: What is the state of your population health management process?', 'Clinical: What is the state of your population health management process?', $csv);
		$csv = str_replace('Poll Question: Which of the following is most likely to influence your decision to purchase a pop health tool?', 'Clinical: Which of the following is most likely to influence your decision to purchase a pop health tool?', $csv);
		$csv = str_replace('Poll Question: How does your organization address fraud, waste and abuse detection?', 'Fraud: How does your organization address fraud, waste and abuse detection?', $csv);
		$csv = str_replace('Poll Question: What’s your biggest hurdle to detecting fraud?', 'Fraud: What’s your biggest hurdle to detecting fraud?', $csv);
		$csv = str_replace('Poll Question: Better member data would help my organization improve:', 'Data/Identity Management: Better member data would help my organization improve:', $csv);
		$csv = str_replace('Poll Question: Where does inaccurate provider data impact your organization the most?', 'Data/Identity Management: Where does inaccurate provider data impact your organization the most?', $csv);

		$answer_action_type = Core::r('actions')->action_types_id(array('action_key' => 'answer_quiz'));

		$sql = "SELECT * FROM " . GAMO_DB . ".users AS users
		WHERE
		(
			SELECT
			count(*)
			FROM " . GAMO_DB . ".users_info AS a
			WHERE a.user_id = users.user_id
			AND a.info_type = 'exclude_stats'
		) = 0
		ORDER BY points DESC";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		while($row = $sth->fetch()) {

			foreach($use as $k => $column) {

				$csv .= '"' . str_replace('"', '', $row[$column]) . '"';

				if($column != 'points') {

					$csv .= ",";

				}

			}

			$group = Core::fetch_column(
				"SELECT info FROM " . GAMO_DB . ".users_info WHERE user_id = :user_id AND info_type = 'user_group' LIMIT 0, 1",
				array(
					':user_id' => $row['user_id']
				)
			);

			$csv .= ',"' . $group . '"';

			$register_source = Core::fetch_column(
				"SELECT info FROM " . GAMO_DB . ".users_info WHERE user_id = :user_id AND info_type = 'register_source' LIMIT 0, 1",
				array(
					':user_id' => $row['user_id']
				)
			);

			$csv .= ',"' . $register_source . '"';

			$register_datetime = Core::fetch_column(
				"SELECT time FROM " . GAMO_DB . ".users_info WHERE user_id = :user_id AND info_type = 'register_datetime' LIMIT 0, 1",
				array(
					':user_id' => $row['user_id']
				)
			);

			$csv .= ',"' . date("m-d-Y", strtotime($register_datetime)) . '"';

			$daily_trivia_c = Core::fetch_column(
				"SELECT count(DISTINCT other_b) AS qty FROM " . GAMO_DB . ".actions_log WHERE action_types_id = 27 AND user_id = :user_id AND other_b IN (75,76,77)",
				array(
					':user_id' => $row['user_id']
				)
			);

			$csv .= ',"' . $daily_trivia_c . '"';

			$live_trivia_c = Core::fetch_column(
				"SELECT count(DISTINCT other_b) AS qty FROM " . GAMO_DB . ".actions_log WHERE action_types_id = 27 AND user_id = :user_id AND other_b IN (70,71,78,79)",
				array(
					':user_id' => $row['user_id']
				)
			);

			$csv .= ',"' . $live_trivia_c . '"';

			$qr_trivia_c = Core::fetch_column(
				"SELECT count(DISTINCT other_b) AS qty FROM " . GAMO_DB . ".actions_log WHERE action_types_id = 27 AND user_id = :user_id AND other_b IN (72,73,74)",
				array(
					':user_id' => $row['user_id']
				)
			);

			$csv .= ',"' . $qr_trivia_c . '"';

			foreach($action_types as $k => $action_type) {

				$c = Core::fetch_column(
					"SELECT count(*) FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id = :action_types_id AND active = 1 LIMIT 0, 1",
					array(
						':user_id' => $row['user_id'],
						':action_types_id' => $action_type['action_types_id']
					)
				);

				if($action_type['action_types_id'] == 29 && $c == 1) { // Retrieve time for in person meeting

					$slot_id = $c = Core::fetch_column(
						"SELECT int_other FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id = :action_types_id AND active = 1 LIMIT 0, 1",
						array(
							':user_id' => $row['user_id'],
							':action_types_id' => $action_type['action_types_id']
						)
					);

					$c = Core::fetch_column(
						"SELECT start_time FROM " . GAMO_DB . ".slots WHERE slot_id = :slot_id",
						array(
							':slot_id' => $slot_id
						)
					);

				}

				if($action_type['action_types_id'] == 37) {

					$c = min(3, $c);

				}

				if($action_type['action_types_id'] == 34) { // Complete a quiz

					$c = Core::fetch_column(
						"SELECT count(*) FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id = :action_types_id AND active = 1 AND int_other NOT IN (1,2,3) LIMIT 0, 1",
						array(
							':user_id' => $row['user_id'],
							':action_types_id' => $action_type['action_types_id']
						)
					);

				}

				$csv .= ',"' . $c . '"';

			}

			foreach($badges as $k => $badge) {

				$c = Core::fetch_column(
					"SELECT count(*) FROM " . GAMO_DB . ".users_info WHERE user_id = :user_id AND badge_id = :badge_id",
					array(
						':user_id' => $row['user_id'],
						':badge_id' => $badge['badge_id']
					)
				);

				$csv .= ',"' . $c . '"';

			}

			foreach($categories as $k => $category) {

				$c = Core::fetch_column(
					"SELECT
					SUM(point_value_use) AS total_points
					FROM " . GAMO_DB . ".actions_log
					WHERE
					user_id = :user_id
					AND	action_types_id IN (
						SELECT
						action_types_id
						FROM " . GAMO_DB . ".action_types_info AS a
						WHERE a.info_type = 'category'
						AND a.int_info = :int_info
					)
					",
					array(
						':user_id' => $row['user_id'],
						':int_info' => $category['category_id']
					)
				);

				if(!is_numeric($c)) {

					$c = 0;

				}

				$csv .= ',"' . $c . '"';

			}

			foreach($quiz_questions as $k => $question) {

				if($question['is_poll'] == 0) {

					$run_sql = "SELECT
						(
							SELECT
							answer
							FROM " . GAMO_DB . ".quiz_answers AS a
							WHERE
							a.answer_id = " . GAMO_DB . ".actions_log.other
							LIMIT 0, 1
						) AS answer
						FROM " . GAMO_DB . ".actions_log
						WHERE
						user_id = :user_id
						AND action_types_id = :action_types_id
						AND int_other IN (" . implode(',', $question['question_ids']) . ") LIMIT 0, 1";

					$answer = Core::fetch_column($run_sql,
						array(
							':user_id' => $row['user_id'],
							':action_types_id' => $answer_action_type
						)
					);
					
					$answer = ($answer === FALSE) ? '' : str_replace('"', "'", $answer);

				} else {

					$answers = Core::fetch_column("SELECT
						other
						FROM " . GAMO_DB . ".actions_log
						WHERE
						user_id = :user_id
						AND action_types_id = :action_types_id
						AND int_other IN (" . implode(',', $question['question_ids']) . ") LIMIT 0, 1",
						array(
							':user_id' => $row['user_id'],
							':action_types_id' => $answer_action_type
						)
					);

					$answers = explode("-", $answers);

					if(count($answers) > 0 && is_numeric($answers[0])) {

						$sql_answers = "SELECT
						answer
						FROM
						" . GAMO_DB . ".quiz_answers
						WHERE
						answer_id IN (" . implode(',', $answers) . ")";
						
						$sth_answers = $dbh->prepare($sql_answers);

						$sth_answers->execute();

						$use_answers = array();

						while($answers_row = $sth_answers->fetch()) {

							array_push($use_answers, str_replace('"', "'", $answers_row['answer']) );

						}

						$answer = implode(', ', $use_answers);

					} else {

						$answer = '';

					}

				}

				$csv .= ',"' . $answer . '"';

			}

			$ct_line = -1;

			foreach($ct_lines as $line) {

				if(isset($line[15]) && strtolower(ltrim(rtrim($line[15]))) == strtolower(ltrim(rtrim($row['email'])))) {

					$ct_line = $line;
					break;

				}

			}

			if($ct_line != -1) {

				foreach($ct_line as $k => $v) {

					if($k >= 25 && $k <= 42) {

						$csv .= ',"' . $v . '"';

					}

				}

			} else {

				for($i = 0; $i <= 17;$i++) {

					$csv .= ',""';

				}

			}

			$csv .= "\n";

		}
		
		header('Content-type: text/calendar; charset=utf-8');
		header('Content-Disposition: inline; filename=' . str_replace(" ", "_", SITE_NAME) . '_users.csv');
		echo $csv;

		return $data;

	}

}
?>
