<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Simulate_Action {

	function run() {

		Core::authorize(array(
				'user_id' => 'get',
				'levels' => 'admin'
			)
		);
		
		global $data, $page_settings, $gamo, $session;
		
		$page_settings['allow_json'] = 1;
		
		$user_id = Core::get_input('user_id', 'GET');
		$action_types_id = Core::get_input('action_types_id', 'GET');

		if(Core::get_input('login', 'GET') == 1) {

			header("Location: /?a=auth_user&user_id=" . $user_id);

		}

		$result = Core::r('actions')->create_action(array(
				'user_id' => $user_id,
				'action_types_id' => $action_types_id
			)
		);

		Core::shift_data($result);

		//$page_settings['pages'] = array('simulator');

		return $data;

	}

}
?>
