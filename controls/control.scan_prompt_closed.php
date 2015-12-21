<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Scan_Prompt_Closed {

	function run() {

		global $data, $page_settings, $models, $session, $gamo;
			
		$data['user_id'] = $session->get('user_id');

		Core::authorize(array(
				'user_id' => $data['user_id']
			)
		);

		Core::r('users')->create_user_info(array(
				'user_id' => $data['user_id'],
				'info_type' => 'scan_prompt_closed',
				'int_info' => 1
			)
		);

		$data['scan_prompt_closed'] = 1;

		return $data;

	}

}
