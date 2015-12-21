<?
/*
This class handles the following:
	1) Calculating how many points a user has
	2) Determining which badges a user has
*/
class Gamo_Rewards {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid action specified to calculate rewards for'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'This action has already been calculated'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Error while calculating action reward'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Invalid user specified'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'Could not properly determine total points'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'Could not properly save total points'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'Invalid information specified for testing a badge requirement'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'Tried evaluating a non-requirement entry as a badge requirement'
			),
			array(
				'error_code' => '9',
				'error_msg' => 'Tried evaluating an undefined badge requirement time'
			),
			array(
				'error_code' => '10',
				'error_msg' => 'User cannot be awarded badge since they have been stopped from playing'
			),
			array(
				'error_code' => '11',
				'error_msg' => 'Invalid badge specified'
			)
		);

	}

	/*
	Calculates how many points a user has for a new action
	*/
	function calc_rewards($options) {
		
		/*
		arguments:
		{
			action_id: the action id for which to recalculate
		}
		
		Iterate through all actions that have a points_value_use value that is different than points_value_used
		and calculate points for those

		Remember to run this->determine_badges() if points change
		
		Return:
			if successful:
			{
				valid: 1
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		Core::ensure_defaults(array(
				'action_id' => -1
			)
		, $options);

		if(!is_numeric($options['action_id']) || $options['action_id'] < 0) {

			return Core::error($this->errors, 1);

		}

		// Retrieve action details
		global $dbh;

		$sql = 'SELECT
		user_id,
		point_value_use,
		point_value_used
		FROM ' . GAMO_DB . '.actions_log
		WHERE action_id = :action_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				'action_id' => $options['action_id']
			)
		);

		$action = $sth->fetch();

		if(!is_array($action)) { // Action not found

			return Core::error($this->errors, 1);

		}

		global $gamo;

		/*
		Determine if the points for this action have al$dbh->rollBack();ready been calculated.
		*/
		if($action['point_value_use'] == $action['point_value_used']
			&& $action['point_value_use'] != 0) { // Already calculated. Do not recalculate

			Core::rewards->determine_badges(array(
					'user_id' => $action['user_id']
				)
			);

			return Core::error($this->errors, 2);

		}

		/*
		Update database to represent points being counted
		We only want to update the points record on users table if the actions_log table has been succesfully updated
		Use mysql's commit system via transactions to ensure that either all queries in a set are executed successfully,
		or none are executed
		*/
		$dbh->beginTransaction();

		// update the actions_log
		$sql = 'UPDATE ' . GAMO_DB . '.actions_log SET point_value_used = :point_value_use WHERE action_id = :action_id';
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':point_value_use' => $action['point_value_use'],
				':action_id' => $options['action_id']
			)
		);

		if($action['point_value_used'] != 0) { // There were already points calculated for this action. Undo that

			$sql = 'UPDATE ' . GAMO_DB . '.users SET points = points - :point_value_used WHERE user_id = :user_id';
			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':point_value_used' => $action['point_value_used'],
					':user_id' => $action['user_id']
				)
			);

		}

		$sql = 'UPDATE ' . GAMO_DB . '.users SET points = points + :point_value_use WHERE user_id = :user_id';
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':point_value_use' => $action['point_value_use'],
				':user_id' => $action['user_id']
			)
		);

		if(!$dbh->commit()) { // One or more transactions were not succesful. Roll back the database

			$dbh->rollBack();
			return Core::error($this->errors, 3);

		}

		Core::rewards->determine_badges(array(
				'user_id' => $action['user_id']
			)
		);

		return array(
			'valid' => 1
		);

	}

	/*
	Recalculate how many points a user should have based on their entire activity history. This is something that
	can be run in a cron job daily to make sure all user points are accurate, in case we are running into issues with
	missing or extra points
	*/
	function full_calc_rewards($options = array()) {

		/*
		arguments:
			user_id: The id of the user to recalculate points for
		
		Return:
			if successful:
			{
				points: how many points the user has now
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		// Determine if the user is valid
		$c = Core::db_count(array(
				'table' => '' . GAMO_DB . '.users',
				'values' => array(
					'user_id' => $options['user_id']
				)
			)
		);

		if($c != 1) { // User is not valid

			return Core::error($this->errors, 4);

		}

		// User is valid. Determine how many points this user should have based on their actions
		global $dbh;

		$sql = 'SELECT
		COUNT(*) AS action_qty,
		SUM(point_value_use) AS total_points
		FROM ' . GAMO_DB . '.actions_log
		WHERE user_id = :user_id';

		$sth = $dbh->prepare($sql);

		$sth->execute(array(
				':user_id' => $options['user_id']
			)
		);

		$history = $sth->fetch();

		if(!is_array($history)) {

			return Core::error($this->errors, 5);

		}

		// Ensure that total points has a value. This will be null if the user has taken no actions
		if(!is_numeric($history['total_points'])) { $history['total_points'] = 0; }

		// pendo Factor in how many points this user should have based on their badges

		/*
		Update database to represent points being counted
		We only want to update the points record on users table if the actions_log table has been succesfully updated
		Use mysql's commit system via transactions to ensure that either all queries in a set are executed successfully,
		or none are executed
		*/
		$dbh->beginTransaction();

		// update the actions_log
		$sql = 'UPDATE ' . GAMO_DB . '.actions_log SET point_value_used = point_value_use WHERE user_id = :user_id';
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id']
			)
		);

		$sql = 'UPDATE ' . GAMO_DB . '.users SET points = :total_points WHERE user_id = :user_id';
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':total_points' => $history['total_points'],
				':user_id' => $options['user_id']
			)
		);

		if(!$dbh->commit()) { // One or more transactions were not succesful. Roll back the database

			$dbh->rollBack();
			return Core::error($this->errors, 6);

		}

		// Determine what badges this user should have
		global $gamo;

		Core::rewards->determine_badges(array(
				'user_id' => $options['user_id']
			)
		);

		return Core::remove_numeric_keys($history);

	}

	/*
	This is used to determine what badges a user should have
	*/
	function determine_badges($options = array()) {

		/*
		arguments:
		{
			user_id: // The user_id for which to run this check for
			badge_state: 	"all" = evaluate all badges (default)
							"new" = only evaluate badges that this user doesn't have
							"has" = only evaluate badges that this user already has
		}

		First, determine the badge_id's we want to test for. This either needs to be retrieved via a query, or will be provided for
		in the arguments[badges] array

		Iterate through each badge_id, and determine the following:
			1) The user has enough points for the badge (simply check the user's points against the badge's point requirements)
			2) The user has met all badge requirements. This is done by iterating through each badge requirement via this->badge_reqs()

		Return:
			if successful:
			{
				badges: an array of badge_ids that this user has, and if they are newly received
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// pendo make this class
		Core::ensure_defaults(array(
				'user_id' => -1,
				'badge_state' => 'all'
			)
		, $options);

		// pendo ensure that user id and badge state values are valid

		// Determine what sql filter to use when retrieving the badges to test for
		if($options['badge_state'] == 'new') { // Only check badges that this user does not already have

			$filter = ' AND (SELECT count(*) FROM ' . GAMO_DB . '.users_info WHERE ' . GAMO_DB . '.users_info.user_id = :user_id AND ' . GAMO_DB . '.users_info.badge_id = ' . GAMO_DB . '.badges.badge_id) = 0';
			$params = array(':user_id' => $options['user_id']);

		} else if($options['badge_state'] == 'has') { // Only check badges that this user already has

			$filter = ' AND (SELECT count(*) FROM ' . GAMO_DB . '.users_info WHERE ' . GAMO_DB . '.users_info.user_id = :user_id AND ' . GAMO_DB . '.users_info.badge_id = ' . GAMO_DB . '.badges.badge_id) > 0';
			$params = array(':user_id' => $options['user_id']);

		} else { // Check all badges

			$filter = '';
			$params = array();

		}

		// Retrieve badges to test
		global $dbh;

		$sql = 'SELECT
		badge_id
		FROM ' . GAMO_DB . '.badges
		WHERE (SELECT count(*) FROM ' . GAMO_DB . '.badges_info WHERE ' . GAMO_DB . '.badges_info.badge_id = ' . GAMO_DB . '.badges.badge_id AND ' . GAMO_DB . '.badges_info.is_req = 1) > 0' . $filter;

		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		$badges = array();

		// Iterate through each badge and test if the user has this badge
		while($row = $sth->fetch()) {

			array_push($badges, $this->badge_reqs(array(
						'badge_id' => $row['badge_id'],
						'user_id' => $options['user_id']
					)
				)
			);

		}

		return $badges;

	}


	/*
	Revoke a badge for a user
	*/
	function revoke_badge($options = array()) {

		/*
		arguments
		{
			user_id: the user to revoke the badge from
			badge_id: the badge to revoke
		}
	
		Also removes any points awarded as a result of getting this badge

		if successful:
		{
			valid: 1
		}

		if error:
		{
			error_code: The error code
			error_msg: The error message
		}
		*/

		// Determine the point value of being awarded this badge
		global $dbh;

		$sql = 'SELECT int_info FROM ' . GAMO_DB . '.users_info WHERE user_id = :user_id AND badge_id = :badge_id';
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id'],
				':badge_id' => $options['badge_id']
			)
		);

		$badge = $sth->fetch();

		if(!isset($badge['int_info']) || !is_numeric($badge['int_info'])) { // This badge is not valid

			return Core::error($this->errors, 11);

		}

		$sql = 'DELETE FROM ' . GAMO_DB . '.users_info WHERE user_id = :user_id AND badge_id = :badge_id';
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id'],
				':badge_id' => $options['badge_id']
			)
		);

		if($badge['int_info'] == -1) {

			return array(
				'valid' => 1
			);

		}

		global $gamo;

		$gamo->actions->modify_action(array(
				'action_id' => $badge['int_info'],
				'values' => 'delete'
			)
		);
		
		return array(
			'valid' => 1
		);

	}


	/*
	Give a user a badge. This method does not test to see if a user deserves a badge. It simply creates it.
	To test if a user has met all the requirements for a badge, use $this->badge_reqs()
	*/
	function give_badge($options = array()) {

		/*
		arguments
		{
			user_id: the user to give the badge to
			badge_id: the badge to award
		}
		
		Also awards a user any points they are owed as a result of getting this badge

		if successful:
		{
			valid: 1
		}

		if error:
		{
			error_code: The error code
			error_msg: The error message
		}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'user_id' => -1,
				'badge_id' => -1
			)
		, $options);

		// Verify user is in the system and is allowed to play
		global $gamo;

		$valid = $gamo->users->user_valid(array(
				'user_id' => $options['user_id'],
				'has' => array(
					'no_play'
				)
			)
		);
		
		if(Core::has_error($valid) || !isset($valid['valid']) || $valid['valid'] != 1) { // User is not valid

			return $valid;

		}

		if($valid['has_all'] == 1) { // User has been blocked from playing

			return Core::error($this->errors, 10);

		}

		// Verify that the badge is valid
		global $dbh;

		$sql = 'SELECT badge_name, rank, int_info, info, info_b, trigger_action FROM ' . GAMO_DB . '.badges WHERE badge_id = :badge_id';
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':badge_id' => $options['badge_id']
			)
		);

		$badge = $sth->fetch();

		if(!isset($badge['badge_name'])) { // This badge is not valid

			return Core::error($this->errors, 11);

		}

		// Everything seems valid. Save the badge for this user
		global $gamo;

		$insert = $gamo->users->create_user_info(array(
				'user_id' => $options['user_id'],
				'badge_id' => $options['badge_id'],
				'rank' => $badge['rank'],
				'info_type' => 'ba__' . $badge['badge_name'],
				'int_info' => -1,
				'info' => $badge['info'],
				'info_b' => $badge['info_b']
			)
		);

		if(Core::has_error($insert)) { // There was an error while inserting this record

			return $insert;

		}

		$other = array();

		if($badge['trigger_action'] != -1) { // This badge is worth points. Factor it into the user's points

			$other['create_action'] = $gamo->actions->create_action(array(
					'user_id' => $options['user_id'],
					'action_types_id' => $badge['trigger_action']
				)
			);

			if(!Core::has_error($other['create_action'])) {

				$gamo->users->update_user_info(array(
						'users_info_id' => $insert['users_info_id'],
						'values' => array(
							'int_info' => $other['create_action']['action_id']
						)
					)
				);

			}

		}
		
		if($badge['rank'] > 0) {

			$msg = "You've moved up to <b>" . $badge['badge_name'] . "</b> rank!";

		} else {

			$msg = 'You earned the <b>' . $badge['badge_name'] . '</b> badge!';

		}

		if($badge['rank'] != 1) { // Do not create a notification for the lowest rank since everyone already has that

			// Notify the user
			$gamo->notify->create_notify(array(
					'user_id' => $options['user_id'],
					'msg' => $msg
				)
			);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Determine if a user has met all badge requirements for a specific badge
	*/
	function badge_reqs($options = array()) {

		/*
		arguments:
			badge_id: the badge id to test for
			user_id: the user id to test for,
			giveable: give the badge if the user passes the requirements test (defaults to 1)

		Retrieve a list of each badge requirement, and test the requirements are met. If necessary, pass the details to badge_reqs->check()
		If all checks returns true, then this user should have the badge. If not, they should not have the badge

		If the user should have the badge, record it in the users_info table. If they should not have the badge, make sure there
		is no record for it in the users_info table
if successful:
			{
				reqs: 1 = has the badge, 0 = does not have the badge
				passed: 1 = met requirements for the badge, 0 = has not met requirements for the badge
				new: 1 = the user has newly received this badge, 0 = the user already had this badge
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		Return:
			if successful:
			{
				reqs: 1 = has the badge, 0 = does not have the badge
				passed: 1 = met requirements for the badge, 0 = has not met requirements for the badge
				new: 1 = the user has newly received this badge, 0 = the user already had this badge
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'badge_id' => -1,
				'user_id' => -1,
				'giveable' => 1
			)
		, $options);
		
		// Determine if the badge is valid
		$c = Core::db_count(array(
				'table' => '' . GAMO_DB . '.badges',
				'values' => array(
					'badge_id' => $options['badge_id']
				)
			)	
		);

		if($c == 0) { // Invalid badge

			return Core::error($this->errors, 7);

		}

		// Determine if the user is valid and get user info
		global $gamo;

		$user = $gamo->users->get_user(array('user_id' => $options['user_id']));

		if(Core::has_error($user)) { // Invalid user

			return $user;

		}

		/*
		Each badge can have multiple requirements to earn the badge. Retrieve and test each requirement
		*/

		global $dbh;

		$sql = 'SELECT
			badges_info_id,
			badge_id,
			info_type,
			is_req,
			action_types_id,
			points,
			int_info,
			info,
			info_b
			FROM ' . GAMO_DB . '.badges_info
			WHERE badge_id = :badge_id AND is_req = 1';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':badge_id' => $options['badge_id']
			)
		);

		// Create an array to store requirement information
		$reqs = array(
			'badge_id' => $options['badge_id'], // The badge id (stored here to make life easier for other methods that depend on this methods return type)
			'reqs' => array(), // Each requirement
			'passed' => 1 // Wether or not the user has met all requirements
		);

		while($req = $sth->fetch()) {
			
			$result = $this->check_badge_req(array(
					'user' => $user,
					'badges_info' => $req,
					'badges_info_id' => $req['badges_info_id']
				)
			);

			if(Core::has_error($result)) {

				return $result;

			}

			array_push($reqs['reqs'], $result);

			if($result['passed'] != 1) { $reqs['passed'] = 0; }

		}
		
		if($options['giveable'] == 1) { // Badge can be given or taken away based on the wether or not the user met the requirements

			if($reqs['passed'] == 1) { // Give the user the badge

				$this->give_badge(array(
						'user_id' => $user['user_id'],
						'badge_id' => $options['badge_id']
					)
				);

			} else {
				
				$this->revoke_badge(array(
						'user_id' => $user['user_id'],
						'badge_id' => $options['badge_id']
					)
				);
				

			}

		}

		return $reqs;

	}

	/*
	Test to see if a user meets a single badge requirement
	*/
	function check_badge_req($options = array()) {

		/*
		arguments
		{
			user: an array of user information. if set to the user id, it will retreieve the user's information
			badges_info_id: The id of the badge requirement to check,
			badges_info: The information requiring the badge info entry this requirement is associated with. It is optional to define this,
						but if it is defined, we don't have to look up the information from the database again
		}

		if(arguments[badges_info][badges_info_type] == some value) {
			
			// run checks here

		} else if(arguments[badges_info][badges_info_type] == some other value) {
			
			// run other checks here

		} else ...

		Return:
			if successful:
			{
				passed: 1 = requirements have been met, 0 = requirements have not been met
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'user' => array(),
				'badges_info_id' => -1,
				'badges_info' => 'get'
			)
		, $options);
		
		// pendo Ensure that user information is valid and pull user info if set to the user id
		// pendo Ensure that badge info entry is valid
		
		// Retrieve badge requirements
		if(!is_array($options['badges_info'])) {

			global $gamo;

			$options['badges_info'] = Core::reward_manager->get_badges_info(array(
				'badges_info_id' => $options['badges_info_id']
				)
			);

		}

		if(Core::has_error($options['badges_info'])) {

			 // There was an error while retrieving the badge info entry
			return $options['badges_info'];

		}

		global $gamo;

		if( !in_array($options['badges_info']['info_type'], $gamo->badge_req->req_types) ) { // This is not a valid requirement type

			return Core::error($this->errors, 8);

		}

		// Check badge requirement
		global $gamo;

		$method = 'req_' . $options['badges_info']['info_type']; // The requirement type (exampel: min_points, has_badge, etc)

		if(!method_exists($gamo->badge_req, $method)) {

			return Core::error($this->errors, 9);

		}
		
		$result = $gamo->badge_req->$method(array(
				'user' => $options['user'],
				'req' => $options['badges_info']
			)
		);

		$result['badges_info_id'] = $options['badges_info_id'];

		return $result;

	}

}
?>
