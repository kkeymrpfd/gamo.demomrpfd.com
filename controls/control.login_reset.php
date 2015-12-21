<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Login_Reset {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;

		$session->destroy();
		
		$email = Core::get_input('email');

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$data['valid'] = 2;

		} else {

			$params = array(
				':email' => $email
			);

			$user_id = Core::fetch_column(
				"SELECT user_id, email FROM " . GAMO_DB . ".users WHERE email = :email ",
				$params
			);

			if($user_id === false) {

				$data['valid'] = 0;

			} else {

				global $dbh;

				$sql = "SELECT
					reset_key
					FROM " . GAMO_DB . ".password_request
					WHERE
					user_id = :user_id
					AND used_time <= request_time";

				$sth = $dbh->prepare($sql);
				$sth->execute(array(
						':user_id' => $user_id
					)
				);

				$record = $sth->fetch();

				if(is_array($record)) {

					$reset_key = $record['reset_key'];

				} else {

					$reset_key = Core::unique_string(30);
					$time = Core::date_string();
					$ip = substr($_SERVER['REMOTE_ADDR'], 0, 200);

					Core::db_insert(array(
							'table' => GAMO_DB . '.password_request',
							'values' => array(
								'user_id' => $user_id,
								'reset_key' => $reset_key,
								'request_time' => $time,
								'used_time' => $time,
								'ip' => $ip,
								'used_ip' => ''
							)
						)
					);

				}

				$data['valid'] = 1;

				$message = "To change your password for Sparkmotive Sales Enablement, please visit the link below:
				<br><br>
				http://" . URL . "/?p=reset_password&key=" . $reset_key;

				Core::email(array(
						'email_to' => $email,
						'name_from' => SITE_NAME,
						'email_from' => ADMIN_EMAIL,
						'subject' => 'Password reset for ' . SITE_NAME ."!",
						'message' => $message,
					)
				);

			}

		}

		return $data;

	}

}
?>
