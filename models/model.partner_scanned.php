<?
class Model_Partner_Scanned {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid set id'
			)
		);

	}

	function run($options = array()) {

		/*
		arguments:
		{
			user_id
		}

		returns:
			Returns:
			if successful:
			{
				user data
				has
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/
		global $gamo, $dbh, $session, $data;

		Core::ensure_defaults(array(
				'set_id' => -1,
				'user_id' => -1,
				'qr_code' => ''
			)
		, $options);

		global $gamo;
		
		$result['code_valid'] = 0;

		// Determine if this set_id is valid
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.qr_codes',
				'values' => array(
					'qr_code' => $options['qr_code'],
					'int_info' => $options['set_id']
				)
			)
		);

		if($c == 0) { // Invalid set id

			$return = Core::error($this->errors, 1);
			$return['code_valid'] = 0;

			return $return;

		}

		// set id is valid. Determine if user has already gotten points for scanning this qr code
		$action_type = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));

		$c = Core::db_count(array(
				'table' => GAMO_DB . '.actions_log',
				'values' => array(
					'user_id' => $options['user_id'],
					'action_types_id' => $action_type,
					'int_other' => $options['set_id']
				)
			)
		);

		$result = array();
		$result['new_scan'] = 0;

		if($c == 0) { // No points earned yet for this set id. Award points

			$result = Core::r('actions')->create_action(array(
					'user_id' => $options['user_id'],
					'action_types_id' => $action_type,
					'int_other' => $options['set_id']
				)
			);

			$result['new_scan'] = 1;

		}

		require_once(DIR_MODELS . "/model.quiz.php");
		$model = new Model_Quiz();
		$result['quiz'] = $model->run(array(
				'set_id' => $options['set_id'],
				'qr_code' => $options['qr_code'],
				'user_id' => $options['user_id']
			)
		);

		// Retrieve partner info
		$result['partner_name'] = Core::fetch_column(
			"SELECT category_name FROM " . GAMO_DB . ".categories WHERE category_id = :category_id",
			array(
				':category_id' => $options['set_id']
			)
		);

		$result['code_valid'] = 1;
		$result['points_earned'] = Core::fetch_column(
			"SELECT points FROM " . GAMO_DB . ".action_types WHERE action_types_id = :action_types_id",
			array(
				':action_types_id' => $action_type
			)
		);

		return $result;

	}

}

?>
