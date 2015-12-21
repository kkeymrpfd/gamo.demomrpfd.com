<?
/*
This class contains the logic for validating badges info entries.
Core::ensure_defaults() is not run in each validation method since $options is only passed to
a validatiom method from $this->run in which Core::ensure_defaults is already run on the $options to be passed
to the validation method
*/
class Gamo_Badges_Info_Validate {

	public $errors; // Store error codes
	public $req_types; // Requirement test types available

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid badge specified'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid validation method'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Invalid points specified'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Invalid quantity specified'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'Invalid action specified to link to'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'Badge requirement setting mismatch for badge info entry'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'Invalid info type specified while creating badge info'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'A matching badge info entry already exists'
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
			info_type: the type of requisite (for example: points)
			is_req: wether this is a badge info
			badge_id: the badge_id to use (if not specified, only a partial validation can occur)
			action_types_id: the action type that this req is tied to (if not specified, only a partial validation can occur)
			points: how many points are required
			int_info: some integer peice of information
			info: some varchar peice of information
			info_b: some varchar peice of information
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
				'info_type' => '',
				'badge_id' => -1,
				'is_req' => 0,
				'action_types_id' => -1,
				'points' => 0,
				'int_info' => '',
				'info' => '',
				'info_b' => '',
				'badge_id_check' => 1,
				'check_duplicate' => 1
			)
		, $options);

		if(trim($options['info_type']) == '') {

			return Core::error($this->errors, 7);

		}

		/*
		We need to check if this is a badge requirement. If it is, then it needs to be registered in Gamo_Badge_Reqs.
		If this info_type is registered in Gamo_Badge_Reqs but it is not a badge requirement, that is also an error.
		Test for those conditions
		*/

		// Determine if this info_type is registered in Gamo_Badge_Reqs.
		global $gamo;

		$badge_req_method = 'req_' . $options['info_type'];

		$is_registered_req = method_exists(Core::r('badge_req'), $badge_req_method);

		if($is_registered_req && $options['is_req'] == 0) { // This is registered as a requirement, but not set to be a requirement. Error.
			
			return Core::error($this->errors, 6);

		} else if(!$is_registered_req && $options['is_req'] > 0) { // This is NOT registered as a requirement, but is set to be a requirement. Error.

			return Core::error($this->errors, 6);

		}

		if($options['badge_id_check'] != 0) { // Check badge id

			$c = Core::db_count(array(
					'table' => '' . GAMO_DB . '.badges',
					'values' => array(
						'badge_id' => $options['badge_id']
					)
				)
			);
			
			if($c != 1) { // Badge is not valid

				return Core::error($this->errors, 1);

			}

		}

		if($options['check_duplicate'] != 0) { // Check for a badge info entry with the same information
			
			$c = Core::db_count(array(
					'table' => '' . GAMO_DB . '.badges_info',
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
			
			if($c > 0) { // A duplicate entry already exists

				return Core::error($this->errors, 8);

			}

		}


		$method = '';

		if($options['info_type'] == 'min_points') {

			$method = 'min_points';

		} else if($options['info_type'] == 'min_action_qty') {

			$method = 'min_action_qty';

		}

		if($method != '') { // A validation method has been specified. Try to run it

			$method = 'validate_' . $method;
			
			if(!method_exists(Core::r('badges_info_validate'), $method)) { // This is not a valid method

				return Core::error($this->errors, 2);

			}

			// Run method
			$passed = Core::r('badges_info_validate')->$method($options);

			if(Core::has_error($passed)) { // There was an error while validating

				return $passed;

			}

		} else { // No method for validation. Set to passed.

			$passed = array(
				'passed' => 1
			);

		}

		return array(
			'passed' => $passed['passed'],
			'options' => $passed['options']
		);

	}

	/*
	Validates for info_type = 'trigger_action'
	*/
	function validate_min_action_qty($options = array()) {

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

		// Determine if the category is valid
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.action_types',
				'values' => array(
					'action_types_id' => $options['action_types_id']
				)
			)
		);

		if($c == 0) { // Invalid action type specified

			return Core::error($this->errors, 5);

		}
		Core::print_r($options);
		if( !is_numeric( $options['int_info'] ) || !is_int( $options['int_info']*1 ) ) { // Invalid quantity specified

			return Core::error($this->errors, 4);

		}

		return array(
			'passed' => 1,
			'options' => $options
		);

	}

	/*
	Validates for info_type = 'max_qty'
	*/
	function validate_min_points($options = array()) {

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

		if( !is_numeric( $options['points'] ) || !is_int( $options['points']*1 ) ) {

			return Core::error($this->errors, 3);
			
		}

		return array(
			'passed' => 1,
			'options' => $options
		);

	}

}
?>
