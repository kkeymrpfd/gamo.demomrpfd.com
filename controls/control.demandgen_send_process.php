<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Demandgen_Send_Process {

	function run($options = array()) {

		Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
		global $data, $page_settings, $models, $session, $dbh, $gamo;

		$page_settings['allow_json'] = 1;

		Core::ensure_defaults(array(
				'email_template_id' => Core::get_input('email_template_id'),
				'list_type' => Core::get_input('list_type'),
				'subject' => Core::get_input('subject'),
				'redirect_url' => Core::get_input('redirect_url'),
				'logo' => Core::get_input('logo'),
				'manual' => Core::get_input('manual'),
				'list_recipients' => Core::get_input('list_recipients'),
				'user_id' => $data['user_id']
			)
		, $options);

		$result = Core::r('demandgen')->send($options);	

		Core::shift_data($result);

		return $data;

	}

}
?>
