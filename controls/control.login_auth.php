<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Login_Auth {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;

		$session->destroy();

		$params = array(
			':email' => substr(Core::get_input('email'), 0, 100),
			':password' => hash('sha256', substr(Core::get_input('password'), 0, 100))
		);

		$user_id = Core::fetch_column(
			"SELECT user_id FROM " . GAMO_DB . ".users WHERE email = :email AND password = :password",
			$params
		);
		
		$data['error_msg'] = '';
		$data['valid'] = 0;

		Core::log(array(
				'info_type' => 'login_attempt',
				'info_a' => $params[':password'],
				'info_b' => $session->session_id(),
				'info_c' => ($user_id === false) ? -1 : $user_id
			)
		);

		$try_qty = Core::fetch_column(
			"SELECT count(*) FROM " . GAMO_DB . ".log WHERE info_type = :info_type AND info_b = :info_b AND datetime > :datetime",
			array(
				':info_type' => 'login_attempt',
				':info_b' => $session->session_id(),
				':datetime' => date("Y-m-d", time()-3600)
			)
		);

		if($try_qty > 100) {

			$data['error_msg'] = "There have been too many login requests from this device. Please try again after 1 hour.";

		} else {

			if($user_id === false) {

				$data['valid'] = 0;

			} else {

				$user = Core::r('users')->get_user(array(
						'user_id' => $user_id
					)
				);

				$session->new_session_id();
								
				// The user id is valid. Log the user in
				$session->set('user_id', $user_id);

				// Set access levels
				foreach($user['has'] as $k => $info_entry) {

					if($info_entry['info_type'] == 'access_level') {

						$session->set('access_' . $info_entry['info'], 1);

					}

				}
					
				$session->set('role', $user['other']);
				
				Core::r('users')->log_login();

				$data['valid'] = 1;

				// Determine redirect page
				$c = Core::fetch_column(
					"SELECT count(*) FROM " . GAMO_DB . ".quizzes_info WHERE info_type = 'locked' AND int_info = '0' AND quiz_id IN (70,71,78,79)",
					array()
				);

				$data['redirect'] =  '/?p=whatsnew';

				$cookie_redirect = Core::get_cookie('login_redirect');

				if($cookie_redirect !== FALSE) {

					$data['redirect'] = $cookie_redirect;
					Core::set_cookie(array(
							'key' => 'login_redirect',
							'delete' => 1
						)
					);

				}

				if(Core::get_input('manual', 'get') == '9aks8s7aja87') {

					header("Location: " . $data['redirect']);
					die();

				}

			}

		}

		return $data;

	}

}
?>
