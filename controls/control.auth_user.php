<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Auth_User {

	function run() {

		global $data, $page_settings, $models, $session;

		$session->destroy();
		$session = new Session();
		
		$hash = Core::get_input('hash', 'get');
		
		$error_msg = 'Invalid credentials. Please refresh the page and try again. If this error persists, please contact an administrator.';

		if(strlen($hash) < 0) { // The hash key is not valid. Error

			$data['valid'] = 0;
			$session->set('user_id', -1);
			echo $error_msg;
			die();

		} else {

			// pendo Run decryption here
			$decrypted = array(
				'user_id' => Core::get_input('user_id', 'get'),
				'time' => time()
			);

			if(!is_array($decrypted)
				|| !isset($decrypted['user_id'])
				|| !is_numeric($decrypted['user_id'])
				|| !isset($decrypted['time'])
				|| !is_numeric($decrypted['time'])) { // The decrypted value was not valid. Error

				$data['valid'] = 0;
				$session->set('user_id', -1);
				echo $error_msg;
				die();

			} else { // The decrypted value has the potential to be valid. Test it

				// We only want to accept hashed values generated from 60 seconds ago or newer.
				$cutoff_time = time() - 60; // The maximum time ago from which we will accept a hashed value

				if($cutoff_time > $decrypted['time']) { // This time is too old. Error

					$data['valid'] = 0;
					$session->set('user_id', -1);
					echo $error_msg;
					die();

				} else { // The time is valid. Check that the user id is valid

					global $gamo;
					$user = Core::r('users')->get_user(array(
							'user_id' => $decrypted['user_id']
						)
					);

					if(!isset($user['has'])) { // Invalid user id

						$data['valid'] = 0;
						$session->set('user_id', -1);
						echo $error_msg;
						die();

					} else {

						$session->new_session_id();
						
						// The user id is valid. Log the user in
						$session->set('user_id', $decrypted['user_id']);

						// Set access levels
						foreach($user['has'] as $k => $info_entry) {

							if($info_entry['info_type'] == 'access_level') {

								$session->set('access_' . $info_entry['info'], 1);

							}

						}

						$session->set('role', $user['other']);

						header("Location: /");
						die();

					}

				}

			}

		}

		return $data;

	}

}
?>
