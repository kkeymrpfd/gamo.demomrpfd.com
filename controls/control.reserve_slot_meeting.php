<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Reserve_Slot_Meeting {

	function run($options = array()) {

		global $data, $page_settings, $models, $session, $gamo;

		Core::ensure_defaults(array(
				'pin' => Core::get_input('pin', 'get'),
				'slot_id' => Core::get_input('slot_id', 'get')
			)
		, $options);

		// Determine if slot is valid
		$slot = Core::r('slots')->get_slots(array(
				'slot_id' => $options['slot_id']
			)
		);

		if(Core::has_error($slot)) {

			echo 'Invalid slot selected';
			die();

		}

		if($slot['slots'][0]['remaining_qty'] == 0) {

			echo 'This meeting slot has been fulled booked. Please try another one. We apologize for any inconvenience.';
			die();

		}
		
		$user_id = Core::r('users')->add_pin_user(array(
				'pin' => $options['pin'],
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

		}

		$user_id = $user_id['user_id'];

		// Determine if slot is valid
		$slot = Core::r('slots')->get_slots(array(
				'slot_id' => $options['slot_id']
			)
		);

		if(Core::has_error($slot)) {

			echo 'Invalid slot selected';
			die();

		}

		if($slot['slots'][0]['remaining_qty'] == 0) {

			echo 'This meeting slot has been fulled booked. Please try another one. We apologize for any inconvenience.';
			die();

		}
		
		$reserve = Core::r('slots')->unreserve_user_group(array(
				'user_id' => $user_id,
				'group' => 'inperson'
			)
		);

		$reserve = Core::r('slots')->reserve_slot(array(
				'slot_id' => $options['slot_id'],
				'user_id' => $user_id
			)
		);
		
		echo 1;

		return $data;

	}

}
?>
