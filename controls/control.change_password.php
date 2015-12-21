<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Change_Password {

	function run() {
		
		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;
		
		$current_password = Core::get_input('current_password', 'POST');
		$password = Core::get_input('password');
		$password2 = Core::get_input('password2');

		// Ensure that the current password is correct
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.users',
				'values' => array(
					'user_id' => $session->get('user_id'),
					'password' => hash('sha256', $current_password)
				)
			)
		);

		if($c == 0) {

			$data['msg'] = "The current password you entered is incorrect.<br><br>Please try again.";

		} else if(strlen($password) == '' || trim($password) == '') {

			$data['msg'] = "Your password must be at least 4 characters long";

		} else if($password != $password2) {

			$data['msg'] = "Please make sure that your password matches in both fields";

		} else {

			$result = Core::r('users')->update_password(array(
					'user_id' => $session->get('user_id'),
					'password' => $password
				)
			);

			if(Core::has_error($result)) {

				$data['msg'] = $result['error_msg'];

			} else {

				$data['msg'] = 1;

			}

		}

		return $data;

	}

}
?>
