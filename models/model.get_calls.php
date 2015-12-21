<?
class Model_Get_Calls {

	function run($options = array()) {
		
		global $session, $dbh;

		$data = array();

		Core::ensure_defaults(array(
				'user_id' => Core::get_input('user_id', 'get'),
				'start' => Core::get_input('start', 'get'),
				'page' => (int)Core::get_input('page', 'get'),
				'type' => (Core::get_input('type', 'activity') == 'activity') ? 'activity' : 'call',
				'min_time' => 0
			)
		, $options);

		if(!is_numeric($options['user_id'])) {

			$options['user_id'] = -1;

		}

		--$options['page'];

		if($options['page'] < 0) { $options['page'] = 0; }

		$per_page = 10;

		$options['start'] = $options['page']*$per_page;

		$filters = array('entry_type = :entry_type');

		$params = array(
			':entry_type' => $options['type']
		);

		if($options['min_time'] != 0) {

			array_push($filters, "time >= :time");
			$params[':time'] = $options['min_time'];

		}

		// Retrieve calls
		$sql = "SELECT
		entry_id,
		entry_title,
		info,
		time,
		entry_type
		FROM " . GAMO_DB . ".call_sessions
		WHERE " . implode(' AND ', $filters) . "
		ORDER BY time DESC
		LIMIT " . $options['start'] . ", " . $per_page;

		$sth = $dbh->prepare($sql);

		$sth->execute($params);

		$entries = array(
			'calls' => array()
		);

		$attend_sql = "SELECT status FROM " . GAMO_DB . ".call_sessions_attend WHERE entry_id = :entry_id AND user_id = :user_id";
		$attend_sth = $dbh->prepare($attend_sql);

		while($row = $sth->fetch()) {

			$row = Core::remove_numeric_keys($row);

			$attend_sth->execute(array(
					':entry_id' => $row['entry_id'],
					':user_id' => $options['user_id']
				)
			);

			$status = $attend_sth->fetchColumn();
			
			if($status === FALSE) { $status = 0; }
			$row['attended'] = $status;

			$row['display_time'] = date("M j, Y", strtotime($row['time']));
			
			array_push($entries['calls'], $row);

		}

		$data['call_sessions'] = $entries;

		return $data;

	}

}

?>
