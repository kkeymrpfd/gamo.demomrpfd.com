<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Qr_Adjust {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		if(Core::get_input('access', 'get') != 'uaosjdlasd') {

			echo 'Invalid';
			die();

		}

		// Retrieve all breakout codes that are missing questions
		$sql = "SELECT
		quiz_id,
		quiz_name,
		(
			SELECT
			int_info
			FROM " . GAMO_DB . ".quizzes_info AS a
			WHERE a.quiz_id = quizzes.quiz_id
			AND a.info_type = 'qr_required'
		) AS qr_id,
		(
			SELECT
			qr_code
			FROM " . GAMO_DB . ".qr_codes AS b
			WHERE b.qr_id = (
				SELECT
				int_info
				FROM " . GAMO_DB . ".quizzes_info AS a
				WHERE a.quiz_id = quizzes.quiz_id
				AND a.info_type = 'qr_required'
			)
		) AS qr_code
		FROM " . GAMO_DB . ".quizzes AS quizzes
		WHERE
		quiz_name LIKE '%breakout%'
		AND (
			SELECT
			count(*)
			FROM " . GAMO_DB . ".quiz_questions AS a
			WHERE
			a.quiz_id = quizzes.quiz_id
		) = 0";

		$quizzes = array();

		$sth = $dbh->prepare($sql);
		$sth->execute();

		$invalid_qrs = array();

		while($row = $sth->fetch()) {

			if($row['qr_id'] != '') {

				array_push($quizzes, Core::remove_numeric_keys($row));

				array_push($invalid_qrs, $row['qr_id']);

			}

		}

		Core::print_r($quizzes);


		$actions_sql = "SELECT
		action_id,
		user_id,
		int_other,
		other
		FROM " . GAMO_DB . ".actions_log
		WHERE
		action_types_id = 28
		AND int_other IN ('" . implode("','", $invalid_qrs) . "')";

		$actions_sth = $dbh->prepare($actions_sql);
		$actions_sth->execute();

		$actions = array();

		while($actions_row = $actions_sth->fetch()) {

			$actions_row = Core::remove_numeric_keys($actions_row);

			array_push($actions, $actions_row);

		}

		Core::print_r($actions);

		return $data;

	}

}
?>
