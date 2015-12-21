<?
// Confirm a user as registered
class Control_Confirm_User {

	function run($options = array()) {

		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;

		Core::ensure_defaults(array(
				'email' => Core::get_input('email'),
				'tnc_accepted' => Core::get_input('tnc_accepted')
			)
		, $options);

		$user_id = Core::fetch_column(
			"SELECT user_id FROM " . GAMO_DB . ".users WHERE email = :email",
			array(
				':email' => $options['email']
			)
		);

		$data['error'] = '';
		$data['success'] = 0;

		if(!is_numeric($user_id)) {

			$data['error'] = "That e-mail address was not found in the system. Please use the e-mail address at which you received the invite.";
			return $data;
				
		}

		$user_accepted = Core::r('users')->has_property(array(
				'user_id' => $user_id,
				'values' => array(
					'info_type' => 'tnc_accepted'
				)
			)
		);

		if($user_accepted['has'] != 1 & $options['tnc_accepted'] != 1) {

			$data['error'] = "You must accept the terms and conditions in order to continue";
			return $data;

		}

		// Mark that the user has accepted the tnc
		Core::r('users')->create_user_info(array(
				'user_id' => $user_id,
				'info_type' => 'tnc_accepted',
				'int_info' => 1
			)
		);

		$login = Core::r('users')->login(array(
				'user_id' => $user_id
			)
		);
		
		$data['success'] = 1;

		return $data;

	}

}
?>