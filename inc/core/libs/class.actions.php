<?
/*
This class handles the CRUD operations associated with actions
*/
class Core_Actions {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Could not properly save action'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Could not properly save action info'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Invalid action id specified for retrieving action'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Could not find action'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'Invalid action info id specified for retrieving action info'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'Could not find action info'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'Invalid action type specified'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'Invalid user information specified'
			),
			array(
				'error_code' => '9',
				'error_msg' => 'User is blocked from playing'
			),
			array(
				'error_code' => '10',
				'error_msg' => 'This action id alias is already in use'
			),
			array(
				'error_code' => '11',
				'error_msg' => 'Could not map action type based on action types alias'
			),
			array(
				'error_code' => '12',
				'error_msg' => 'Action was already triggered in the action chain'
			)
		);

	}
	
	/*
	Stores an action. For example, if someone posts a tweet, visits a page, or fills out a survey,
	the details of that action are passed to this method so the action can be recorded.
	*/
	function create_action($options = array()) {

		/*
		arguments
		{
			action_types_id:	A reference to the type of action being taken. For example, posting a tweet might have an action_types_id of 1
			user_id: The id of the user commiting this action,
			int_other: Some peice of information that is an integer (optional)
			other: Some peice of information (optional)
			other_b Some peice of information (optional),
			time: the datetime string of when this action was commited (optional. Defaults to current time)
			action_id_alias: The id associated with this action in an external system (optional)
			active: 1 = active action, 0 = inactive action,
			triggered_by: the action id this action was triggered by (-1 if none),
			triggere_type: the type of trigger (1 = action triggers action without linking, 2 = action triggers action with linking)
			action_trigger_chain: all actions that were triggered together. This is to prevent a loop of the same actions getting triggered over and over again in case a triggers b and b triggers a
			create_action_info: array( // Optional addtional detail entries (passed to this->create_action_info() )
				array(),
				array(),
				array()
			) 
		}

		The information above must also be validated. For example, we must validate that the action_types_id and user_id values are valid.
		This validation can occur in other methods (perhaps in this class) to promote modularity
		Additionally, verification must occur that this action should even be recorded. For example, if we are using an API
		to fetch actions from a third party service, we don't want to record an action twice if we have accidentally fetched it twice.
		Even though we would ideally check for such things while fetching the records via the API, the action layer must ultimately
		take responsibility for what it records, and therefore, conduct it's own checks. This validation would occur in action_verify->run()
	
		If the insert is succesful, remember to call rewards->calc_points() to calculate the user's points properly

		Return:
			if successful:
			action_types_id:	A reference to the type of action being taken. For example, posting a tweet might have an action_types_id of 1
			user_id: The id of the user commiting this action,
			int_other: Some peice of information that is an integer (optional)
			other: Some peice of information (optional)
			action_trigger_chain: the action trigger chain
			other_b Some peice of information (optional)
			{
				action_id: The action_id of the row createdalready in use
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'action_types_id' => -1,
				'user_id' => -1,
				'int_other' => -1,
				'other' => '',
				'other_b' => '',
				'time' => Core::date_string(),
				'action_id_alias' => '',
				'create_action_info' => array(),
				'active' => 1,
				'triggered_by' => -1,
				'trigger_type' => -1,
				'action_trigger_chain' => array(),
				'point_value' => 'get'
			), 
		$options);

		$valid = $this->create_action_validate($options);

		if(Core::has_error($valid)) {

			return $valid;

		}

		// # of points this action is worth as determined during the action validation phase
		$point_value = (is_numeric($options['point_value'])) ? $options['point_value'] : $valid['points'];
		
		$active = $valid['active'];

		$options['action_types_id'] = $valid['action_types_id'];
		// pendo Validate input
		// pendo trigger badge calculation

		// If an action id alias is being used, ensure that it is unique
		if($options['action_id_alias'] != '') {

			$c = Core::db_count(array(
					'table' => '' . CORE_DB . '.actions_log',
					'values' => array(
						'action_id_alias' => $options['action_id_alias']
					)
				)
			);

			if($c > 0) { // This action id alias is already in use

				return Core::error($this->errors, 10);

			}

		}

		// Try inserting the record
		$action_id = Core::db_insert(array(
				'table' => '' . CORE_DB . '.actions_log',
				'values' => array(
					'action_types_id' => $options['action_types_id'],
					'user_id' => $options['user_id'],
					'point_value' => $point_value,
					'point_value_use' => $point_value,
					'point_value_used' => 0,
					'int_other' => $options['int_other'],
					'other' => $options['other'],
					'other_b' => $options['other_b'],
					'time' => $options['time'],
					'triggered_by' => $options['triggered_by'],
					'trigger_type' => $options['trigger_type'],
					'action_id_alias' => $options['action_id_alias'],
					'active' => $active
				)
			)
		);

		if(!is_numeric($action_id)) {

			return Core::error($this->errors, 1);

		}

		// Calculate points
		global $gamo, $dbh;

		Core::r('rewards')->calc_rewards(array(
				'action_id' => $action_id
			)
		);
		
		// Execute trigger actions
		$sql = "SELECT int_info FROM " . CORE_DB . ".action_types_info WHERE action_types_id = :action_types_id AND info_type = 'trigger_action'";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $options['action_types_id']
			)
		);

		while($row = $sth->fetch()) {

			$options['action_trigger_chain'][$row['int_info']] = Core::r('actions')->create_action(array(
					'action_types_id' => $row['int_info'],
					'user_id' => $options['user_id'],
					'action_trigger_chain' => $options['action_trigger_chain'],
					'triggered_by' => $action_id,
					'trigger_type' => 1
				)
			);

		}

		$other = array(); // Misc information to return

		/*
		Iterate through user properties to test for special properties that might require procesing during action triggers
		For example, if the user is linked to another user in such way that for every action that is tallied for them or for the other user
		then this section is responsible for handling that
		*/

		foreach($valid['user']['has'] as $k => $has) {

			if($has['info_type'] == 'link_action_to') { // Link this user to another user or another set of users

				$other['link_action_to'] = array();

				/*
				There might be different types of way that a user is linked. Based on the type of link, we want to retrieve
				what other users this user is linked to. Rather then having seperate sections for each, we are going to just
				contstruct the query to retrieve the user(s) that this user is linked to based on thei link type, then trigger
				the action for the user(s) that this user is linked to
				*/
				$params_raw = array();

				if($has['info'] == 'company') { // For every action that this user has tallied, tally it for the user's company

					$params_raw['company'] = $valid['user']['company'];
					$params_raw['user_group'] = 'company';

				}

				$params = Core::db_params(array(
						'values' => $params_raw
					)
				);

				$sql = "SELECT
				user_id
				FROM " . CORE_DB . ".users WHERE " . $params['sql'];
				
				$sth = $dbh->prepare($sql);
				$sth->execute($params['params']);

				while($row = $sth->fetch()) {

					$row['action'] = Core::r('actions')->create_action(array(
							'action_types_id' => $options['action_types_id'],
							'user_id' => $row['user_id'],
							'triggered_by' => $action_id,
							'trigger_type' => 2
						)
					);

					array_push($other['link_action_to'], Core::remove_numeric_keys($row));

				}

			}

		}

		return array(
			'action_id' => $action_id,
			'points' => $point_value,
			'action_trigger_chain' => $options['action_trigger_chain'],
			'other' => $other
		);

	}

	/*
	Map an action type based on the action_types_id_alias
	*/
	function map_action_type($action_types_id_alias = -1) {

		/*
		arguments:
			action_types_id_alias: the alias

		Return:
			if successful:
			{
				action_types_id: the action types id
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		global $dbh;

		$sql = 'SELECT action_types_id FROM ' . CORE_DB . '.action_types WHERE action_types_id_alias = :action_types_id_alias';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(':action_types_id_alias' => $action_types_id_alias));

		$row = $sth->fetch();

		if(!is_array($row)) {

			return Core::error($this->errors, 11);

		}

		return array(
			'action_types_id' => $row['action_types_id']
		);

	}

	/*
	Basic verification to determine that action settings are valid. Does not actually validate the action
	*/
	function create_action_validate($options) {

		/*
		arguments
		{
			action_types_id:	A reference to the type of action being taken. For example, posting a tweet might have an action_types_id of 1
			user_id: The id of the user commiting this action,
			int_other: Some peice of information that is an integer (optional)
			other: Some peice of information (optional)
			other_b Some peice of information (optional),
			action_trigger_chain: the action trigger chain,
			time: optional
		}

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

		// Ensure defaults
		Core::ensure_defaults(array(
				'action_types_id' => -1,
				'user_id' => -1,
				'int_other' => -1,
				'other' => '',
				'other_b' => '',
				'create_action_info' => array(),
				'time' => Core::date_string(),
				'action_id_alias' => '',
				'action_trigger_chain' => array()
			), 
		$options);

		if(!is_numeric($options['action_types_id'])) {

			global $gamo;
			
			$options['action_types_id'] = Core::r('actions')->action_types_id(array(
	        		'action_key' => $options['action_types_id']
	        	)
	        );

	        if(!is_numeric($options['action_types_id'])) {

	        	return Core::error($this->errors, 7);

	        }

		}

		// Determine that the action_types_id is valid
		if(!is_numeric($options['action_types_id']) || $options['action_types_id'] < 0) { // action_types_id is invalid since it is numeric or less than 0

			return Core::error($this->errors, 7);

		} else if(isset($options['action_trigger_chain'][$options['action_types_id']])) { // This action was already triggered in this action chain

			return Core::error($this->errors, 12);

		} else { // Try checking the database to see if the action_types_id is valid

			$action_type = $this->get_action_type(array(
					'action_types_id' => $options['action_types_id']
				)
			);
			
			if(!is_array($action_type)) { // action_types_id is invalid

				return Core::error($this->errors, 7);

			}
			
			$points = $action_type['points'];
			$active = 1;

			foreach($action_type['has'] as $k => $has) {

				if($has['info_type'] == 'max_qty') { // There is a maximum number of times this action can be taken

					$c = Core::db_count(array(
							'table' => CORE_DB . '.actions_log',
							'values' => array(
								'action_types_id' => $options['action_types_id'],
								'user_id' => $options['user_id'],
								'active' => 1
							)
						)
					);

					// Determine if this action has been taken more times then is allowed
					if($c >= $has['int_info']) { // We still want to record the action, but just not with any points
						
						$points = 0;
						$active = 0;

					}

				} else if($has['info_type'] == 'max_qty_per_seconds') { // There is a maximum number of times this action can be taken in the last n number of seconds

					$c = Core::fetch_column(
						"SELECT
						count(*)
						FROM " . CORE_DB . ".actions_log
						WHERE
						action_types_id = :action_types_id
						AND user_id = :user_id
						AND active = 1
						AND time >= :time",
						array(
							'action_types_id' => $options['action_types_id'],
							'user_id' => $options['user_id'],
							'time' => Core::date_string(time() - $has['info']*1)
						)
					);

					// Determine if this action has been taken more times then is allowed
					if($c >= $has['int_info']) { // We still want to record the action, but just not with any points
						
						$points = 0;
						$active = 0;

					}

				} else if($has['info_type'] == 'max_points_per_seconds') { // There is a maximum number of times this action can be taken in the last n number of seconds

					$c = Core::fetch_column(
						"SELECT
						sum(point_value_used)
						FROM " . CORE_DB . ".actions_log
						WHERE
						action_types_id = :action_types_id
						AND user_id = :user_id
						AND active = 1
						AND time >= :time",
						array(
							'action_types_id' => $options['action_types_id'],
							'user_id' => $options['user_id'],
							'time' => Core::date_string(time() - $has['info']*1)
						)
					);

					// Determine if this action has been taken more times then is allowed
					if($c >= $has['int_info']) { // We still want to record the action, but just not with any points
						
						$points = 0;
						$active = 0;

					}

				}

			}

		}

		global $gamo;

		// Determine if this user is valid and is allowed to play
		$user_valid = Core::r('users')->user_valid(array(
				'user_id' => $options['user_id'],
				'has' => 'no_play'
			)
		);

		if(Core::has_error($user_valid)
		|| isset($user_valid['valid']) && $user_valid['valid'] != 1) { // User is not valid
			
			return Core::error($this->errors, 8);;

		}

		if(isset($user['has_all']) && $user['has_all'] == 0) { // User is not allowed to play

			return Core::error($this->errors, 9);

		}
		

		return array(
			'valid' => 1,
			'points' => $points,
			'active' => $active,
			'action' => $action_type,
			'user' => Core::r('users')->get_user(array('user_id' => $options['user_id'])),
			'action_types_id' => $options['action_types_id']
		);


	}

	/*
	This stores additional information pertaining to an action. For example, if we have used up all of the extra storage fields in the
	actions_log table, and we want to store information about what links a person has posted in their tweets, this method would handle that
	*/
	function create_action_info($options = array()) {

		/*
		arguments
		{
			action_id: the action_id of the action for which this info record is being created
			info_type: the type of information. For example, if we are recording a URL in a tweet, we might set info_type to "tweet_url"
			int_info: an integer peice of information
			info: a peice of information
			info_b: a peice of information
			time: a date time string (yyyy-mm-dd hh:mm:ss)
		}
		
		Remember to validate action_id to ensure that it is valid

		Return:1
			if successful:
			{
				actions_info_id: Tif(!is_numeric($action_id)) {

			return Core::error($this->errors, 1);

		}

		return array(
			'action_id' => $action_id
		);he actions_info_id of the row created
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'action_id' => -1,
				'info_type' => '',
				'int_info' => -1,
				'info' => '',
				'info_b' => '',
				'time' => '0000-00-00 00:00:00'
			)
		, $options);

		// pendo Validate input

		$actions_info_id = Core::db_insert(array(
				'table' => '' . CORE_DB . '.actions_info',
				'values' => array(
					'action_id' => $options['action_id'],
					'info_type' => $options['info_type'],
					'int_info' => $options['int_info'],
					'info' => $options['info'],
					'info_b' => $options['info_b'],
					'time' => $options['time']
				)
			)
		);

		if(!is_numeric($actions_info_id)) {

			return Core::error($this->errors, 2);

		}

		return array(
			'actions_info_id' => $actions_info_id
		);

	}

	/*
	This updates a row in the actions_log table. It is important to ONLY update rows in the actions_log table through this method
	since we want to centralize interaction with the actions_log table. This is to compensate for situations in which
	business logic must occur corresponding to updates and values. Having this centralized makes such situations easier to manage
	*/
	function modify_action($options = array()) {

		/*
		arguments
		{
			action_id: // The action_id of the row to be updated
			values: {
				action_types_id:	A reference to the type of action being taken. For example, posting a tweet might have an action_types_id of 1 (optional)
				user_id: The id of the user commiting this action (optional),
				int_other: Some peice of information that is an integer (optional)
				other: Some peice of information (optional)
				other_b: Some peice of information (optional),
				active: wether or not this row is active (setting it to 0 is how we "delete" a row. We rarely want to ACTUALLY delete a row due to logging requirements)
				action_id_alias: the action id for this action from an external system
			}
		}

		If values is set to "delete", the active value will be set to 0 along with the active values for all related action_info rows
		
		If the insert is succesful, remember to call rewards->recalc_points() to calculate the user's points properly

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
			'action_id' => -1,
			'values' => array()
		)
		, $options);

		// pendo Validate input
		// pendo trigger point and badge calculation
		// pendo if an inactive entry is reactived, handle point calculations to factor in a weird point scenario
		// pendo ensure that another action with this action id alias does not already exist

		if(is_array($options['values']) && isset($options['values']['active']) && !is_numeric($options['values']['active'])) {

			unset($options['values']['active']);

		}

		if($options['values'] == 'delete' || isset($options['values']['active']) && $options['values']['active'] == 0) {

			$options['values'] = array(
				'active' => 0,
				'point_value_use' => 0
			);

		}
		
		// If an action id alias is being used, ensure that it is unique
		if(isset($options['values']['action_id_alias']) && $options['values']['action_id_alias'] != '') {

			$c = Core::db_count(array(
					'table' => '' . CORE_DB . '.actions_log',
					'values' => array(
						'action_id_alias' => $options['values']['action_id_alias']
					)
				)
			);

			if($c > 0) { // This action id alias is already in use

				Core::error($this->errors, 10);

			}

		}

		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.actions_log',
				'values' => $options['values'],
				'where' => array(
					'action_id' => $options['action_id'],
				)
			)
		);

		if(!$result) {

			return Core::error($this->errors, 2);

		}

		global $gamo, $dbh;

		$calc = 0;

		// Update was succesful. If point_value was updated, then recalculate rewards
		if(isset($options['values']['point_value_use']) || isset($options['values']['point_value_used'])) {
			
			$calc = Core::r('rewards')->calc_rewards(array(
					'action_id' => $options['action_id']
				)
			);

		}

		// Process the same modification for all actions that are linked to this action
		$other = array(); // Misc return values

		$sql = "SELECT action_id FROM " . CORE_DB . ".actions_log WHERE triggered_by = :triggered_by AND trigger_type = 2";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':triggered_by' => $options['action_id']
			)
		);

		$link_c = 0;

		while($row = $sth->fetch()) {

			if($link_c == 0) { $other['link_action_to'] = array(); }
			
			$link_result = Core::r('actions')->modify_action(array(
					'action_id' => $row['action_id'],
					'values' => $options['values']
				)
			);

			array_push($other['link_action_to'], $link_result);
			
			++$link_c;

		}

		return array(
			'valid' => 1,
			'action_id' => $options['action_id'],
			'other' => $other,
			'calc' => $calc
		);

	}

	/*
	This updates a row in the action_info table. It is important to ONLY update rows in the action_info table through this method
	since we want to centralize interaction with the actions_log table. This is to compensate for situations in which
	business logic must occur corresponding to updates and values. Having this centralized makes such situations easier to manage
	*/
	function modify_action_info($options = array()) {

		/*
		arguments
		{
			actions_info_id: // The actions_info_id of the row to be updated
			values: {
				action_id: the action_id of the action for which this info record is being created (optional)
				info_type: the type of information. For example, if we are recording a URL in a tweet, we might set info_type to "tweet_url" (optional)
				int_info: an integer peice of information (optional)
				info: a peice of information (optional)
				info_b: a peice of information (optional)
				active: wether or not this row is active (setting it to 0 is how we "delete" a row. We rarely want to ACTUALLY delete a row due to logging requirements)
			}
		}

		If values is set to "delete", the active value will be set to 0

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
			'actions_info_id' => -1,
			'values' => array()
		)
		, $options);

		// pendo Validate input
		// pendo trigger point and badge calculation

		if($options['values'] == 'delete') {

			$options['values'] = array('active' => 0);

		}
		
		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.actions_info',
				'values' => $options['values'],
				'where' => array(
					'actions_info_id' => $options['actions_info_id']
				)
			)
		);

		if(!is_numeric($result)) {

			return Core::error($this->errors, 2);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Return the action_types id based on a property
	*/
	function action_types_id($options = array()) {

		/*
		args:
		{
			action_key
		}

		returns:
		if success: (this returns a number instead of an array)
			action_type_id
		*/

		global $dbh;

		if(!is_array($options)) {

			$options = array(
				'action_key' => $options
			);

		}

		Core::ensure_defaults(array(
			)
		, $options);

		$filters = Core::db_params(array(
				'values' => $options
			)
		);
		
		$sql = "SELECT action_types_id FROM " . CORE_DB . ".action_types WHERE " . $filters['sql'] . " LIMIT 0, 1";		

		$action_types_id = Core::fetch_column(
			$sql,
			$filters['params']
		);

		return $action_types_id;

	}

	/*
	Returns information regarding an action
	*/
	function get_action($options) {

		/*
		arguments:
			action_id: The action_id to retrieve information for

		Return:// pendo trigger point and badge calculation
			if successful:
			{
				action_id:
				action_types_id
				user_id
				point_value
				point_value_use
				int_other
				other
				other_b
				time
				other_info: {
					<other info entry>,
					<other info entry>,
					<other info entry>
				}
			}

			if error:
			{
				error_code: The error code.google.com
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'action_id' => -1,
			)
		, $options);

		if(!is_numeric($options['action_id'])) { // Invalid action_id was specified

			return Core::error($this->errors, 3);

		}

		// Try to retrieve action entry
		global $dbh;

		$sql = 'SELECT
			action_id,
			action_types_id,
			user_id,
			point_value,
			point_value_use,
			int_other,
			other,
			other_b,
			time
			FROM ' . CORE_DB . '.actions_log
			WHERE action_id = :action_id';
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_id' => $options['action_id']
			)
		);

		$result = $sth->fetch();

		if(!is_array($result)) { // Action not found

			return Core::error($this->errors, 4);

		}
		
		Core::remove_numeric_keys($result);

		// Try to retrieve action info entries
		$result['actions_info'] = array();

		$sql = 'SELECT
		actions_info_id,
		action_id,
		info_type,
		int_info,
		info,
		info_b,
		time
		FROM
		' . CORE_DB . '.actions_info
		WHERE action_id = :action_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_id' => $options['action_id']
			)
		);

		// Save each action info entry
		while($row = $sth->fetch()) {

			array_push($result['actions_info'], Core::remove_numeric_keys($row));

		}

		return $result;

	}

	/*
	Retrieve the details of an action type
	*/
	function get_action_type($options = array()) {

		/*
		arguments:
			action_types_id: the action type to retrieve

		returns
			if successful:
			{
				action_types_id,
				action_name,
				points,
				action_type_id_alias,
				has: {
					{
						action_types_info_id,
						action_types_id,
						info_type,
						int_info,
						info,
						info_b,
						time
					},
					{
						action_types_info_id,
						action_types_id,
						info_type,
						int_info,
						info,
						info_b,
						time
					},
					..
					..
				}
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'action_types_id' => -1
			)
		, $options);

		global $dbh, $gamo;

		if(!is_numeric($options['action_types_id'])) {

			$options['action_types_id'] = Core::r('actions')->action_types_id(array(
	        		'action_key' => $options['action_types_id']
	        	)
	        );

	    }

		$sql = 'SELECT
			action_types_id,
			action_name,
			points,
			action_key,
			action_types_id_alias
			FROM ' . CORE_DB . '.action_types
			WHERE action_types_id = :action_types_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $options['action_types_id']
			)
		);

		$action = $sth->fetch();

		if(!is_array($action)) {

			return Core::error($this->errors, 7);

		}

		$action = Core::remove_numeric_keys($action);

		$has = array();
		$sql = 'SELECT
			action_types_info_id,
			action_types_id,
			info_type,
			int_info,
			info,
			info_b,
			time
			FROM ' . CORE_DB . '.action_types_info
			WHERE action_types_id = :action_types_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $options['action_types_id']
			)
		);

		while($row = $sth->fetch()) {

			array_push($has, Core::remove_numeric_keys($row));

		}

		$action['has'] = $has;

		return $action;

	}

	function get_action_points($options = array()) {

		if(!is_array($options)) {

			$options = array(
				'action_key' => $options
			);

		}

		Core::ensure_defaults(array(
				'action_key' => ''
			)
		, $options);

		return Core::fetch_column(
			"SELECT points FROM " . CORE_DB . ".action_types WHERE action_key = :action_key",
			array(
				':action_key' => $options['action_key']
			)
		);

	}

	function get_action_name($options = array()) {

		if(!is_array($options)) {

			$options = array(
				'action_key' => $options
			);

		}

		Core::ensure_defaults(array(
				'action_key' => ''
			)
		, $options);

		return Core::fetch_column(
			"SELECT action_name FROM " . CORE_DB . ".action_types WHERE action_key = :action_key",
			array(
				':action_key' => $options['action_key']
			)
		);

	}

	/*
	Retrieve action types optionally filterable by category
	*/
	function get_action_types($options = array()) {

		/*
		arguments:
		{
			category_id: an optional filter to retrieve only action types in this category
			get_info: 'all' = retrieve all action info entries for this action
					  array(info_type, info_type, etc, etc) = retrieve just these info types
					  'none' => do not retrieve info entries for this action type default)
		}

		returns
			if successful:
			{
				{
					action_types_id
					action_name
				},
				{
					action_types_id
					action_name
				},
				{
					action_types_id
					action_name
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

		// Ensure defaults
		Core::ensure_defaults(array(
				'category_id' => -1,
				'get_info' => 'all',
				'category_tag' => ''
			)
		, $options);

		$filter = '';

		$params = array();

		if($options['category_id'] != -1) {

			$filter = " WHERE
			(SELECT 
				count(*) 
				FROM ' . CORE_DB . '.action_types_info
				WHERE
				' . CORE_DB . '.action_types_info.action_types_id = ' . CORE_DB . '.action_types.action_types_id
				AND ' . CORE_DB . '.action_types_info.info_type = 'category'
				AND ' . CORE_DB . '.action_types_info.int_info = :category_id) > 0";
			
			$params[':category_id'] = $options['category_id'];

		}
		
		if($options['category_tag'] != -1) {
		
			$filter = " WHERE
			(SELECT
			count(*)
			FROM " . CORE_DB . ".action_types_info
			WHERE
			" . CORE_DB . ".action_types_info.action_types_id = " . CORE_DB . ".action_types.action_types_id
			AND " . CORE_DB . ".action_types_info.info_type = 'category'
			AND " . CORE_DB . ".action_types_info.int_info = (SELECT category_id FROM " . CORE_DB . ".categories WHERE category_tag = :category_tag LIMIT 1) ) > 0";
				
			$params[':category_tag'] = $options['category_tag'];
		
		}

		global $dbh;

		$sql = 'SELECT action_types_id, action_name, points FROM ' . CORE_DB . '.action_types' . $filter;

		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		$action_types = array();

		while($row = $sth->fetch()) {

			array_push($action_types, Core::remove_numeric_keys($row));

		}

		// Retrieve info entries if applicable
		if($options['get_info'] != 'none'
		&& ($options['get_info'] == 'all'
			|| is_array($options['get_info']) && count($options['get_info'] > 0)
			)
			) { // Retrieve info

			// Construct the sql query
			if($options['get_info'] == 'all') { // Retrieve all info entries

				$sql_filter = '';
				$params = array();

			} else { // Only retrieve the defined info types

				$sql_params = Core::db_params(array(
						'values' => $options['get_info'],
						'type' => 'or'
					)
				);

				$sql_filter = 'AND (' . $sql_params['sql'] . ')';
				$params = $sql_params['params'];

			}

			$sql = 'SELECT
				action_types_info_id,
				info_type,
				int_info,
				info,
				info_b,
				time
				FROM
				' . CORE_DB . '.action_types_info
				WHERE
				action_types_id = :action_types_id' . $sql_filter;

			$sth = $dbh->prepare($sql);

			foreach($action_types as $k => $v) {

				$params[':action_types_id'] = $v['action_types_id'];
				$sth->execute($params);

				$action_types[$k]['has'] = array();

				while($row = $sth->fetch()) {

					array_push($action_types[$k]['has'], Core::remove_numeric_keys($row));

				}

			}

		}

		return $action_types;

	}

	/*
	Retrieve a set of actions filterable by user id and/or category
	*/
	function get_actions($options = array()) {

		/*
		arguments:
			start: the bth row to begin from
			records: how many records to retrieve
			category_id: which category (by default set to -1 which means no category filter is applied)
			user_id: the user for which to retrieve action (by default set to -1, which means no user filter is applied),
			action_types: the action type to retrieve
			sort: how to sort the results (by default, time DESC),
			locale: the locale to retrieve the action names in (defaults to the locale set for the session),
			get_count: wether to retrieve how many total records there are
			user_name: the name to filter by (searches company name, first name, last name, display name, and e-mail)
			filters: array() general filters such as active, int_other, etc

		Returns:
			if successful:
			{
				action_id: the id of the action
				action_types_id,
				user_id,
				point_value,
				point_value_use,
				point_value_used,
				int_other,
				other,
				other_b,
				time,
				triggered_by,
				active: 1 = only show active, 0 = only show inactive, 2 = show both active and inactive
				action_id_alias
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'start' => 0,
				'records' => 20,
				'category_id' => -1,
				'action_types' => -1,
				'user_id' => -1,
				'sort' => "action_id DESC",
				'locale' => 'en-us',
				'get_count' => 0,
				'user_name' => '',
				'active' => 1,
				'filters' => array()
			)
		, $options);
		
		$options['start'] = max((int)$options['start'], 0);

		$sql = 'SELECT
			action_id,
			action_types_id,
			user_id,
			point_value,
			point_value_use,
			point_value_used,
			int_other,
			other,
			other_b,
			time,
			triggered_by,
			active,
			action_id_alias,
			(SELECT display_name FROM ' . CORE_DB . '.users WHERE ' . CORE_DB . '.users.user_id = ' . CORE_DB . '.actions_log.user_id) AS user_display_name,
			(SELECT action_name FROM ' . CORE_DB . '.action_types WHERE ' . CORE_DB . '.action_types.action_types_id = ' . CORE_DB . '.actions_log.action_types_id) AS action_name_display,
			(SELECT action_key FROM ' . CORE_DB . '.action_types WHERE ' . CORE_DB . '.action_types.action_types_id = ' . CORE_DB . '.actions_log.action_types_id) AS action_key
			FROM
			' . CORE_DB . '.actions_log';

		$filters = array();
		$params = array();

		if(count($options['filters']) > 0) { // There are specific filters. Use them

			foreach($options['filters'] as $k => $v) {

				$key_use = $k;

				if(strpos($k, '>') === FALSE && strpos($k, '<') === FALSE) { $key_use .= ' ='; }

				$k = str_replace(array('>', '<'), '', $k);
				
				array_push($filters, $key_use . ' :filter' . $k);
				$params[':filter' . $k] = $v;

			}

		}
		
		if($options['active'] != 2) { // Filter based on active

			array_push($filters, "active = :show_active");
			$params[':show_active'] = $options['active'];

		}

		if($options['user_id'] != -1) { // There is a user filter. Add it

			array_push($filters, "user_id = :user_id");
			$params[':user_id'] = $options['user_id'];

		}

		if(is_array($options['action_types']) && count($options['action_types']) > 0) { // There is an action filter. Add it

			$str_in_act_typ = '';
			foreach($options['action_types'] as $k => $v) {
				$str_in_act_typ .=  ':action_types_id' . $k.',';
				$params[':action_types_id' . $k] = $v;
			}
			
			$str_in_act_typ = trim($str_in_act_typ,',');
			array_push($filters, "action_types_id IN ($str_in_act_typ)");

		}

		if(is_numeric($options['category_id']) && $options['category_id'] != -1) { // There is a category filter. Add it

			array_push($filters, "(SELECT
									count(*)
									FROM " . CORE_DB . ".action_types_info AS a
									WHERE
									a.action_types_id = " . CORE_DB . ".actions_log.action_types_id
									AND a.info_type = 'category'
									AND a.int_info = :category_id) > 0");

			$params[':category_id'] = $options['category_id'];

		}

		if(trim($options['user_name']) != '') { // There is an action filter. Add it

			array_push($filters, "(SELECT
				count(*)
				FROM " . CORE_DB . ".users
				WHERE
				" . CORE_DB . ".users.user_id = " . CORE_DB . ".actions_log.user_id
					AND (
						" . CORE_DB . ".users.email LIKE :email
						OR " . CORE_DB . ".users.first_name LIKE :first_name
						OR " . CORE_DB . ".users.last_name LIKE :last_name
						OR " . CORE_DB . ".users.display_name LIKE :display_name
						OR " . CORE_DB . ".users.company LIKE :company
					)
				) > 0");

			$params[':first_name'] = '%' . $options['user_name'] . '%';
			$params[':last_name'] = '%' . $options['user_name'] . '%';
			$params[':display_name'] = '%' . $options['user_name'] . '%';
			$params[':company'] = '%' . $options['user_name']. '%';
			$params[':email'] = '%' . $options['user_name'] . '%';

		}

		$sql_filters = '';

		// Append the filter string if there is one
		if(count($filters) > 0) { // There are filters

			$sql_filters = ' WHERE ' . implode(' AND ', $filters);
			$sql .= $sql_filters;

		}

		global $dbh;

		// Make sure to convert the start and records values to ints for security
		$sql .= ' ORDER BY ' . $options['sort'] . ' LIMIT ' . (int)$options['start'] . ', ' . (int)$options['records'];

		// Try to retrieve action info entries
		$result['actions_info'] = array();

		$sql_info = 'SELECT
		actions_info_id,
		action_id,
		info_type,
		int_info,
		info,
		info_b,
		time
		FROM
		' . CORE_DB . '.actions_info
		WHERE action_id = :action_id';

		$sth_info = $dbh->prepare($sql_info);

		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		$actions = array();

		while($row = $sth->fetch()) {

			if($options['category_id'] != -1) {

				$row['category_id'] = $options['category_id'];

			}

			$row['timestamp'] = strtotime($row['time']);
			$row['other_info'] = array();

			$sth_info->execute(array(
					':action_id' => $row['action_id']
				)
			);

			// Save each action info entry
			while($row_info = $sth_info->fetch()) {
				
				array_push($row['other_info'], Core::remove_numeric_keys($row_info));

			}

			array_push($actions, Core::remove_numeric_keys($row));

		}

		$return = array(
			'actions' => $actions
		);
		
		if($options['get_count'] == 1) { // Retrieve how many total records there are

			$sql = 'SELECT
			count(*)
			FROM ' . CORE_DB . '.actions_log' . $sql_filters;

			$c = Core::fetch_column($sql, $params);

			$return['records'] = $c;

		}
		
		return $return;

	}

	/*
	Returns information regarding an action_info entry
	*/
	function get_action_info($options = array()) {

		/*
		arguments:
			actions_info_id: The actions_info_id to retrieve information for

		Return:
			if successful:
			{
				actions_info_id (p-u-ai)
				action_id
				info_type
				int_info
				info
				info_b
				time
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'actions_info_id' => -1,
			)
		, $options);

		if(!is_numeric($options['actions_info_id'])) { // Invalid actions_info_id was specified

			return Core::error($this->errors, 5);

		}

		// Try to retrieve action info entry
		global $dbh;

		$sql = 'SELECT
		actions_info_id,
		action_id,
		info_type,
		int_info,
		info,
		info_b,
		time
		FROM
		' . CORE_DB . '.actions_info
		WHERE actions_info_id = :actions_info_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':actions_info_id' => $options['actions_info_id']
			)
		);

		$result = $sth->fetch();

		if(!is_array($result)) { // Action not found

			return Core::error($this->errors, 6);

		}

		return Core::remove_numeric_keys($result);

	}
	
	/*
	Logs when a change is made to an action row or an action_info row
	*/
	function log_action_change() {

		/*
		arguments:
		{
			action_id: the action_id for which this change is being recorded
			actions_info_id: the actions_info_id for which this change is being recorded. If one is not available, set it to 0
			user_id: the user_id for which this change is being recorded
			change_by_id: the user_id of the user that is making this change
			int_info: an integer peice of information
			info: a peice of information
			info_b: a peice of information
		}
	
		Remember to validate that the action_id and actions_info_id are actually valid

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

		// pendo Make this method

	}

}

?>
