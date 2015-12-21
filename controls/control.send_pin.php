<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Send_Pin {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;

		$email = trim(Core::get_input("email"));
		$first_name = ltrim(rtrim(Core::get_input("first_name")));
		$last_name = ltrim(rtrim(Core::get_input("last_name")));

		$data['error_msg'] = '';
		$data['logged_in'] = 0;

		if($email == '') {

			$data['error_msg'] = "Please enter a valid e-mail address";

		} else {

			Core::log(array(
					'info_type' => 'pin_send_attempt',
					'info_a' => $email,
					'info_b' => $session->session_id()
				)
			);

			$try_qty = Core::fetch_column(
				"SELECT count(*) FROM " . GAMO_DB . ".log WHERE info_type = :info_type AND info_b = :info_b AND datetime > :datetime",
				array(
					':info_type' => 'pin_send_attempt',
					':info_b' => $session->session_id(),
					':datetime' => date("Y-m-d", time()-3600)
				)
			);

			if($try_qty > 100) {

				$data['error_msg'] = "There have been too many requests for a pin from this device. Please try again after 1 hour.";

			}

		}

		if($data['error_msg'] == '') {

			$pin = Core::unique_string(5, array(
					'a', 'b', 'c', 'd', 'e', 'g', 'h', 'j', 'm', 'n', 'p', 'q', 'r', '', 'w', 'x', 'y', '2', '3', '4', '6', '8', '9' 
				)
			);

			$validate_email = Core::r('users')->validate_email(array(
					'email' => $email
				)
			);

			$email_registered = (Core::has_error($validate_email) && $validate_email['error_code'] == 3) ? true : false;

			if(!$email_registered) {

				if(Core::has_error($validate_email)) {

					$data['error_msg'] = "Please enter a valid e-mail address";

				} else if($first_name == '') {

					$data['error_msg'] = "Please enter your first name";

				} else if($last_name == '') {

					$data['error_msg'] = "Please enter your last name";

				}

			}

			if($data['error_msg'] == '') {

				// Determine if this is a valid user
				$user_id = Core::fetch_column(
					"SELECT user_id FROM " . GAMO_DB . ".users WHERE email = :email ORDER BY user_id_alias DESC LIMIT 0, 1",
					array(
						':email' => $email
					)
				);

				if(!is_numeric($user_id)) { // Create user

					$display_name = ucwords($first_name . ' ' . substr($last_name, 0, 1));

					$user_create = Core::r('users')->create_user(array(
							'first_name' => $first_name,
							'last_name' => $last_name,
							'display_name' => $display_name,
							'email' => $email,
							'password' => $pin
						)
					);

					if(Core::has_error($user_create)) {

						$data['error_msg'] = "There was an error while processing your request. Please refresh the page and try again";

					} else {

						$user_id = (is_numeric($user_create['user_id'])) ? $user_create['user_id'] : '';

					}

				}

				if(!is_numeric($user_id)) { // Invalid user

					$data['error_msg'] = $not_found;

				} else { // User found. Retrieve pin

					$user = Core::r('users')->get_user(array(
							'user_id' => $user_id
						)
					);

					if(Core::has_error($user)) {

						$data['error_msg'] = $not_found;

					} else {

						$sent_qty = Core::fetch_column(
							"SELECT count(*) FROM " . GAMO_DB . ".log WHERE info_type = :info_type AND info_a = :info_a AND datetime > :datetime",
							array(
								':info_type' => 'pin_request',
								':info_a' => $user_id,
								':datetime' => date("Y-m-d", time()-3600)
							)
						);

						$find = Core::multi_find($user['has'], 'info_type', 'login_pin');

						if($find != -1) { // user already has a pin. use that.

							$pin = $user['has'][$find]['info'];

						} else { // user does not already have a pin. Generate a new one							

							Core::r('users')->create_user_info(array(
									'user_id' => $user_id,
									'info_type' => 'login_pin',
									'info' => $pin
								)
							);

						}

						$c = Core::db_count(array(
								'table' => GAMO_DB . '.logins',
								'values' => array(
									'user_id' => $user_id
								)
							)
						);

						if($c <= 9999999) {

							// Login the user since this is one of their first 2 logins
							Core::r('users')->login(array(
									'user_id' => $user_id
								)
							);

							$data['logged_in'] = 1;

						}

						$data['user_id'] = $user_id;

						$log = array(
							'info_type' => 'pin_request',
							'info_a' => $user_id,
							'info_b' => $pin,
							'info_c' => 0
						);

						if($sent_qty < 10) {	

							$log['info_c'] = 1;

							Core::r('users')->update_user(array(
									'user_id' => $user_id,
									'values' => array(
										'password' => $pin
									)
								)
							);

							$message = "Here is your PIN to access the Sales Kickoff Game. Go back to the login page where you requested this PIN and enter it to login. 
	<br><br>
	PIN: " . $pin;
							
							$headers = "Content-Type: text/html;\n";
							$headers .= 'From: Sales Kickoff Game <contact@saleskickoffgame.com>' . "\n";

							//mail($user['email'], "PIN for Sales Kickoff Game", $message, $headers);
							mail('nahmed@entermarketing.com', "PIN for Sales Kickoff Game for " . $user['email'], $message, $headers);


						}

						Core::log($log);

						$data['sent'] = 1;

					}

				}

			}

		}

		return $data;

	}

}
?>
