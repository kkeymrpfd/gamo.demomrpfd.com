<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Submit_Action {

	function run() {

		Core::authorize(array(
				'user_id' => 'get',
				'levels' => 'admin'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		$page_settings['allow_json'] = 1;

		$user_id = Core::get_input('user_id');
		$action_types_id = Core::get_input('action_types_id');

		$data = Core::r('actions')->create_action(array(
				'user_id' => $user_id,
				'action_types_id' => $action_types_id
			)
		);

		return $data;

	}

}
?>