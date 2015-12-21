<?
/*
This class handles the generation of stats regarding gamo
*/
class Gamo_Stats {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Could not properly save action'
			)
		);

	}

	/*
	This class returns how many users are in gamo and how many average points they have
	*/
	function user_stats() {

		/*
		arguments:
			none

		returns:
	
		Return:
			if successful:
			{
				user_qty: how many users there are in gamo
				user_qty_active: how many users are active
				avg_points: how many points on average users have
				avg_points_active: how many points on average active users have
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		global $dbh;

		$result = array(); // This is where the results will be stored

		// Retrieve status for all users (active + non-active)
		$sql = 'SELECT
		count(*),
		SUM(points) as total_points
		FROM ' . GAMO_DB . '.users';

		$sth = $dbh->prepare($sql);
		$sth->execute();
		$row = $sth->fetch();

		// Store the results for all users
		$results['user_qty'] = $row['count(*)'];
		$results['avg_points'] = floor($row['total_points'] / max($row['count(*)'], 1));

		// Retrieve status for active users only
		$sql = 'SELECT
		count(*),
		SUM(points) as total_points
		FROM ' . GAMO_DB . '.users WHERE points > 0';

		$sth = $dbh->prepare($sql);
		$sth->execute();
		$row = $sth->fetch();

		// Store the results for active only users
		$results['user_qty_active'] = $row['count(*)'];
		$results['avg_points_active'] = floor($row['total_points'] / max($row['count(*)'], 1));

		return $results;

	}

	/*
	Returns stats regarding different action types
	*/
	function action_stats($options = array()) {

		/*
		arguments:
		{
			filters: {
				user_id: user id for whom to retrieve stats (optional)
			}
		}

		returns:
	
		Return:
			if successful:
			{
				{
					action_type_id: the action type
					qty: how many times this action was done,
					action_name: the name of this action
				},
				{
					action_type_id: the action type
					qty: how many times this action was done,
					action_name: the name of this action
				},
				{
					action_type_id: the action type
					qty: how many times this action was done,
					action_name: the name of this action
				}
				..
				..
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		Core::ensure_defaults(array(
				'filters' => array()
			)
		, $options);

		global $dbh;

		$user_filter = '';

		$filter_params = Core::db_params(array(
				'values' => $options['filters']
			)
		);

		if($filter_params['sql'] != '') {

			$filter_params['sql'] = ' AND ' . $filter_params['sql'];

		}

		// Iterate through each action type and determine stats for each action type
		$action_types = array();

		$sql = 'SELECT
			action_types_id,
			action_name,
			(
				SELECT
				count(*)
				FROM ' . GAMO_DB . '.actions_log
				WHERE ' . GAMO_DB . '.actions_log.action_types_id = ' . GAMO_DB . '.action_types.action_types_id AND ' . GAMO_DB . '.actions_log.active = 1' . $filter_params['sql'] . '
			) AS action_qty
			FROM ' . GAMO_DB . '.action_types
			ORDER BY action_name ASC
			';

		
		$sth = $dbh->prepare($sql);
		$sth->execute($filter_params['params']);

		while($row = $sth->fetch()) {

			array_push($action_types, Core::remove_numeric_keys($row));

		}

		$action_types = Core::multi_sort($action_types, 'action_qty', 'desc');

		return $action_types;

	}

	/*
	Retrieve stats regarding badges
	*/
	function badge_stats() {

		/*
		arguments:
			none

		returns:
	
		Return:
			if successful:
			{
				{
					badge_id: the badge id
					badge_name: the name of the badge
					qty: how many people have this badge
				},
				..
				..
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		global $dbh;

		// Iterate through each badge and retrieve stats for that badge
		// Iterate through each action type and determine stats for each action type
		$badges = array();

		$sql = 'SELECT
			badge_id,
			badge_name,
			(
				SELECT
				count(*)
				FROM ' . GAMO_DB . '.users_info
				WHERE ' . GAMO_DB . '.users_info.badge_id = ' . GAMO_DB . '.badges.badge_id
			) AS badge_qty
			FROM ' . GAMO_DB . '.badges
			ORDER BY badge_name ASC
			';

		$sth = $dbh->prepare($sql);
		$sth->execute();

		while($row = $sth->fetch()) {

			array_push($badges, Core::remove_numeric_keys($row));

		}

		$badges = Core::multi_sort($badges, 'badge_qty', 'desc');

		return $badges;

	}

}

?>
