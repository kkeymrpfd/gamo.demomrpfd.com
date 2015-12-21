<?
// Class to manage users
//@depend core/core.php
//@depend core/class.Session.php
//@depend core/class.Validate.php
require_once(DIR_INC . '/lib/class.Gamo_Validate.php');

class User extends Gamo_Validate {

	function check_username($options) { // Check that the display name is valid

		/*
		$options:
			username: The display name to be tested
		*/

		$options = Core::ensure_defaults(Array(
			'username' => '',
			'user_id' => Core::user_id()
		), $options);

		$this->reset_errors();

		if(trim($options['username']) == '') { // The username contains invalid characters

			$this->add_error_output(Array(
					'msg' => 'Please enter a display name',
					'id' => 'signup_username'
				)
			);

			return $this->get_result_output();

		}

		$result = $this->validate_characters(Array(
				'string' => &$options['username'],
				'allowed_string' => '_.'
			)
		);

		if($result['valid'] == 0) { // The username contains invalid characters

			$this->add_error_output(Array(
					'msg' => 'The display can only contain letters, numbers, spaces, and the _ and . symbols',
					'id' => 'signup_username'
				)
			);

			return $this->get_result_output();

		} else { // The username does not contain any invalid characters. Check the length

			$length = strlen($options['username']);

			 if($length < 4) {

				$this->add_error_output(Array(
						'msg' => 'The display is too short. It must be at least 4 characters long',
						'id' => 'signup_username'
					)
				);

			} else if($length > 24) {

				$this->add_error_output(Array(
						'msg' => 'The display name is too long. It must be less than 25 characters long',
						'id' => 'signup_username'
					)
				);

			}

			$result = $this->get_result_output();

			if($result['valid'] == 0) {

				return $result;

			}

		}

		global $dbh;

		// Determine if the display name is unique
		$sql = "SELECT count(*) FROM general.users WHERE username = :username AND user_id != :user_id"; 
		$sth = $dbh->prepare($sql);
		$sth->execute(Array(
				':username' => $options['username'],
				':user_id' => $options['user_id']
			)
		); 
		
		if($sth->fetchColumn() > 0) { // The username is not unique

			$this->add_error_output(Array(
					'msg' => 'That username is already in use. Please try a different one',
					'id' => 'signup_username'
				)
			);

			return $this->get_result_output();

		}

		return $result;

	}

	function check_email($options) { // Check that the e-mail is valid

		$options = Core::ensure_defaults(Array(
			'email' => $options['email'],
			'email2' => $options['email2'],
			'user_id' => Core::user_id()
		), $options);	

		$result = $this->validate_email( Array('email' => $options['email']) );
		$result2 = $this->validate_email( Array('email' => $options['email2']) );

		if($result['valid'] == 0 && $result2['valid'] == 0) { // Error detected with e-mail format

			$this->add_error_output(Array(
					'msg' => 'Please enter a valid e-mail address',
					'id' => 'signup_email'
				)
			);

			$this->add_error_output(Array(
					'msg' => '',
					'id' => 'signup_email2'
				)
			);

		} else if($options['email'] != $options['email2']) { // The two e-mail addresses are not valid

			$this->add_error_output(Array(
					'msg' => 'Please make sure that your e-mail address matches in both fields',
					'id' => 'signup_email'
				)
			);

			$this->add_error_output(Array(
					'msg' => 'Please make sure that your e-mail address matches in both fields',
					'id' => 'signup_email2'
				)
			);

		}

		global $dbh;

		// Determine if the e-mail is already in use
		$sql = "SELECT count(*) FROM general.users WHERE email = :email AND user_id != :user_id"; 
		$sth = $dbh->prepare($sql);
		$sth->execute(Array(
				':email' => Core::encrypt($options['email']),
				':user_id' => $options['user_id']
			)
		); 
		
		if($sth->fetchColumn() > 0) { // The username is not unique

			$this->add_error_output(Array(
					'msg' => 'That e-mail address is already in use. Please try a different one',
					'id' => 'signup_email'
				)
			);

			$this->add_error_output(Array(
					'msg' => '',
					'id' => 'signup_email2'
				)
			);

			return $this->get_result_output();

		}

		return $this->get_result_output();

	}

	function check_password($options) { // Ensure that the password is okay

		/*
		$options:
			password: // The password to check
			unallowed: // Strings that are not allowed in the password
		*/

		$this->reset_errors();

		$result = $this->validate_password(Array(
			'password' => &$options['password'],
			'unallowed' => &$options['unallowed']
		));

		if($result['valid'] == 0) { // There is something wrong with the password

			$this->add_error_output(Array(
					'msg' => $result['errors'][0],
					'id' => 'signup_password'
				)
			);

		}

		return $this->get_result_output();

	}

