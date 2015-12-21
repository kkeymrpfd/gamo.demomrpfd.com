<?
class Model_President_Club {

	function run($options = array()) {
		
		global $gamo, $dbh;

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		if(!is_numeric($options['user_id'])) {

			$options['user_id'] = -1;

		}

		$sql = "SELECT
		action_types_id,
		action_name,
		(SELECT
			count(*)
			FROM " . GAMO_DB . ".actions_log
			WHERE
			" . GAMO_DB . ".actions_log.user_id = :user_id
			AND " . GAMO_DB . ".actions_log.active = 1
			AND " . GAMO_DB . ".actions_log.action_types_id = " . GAMO_DB . ".action_types.action_types_id LIMIT 0, 1) AS action_done
		FROM
		" . GAMO_DB . ".action_types
		WHERE action_types_id >= 5 AND action_types_id < 15";
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				'user_id' => $options['user_id']
			)
		);

		$actions = array();
		$c = 0;

		while($row = $sth->fetch()) {

			array_push($actions, Core::remove_numeric_keys($row));
			++$c;

		}

		$data['presidents_club'] = array(
			'actions' => $actions,
			'current_page' => 1,
			'last_page' => 1,
			'records' => $c
		);

		return $data;

	}

}

?>
