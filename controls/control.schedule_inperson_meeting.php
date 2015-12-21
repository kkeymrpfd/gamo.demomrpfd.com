<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Schedule_Inperson_Meeting {

	function run($options = array()) {

		global $data, $page_settings, $models, $session, $gamo;

		Core::authorize();

		Core::ensure_defaults(array(
				'slot_id' => Core::get_input('slot_id'),
				'topic' => Core::get_input('topic', 'post', 80)
			)
		, $options);

		$page_settings['allow_json'] = 1;

		if(Core::r('meeting')->meeting_scheduled(array('user_id' => $data['user_id'])) == 1) {

			$data['error'] = 'You have already scheduled a phone meeting';
			return $data;

		}

		if($options['topic'] == '') {

			$data['error'] = 'Please enter a topic for this meeting';
			return $data;

		}

		// Determine if slot is valid
		$slot = Core::r('slots')->get_slots(array(
				'slot_id' => $options['slot_id']
			)
		);

		$data['success'] = 0;
		$data['error'] = '';

		if(Core::has_error($slot)) {

			$data['error'] = 'Invalid slot selected';
			return $data;

		}

		if($slot['slots'][0]['remaining_qty'] == 0) {

			$data['error'] = 'This meeting slot has been fulled booked. Please try another one. We apologize for any inconvenience.';
			return $data;

		}
		

		// Determine if slot is valid
		$slot = Core::r('slots')->get_slots(array(
				'slot_id' => $options['slot_id']
			)
		);

		if($slot['slots'][0]['remaining_qty'] == 0) {

			$data['error'] = 'This meeting slot has been fulled booked. Please try another one. We apologize for any inconvenience.';
			return $data;

		}
		
		$reserve = Core::r('slots')->unreserve_user_group(array(
				'user_id' => $data['user_id'],
				'group' => 'inperson'
			)
		);

		$reserve = Core::r('slots')->reserve_slot(array(
				'slot_id' => $options['slot_id'],
				'user_id' => $data['user_id'],
				'topic' => $options['topic']
			)
		);
		
		$data['success'] = 1;

		return $data;

	}

}
?>
