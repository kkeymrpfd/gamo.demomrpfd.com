<?
class Model_Profile_Landing {

	function run($options = array()) {

		global $gamo, $dbh, $data, $session;

		$pin = Core::get_input('pin', 'get');

		$type1 = Core::r('actions')->action_types_id('schedule_meeting');
		$type2 = Core::r('actions')->action_types_id('reserve_slot_meeting');

		if($pin != '') {

			$session->destroy();

			$user_id = Core::r('users')->add_pin_user(array(
					'pin' => $pin,
					'source' => Core::get_input('source', 'get')
				)
			);

			if(Core::has_error($user_id)) {

				if($user_id['error_code'] == 17) {

					echo "Invalid source specified";
					die();

				}
				
				echo 'Invalid pin specified';
				die();

			} else {

				// Determine if user should get points for scheduling a meeting
				if(Core::get_input('meeting', 'get') == 1) {
					
					$c = Core::fetch_column(
						"SELECT count(*) FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id IN (" . $type1 . ", " . $type2 . ")",
						array(
							':user_id' => $user_id['user_id']
						)
					);

					if($c == 0) {
						
						$result = Core::r('actions')->create_action(array(
								'user_id' => $user_id['user_id'],
								'action_types_id' => 'schedule_meeting'
							)
						);

					}

				}

				Core::r('users')->login(array(
						'user_id' => $user_id['user_id']
					)
				);

				header("Location: /?p=profile_landing");
				die();

			}

		} else {

			$user_id['user_id'] = $data['user_id'];
			Core::authorize();

		}

		if(isset($user_id['user_id'])) {

			$data['user_id'] = $user_id['user_id'];

		}

		$data['user'] = Core::r('users')->get_user(array(
				'user_id' => $data['user_id']
			)
		);

		// Check for phone meeting
		$data['meeting_data'] = 0;

		$c = Core::db_count(array(
				'table' => GAMO_DB . ".actions_log",
				'values' => array(
					'user_id' => $user_id['user_id'],
					'action_types_id' => $type1
				)
			)
		);

		if($c > 0) { // Phone meeting scheduled

			$data['meeting_data'] = array(
				'type' => 'phone'
			);

		} else { // Check for in person meeting

			$slot_id = Core::fetch_column(
				"SELECT int_other FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id = :action_types_id",
				array(
					':user_id' => $user_id['user_id'],
					':action_types_id' => $type2
				)
			);				

			if(is_numeric($slot_id)) { // In-person meeting scheduled

				$slot = Core::r('slots')->get_slots(array(
						'slot_id' => $slot_id
					)
				);

				if(!Core::has_error($slot) && isset($slot['slots'][0]['display_time_range'])) {

					$data['meeting_data'] = array(
						'type' => 'inperson',
						'display_time_range' => $slot['slots'][0]['display_time_range']
					);

				}

			}

		}

		// Determine if user should get points for scheduling a meeting
		if(Core::get_input('meeting', 'get') == 1) {
			
			$c = Core::fetch_column(
				"SELECT count(*) FROM " . GAMO_DB . ".actions_log WHERE user_id = :user_id AND action_types_id IN (" . $type1 . ", " . $type2 . ")",
				array(
					':user_id' => $data['user_id']
				)
			);

			if($c == 0) {
				
				$result = Core::r('actions')->create_action(array(
						'user_id' => $data['user_id'],
						'action_types_id' => 'schedule_meeting'
					)
				);

			}

		}

		$data['user'] = Core::r('users')->get_user(array(
				'user_id' => $data['user_id']
			)
		);

		if($data['user']['points'] > 50) {

			$data['user']['points'] = 150;

		}

		return $data;

	}

}