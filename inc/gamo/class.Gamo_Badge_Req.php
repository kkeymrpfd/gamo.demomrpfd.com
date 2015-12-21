<?
/*
This class contains the logic for testing for a badge requirement that is outside the scope of the abstract logic check in rewards->badges_infos().
For example, if we a have badge requirement that a user can only get a badge if they live in Russia, then that check would be done here
This is kept seperate from the Badge class itself for the sake of making it so it is easier to modify the badge requirements without
touching the Badge class itself (less problems when merging branches in GIT)
*/
class Gamo_Badge_Req {

	public $errors; // Store error codes
	public $req_types; // Requirement test types available

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid user information provided for running badge requirement test'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid badge requirement provided for running badge requirement test'
			)
		);

		/*
		Save requirement types. Every time a new requirement type is created it must have an entry here or else it will
		return an error when being tested for
		*/
		$this->req_types = array(
			'min_points', // Must have a minimum number of points
			'min_action_qty', // Must have committed an action a certain number of times
			'min_cat_qty', // Must have a minimum number of actions that belong to a certain category (for example, sharing 20 social media items)
			'min_cat_points' // Must have a minimum number of points that belong to a certain category (for example, sharing 20 social media items)
		);

	}

	/*
	Ensure that parameters passed to a requirement test are valid.
	Tests to ensure that user information and badge requirement information is properly specified
	*/
	function check_params($options = array()) {

		/*
		arguments:
		{
			user: an array of info about the user
			req: information regarding the requirement
		}
		
		if successful:
			{
				user: an array of info about the user
				req: information regarding the requirement
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
				'req' => array()
			)
		, $options);

		if(!isset($options['user']['user_id'])) { // Invalid user info

			return Core::error($this->errors, 1);

		}

		if(!isset($options['req']['badges_info_id'])) { // Invalid badge info

			return Core::error($this->errors, 2);

		}

		global $gamo;

		if(count($options['user']) < 7) { // All user info has not been specified. Pull it now

			$user = $gamo->users->get_user(array(
					'user_id' => $options['user']['user_id']
				)
			);

			if(Core::has_error($user)) { // User information could not be pulled properly

				return $user;

			}

			$options['user'] = $user; // User information was pulled properly. Save it to be returned

		}

		if(count($options['req']) < 5) { // All badge requirement info has not been specified. Pull it now

			$badges_info = Core::reward_manager->get_badges_info(array(
					'badges_info_id' => $options['req']['badges_info_id']
				)
			);

			if(Core::has_error($badges_info)) { // User information could not be pulled properly

				return $badges_info;

			}

			$options['req'] = $badges_info; // User information was pulled properly. Save it to be returned

		}

		return array(
			'user' => $options['user'],
			'req' => $options['req']
		);

	}

	/*
	Tests to see that a user has a minimum number of points
	structure of an entry in badge_reqs
	{
		badge_id: the id of the badge for which this is a requirement
		info_type: 'min_points',
		int_info: the minimum # of points needed
	}
	*/
	function req_min_points($options = array()) {

		/*
		arguments:
		{
			user: an array of info about the user
			req: information regarding the requirement
		}

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

		$valid = $this->check_params(array(
				'user' => $options['user'],
				'req' => $options['req']
			)
		);

		if(Core::has_error($valid)) {

			return $valid;

		}
		
		// Parameters are valid. Save the users and requirements information from the validation phase since that is where the checks are happening
		$options['user'] = $valid['user'];
		$options['req'] = $valid['req'];
		
		$req_passed = 0;

		if($options['user']['points'] >= $options['req']['points']) {

			$req_passed = 1;

		}

		return array(
			'badges_info_id' => $options['req']['badges_info_id'],
			'passed' => $req_passed
		);

	}

	/*
	Tests to see that a user has a certain # of points
	structure of an entry in badge_reqs
	{
		badge_id: the id of the badge for which this is a requirement
		info_type: 'action_qty',
		int_info: the minimum # of times this action needs to be taken
	}
	*/
	function req_min_action_qty($options = array()) {

		/*
		arguments:
		{
			user: an array of info about the user
			req: information regarding the requirement
		}

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

		$valid = $this->check_params(array(
				'user' => $options['user'],
				'req' => $options['req']
			)
		);

		if(Core::has_error($valid)) {

			return $valid;

		}
		
		// Parameters are valid. Determine how many times the user has taken an action
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.actions_log',
				'values' => array(
					'user_id' => $options['user']['user_id'],
					'action_types_id' => $valid['req']['action_types_id'],
					'active' => 1
				)
			)
		);
		
		$req_passed = 0;

		if($c >= $options['req']['int_info']) {

			$req_passed = 1;

		}

		return array(
			'passed' => $req_passed
		);

	}

	/*
	Requires that a have at minimum a certain number of actions belonging to a certain category (for example, "shared 20 peices of social media")
	That means that they have to take a total of actions, with any of those actions belonging to the social media category
	structure of an entry in badge_reqs
	{
		badge_id: the id of the badge for which this is a requirement
		info_type: 'min_cat_qty',
		int_info: the minimum # of actions requires
		info: the category_id
	}
	*/
	function req_min_cat_qty($options = array()) {

		/*
		arguments:
		{
			user: an array of info about the user
			req: information regarding the requirement
		}

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

		$valid = $this->check_params(array(
				'user' => $options['user'],
				'req' => $options['req']
			)
		);

		if(Core::has_error($valid)) {

			return $valid;

		}

		global $dbh;

		$sql = "SELECT
			count(*)
			FROM " . GAMO_DB . ".actions_log
			WHERE
			active = 1
			AND user_id = :user_id
			AND (
				SELECT
					count(*)
					FROM " . GAMO_DB . ".action_types_info
					WHERE
					" . GAMO_DB . ".action_types_info.action_types_id = " . GAMO_DB . ".actions_log.action_types_id
					AND " . GAMO_DB . ".action_types_info.info_type = 'category'
					AND " . GAMO_DB . ".action_types_info.int_info = :category_id
			) > 0
			";
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':category_id' => $options['req']['info'],
				':user_id' => $options['user']['user_id']
			)
		);

		$qty = $sth->fetchColumn();

		if($qty >= $options['req']['int_info']) {

			return array(
				'passed' => 1
			);

		}

		return array(
			'passed' => 0
		);

	}

	/*
	Requires that a have at minimum a certain number of points belonging to a certain category (for example, "shared 20 peices of social media")
	That means that they have to take a total of actions, with any of those actions belonging to the social media category
	structure of an entry in badge_reqs
	{
		badge_id: the id of the badge for which this is a requirement
		info_type: 'min_cat_qty',
		int_info: the minimum # of points required
		info: the category_id
	}
	*/
	function req_min_cat_points($options = array()) {

		/*
		arguments:
		{
			user: an array of info about the user
			req: information regarding the requirement
		}

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

		$valid = $this->check_params(array(
				'user' => $options['user'],
				'req' => $options['req']
			)
		);

		if(Core::has_error($valid)) {

			return $valid;

		}

		global $dbh;

		$sql = "SELECT
			SUM(point_value_use) AS total_points
			FROM " . GAMO_DB . ".actions_log
			WHERE
			active = 1
			AND user_id = :user_id
			AND (
				SELECT
					count(*)
					FROM " . GAMO_DB . ".action_types_info
					WHERE
					" . GAMO_DB . ".action_types_info.action_types_id = " . GAMO_DB . ".actions_log.action_types_id
					AND " . GAMO_DB . ".action_types_info.info_type = 'category'
					AND " . GAMO_DB . ".action_types_info.int_info = :category_id
			) > 0
			";
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':category_id' => $options['req']['info'],
				':user_id' => $options['user']['user_id']
			)
		);

		$total_points = $sth->fetchColumn();

		if($total_points >= $options['req']['int_info']) {

			return array(
				'passed' => 1
			);

		}

		return array(
			'passed' => 0
		);

	}

}
?>
