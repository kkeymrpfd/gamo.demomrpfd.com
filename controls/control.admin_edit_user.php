<?
/*
Looks up a user based on e-mail address to see if they are already registered, needs a password, or can log in
*/
class Control_Admin_Edit_User {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $gamo, $session, $dbh, $data, $page_settings;

		$page_settings['allow_json'] = 1;
		
		$user_id = Core::get_input('user_id');
		$first_name = ltrim(rtrim(Core::get_input('first_name')));
		$last_name = ltrim(rtrim(Core::get_input('last_name')));
		$display_name = ltrim(rtrim(Core::get_input('display_name')));
		$email = ltrim(rtrim(Core::get_input('email')));
		$title = ltrim(rtrim(Core::get_input('title')));
		$phone = ltrim(rtrim(Core::get_input('phone')));
		$partner = ltrim(rtrim(Core::get_input('partner')));
		
		// Ensure that the group is valid
		$valid_groups = array('bss', 'is', 'pm', 'ps', 'company');
		$data['msg'] = '';

		if($first_name == '') {

			$data['msg'] = 'Please enter a first name for this user';

		} else if($last_name == '') {

			$data['msg'] = 'Please enter a last name for this user';

		} else {

			$email_check = Core::r('users')->validate_email(array(
					'email' => $email,
					'user_id' => $user_id
				)
			);

			if(Core::has_error($email_check)) {

				if($email_check['error_code'] == 2) {

					$email_check['error_msg'] = "Please enter a valid e-mail address";

				}

				$data['msg'] = $email_check['error_msg'];

			} else if($title == '') {

				$data['msg'] = 'Please enter a title for this user';

			} else if($phone == '') {

				$data['msg'] = 'Please provide a phone number for this user';

			} else { // Determine if user is valid and if applicable, the partner

				$user = Core::r('users')->get_user(array(
						'user_id' => $user_id
					)
				);

				if(Core::has_error($user)) {

					$data['msg'] = "There as an error while processing your request. Please refresh the page and try again.";

				} else if($user['user_group'] == 'pm' || $user['user_group'] == 'ps') { // Ensure that the partner is valid

					$partner_user = Core::r('users')->get_user(array(
							'user_id' => $partner
						)
					);

					if(Core::has_error($partner_user)) {

						$data['msg'] = "Please select a partner for this user.";;

					}

				}

			}

		}

		if($data['msg'] == '') {

			Core::r('users')->update_user(array(
					'user_id' => $user_id,
					'values' => array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'display_name' => $display_name,
						'email' => $email,
						'title' => $title,
						'phone' => $phone
					)
				)
			);

			if($user['user_group'] == 'pm' || $user['user_group'] == 'ps') {

				Core::r('users')->update_user(array(
						'user_id' => $user_id,
						'values' => array(
							'company' => $partner_user['company']
						)
					)
				);

			}

			$data['msg'] = 1;

		}

		return $data;

	}

}
?>