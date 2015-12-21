<?
/*
This class handles qr codes
*/
class Core_Qr {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid QR code specified'
			)
		);

	}

	function check_code($options = array()) {

		global $dbh;

		Core::ensure_defaults(array(
				'qr_code' => ''
			)
		, $options);

		$sql = "SELECT qr_id, qr_code, trigger_step, url, int_info, info_a, info_b FROM " . CORE_DB . ".qr_codes WHERE qr_code = :qr_code";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':qr_code' => $options['qr_code']
			)
		);

		$row = $sth->fetch();

		if(!is_numeric($row['qr_id'])) { // Invalid qr code

			return Core::error($this->errors, 1);

		}

		return Core::remove_numeric_keys($row);

	}

	function scan_code($options = array()) {

		global $gamo;

		Core::ensure_defaults(array(
				'code' => '',
				'qr_id' => -1,
				'user_id' => ''
			)
		, $options);

		if($options['qr_id'] == -1) {

			$options['qr_id'] = Core::fetch_column(
				"SELECT qr_id FROM " . CORE_DB . '.qr_codes WHERE qr_code = :qr_code',
				array(
					':qr_code' => $options['code']
				)
			);

		}

		$action_types_id = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));

		$point_value_used = Core::fetch_column(
			"SELECT
			point_value_used
			FROM " . CORE_DB . ".actions_log
			WHERE
			action_types_id = :action_types_id
			AND user_id = :user_id
			AND int_other = :int_other
			ORDER BY point_value_used DESC LIMIT 0, 1",
			array(
				':action_types_id' => $action_types_id,
				':user_id' => $options['user_id'],
				':int_other' => $options['qr_id']
			)
		);

		if(is_numeric($point_value_used)) {

			return array(
				'scanned' => 1,
				'points' => $point_value_used,
				'result' => array()
			);

		}

		$result = Core::r('actions')->create_action(array(
				'action_types_id' => $action_types_id,
				'user_id' => $options['user_id'],
				'int_other' => $options['qr_id'],
				'other' => $options['code']
			)
		);

		$result['scanned'] = 1;
		
		return $result;

	}

}
?>