	function check_all($options) { // Check all fields

		$this->reset_errors_output();

		// Validate display name
		$result = $this->check_username(Array('username' => &$options['username']));

		// Validate the e-mail
		$result = $this->check_email(Array(
			'email' => &$options['email'],
			'email2' => &$options['email2'],
			'user_id' => $options['user_id']
		));

		// Validate password
		$result = $this->check_password(Array(
			'password' => &$options['password'],
			'unallowed' => Array(
				Array('name' => 'display name', 'value' => &$options['username']),
				Array('name' => 'e-mail address', 'value' => &$options['email']),
			)
		));

		return $this->get_result_output();

	}

	function create_user($options) { // Create a new user

		$options = Core::ensure_defaults(Array(
			'username' => '',
			'first_name' => '',
			'last_name' => '',
			'email' => '',
			'email2' => '',
			'dob' => '',
			'age_min' => 13
		), $options);

		$valid = $this->check_all($options);

		if($valid['valid'] == 0) { // User details are not valid. Return error.

			return $valid;

		}

		// Try creating user row
		$user_id = Core::db_insert(Array(
				'table' => 'general.users',
				'values' => Array(
					'username' => $options['username'],
					'first_name' => $options['first_name'],
					'last_name' => $options['last_name'],
					'email' => Core::encrypt($options['email']),
					'dob' => $options['dob'],
					'age_min' => $options['age_min']
				)
			)
		);

		if(!is_numeric($user_id)) { // User record could not be created

			return $this->modal_error('unknown');

		}

		Core::db_insert(Array(
				'table' => 'general.user_passwords',
				'values' => Array(
					'user_id' => $user_id,
					'password' => Core::encrypt($options['password']),
					'time' => date("Y-m-d h:i:s")
				)
			)
		);

		$this->reset_errors_output();

		return $this->get_result_output();

	}

	function check_credentials($options) { // Verify login credentials

		global $dbh;

		$options = Core::ensure_defaults(Array(
			'name' => $options['name'],
			'password' => $options['password']
		), $options);

		$this->reset_errors_output();

		$error = false;

		if(trim($options['name']) == '') { // The name is blank. This cannot be valid

			$error = true;

		} else if(trim($options['password']) == '') { // The password is blank. This cannot be valid

			$error = true;

		} else { // Check credentials

			// Determine if the username/email and password combination is valid
			$sql = "SELECT count(*), user_id, username FROM general.users WHERE
			(username = :username OR email = :email)
			AND (
				SELECT password
				FROM general.user_passwords
				WHERE general.user_passwords.user_id = general.users.user_id
				ORDER BY time DESC
				LIMIT 0, 1
				) = :password";
		
			$sth = $dbh->prepare($sql);
			$sth->execute(Array(
					':username' => $options['name'],
					':email' => Core::encrypt($options['name']),
					':password' => Core::encrypt($options['password']),
				)
			);

			$row = $sth->fetch();

			if($row['count(*)'] == 0) {

				$error = true;

			}

		}

		if($error) {

			$type = (strpos($options['name'], '@') === FALSE) ? 'username' : 'email';

			$this->add_error_output(Array(
					'msg' => 'The ' . $type . ' or password you entered is incorrect',
					'id' => 'login_result'
				)
			);

			$this->add_error_output(Array(
					'msg' => '',
					'id' => 'login_name'
				)
			);

			$this->add_error_output(Array(
					'msg' => '',
					'id' => 'login_password'
				)
			);

		} else {

			$this->add_data_output(Array(
				'user_id' => $row['user_id'],
				'username' => $row['username']
			));

		}

		return $this->get_result_output();

	}

	function login($options) {

		global $session;

		$options = Core::ensure_defaults(Array(
			'user_id' => '',
			'session_id' => $session->session_id(),
			'ip' => '127.0.0.1',
			'time' => date("Y-m-d h:i:s"),
			'persistent' => ''
		), $options);

		$this->reset_errors_output();


		// Ensure that the user_id is valid
		$sql = "SELECT count(*) FROM general.users WHERE user_id = :user_id";

		$user_qty = Core::fetch_column($sql, Array(':user_id' => $options['user_id']));

		if($user_qty == 0) { // No user was found with this user_id

			$this->add_error_output(Array(
					'msg' => 'There was an error. Please refresh the page and try again.',
					'id' => 'general_error'
				)
			);

		} else { // The user id is valid. Log the user in

			// Ensure that any other logins with this session id are inactive
			global $dbh;
			$sql = "UPDATE general.user_logins SET active = 0 WHERE session_id = :session_id";
			$sth = $dbh->prepare($sql);
			$sth->execute(Array(':session_id' => $options['session_id']));

			$insert_id = Core::db_insert(Array(
					'table' => 'general.user_logins',
					'values' => Array(
						'user_id' => $options['user_id'],
						'session_id' => $options['session_id'],
						'ip' => $options['ip'],
						'time' => $options['time'],
						'last_activity' => $options['time'],
						'active' => 1
					)
				)
			);

			if(!is_numeric($insert_id)) { // The login could not be saved properly

				$this->add_error_output(Array(
						'msg' => 'There was an error. Please refresh the page and try again.',
						'id' => 'general_error'
					)
				);

			}

		}

		return $this->get_result_output();

	}

}

$user = new User();
?>