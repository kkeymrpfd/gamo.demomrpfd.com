<?
// @depend core/class.Core.php
class Control_Qr {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		$qr_code = trim(strtolower(Core::get_input('c', 'get')));

		$qr = Core::r('qr')->check_code(array(
				'qr_code' => $qr_code
			)
		);

		if(Core::has_error($qr)) {

			echo 'Invalid QR Code';

		} else {

			if($qr['trigger_step'] == 'trivia') {

				if(!is_numeric($data['user_id']) || $data['user_id'] == -1) {

					Core::set_cookie(array(
							'key' => 'login_redirect',
							'value' => '/?a=qr&c=' . $qr_code
						)
					);

					header("Location: /?p=login");

				} else {

					$action_types_id = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));

					// Determine if breakout limits have been hit
					// Retrieve all breakout qr codes
					$sql = "SELECT qr_id, qr_name, qr_code,
					(
						SELECT
						count(*)
						FROM " . GAMO_DB . ".actions_log AS a
						WHERE a.action_types_id = :action_types_id
						AND a.int_other = " . GAMO_DB . ".qr_codes.qr_id
						AND a.user_id = :user_id
					) AS scanned
					FROM " . GAMO_DB . ".qr_codes WHERE qr_name LIKE 'breakout%'";
					$sth = $dbh->prepare($sql);
					$sth->execute(array(
							':action_types_id' => $action_types_id,
							':user_id' => $data['user_id']
						)
					);

					$breakout_qrs = array();
					$breakout_qr_ids = array();

					$qr_breakout_id = -1;

					while($row = $sth->fetch()) {

						array_push($breakout_qrs, Core::remove_numeric_keys($row));
						array_push($breakout_qr_ids, $row['qr_id']);

						if($qr_code == $row['qr_code']) {

							$qr_breakout_id = $row['qr_id'];

						}

					}

					$limits = array(
						'monday' => array(
							'hourly' => 1,
							'daily' => 3
						),
						'tuesday' => array(
							'hourly' => 1,
							'daily' => 3
						),
						'wednesday' => array(
							'hourly' => 1,
							'daily' => 5
						),
						'thursday' => array(
							'hourly' => 1,
							'daily' => 2
						),
						'friday' => array(
							'hourly' => 1,
							'daily' => 3
						),
						'saturday' => array(
							'hourly' => 1,
							'daily' => 3
						),
						'sunday' => array(
							'hourly' => 1,
							'daily' => 3
						)
					);

					$use_limit = $limits['monday'];
					
					if($qr_breakout_id != -1) { // This is a breakout qr code
						
						// Pick random qr code
						// Pick random qr code
						shuffle($breakout_qrs);

						$rand_qr_key = Core::multi_find($breakout_qrs, 'scanned', 0);

						if($rand_qr_key == -1) {

							header("Location: /?p=qr_breakout_limit&type=all_scanned");
							die();

						} else {

							$qr_breakout_id = $breakout_qrs[$rand_qr_key]['qr_id'];
							$qr_code = $breakout_qrs[$rand_qr_key]['qr_code'];
							$qr['qr_id'] = $qr_breakout_id;

						}
						
						$breakout_qr_ids_list = "'" . implode("','", $breakout_qr_ids) . "'";

						$daily_c = Core::fetch_column(
							"SELECT
							count(*)
							FROM " . GAMO_DB . ".actions_log
							WHERE
							action_types_id = :action_types_id
							AND int_other IN (" . $breakout_qr_ids_list . ")
							AND time >= :time
							AND user_id = :user_id",
							array(
								':action_types_id' => $action_types_id,
								':time' => date('Y-m-d'),
								':user_id' => $data['user_id']
							)
						);
						
						if($daily_c > $use_limit['daily']) {

							header("Location: /?p=qr_breakout_limit&type=daily");
							die();

						} else {

							// Determine # of qr codes scanned in past hour, and today
							$hourly_c = Core::fetch_column(
								"SELECT
								count(*)
								FROM " . GAMO_DB . ".actions_log
								WHERE
								action_types_id = :action_types_id
								AND int_other IN (" . $breakout_qr_ids_list . ")
								AND time >= :time
								AND user_id = :user_id",
								array(
									':action_types_id' => $action_types_id,
									':time' => Core::date_string(time() - 3600),
									':user_id' => $data['user_id']
								)
							);

							if($hourly_c > $use_limit['hourly']) {

								header("Location: /?p=qr_breakout_limit&type=hourly");
								die();

							}

						}

					}

					// Process scan
					$scan = Core::r('qr')->scan_code(array(
								'code' => $qr_code,
								'user_id' => $data['user_id']
							)
						);

					$quiz_id = Core::fetch_column(
						"SELECT quiz_id FROM " . GAMO_DB . ".quizzes_info WHERE info_type = 'qr_required' AND int_info = :int_info",
						array(
							':int_info' => $qr['qr_id']
						)
					);

					header("Location: /?p=qr_scanned&points=" . $scan['points'] . "&quiz_id=" . $quiz_id);

				}

			}

			$session->set('qr_scanned', $qr);
			//header("Location: " . $qr['url'] . '&qr_code=' . $qr_code);

		}

		return $data;

	}

}
?>
