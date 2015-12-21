<?
/*
Retrieve recent activity
*/
class Model_Category_Actions {

	function run($options = array()) {
		
		global $session, $dbh, $data;

		Core::ensure_defaults(array(
				'category_id' => -1
			)
		, $options);

		$sql = "SELECT
		action_name,
		points
		FROM
		" . GAMO_DB . ".action_types
		WHERE
		(
			SELECT
			count(*)
			FROM " . GAMO_DB . ".action_types_info AS a
			WHERE a.action_types_id = " . GAMO_DB . ".action_types.action_types_id
			AND a.info_type = 'category'
			AND a.int_info = :category_id
		) > 0
		ORDER BY points DESC
		";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':category_id' => $options['category_id']
			)
		);

		$actions = array();

		while($row = $sth->fetch()) {

			$row = Core::remove_numeric_keys($row);
			
			array_push($actions, $row);

		}

		$actions = array(
			'category_actions' => $actions
		);

		return $actions;

	}

}

?>
