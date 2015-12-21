<?
/*
This class contains the logic for testing for validating users info entries
Core::ensure_defaults() is not run in each validation method since $options is only passed to
a validatiom method from $this->run in which Core::ensure_defaults is already run on the $options to be passed
to the validation method
*/
class Core_Users_Info_Validate {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid user information specified'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid method specified'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Invalid user group specified for access level'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Invalid badge specified'
			)
		);

	}

	/*
	Executes the required validation method based on the parameters
	*/
	function run($options = array()) {

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
		
		if successful:
			{
				valid: 0 = valid, 1 = invalid
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

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

		// Determine if the user_id is valid
		$c = Core::db_count(array(
				'table' => CORE_DB . '.users',
				'values' => array(
					'user_id' => $options['user_id']
				)
			)
		);

		if($c == 0) { // Invalid user specified

			return Core::error($this->errors, 1);

		}

		$method = '';

		if($options['info_type'] == 'access_level') {

			$method = 'access_level';

		} else if($options['badge_id'] > -1) {

			$method = 'check_badge';

		}

		if($method != '') { // A validation method has been specified. Try to run it

			global $gamo;

			$method = 'validate_' . $method;
			
			if(!method_exists(Core::r('users_info_validate'), $method)) { // This is not a valid method

				return Core::error($this->errors, 2);

			}

			// Run method
			$passed = Core::r('users_info_validate')->$method($options);

			if(Core::has_error($passed)) { // There was an error while validating

				return $passed;

			}

		} else { // No method for validation. Set to passed.

			$passed = array(
				'passed' => 1,
				'options' => $options
			);

		}

		return array(
			'passed' => $passed['passed'],
			'options' => $passed['options']
		);

	}

	/*
	Validates for info_type = 'access_level'
	*/
	function validate_access_level($options = array()) {

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

		$c = Core::db_count(array(
				'table' => CORE_DB . '.user_groups',
				'values' => array(
					'user_groups_id' > $options['int_info']
				)
			)
		);

		if($c == 0) { // Invalid user group

			return Core::error($this->errors, 3);

		}

		return array(
			'passed' => 1,
			'options' => $options
		);

	}

	/*
	Validates for a badge entry
	*/
	function validate_check_badge($options = array()) {

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

		$badge_name = Core::fetch_column(
			"SELECT badge_name FROM " . CORE_DB . ".badges WHERE badge_id = :badge_id",
			array(
				':badge_id' => $options['badge_id']
			)
		);

		if($badge_name === FALSE) { // Invalid badge

			return Core::error($this->errors, 4);

		} else { // Set the info_type to the correct value based on the badge

			$options['info_type'] = 'ba__' . $badge_name;

		}

		return array(
			'passed' => 1,
			'options' => $options
		);

	}

}
?>
