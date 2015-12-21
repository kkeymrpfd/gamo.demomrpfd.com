<?
/*
Retrieve content for the whats new page (most recent activity that we want to display as new activity on the whats new page)
*/
class Model_Whats_New {

	function run($options = array()) {
		
		global $session, $dbh, $data;

		global $dbh;

		// Retrieve virtual events
		$sql = "SELECT
		id,
		title,
		description,
		summary,
		date_time,
		active,
		time_added
		FROM " . GAMO_DB . ".virtual_events
		WHERE
		active = 1
		AND date_time > :date_time
		ORDER BY time_added DESC
		LIMIT 0, 10
		";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':date_time' => Core::date_string()
			)
		);

		$vevents = array();

		while($row = $sth->fetch()) {

			$row = Core::remove_numeric_keys($row);
			$row['item_type'] = 'vevent';

			array_push($vevents, $row);

		}

		// Retrieve resources
		$sql = "SELECT
		resource_id,
		title,
		descrip,
		type,
		time_added
		FROM " . GAMO_DB . ".resources
		WHERE active = 1
		ORDER BY time_added DESC
		LIMIT 0, 10";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		$resources = array();

		while($row = $sth->fetch()) {

			$row = Core::remove_numeric_keys($row);
			$row['item_type'] = 'resource';

			array_push($resources, $row);

		}

		// Retrieve resources
		$sql = "SELECT
		entry_id,
		title,
		descrip,
		time_added,
		url,
		image
		FROM " . GAMO_DB . ".whats_new
		WHERE active = 1
		ORDER BY time_added DESC
		LIMIT 0, 10";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		$whats_new = array();

		while($row = $sth->fetch()) {

			$row = Core::remove_numeric_keys($row);
			$row['item_type'] = 'whats_new';
			$row['replace'] = array();

			$re1='.*?';	# Non-greedy match on filler
			$re2='(local_time)';	# Word 1
			$re3='(\\[)';	# Any Single Character 1
			$re4='((?:2|1)\\d{3}(?:-|\\/)(?:(?:0[1-9])|(?:1[0-2]))(?:-|\\/)(?:(?:0[1-9])|(?:[1-2][0-9])|(?:3[0-1]))(?:T|\\s)(?:(?:[0-1][0-9])|(?:2[0-3])):(?:[0-5][0-9]):(?:[0-5][0-9]))';	# Time Stamp 1
			$re5='(\\])';	# Any Single Character 2

			if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $row['descrip'], $matches))
			{

				$word1=$matches[1][0];
				$c1=$matches[2][0];
				$timestamp1=$matches[3][0];
				$c2=$matches[4][0];

				foreach($matches[1] as $k => $v) {

					$row['descrip'] = str_replace($matches[1][$k] . $matches[2][$k] . $matches[3][$k] . $matches[4][$k], ':replace' . $k, $row['descrip']);

					array_push($row['replace'], array(
							'type' => 'local_time',
							'key' => ':replace' . $k,
							'data' => $matches[3][$k]
						)
					);

				}
				
			}

			array_push($whats_new, $row);

		}

		$items = array_merge($resources, $vevents, $whats_new);
		$items = Core::multi_sort($items, 'time_added', 'desc');
		$items = array_splice($items, 0, 3);
		$items = array(
			'whats_new' => $items
		);

		return $items;

	}

}

?>
