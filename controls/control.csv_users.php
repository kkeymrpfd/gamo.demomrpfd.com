<?
class Control_Csv_Users {

	function run() {

		global $data, $page_settings, $models, $dbh, $gamo;

		if(Core::get_input('c', 'get') != 'jaksj38ak27a') {

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

		$sql = "SELECT action_types_id, action_name FROM " . GAMO_DB . ".action_types WHERE
		(SELECT count(*) FROM " . GAMO_DB . ".actions_log AS a WHERE a.action_types_id = " . GAMO_DB . ".action_types.action_types_id) > 0
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

			$exclude_users = " WHERE email NOT LIKE '%@mrp%' AND email NOT LIKE '%test%'  AND email NOT LIKE '%dell%'";

		}

		$sql = "SELECT * FROM " . GAMO_DB . ".users" . $exclude_users . " ORDER BY points DESC";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$use = array(
			'user_id',
			'first_name',
			'last_name',
			'display_name',
			'company',
			'email',
			'other',
			'points',
			'zip',
			'city',
			'state'
		);

		$csv = '';

		$csv .= '"' . str_replace('_', ' ', implode('","', $use) . '"');

		foreach($action_types as $k => $action_type) {

			$csv .= ',"' . $action_type['action_name'] . '"';

		}

		foreach($badges as $k => $badge) {

			$csv .= ',"' . $badge['badge_name'] . '"';

		}

		$csv .= "\n";

		while($row = $sth->fetch()) {

			foreach($use as $k => $column) {

				if($column != 'city' && $column != 'state') {

					$csv .= '"' . str_replace('"', '', $row[$column]) . '"';

					if($column != 'state') {

						$csv .= ",";

					}

				}

			}

			if($row['zip'] == '' || $row['state'] != '') {

				if($row['state'] != '') {

					$csv .= '"' . $row['city'] . '","' .  $row['state'] . '"';

				} else {

					$csv.= '"",""';

				}

			} else {

				$location = array();
				$location = file_get_contents('http://ziptasticapi.com/' . $row['zip']);
				$location = @json_decode($location, true);
				
				if(isset($location['state'])) {

					$csv .= '"' . $location['city'] . '","' .  $location['state'] . '"';

					Core::db_update(array(
							'table' => GAMO_DB . ".users",
							'values' => array(
								'city' => $location['city'],
								'state' => $location['state']
							),
							'where' => array(
								'user_id' => $row['user_id']
							)
						)
					);

				} else {

					$csv .= '"' . $row['city'] . '","' .  $row['state'] . '"';

					Core::db_update(array(
							'table' => GAMO_DB . ".users",
							'values' => array(
								'city' => '-',
								'state' => '-'
							),
							'where' => array(
								'user_id' => $row['user_id']
							)
						)
					);

				}

			}

			foreach($action_types as $k => $action_type) {

				$c = Core::fetch_column(
					"SELECT count(*) FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id = :action_types_id AND active = 1",
					array(
						':user_id' => $row['user_id'],
						':action_types_id' => $action_type['action_types_id']
					)
				);

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

			$csv .= "\n";

		}

		header('Content-type: text/calendar; charset=utf-8');
		header('Content-Disposition: inline; filename=' . str_replace(" ", "_", SITE_NAME) . '_users.csv');
		echo $csv;

		return $data;

	}

}
?>
