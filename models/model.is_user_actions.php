<?
class Model_Is_User_Actions {

	function run($options = array()) {
		
		global $gamo, $dbh;

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		if(!is_numeric($options['user_id'])) {

			$options['user_id'] = -1;

		}

		$data['is_user_actions'] = array();

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
		WHERE action_types_id >= 16 AND action_types_id <= 20";
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				'user_id' => $options['user_id']
			)
		);

		while($row = $sth->fetch()) {

			array_push($data['is_user_actions'], Core::remove_numeric_keys($row));

		}

		return $data;

	}

}

?>
