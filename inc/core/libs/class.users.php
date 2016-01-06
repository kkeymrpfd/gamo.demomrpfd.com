<?
/*
This class handles users
*/
class Core_Users {

	public $errors; // Store error codes
	public $exclude_emails; // Emails to exclude

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid user information provided'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid e-mail address'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'This e-mail address is already in use'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Invalid user properties check requested'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'Could not create user info'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'Invalid values for updating user info'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'Could not update user info'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'Could not update user'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'Invalid password provided'
			),
			array(
				'error_code' => '9',
				'error_msg' => 'Could not update user password'
			),
			array(
				'error_code' => '10',
				'error_msg' => 'Could not update e-mail address'
			),
			array(
				'error_code' => '11',
				'error_msg' => 'Invalid parameters given for retrieving user info'
			),
			array(
				'error_code' => '12',
				'error_msg' => 'Error while testing for user property'
			),
			array(
				'error_code' => '13',
				'error_msg' => 'There is already an identical user info entry'
			),
			array(
				'error_code' => '14',
				'error_msg' => 'Could not map to user based on user id alias'
			),
			array(
				'error_code' => '15',
				'error_msg' => 'Invalid badge specified'
			)
		);

		$this->exclude_emails = array(
			'entermarketing',
			'mrpfddd'
		);

	}

	/*
	Create a new user
	*/
	function create_user($options) {

		/*
		arguments:
			first_name: user's first name
			last_name: user's last name
			display_name: user's name to display on the leader board
			company: user's company,
			country: user's country,
			city: user's city,
			state: user's state,
			zip: user's zip,
			locale: user's default locale,
			email: user's e-mail address,
			password: user's password (provided in plain text. We encrypt it here),
			int_other: an int peice of information,
			other: a varchar peice of information,
			other_b: a varchar peice of information
			group: the group this user belongs to (blank by default)
			user_id_alias: the alias of this user from an external system

		Validation occurs in this->create_user_validate()
		Remember to validate entries in the users_info array (if any) before creating the user

		Returns:
			if successful:
			{
				user_id: the user id for this user
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'first_name' => '',
				'last_name' => '',
				'display_name' => '',
				'company' => '',
				'title' => '',
				'country' => '',
				'city' => '',
				'state' => '',
				'zip' => '',
				'locale' => '',
				'email' => '',
				'phone' => '',
				'password' => 'trivia',
				'int_other' => '',
				'other' => '',
				'other_b' => '',
				'user_group' => '',
				'user_id_alias' => ''
			)
		, $options);

		// Validate the input
		$validate = $this->create_user_validate($options);

		if(Core::has_error($validate)) {

			return $validate;

		}

		$options = $validate['user_info'];
		
		$user_id = Core::db_insert(array(
				'table' => '' . CORE_DB . '.users',
				'values' => array(
					'first_name' => $options['first_name'],
					'last_name' => $options['last_name'],
					'display_name' => $options['display_name'],
					'company' => $options['company'],
					'title' => $options['title'],
					'country' => $options['country'],
					'city' => $options['city'],
					'state' => $options['state'],
					'zip' => $options['zip'],
					'locale' => $options['locale'],
					'email' => $options['email'],
					'phone' => $options['phone'],
					'password' => hash('sha256', $options['password']),
					'int_other' => $options['int_other'],
					'other' => $options['other'],
					'other_b' => $options['other_b'],
					'user_group' => $options['user_group'],
					'user_id_alias' => $options['user_id_alias']
				)
			)
		, $options);

		// Calculate points
		global $gamo;

		Core::r('rewards')->determine_badges(array(
				'user_id' => $user_id
			)
		);

		return array(
			'user_id' => $user_id
		);

	}

	/*
	Login a user
	*/
	function login($options = array()) {

		global $gamo, $session;

		Core::ensure_defaults(array(
				'user_id' => -1,
				'session_duration' => 86400*365
			)
		, $options);

		$user = Core::r('users')->get_user(array(
				'user_id' => $options['user_id']
			)
		);

		$session->new_session_id('get', $options['session_duration']);
							
		// The user id is valid. Log the user in
		$session->set('user_id', $options['user_id']);
		
		if(isset($user['has']) && is_array($user['has'])) {

			// Set access levels
			foreach($user['has'] as $k => $info_entry) {

				if($info_entry['info_type'] == 'access_level') {

					$session->set('access_' . $info_entry['info'], 1);

				}

			}
		
		}

		Core::r('users')->log_login();

		return true;

	}

	/*
	Log that a user has logged in
	*/
	function log_login($options = array()) {

		/*
		args:
		{ (defaults to what is stored in the session)
			user_id: the user that is logging in,
			session_id: the session id for the login
		}

		returns
		{
			login_id: the id of the login entry
		}
		*/

		global $session;
		
		Core::ensure_defaults(array(
				'user_id' => $session->get('user_id'),
				'session_id' => $session->session_id()
			)
		, $options);

		$login_id = Core::db_insert(array(
				'table' => CORE_DB . '.logins',
				'values' => array(
					'user_id' => $options['user_id'],
					'session_id' => $options['session_id'],
					'ip' => substr($_SERVER['REMOTE_ADDR'], 0, 200),
					'active' => 1,
					'time' => Core::date_string()
				)
			)
		);

		return $login_id;

	}

	/*
	Validates that user information is valid before creating a new user
	*/
	function create_user_validate($options) {

		/*
		arguments:
			first_name: user's first name
			last_name: user's last name
			display_name: user's name to display on the leader board
			company: user's company,
			title: the title of the user,
			country: user's country,
			city: user's city,
			state: user's state,
			zip: user's zip,
			locale: user's default locale,
			email: user's e-mail address,
			phone: user's phone number,
			password: user's password,
			int_other: an int peice of information,
			other: a varchar peice of information,
			other_b: a varchar peice of information
			group: the group of the user,
			ignore: an optional array of checks to skip.
					"email_exists" = do not check if e-mail address exists

		No plans for input validation yet since the gamo doesn't currently care about such things. It just wants gamify it.
		
		Returns:
			if successful:
			{
				valid: 1
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
				error_list: array() A list of errors
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'first_name' => '',
				'last_name' => '',
				'display_name' => '',
				'company' => '',
				'title' => '',
				'country' => '',
				'city' => '',
				'state' => '',
				'zip' => '',
				'locale' => '',
				'email' => '',
				'phone',
				'password' => 'test123',
				'int_other' => '',
				'other' => '',
				'other_b' => '',
				'user_group' => '',
				'user_id_alias' => '',
				'ignore' => array()
			)
		, $options);
		
		$errors = array();

		// Ensure that a display name is set
		if( trim($options['display_name']) == '' ) {

			// The display name is blank. Use a combination of the first and last name
			$options['display_name'] = ucfirst($options['first_name']) . ' ' . strtoupper(substr($options['last_name'], 0, 1));

		}

		if( trim($options['display_name']) == '' ) { // The display name is blank. This is not allowed

			array_push($errors, 'No first name, last name, or display name was specified');

		}

		// Validate the e-mail address
		$email_check = self::validate_email(array(
				'email' => $options['email']
			)
		);

		if(Core::has_error($email_check)) { // The e-mail address is not valid

			array_push($errors, $email_check['error_msg']);

		}

		// Check if a password was provided
		if( trim($options['password']) == '' ) {

			array_push($errors, 'No password was provided');

		}

		// Determine that the user id alias is not already in use if it is set
		if($options['user_id_alias'] != '') {

			$c = Core::db_count(array(
					'table' => '' . CORE_DB . '.users',
					'values' => array(
						'user_id_alias' => $options['user_id_alias']
					)
				)
			);

			if($c > 0) {

				array_push($errors, 'This user id alias is already in use');

			}

		}

		// If this user is a company group, ensure that the company is unique (there can only be one company user per company)
		if($options['user_group'] == 'company') {

			if($options['company'] == '') {

				array_push($errors, 'This user is supposed to be a company, but no company was specified');

			} else {

				$c = Core::db_count(array(
						'table' => CORE_DB . '.users',
						'values' => array(
							'user_group' => 'company',
							'company' => $options['company']
						)
					)
				);

				if($c > 0) {

					array_push($errors, 'There is already a company user with this company name');

				}

			}

		}

		// If there are entries in the errors array, that means that there are errors
		if(count($errors) > 0) {
			
			$return = Core::error($this->errors, 1);
			$return['errors'] = $errors;

			return $return;

		}
		
		return array(
			'valid' => 1,
			'user_info' => $options
		);

	}

	/*
	Map a user based on their user id alias
	*/
	function map_user($user_id_alias = -1) {

		/*
		arguments
			user_id_alias: passed directly (not as an array)

		Returns:
			if successful:
			{
				user_id: the user id
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		global $dbh;

		$sql = 'SELECT user_id FROM ' . CORE_DB . '.users WHERE user_id_alias = :user_id_alias';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(':user_id_alias' => $user_id_alias));

		$row = $sth->fetch();

		if(!is_array($row)) {

			return Core::error($this->errors, 14);

		}

		return array(
			'user_id' => $row['user_id']
		);

	}

	/*
	Validate an e-mail address for a user
	*/
	function validate_email($options = array()) {

		/*
		arguments:
		{
			email: email address to validate
			user_id: optional user id. If the e-mail exists, but it belongs to this user, it will not classify as an error
			unique_check: 1 = test to see if the e-mail is unique, 0 = do not test to see if the e-mail is unique

		if successful:
			{
				valid: 1
			}
			
			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		}
		*/

		Core::ensure_defaults(array(
				'email' => '',
				'user_id' => -1,
				'unique_check' => 1
			)
		, $options);
		
		// Determine if e-mail is valid
		if(!filter_var($options['email'], FILTER_VALIDATE_EMAIL)) {

			return Core::error($this->errors, 2);

		} else if($options['unique_check'] != 0) { // Test to see if the e-mail is unique

			/*
			If we are testing for e-mail uniqueness, we may or may not also factor in the user id. For example,
			if a user wants to us an e-mail address is available, but they enter their own e-mail address,
			it is not an error. This section accounts for that.
			*/
			$params = array(
				':email' => $options['email']
			);

			if(is_numeric($options['user_id']) && $options['user_id'] > -1) { // Factor in user_id when testing for uniqueness

				$sql = 'SELECT count(*) FROM ' . CORE_DB . '.users WHERE email = :email AND user_id != :user_id';
				$params[':user_id'] = $options['user_id'];

			} else { // Do NOT factor in user_id when testing for uniqueness

				$sql = 'SELECT count(*) FROM ' . CORE_DB . '.users WHERE email = :email';

			}
			
			// Determine how many rows there are that match the parameters (either matches e-mail, or e-mail and user_id)
			$c = Core::fetch_column(
				$sql,
				$params
			);
			
			if($c > 0) { // There is already in entry in the users table with this e-mail address

				return Core::error($this->errors, 3);

			}

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Determine if a user is valid and what properties they have
	*/
	function user_valid($options = array()) {

		/*
		arguments:
		{
			user_id: the id of the user to validate
			has: an array of properties that we want this user to have.
		}
		
		Returns:
			if successful:
			{
				valid: 1,
				has: an array of properties specified that we want this user to have along with if they have it,
				has_all: 1 = has all properties specified, 0 = does not have all requirements specified
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
				'has' => array()
			)
		, $options);

		// Ensure that options[has] is an array
		if(!is_array($options['has'])) {

			$options['has'] = array($options['has']);

		}

		// Construct "has" array to be returned
		$has = array();

		foreach($options['has'] as $k => $v) {

			array_push($has, array(
					'name' => $v,
					'has' => 0
				)
			);

		}

		// Determine if user_id is valid
		global $dbh;

		$c = Core::fetch_column(
			'SELECT count(*) FROM ' . CORE_DB . '.users WHERE user_id = :user_id',
			array(
				':user_id' => $options['user_id']
			)
		);

		if($c == 0) { // No user found with this user_id. Return result
			
			return array(
				'valid' => 0,
				'has' => $has,
				'has_all' => 0
			);

		}

		$has_all = 1;
		$has = array();

		foreach($options['has'] as $k => $v) {

			if(!is_array($v)) { // Just test to see if there is a user_info entry for this user with the info_type set to this value

				$use_values = array(
					'info_type' => $v
				);

			} else { // Test for an array of values

				$use_values = $v;

			}

			$has_property = self::has_property(array(
					'user_id' => $options['user_id'],
					'values' => $use_values
				)
			);

			$has_property = (isset($has_property['has']) && $has_property['has'] == 1) ? 1 : 0;

			array_push($has, array(
					'name' => $v,
					'has' => $has_property
				)
			);

			if($has_property == 0) { // Since user does not have this property, the cannot have all properties being tested for

				$has_all = 0;

			}

		}

		return array(
			'valid' => 1,
			'has' => $has,
			'has_all' => $has_all
		);

	}

	/*
	Get user entry information
	*/
	function get_user($options = array()) {

		/*
		arguments:
		{
			user_id: the user to retreive information for,
			get_has: 1 = get properties that this user has, 0 = do not get properties that this user has,
			exclude_emails: emails to exclude for ranking. Defaults to $this->exclude_emails. 0 = do not filter out e-mail domains
			fields: an array of which fields to retrieve
			{
				user_id,
				first_name,
				last_name,
				..
				..
			}
		}

		Returns:
			if successful:
			{
				user_id: the id of the user
				first_name: user's first name
				last_name: user's last name
				display_name: user's name to display on the leader board
				company: user's company,
				country: user's country,
				city: user's city,
				state: user's state,
				zip: user's zip,
				locale: user's default locale,
				email: user's e-mail address,
				password: user's password (provided in plain text. We encrypt it here),
				int_other: an int peice of information,
				other: a varchar peice of information,
				other_b: a varchar peice of information
				user_group: the user's group
				users_info: an optional array of users info
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
				'get_has' => 1,
				'fields' => 'default',
				'exclude_emails' => $this->exclude_emails,
				'rank_type' => 'same' // If set to any, all user groups are counted in rank. If set to "same", then only users in the same group are counted
			)
		, $options);
		
		if(!is_numeric($options['user_id']) || $options['user_id'] < 0) { // Invalid user information

			Core::error($this->errors, 1);

		}

		if($options['fields'] == 'default') { // Set the fields value to default

			$options['fields'] = array(
				'user_id',
				'first_name',
				'last_name',
				'display_name',
				'company',
				'title',
				'country',
				'city',
				'state',
				'zip',
				'locale',
				'email',
				'phone',
				'int_other',
				'points',
				'other',
				'other_b',
				'user_group',
				'rank'
			);

		}

		// Try to retrieve user information
		global $dbh;

		$filters = array();
		$params = array();

		// Replace "rank" with the actual query for rank (makes life easier for coding)
		$rank_k = array_search('rank', $options['fields']);

		if($rank_k !== FALSE) { // the rank field was found in the fields list. Update it with the actual sub-query value

			if(is_array($options['exclude_emails']) && count($options['exclude_emails']) > 0) {

			if($options['exclude_emails'] == 'get') {

					$options['exclude_emails'] = $this->exclude_emails;

				}

				foreach($options['exclude_emails'] as $k => $email) {

					array_push($filters, "a.email NOT LIKE :email_exclude" . $k);
					$params[":email_exclude" . $k] = '%' . $email . '%';

				}

			}

			$filter_sql = (count($filters) > 0) ? ' AND ' . implode(' AND ', $filters) : '';

			$options['fields'][$rank_k] = '(SELECT count(DISTINCT points) FROM ' . CORE_DB . '.users AS a WHERE ' . CORE_DB . '.users.points < a.points AND ' . CORE_DB . '.users.user_group = a.user_group' . $filter_sql;

			if($options['rank_type'] != 'all') {

				$options['fields'][$rank_k] .= ' AND ' . CORE_DB . '.users.other = a.other';

			}

			$options['fields'][$rank_k] .= ') AS rank';

		}

		$params[':user_id'] = $options['user_id'];

		$sql = 'SELECT
			' . implode(',', $options['fields']) . '
			FROM ' . CORE_DB . '.users
			WHERE user_id = :user_id';
		
		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		$user_info = $sth->fetch();

		if(!is_array($user_info)) { // Invalid user information

			return Core::error($this->errors, 1);

		}

		if($options['get_has'] == 1) {

			// Retrieve user info
			$has = array();

			$sql = 'SELECT
			users_info_id,
			badge_id,
			rank,
			(SELECT badge_name FROM ' . CORE_DB . '.badges WHERE ' . CORE_DB . '.badges.badge_id = ' . CORE_DB . '.users_info.badge_id LIMIT 0, 1) AS badge_name,
			info_type,
			int_info,
			info,
			info_b,
			time
			FROM ' . CORE_DB . '.users_info
			WHERE user_id = :user_id
			ORDER BY rank DESC';

			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':user_id' => $options['user_id']
				)
			);

			$user_info['badge_qty'] = 0;
			$has_rank = false;

			while($row = $sth->fetch()) {

				array_push($has, Core::remove_numeric_keys($row));

				if($row['badge_id'] > 0 && $row['rank'] == 0) {

					++$user_info['badge_qty'];

				} else if($row['rank'] > 0) {

					$has_rank = true;

				}

			}

			$user_info['has'] = $has;

			if($has_rank) {

				$user_info['level'] = $user_info['has'][0]['badge_name'];
				$user_info['level_min_points'] = Core::fetch_column(
					"SELECT points FROM " . CORE_DB . ".badges_info WHERE badge_id = :badge_id AND info_type = 'min_points'",
					array(
						':badge_id' => $user_info['has'][0]['badge_id']
					)
				);


			} else {

				$user_info['level'] = Core::fetch_column(
					"SELECT badge_name FROM " . CORE_DB . ".badges WHERE rank > 0 AND active = 1 ORDER BY rank ASC LIMIT 0, 1",
					array()		
				);
				$user_info['level_min_points'] = 0;

			}

		}

		if(isset($user_info['rank'])) {

			++$user_info['rank'];

		}

		$user_info['user_group_display'] = (isset($user_info['user_group'])) ? $user_info['user_group'] : '';
		
		if(isset($user_info['user_group'])) {

			switch($user_info['user_group']) {

				case 'is':
					$user_info['user_group_display'] = 'Arrow Inside Sales';
					break;
				case 'ps':
					$user_info['user_group_display'] = 'Partner Sales';
					break;
				case 'pm':
					$user_info['user_group_display'] = 'Partner Marketing';
					break;
				case 'bss':
					$user_info['user_group_display'] = 'Arrow BSS';
					break;

			}

		}
		
		return Core::remove_numeric_keys($user_info);

	}

	/*
	Retrieve a list of users in order by points
	*/
	function get_users($options = array()) {

		/*
		arguments:
			start: which record # to start from
			records: how many records to retrieve
			sort: how to order (defult = 'points desc'). Can also use multiple sorts such as "display_name asc, company desc, points asc"
			fields: which fields to retrieve for each user (by default, set to "default" which causes the default values from $this->get_user to be used),
			exclude_emails: email domains to exclude. Defaults to $this->exclude_emails. Setting to 0 means e-mail domains is not filtered
			filters: an array of filters to apply (optional, and so is each entry)
			{
				company: the company for this user
				name: the name of this user (applied to first name, last name, and display name)
				email: the e-mail address for this user,
				badges: { an array of badges that this user has by badge id (optional, and so is each entry)
					1,
					3,
					..
					..
				},
				action_types: { an array of actions that this user has by action_types_id (optional, and so is each entry)
					{ // Can be passed as an array like this (this is the proper form)
						action_types_id: the action type id
						qty: how many times this action needs to happen
					},
					action_types_id: just the action_types_id can be passed as well and it will be converted to the "proper" form
					..
					..
				}
			}
		returns:
			Returns:
			if successful:
			{
				user, (retrieved from $this->get_user())
				user,
				user,
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
				'start' => 0,
				'records' => 4,
				'sort' => 'points desc',
				'fields' => 'default',
				'filters' => array(),
				'exclude_emails' => $this->exclude_emails
			)
		, $options);

		// Retrieve users
		$users = array();

		global $dbh;

		// pendo Validate filters
		$filters = array();
		$params = array();

		if(count($options['filters']) > 0) { // There are filters. Convert them to sql

			if(isset($options['filters']['name'])) { // Filter by name

				array_push($filters, "((first_name LIKE :first_name) OR (last_name LIKE :last_name) OR (display_name LIKE :display_name)) OR (company LIKE :company) OR (email LIKE :email)");
				$params[':first_name'] = '%' . $options['filters']['name'] . '%';
				$params[':last_name'] = '%' . $options['filters']['name'] . '%';
				$params[':display_name'] = '%' . $options['filters']['name'] . '%';
				$params[':company'] = '%' . $options['filters']['name'] . '%';
				$params[':email'] = '%' . $options['filters']['name'] . '%';

			}

			if(isset($options['filters']['email'])) { // Filter by e-mail

				array_push($filters, "email LIKE '%:email'");
				$params[':email'] = $options['filters']['email'];

			}

			if(isset($options['filters']['other'])) { // Filter by e-mail

				array_push($filters, "other = :other");
				$params[':other'] = $options['filters']['other'];

			}

			if(isset($options['filters']['user_group'])) { // Filter by e-mail

				array_push($filters, "user_group = :user_group");
				$params[':user_group'] = $options['filters']['user_group'];

			}

			if(isset($options['filters']['badges']) && count($options['filters']['badges']) > 0) { // Filter by badge(s)

				foreach($options['filters']['badges'] as $k => $badge_id) {

					array_push($filters, "(SELECT
						count(*)
						FROM " . CORE_DB . ".users_info
						WHERE
						" . CORE_DB . ".users_info.user_id = " . CORE_DB . ".users.user_id
						AND " . CORE_DB . ".users_info.badge_id = :badge_id" . $k . "
						) > 0
					");

					$params[':badge_id' . $k] = $badge_id;

				}

			}

			if(isset($options['filters']['action_types']) && count($options['filters']['action_types']) > 0) { // Filter by action(s)

				foreach($options['filters']['action_types'] as $k => $action_type) {

					if(!is_array($action_type)) { // This is just the action_types_id. Convert it to the proper array format

						$action_type = array(
							'action_types_id' => $action_type,
							'qty' => 1
						);

					}

					if(!is_numeric($action_type['qty'])) { // Ensure that the action_type qty is numeric

						$action_type['qty'] = 1;

					}

					array_push($filters, "(SELECT
						count(*)
						FROM " . CORE_DB . ".actions_log
						WHERE
						" . CORE_DB . ".actions_log.user_id = " . CORE_DB . ".users.user_id
						AND " . CORE_DB . ".actions_log.action_types_id = :action_types_id" . $k . "
						) >= :action_types_qty" . $k . "
					");

					$params[':action_types_id' . $k] = $action_type['action_types_id'];
					$params[':action_types_qty' . $k] = $action_type['qty'];

				}

			}

		}

		if(is_array($options['exclude_emails'])) {

			if($options['exclude_emails'] == 'get') {

				$options['exclude_emails'] = $this->exclude_emails;

			}

			foreach($options['exclude_emails'] as $k => $email) {

				array_push($filters, "email NOT LIKE :email_exclude" . $k);
				$params[":email_exclude" . $k] = '%' . $email . '%';

			}

		}

		// Convert the filters array to a filters string if necessary
		$sql_filter = '';

		if(count($filters) > 0) { // There are filters

			$sql_filter = ' WHERE ' . implode(' AND ', $filters);

		}

		$sql = 'SELECT user_id FROM ' . CORE_DB . '.users' . $sql_filter . ' ORDER BY ' . $options['sort'] . ' LIMIT ' . (int)$options['start'] . ', ' . (int)$options['records'];
		
		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		while($row = $sth->fetch()) {

			array_push($users, $this->get_user(array(
						'user_id' => $row['user_id'],
						'fields' => $options['fields']
					)
				)
			);

		}

		// Determine total # of records
		$sql = 'SELECT count(*) FROM ' . CORE_DB . '.users' . $sql_filter;
		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		$row = $sth->fetch();

		$result['records'] = $row['count(*)'];
		$result['users'] = $users;

		return array(
			'records' => $row['count(*)'],
			'users' => $users
		);

	}

	/*
	Determine if a user has a property. For example, if we want to see if a user has a badge, we would use this.
	This works by looking for a row in the user info table
	*/
	function has_property($options) {

		/*
		arguments:
			user_id: the user to test for
			values: { an array of values to look for in the users_info table. Each entry is optional, but overall cannot be an empty array
				info_type
				int_info
				info
				info_b
				time
			}

		Returns:
			if successful:
			{
				has: 1 = has property, 0 = does not have property
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
				'values' => array()
			)
		, $options);

		if(!is_numeric($options['user_id']) || $options['user_id'] < 0) { // Invalid user id

			return Core::error($this->errors, 1);

		}

		if(!is_array($options['values']) || count($options['values']) == 0) { // Invalid filters specified

			return Core::error($this->errors, 11);

		}

		$options['values']['user_id'] = $options['user_id'];

		$result = Core::db_count(array(
				'table' => '' . CORE_DB . '.users_info',
				'values' => $options['values']
			)
		);

		if(!is_numeric($result)) {

			return Core::error($this->errors, 12);

		}

		// Return wether the user has this property or not
		return array(
			'has' => ($result == 0) ? 0 : 1
		);

	}

	/*
	Create a user info entry
	*/
	function create_user_info($options = array()) {

		/*
		arguments:
		{
			user_id
			badge_id
			rank
			info_type
			int_info
			info
			info_b
			time
		}

		Returns:
			if successful:
			{
				users_info_id: the id of the newly created user_info row
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
				'badge_id' => -1,
				'rank' => 0,
				'info_type' => '',
				'int_info' => 0,
				'info' => '',
				'info_b' => '',
				'time' => Core::date_string()
			)
		, $options);
		
		if(!is_numeric($options['user_id'])) { // Invalid user_id

			return Core::error($this->errors, 1);

		}

		// Determine if the user id is valid
		global $dbh, $gamo;

		$validate = Core::r('users_info_validate')->run($options);

		if(Core::has_error($validate)) {

			return $validate;

		}

		$options = $validate['options'];

		// Ensure that an identical record doesn't already exist
		$c = Core::db_count(array(
				'table' => '' . CORE_DB . '.users_info',
				'values' => array(
					'user_id' => $options['user_id'],
					'badge_id' => $options['badge_id'],
					'info_type' => $options['info_type'],
					'int_info' => $options['int_info'],
					'info' => $options['info'],
					'info_b' => $options['info_b']
				)
			)
		, $options);

		if($c > 0) { // An identical entry already exists

			return Core::error($this->errors, 13);

		}

		// Create record
		$result = Core::db_insert(array(
				'table' => '' . CORE_DB . '.users_info',
				'values' => array(
					'user_id' => $options['user_id'],
					'badge_id' => $options['badge_id'],
					'rank' => $options['rank'],
					'info_type' => $options['info_type'],
					'int_info' => $options['int_info'],
					'info' => $options['info'],
					'info_b' => $options['info_b'],
					'time' => $options['time']
				)
			)
		);

		if(!is_numeric($result)) { // Could not create record

			return Core::error($this->errors, 5);

		}

		return array(
			'users_info_id' => $result
		);

	}

	/*
	Create a user group
	A user a group would be something such as "admin", "location_manager", "sales_rep", and so forth.
	To assign a user to a user group, we would create a users_info entry with info_type set to "access_type"
	and info being set to user_group_[user_group_id] (for example, user_group_39)
	*/
	function create_user_group($options = array()) {

		/*
		args:
		{
			group_name: the name of the group
		}

		returns:
			if success:
			{
				user_groups_id
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

	}

	/*
	Update a user info entry
	*/
	function update_user_info($options = array()) {

		/*
		arguments:
		{	
			users_info_id
			values: { array of values to update
				info_type (optional)
				int_info (optional)
				info (optional)
				info_b (optional)
				time (optional)
			}
		}

		If options[values] is set to "delete", the entry will be deleted

		Returns:
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
			'users_info_id' => -1,
			'values' => array()
		)
		, $options);

		if(!is_numeric($options['users_info_id'])) { // Invalid user info

			Core::error($this->errors, 1);

		}

		// pendo Validate input

		if(is_array($options['values'])) { // Update user info

			$result = Core::db_update(array(
					'table' => '' . CORE_DB . '.users_info',
					'values' => $options['values'],
					'where' => array(
						'users_info_id' => $options['users_info_id']
					)
				)
			);

		} else if($options['values'] != "delete") {

			global $dbh;

			$sql = 'DELETE FROM users_info WHERE users_info_id = :users_info_id';
			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':users_info_id' => $options['users_info_id']
				)
			);

		} else { // Invalid value for options[values]

			return Core::error($this->errors, 6);

		}

		if($result !== 1) { // Update was not succesful

			return Core::error($this->errors, 7);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Update user info
	*/
	function update_user($options = array()) {

		/*
		arguments:
		{
			user_id: the user for whevents. By eventsich to udpate information
			values: { // An array of values to update. e-mail, password, and locale CANNOT be updated through here.
			             They have their own methods for updating
				first_name: user's first name
				last_name: user's last name
				display_name: user's name to display on the leader board
				company: user's company,
				title: the title of the user,
				country: user's country,
				city: user's city,
				state: user's state,
				zip: user's zip,
				int_other: an int peice of information,
				other: a varchar peice of information,
				other_b: a varchar peice of information,
				group: what group this user belongs to
			}
		}
		
		Runs checks to ensure that input is valid. Remember to ensure that e-mail, password, nor locale are NOT updated through here
		
		Returns:
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
				'user_id' => array(),
				'values' => array()
			)
		, $options);

		// Pendo validate input (no crazy values, fields being updated are actually allowed to be updated, etc)

		if(!is_numeric($options['user_id'])) { // Invalid user_id

			return Core::error($this->errors, 1);

		}

		// Determine that user_id is valid
		$c = Core::fetch_column(
			'SELECT count(*) FROM ' . CORE_DB . '.users WHERE user_id = :user_id',
			array(
				':user_id' => $options['user_id']
			)
		);

		if($c == 0) { // non-existent user_id

			return Core::error($this->errors, 1);

		}

		if(isset($options['values']['password'])) {

			$options['values']['password'] = hash('sha256', $options['values']['password']);

		}

		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.users',
				'values' => $options['values'],
				'where' => array(
					'user_id' => $options['user_id']
				)
			)
		);

		if($result !== 1) { // Could not update user

			return Core::error($this->errors, 7);

		}

		// User was updated
		return array(
			'valid' => 1
		);

	}

	/*
	Update a user's password
	*/
	function update_password($options = array()) {

		/*
		arguments:
		{
			user_id: the user to update the password for
			password: the new password (plain-text)
		}

		Encrypts the password as well

		return
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
			'user_id' => -1,
			'password' => ''
		)
		, $options);

		// pendo Validate input

		if( !is_numeric($options['user_id']) ) { // Invalid user id

			return Core::error($this->errors, 1);

		}

		if( trim($options['password']) == '' ) { // No password was given

			return Core::error($this->errors, 8);

		}
		
		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.users',
				'values' => array(
					'password' => hash('sha256', $options['password'])
				),
				'where' => array(
					'user_id' => $options['user_id']
				)
			)
		);

		if($result !== 1) {

			return Core::error($this->errors, 9);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Update a user's e-mail
	*/
	function update_email($options) {

		/*
		arguments:
		{
			user_id: the user to update the password forcheckcheck
			e-mail: the new e-mail
		}

		Ensure that the e-mail is unique and valid

		return
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
			'user_id' => -1,
			'password' => ''
		)
		, $options);

		if( !is_numeric($options['user_id']) ) { // Invalid user id

			return Core::error($this->errors, 1);

		}
		
		// Validate e-mail
		$email_valid = $this->validate_email(array(
				'user_id' => $options['user_id'],
				'email' => $options['email']
			)
		);

		if(Core::has_error($email_valid)) {

			return $email_valid;

		}

		$result = Core::db_update(array(
				'table' => '' . CORE_DB . '.users',
				'values' => array(
					'email' => $options['email']
				),
				'where' => array(
					'user_id' => $options['user_id']
				)
			)
		);

		if($result !== 1) {

			return Core::error($this->errors, 10);

		}

		return array(
			'valid' => 1
		);


	}

}
?>
