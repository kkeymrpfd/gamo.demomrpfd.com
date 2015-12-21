<?
class Core_Reward_Manager {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Could not properly create action type'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid entry specified while trying to retrieve action type'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Could not retrieve action type details'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Invalid entry specified while trying to retrieve action value'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'Could not retrieve action value'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'Could not create action type info record'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'Invalid entry specified while trying to retrieve action type info'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'Could not retrieve action type info details'
			),
			array(
				'error_code' => '9',
				'error_msg' => 'Invalid entry specified while trying to update action type'
			),
			array(
				'error_code' => '10',
				'error_msg' => 'Could not update action types record'
			),
			array(
				'error_code' => '11',
				'error_msg' => 'Invalid entry specified while trying to update action type info'
			),
			array(
				'error_code' => '12',
				'error_msg' => 'Could not update action type info'
			),
			array(
				'error_code' => '13',
				'error_msg' => 'Could not create badge'
			),
			array(
				'error_code' => '14',
				'error_msg' => 'Invalid entry specified for updating badge'
			),
			array(
				'error_code' => '15',
				'error_msg' => 'Could not update badge'
			),
			array(
				'error_code' => '16',
				'error_msg' => 'Could not create badge info'
			),
			array(
				'error_code' => '17',
				'error_msg' => 'Invalid entry specified for updating badge requisite'
			),
			array(
				'error_code' => '18',
				'error_msg' => 'Could not update badge requisite'
			),
			array(
				'error_code' => '19',
				'error_msg' => 'Invalid action type specified'
			),
			array(
				'error_code' => '20',
				'error_msg' => 'An action type info entry with this information already exists'
			),
			array(
				'error_code' => '21',
				'error_msg' => 'An action type with this information already exists'
			),
			array(
				'error_code' => '22',
				'error_msg' => 'There is already a badge with this name'
			),
			array(
				'error_code' => '23',
				'error_msg' => 'Invalid badge specified while creating badge info'
			),
			array(
				'error_code' => '24',
				'error_msg' => 'Badge requirement setting mismatch for badge info entry'
			),
			array(
				'error_code' => '25',
				'error_msg' => 'Invalid info type specified while creating badge info'
			),
			array(
				'error_code' => '26',
				'error_msg' => 'A matching badge info entry already exists'
			),
			array(
				'error_code' => '27',
				'error_msg' => 'Invalid badge info entry specified'
			),
			array(
				'error_code' => '28',
				'error_msg' => 'Could not retrieve badge info'
			),
			array(
				'error_code' => '29',
				'error_msg' => 'Invalid badge specified'
			)
		);

	}

	/*
	Creates a new action type
	*/
	function create_action_type($options = array()) {

		/*
		arguments:
		{
			points: how many points this action is worth
			action_name: the name of this action (will be saved to the default locale)
			display_name: the display name to use for this action (reverts to action_name if not specified)
			categories: an array of category_ids that this action should belong to (optional)
			locale: locale to save the name to (by default, this will revert to the default locale) (optional),
			action_types_id_alias: the action id that an outside system might want to associate with this action. For example, if the action id
							for sharing on Facebook is 203 for Gamo, but the API for the client has the action id for that same action as 938 or "facebook_share",
							this is where we would store the outside action id so we know that they are actually the same thing
			other_info: { an array of other info to store (optional)
				<other info entry>,
				<other info entry>,
				<other info entry>
			}
		}

		Return:
			if successful:
			{
				action_types_id: the id of the newly created action_type row
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		Core::ensure_defaults(array(
			'action_name' => '',
			'display_name' => '',
			'points' => 0,
			'categories' => array(),
			'locale' => DEFAULT_LOCALE,
			'other_info' => array(),
			'action_types_id_alias' => ''
		), $options);

		// pendo Validate input
		// pendo validate categories entries before actually creating the new action type
		// pendo validate other_info entries before actually creating the new action type
		// pendo ensure that another action type does not have the same name
		// pendo use action_name for display_name if no display_name is provided
		// pendo remember to insert the action type name into the locale layer

		// Ensure that action type info entry with matching information does not already exist
		$params = array(
			'action_name' => $options['action_name'],
			'action_types_id_alias' => $options['action_types_id_alias']
		);

		if($options['action_types_id_alias'] != '') {

			$params['action_types_id_alias'] = $options['action_types_id_alias'];

		}

		if($params['action_types_id_alias'] == '') {

			unset($params['action_types_id_alias']);

		}
		
		$c = Core::db_count(array(
				'table' => '' . CORE_DB . '.action_types',
				'values' => $params,
				'type' => 'OR'
			)
		);

		if($c > 0) { // Action type already exists
			
			return Core::error($this->errors, 21);

		}

		$action_types_id = Core::db_insert(array(
				'table' => '' . CORE_DB . '.action_types',
				'values' => array(
					'action_name' => $options['action_name'],
					'points' => $options['points'],
					'action_types_id_alias' => $options['action_types_id_alias']
				)
			)
		);

		if(!is_numeric($action_types_id)) {

			return Core::error($this->errors, 1);

		}

		return array(
			'action_types_id' => $action_types_id
		);

	}

	/*
	Returns the details of an action type
	*/
	function get_action_type($options = array()) {

		/*
		arguments
			action_id: The action for which to determine the reward value

		This value is stored in the "rewards" table

		Return:
			if successful:
			{
				action_types_id,
				action_name,
				points,
				action_types_id_alias
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
		), $options);

		if(!is_numeric($options['action_types_id'])) { // Invalid action_types_id

			return Core::error($this->errors, 2);

		}

		// Try to retrieve action type details
		global $dbh;

		$sql = 'SELECT
		action_types_id,
		action_name,
		points,
		action_types_id_alias
		FROM ' . CORE_DB . '.action_types
		WHERE action_types_id = :action_types_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $options['action_types_id']
			)
		);

		$result = $sth->fetch();

		if(!is_array($result)) { // Could not find record

			return Core::error($this->errors, 3);

		}

		return Core::remove_numeric_keys($result);

	}

	/*
	Returns the point value of an action
	*/
	function get_action_value($options = array()) {

		/*
		arguments
			action_id: The action for which to determine the reward value

		This value is stored in the "rewards" table

		Return:
			if successful:
			{
				value_total: how many points the action is worth
				(using value_total instead of just "value" in case we want to create "action triggers action" situations in the future
				in which case an action's total point value might exceed it's instrinsic point value)
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
		), $options);

		if(!is_numeric($options['action_types_id'])) { // Invalid action_types_id

			return Core::error($this->errors, 4);

		}

		// Try to retrieve action type details
		global $dbh;

		$sql = 'SELECT
		points
		FROM ' . CORE_DB . '.action_types
		WHERE action_types_id = :action_types_id';
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $options['action_types_id']
			)
		);

		$result = $sth->fetch();

		if(!is_array($result)) { // Could not find record

			return Core::error($this->errors, 5);

		}

		return Core::remove_numeric_keys($result);


	}

	/*
	Creates a new entry in the action_type_info table
	*/
	function create_action_type_info($options = array()) {

		/*
		arguments:
		{
			action_types_id: the action type we are creating this entry for
			info_type: the type of information. For example, "category"
			int_info: an integer peice of information
			info: a varchar peice of information
			info_b: a varchar peice of information
		}

		Return:
		if successful:
		{
			action_type_info_id: the id of the newly created action_type_info row
		}

		if error:
		{
			error_code: The error code
			error_msg: The error message
		}
		*/

		// Ensure details
		Core::ensure_defaults(array(
			'action_types_id' => -1,
			'info_type' => '',
			'int_info' => '',
			'info' => '',
			'info_b' => '',
			'time' => '0000-00-00 00:00:00'
		), $options);

		// pendo Validate input

		// Determine if the action type id is valid
		$c = Core::db_count(array(
				'table' => '' . CORE_DB . '.action_types',
				'values' => array(
					'action_types_id' => $options['action_types_id']
				)
			)
		);

		if($c != 1) { // Action type is not valid

			return Core::error($this->errors, 19);

		}

		// Ensure that action type info entry with matching information does not already exist
		$c = Core::db_count(array(
				'table' => '' . CORE_DB . '.action_types_info',
				'values' => array(
					'action_types_id' => $options['action_types_id'],
					'info_type' => $options['info_type'],
					'int_info' => $options['int_info'],
					'info' => $options['info'],
					'info_b' => $options['info_b'],
					'time' => $options['time']
				)
			)
		);

		if($c > 0) { // Action type is not valid

			return Core::error($this->errors, 20);

		}

		$result = Core::db_insert(array(
				'table' => '' . CORE_DB . '.action_types_info',
				'values' => array(
					'action_types_id' => $options['action_types_id'],
					'info_type' => $options['info_type'],
					'int_info' => $options['int_info'],
					'info' => $options['info'],
					'info_b' => $options['info_b'],
					'time' => $options['time']
				)
			)
		);

		if(!is_numeric($result)) {

			return Core::error($this->errors, 6);

		}

		return array(
			'action_types_info_id' => $result
		);

	}

	/*
	Retrieve information for an action type info record
	*/
	function get_action_types_info($options) {

		/*
		arguments
			action_types_info_id: The action info entry for which we want to retrieve info

		This value is stored in the "rewards" table

		Return:
			if successful:
			{
				action_types_info_id,
				action_types_id,
				info_type,
				int_info,
				info,
				info_b,
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
			'action_types_info_id' => -1
		), $options);

		if(!is_numeric($options['action_types_info_id'])) { // Invalid action_types_id

			return Core::error($this->errors, 7);

		}

		// Try to retrieve action type details
		global $dbh;

		$sql = 'SELECT
		action_types_info_id,
		action_types_id,
		info_type,
		int_info,
		info,
		info_b,
		time
		FROM ' . CORE_DB . '.action_types_info
		WHERE action_types_info_id = :action_types_info_id';
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_info_id' => $options['action_types_info_id']
			)
		);

		$result = $sth->fetch();	

		if(!is_array($result)) { // Could not find record

			return Core::error($this->errors, 8);

		}

		return Core::remove_numeric_keys($result);

	}

	/*
	Updates information regarding an action type. For example, if we wanted to update how many points an action type is worth,
	this is the method to use
	*/
	function update_action_type($options = array()) {

		/*
		arguments:
		{
			action_types_id: the action type to update
			values: {
				points: how many points this action should be worth
				action_name: the name of this action (will be saved to the default locale)
				display_name: the display name to use for this action (reverts to action_name if not specified)
				locale: locale to save the name to (by default, this will revert to the default locale) (optional)
			}
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
				'values' => array()
			)
		, $options);

		if(!is_numeric($options['action_types_id'])) {

			return Core::error($this->errors, 9);

		}

		// pendo Validate input

		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.action_types',
				'values' => $options['values'],
				'where' => array(
					'action_types_id' => $options['action_types_id']
				)
			)
		);

		if($result != 1) {

			return Core::error($this->errors, 10);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Update an action type info entry
	*/
	function update_action_type_info($options = array()) {

		/*
		arguments:
		{
			action_types_info_id: the action type info entry to update
			values: {
				actions_info_id: the action info entry to update (optional),
				action_types_id: the action_type value (optional)
				info_type: the type of information (optional)
				int_info: some integer peice of information (optional)
				info: some varchar peice of information (optional)
				info_b: some varchar peice of information (optional)
			}
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
				'action_types_info_id' => -1,
				'values' => array()
			)
		, $options);

		if(!is_numeric($options['action_types_info_id'])) {

			return Core::error($this->errors, 11);

		}

		// pendo Validate input

		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.action_types_info',
				'values' => $options['values'],
				'where' => array(
					'action_types_info_id' => $options['action_types_info_id']
				)
			)
		);

		if(!is_numeric($result)) {

			return Core::error($this->errors, 12);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Create a new badge. Since ranks are essentially badges (we can just hide them from being displayed as badges), we would also
	use this to create new ranks
	*/
	function create_badge($options) {

		/*
		arguments:
		{
			active: if this badge is active
			hidden: if this badge is hidden (won't show up on any badge-only badge listings)
			badge_name: the name of this badge (will be saved to the default locale),
			display_name: the name to display to display (reverts to badge_name if not specified)
			locale: locale to save the name to (by default, this will revert to the default locale) (optional)
			rank: this badges rank value,
			int_info: misc into info,
			info: misc info,
			info_b: another misc info field,
			badges_info: an array of badge infos
			trigger_action: an action to trigger when badge is earned (-1 = do not trigger an action)
		}
		
		Before attempting to create the badge, pass each badges_info (if applicable) to this->badges_info_validate()

		If the badge creation is succesful and there are badges_info specified, we should iterate through the list of
		arguments[badges_info] and pass them to this->create_badges_info()

		Return:
			if successful:
			{
				badge_id: the badge_id of the newly created badge
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'active' => 1,
				'hidden' => 0,
				'badge_name' => '',
				'display_name' => '',
				'locale' => DEFAULT_LOCALE,
				'rank' => 0,
				'badges_info' => array(),
				'trigger_action' => $options['trigger_action']
			)
		, $options);

		// pendo Validate input
		// pendo validate badge infos before inserting
		// pendo remember to insert name into locale layer

		// Determine that there isnt already a badge with this same info
		$c = Core::db_count(array(
				'table' => '' . CORE_DB . '.badges',
				'values' => array(
					'badge_name' => $options['badge_name']
				)
			)
		);

		if($c > 0) { // Action type is not valid

			return Core::error($this->errors, 22);

		}

		$result = Core::db_insert(array(
				'table' => '' . CORE_DB . '.badges',
				'values' => array(
					'badge_name' => $options['badge_name'],
					'active' => $options['active'],
					'hidden' => $options['hidden'],
					'rank' => $options['rank'],
					'trigger_action' => $options['trigger_action']
				)
			)
		);
		
		if(!is_numeric($result)) {

			return Core::error($this->errors, 13);

		}

		return array(
			'badge_id' => $result
		);

	}

	/*
	Updates a badge
	*/
	function update_badge($options = array()) {

		/*
		arguments
		{
			badge_id: the badge to update
			values: { values to update
				points
				active
				hidden
				badge_name
				int_info
				info
				info_b
			}	
		}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'badge_id' => -1,
				'values' => array()
			)
		, $options);

		if(!is_numeric($options['badge_id'])) {

			return Core::error($this->errors, 14);

		}

		// pendo Validate input
			
		if(is_array($options['values'])) { // Update badge

			

		}

		// Ensure that a badge does not already exist with this name if name is being altered
		global $dbh;

		if($options['values'] == 'delete') {

			$options['values'] = array(
				'active' => 0
			);

		} else if(isset($options['values']['badge_name'])) { // Attempting to update badge name. Ensure that it is unique

			$sql = 'SELECT count(*) FROM ' . CORE_DB . '.badges WHERE badge_name = :badge_name AND badge_id != :badge_id';
			$sth = $dbh->prepare($sql);

			$sth->execute(array(
					':badge_id' => $options['badge_id'],
					':badge_name' => $options['values']['badge_name']
				)
			);

			$c = $sth->fetchColumn();

			if($c > 0) {

				return Core::error($this->errors, 22);

			}

		}

		// Update the badge
		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.badges',
				'values' => $options['values'],
				'where' => array(
					'badge_id' => $options['badge_id']
				)
			)
		);

		if($result != 1) {

			return Core::error($this->errors, 15);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Create a badge info
	*/
	function create_badge_info($options = array()) {

		/*
		arguments:
		{
			info_type: the type of requisite (for example: points)
			is_req: wether this is a badge info
			badge_id: the badge_id to use (if not specified, only a partial validation can occur)
			action_types_id: the action type that this req is tied to (if not specified, only a partial validation can occur)
			points: how many points are required
			int_info: some integer peice of information
			info: some varchar peice of information
			info_b: some varchar peice of information
		}

		Return:
			if successful:
			{
				badges_info_id: the id of the new badge info
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		Core::ensure_defaults(array(
				'info_type' => '',
				'badge_id' => -1,
				'is_req' => 0,
				'action_types_id' => -1,
				'int_info' => '',
				'info' => '',
				'info_b' => ''
			)
		, $options);

		global $gamo;

		// Validate input
		$valid = Core::r('badges_info_validate')->run($options);
		
		if(Core::has_error($valid)) {

			return $valid;

		}

		$options = $valid['options'];
		
		$result = Core::db_insert(array(
				'table' => '' . CORE_DB . '.badges_info',
				'values' => array(
					'info_type' => $options['info_type'],
					'is_req' => ($options['is_req'] != 1) ? 0 : 1,
					'badge_id' => $options['badge_id'],
					'action_types_id' => $options['action_types_id'],
					'points' => $options['points'],
					'int_info' => $options['int_info'],
					'info' => $options['info'],
					'info_b' => $options['info_b']
				)
			)
		);

		if(!is_numeric($result)) {

			Core::error($this->errors, 16);

		}

		return array(
			'badges_info_id' => $result
		);

	}

	/*
	Update badge info
	*/
	function update_badges_info($options = array()) {

		/*
		arguments:
		{
			info_type: the type of requisite (for example: points)
			values
			{
				badge_id: the badge_id to use (if not specified, only a partial validation can occur)
				info_type,
				is_req,
				action_types_id: the action type that this req is tied to (if not specified, only a partial validation can occur)
				int_info: some integer peice of information
				info: some varchar peice of information
				info_b: some varchar peice of information
			}
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
				'badges_info_id' => -1,
				'values' => array()
			)
		, $options);

		if(!is_numeric($options['badges_info_id'])) {

			return Core::error($this->errors, 17);

		}

		// pendo Validate input
		
		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.badges_info',
				'values' => $options['values'],
				'where' => array(
					'badges_info_id' => $options['badges_info_id']
				)
			)
		);

		if($result != 1) {

			return Core::error($this->errors, 18);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Retrieve a badge info record
	*/
	function get_badges_info($options = array()) {

		/*
		arguments:
		{
			badges_info_id: the badge info entry to retrieve
		}

		if successful:
			{
				badges_info_id: the id of the badge info entry
				badge_id: the badge_id to use (if not specified, only a partial validation can occur)
				info_type,
				is_req,
				action_types_id: the action type that this req is tied to (if not specified, only a partial validation can occur)
				points: how many points are required
				int_info: some integer peice of information
				info: some varchar peice of information
				info_b: some varchar peice of information
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'badges_info_id' => -1
			)
		, $options);

		if(!is_numeric($options['badges_info_id']) || $options['badges_info_id'] < 0) {

			return Core::error($this->errors, 27);

		}

		// Try to retrieve information from the database
		global $dbh;

		$sql = 'SELECT
			badges_info_id,
			badge_id,
			info_type,
			is_req,
			action_types_id,
			int_info,
			info,
			info_b
			FROM ' . CORE_DB . '.badges_info
			WHERE badges_info_id = :badges_info_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':badges_info_id' => $options['badges_info_id']
			)
		);

		$row = $sth->fetch();

		if(!is_array($row)) {

			return Core::error($this->errors, 28);

		}

		return Core::remove_numeric_keys($row);

	}

	/*
	Retrieve all badges
	*/
	function get_badges($options = array()) {

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		/*

		returns
			if successful:
			{
				{
					badge_id,
					badge_name
					rank
				},
				{
					badge_id,
					badge_name,
					rank
				},
				{
					badge_id,
					badge_name,
					rank
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

		$sql = "SELECT
		badge_id,
		badge_name,
		rank,
		(
			SELECT
			info
			FROM
			" . CORE_DB . ".badges_info AS a
			WHERE
			a.badge_id = badges.badge_id
			AND a.info_type = 'description'
			LIMIT 0, 1
		) AS badge_description,
		(
			SELECT
			info
			FROM
			" . CORE_DB . ".badges_info AS a
			WHERE
			a.badge_id = badges.badge_id
			AND a.info_type = 'prize'
			LIMIT 0, 1
		) AS badge_prize,
		(
			SELECT
			count(*)
			FROM
			" . CORE_DB . ".users_info AS b
			WHERE
			b.badge_id = badges.badge_id
			AND b.user_id = :user_id
			LIMIT 0, 1
		) AS user_has
		FROM
		" . CORE_DB . ".badges AS badges ORDER BY ordered ASC, badge_name ASC
		";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id']
			)
		);

		$badges = array();

		while($row = $sth->fetch()) {

			array_push($badges, Core::remove_numeric_keys($row));

		}
		
		return $badges;

	}

	// Retrieve info for a single badge
	function get_badge($options = array()) {

		global $dbh;
		
		Core::ensure_defaults(array(
				'badge_id' => -1
			)
		, $options);

		$sql = 'SELECT badge_id, badge_name, rank FROM ' . CORE_DB . '.badges WHERE badge_id = :badge_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':badge_id' => $options['badge_id']
			)
		);

		$row = $sth->fetch();

		if(!is_array($row)) {

			return Core::error($this->errors, 29);

		}

		return Core::remove_numeric_keys($row);

	}

}
?>
