<?
/*
Looks up a user based on e-mail address to see if they are already registered, needs a password, or can log in
*/
class Control_Email_Pin {

	function run() {
		
		global $gamo, $session, $dbh, $data, $page_settings;

		$page_settings['allow_json'] = 1;

		$data['email'] = Core::get_input('email');
		$data['pin'] = '';
		$data['msg'] = 'not_found';
		$data['user_id'] = '';

		if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) { // Invalid e-mail

			$data['msg'] = 'invalid_email';

		} else { // Try to retrieve user based on e-mail address

			// Determine if this is a user already in gamo
			$c = Core::db_count(array(
					'table' => GAMO_DB . '.users',
					'values' => array(
						'email' => $data['email']
					)
				)
			);

			if($c > 0) {

				$data['msg'] = 'is_user';

			} else {

				$ct = Core::r('ct')->get_pin(array(
						'email' => $data['email']
					)
				);

				if(Core::has_error($ct)) {

					$data['msg'] = 'not_found';

				} else {

					$data['msg'] = 'register_pending';
					$data['pin'] = $ct['pin'];

				}

			}

		}

		return $data;

	}

}
?>