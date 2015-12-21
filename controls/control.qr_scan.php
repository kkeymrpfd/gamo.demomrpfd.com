<?
// @depend core/class.Core.php
class Control_Qr_Scan {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$qr_code = trim(strtolower(Core::get_input('c', 'get')));

		$result = Core::r('qr')->check_code(array(
				'qr_code' => $qr_code
			)
		);

		if(Core::has_error($result)) {

			echo 'Invalid QR Code';

		} else {
			echo 'here';
			die();
			// Determine if breakout limits have been hit
			// Retrieve all breakout qr codes
			$sql = "SELECT qr_id, qr_name, qr_code FROM " . GAMO_DB . ".qr_codes WHERE qr_name LIKE 'breakout%'";
			$sth = $dbh->prepare($sql);
			$sth->execute();

			$breakout_qrs = array();
			$breakout_qr_ids = array();

			$is_breakout = 0;

			while($row = $sth->fetch()) {

				array_push($breakout_qrs, Core::remove_numeric_keys($row));
				array_push($breakout_qr_ids, $row['qr_id']);

				if($qr_code == $row['qr_code']) {

					$is_breakout = 1;

				}

			}

			$action_types_id = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));

			if($is_breakout) { // This is a breakout qr code
				
				$breakout_ids_list = "'" . implode("','", $breakout_ids) . "'";

				// Determine # of qr codes scanned in past hour, and today
				$hourly_c = Core::fetch_column(
					"SELECT
					count(*)
					FROM " . GAMO_DB . ".actions_log
					WHERE
					action_types_id = :action_types_id
					AND int_other IN (" . $breakout_ids_list . ")
					AND time >= :time",
					array(
						':action_types_id' => $action_types_id,
						':time' => Core::date_string(time() - 3600)
					)
				);

				if($hourly_c > 0) {

					// Hourly limit hit

				} else {



				}

			}

			Core::r('actions')->create_action(array(
					'user_id' => $data['user_id'],
					'action_types_id' => $action_types_id,
					'int_other' => $result['qr_id'],
				)
			);

			$session->set('qr_scanned', $qr_code);
			//header("Location: " . $result['url'] . '&qr_code=' . $qr_code);

		}

		return $data;

	}

}
?>
