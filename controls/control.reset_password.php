<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Reset_Password {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;

		$session->destroy();
		
		$email = Core::get_input('email');
		$reset_key = Core::get_input('reset_key');
		$password = Core::get_input('password');
		$password2 = Core::get_input('password2');

		if(trim($password) == '' || strlen($password) < 4) {

			$data['msg'] = "Your password must be at least 4 characters long";
			
		} else if($password != $password2) {

			$data['msg'] = "Please make sure that your password matches in both fields";
			
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$data['msg'] = "Please enter a valid e-mail address";

		} else {

			global $dbh;

			$sql = "SELECT
				user_id
				FROM " . GAMO_DB . ".password_request
				WHERE
				used_time <= request_time
				AND reset_key = :reset_key
				AND (SELECT
					count(*)
					FROM " . GAMO_DB . ".users
					WHERE
					" . GAMO_DB . ".users.user_id = " . GAMO_DB . ".password_request.user_id
					AND " . GAMO_DB . ".users.email = :email) > 0";

			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':email' => $email,
					':reset_key' => $reset_key
				)
			);

			$user_id = $sth->fetchColumn();

			if(!is_numeric($user_id)) {

				$data['msg'] = "This e-mail is not the one that was used for this password reset request";

			} else {

				Core::db_update(array(
						'table' => GAMO_DB . '.users',
						'values' => array(
							'password' => hash('sha256', $password)
						),
						'where' => array(
							'user_id' => $user_id
						)
					)
				);

				Core::db_update(array(
						'table' => GAMO_DB . '.password_request',
						'values' => array(
							'used_time' => Core::date_string(),
							'used_ip' => substr($_SERVER['REMOTE_ADDR'], 0, 200)
						),
						'where' => array(
							'reset_key' => $reset_key
						)
					)
				);

				Core::r('users')->login(array(
						'user_id' => $user_id
					)
				);

				$data['msg'] = 1;

			}

		}

		return $data;

	}

}
?>
