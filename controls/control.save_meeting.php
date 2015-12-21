<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Save_Meeting {

	function run($options = array()) {
		
		Core::authorize(array(
                'user_id' => 'get'
            )
        );

        global $data, $page_settings, $models, $session, $gamo, $dbh;

        $page_settings['allow_json'] = 1;

		Core::ensure_defaults(array(
				'user_id' => $data['user_id'],
				'contact_name' => Core::get_input('meeting_name'),
                'title' => Core::get_input('meeting_title'),
                'company' => Core::get_input('meeting_company'),
                'phone' => Core::get_input('meeting_phone'),
                'email' => Core::get_input('meeting_email'),
                'date' => Core::get_input('meeting_date'),
                'meeting_id' => Core::get_input('meeting_id'),
                'status' => Core::get_input('meeting_status'),
                'amount' => Core::get_input('meeting_amount'),
                'notes' => Core::get_input('meeting_notes'),
                'action_id' => Core::get_input('action_id')
			)
		, $options);

		$result = Gamo::r('meeting')->create_meeting($options);

		Core::shift_data($result);

		if(!Core::has_error($result)) {

			$data['saved'] = 1;

		}

		return $data;

	}

}
?>
