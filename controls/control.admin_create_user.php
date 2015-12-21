<?
/*
Looks up a user based on e-mail address to see if they are already registered, needs a password, or can log in
*/
class Control_Admin_Create_User {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);

		global $gamo, $session, $dbh, $data, $page_settings;

		$page_settings['allow_json'] = 1;

		$first_name = ltrim(rtrim(Core::get_input('create_user_first_name')));
		$last_name = ltrim(rtrim(Core::get_input('create_user_last_name')));
		$email = ltrim(rtrim(Core::get_input('create_user_email')));
		$company = ltrim(rtrim(Core::get_input('create_user_company')));
		$title = ltrim(rtrim(Core::get_input('create_user_title')));
		$phone = ltrim(rtrim(Core::get_input('create_user_phone')));
		$partner = ltrim(rtrim(Core::get_input('create_user_partner')));
		$group = Core::get_input('create_user_group');
		$bss_owner = Core::get_input('create_user_bss_owner');
		$cert_level = Core::get_input('create_user_cert_level');

		if($group == 'company') {

			$first_name = 'Company';
			$last_name = 'Company';
			$email = 'rand' . time() . rand(111, 999) . '@noreply.entermarketing.com';
			$title = 'Company';
			$phone = '555-555-5555';

		}
		
		// Ensure that the group is valid
		$valid_groups = array('bss', 'is', 'pm', 'ps', 'company');
		$data['error'] = '';

		if(!in_array($group, $valid_groups)) {

			$data['error'] = 'Please select a group for this users';

		} else if($first_name == '') {

			$data['error'] = 'Please enter a first name for this user';

		} else if($last_name == '') {

			$data['error'] = 'Please enter a last name for this user';

		} else {

			$email_check = Core::r('users')->validate_email(array(
					'email' => $email
				)
			);

			if(Core::has_error($email_check)) {

				if($email_check['error_code'] == 2) {

					$email_check['error_msg'] = "Please enter a valid e-mail address";

				}

				$data['error'] = $email_check['error_msg'];

			} else if($title == '') {

				$data['error'] = 'Please enter a title for this user';

			} else if($phone == '') {

				$data['error'] = 'Please provide a phone number for this user';

			} else if(($group == 'pm' || $group == 'ps') && !is_numeric($partner)) {

				$data['error'] = 'Please select a partner for this user';

			} else { // Determine if e-mail address is unique

				$c = Core::db_count(array(
						'table' => GAMO_DB . '.users',
						'values' => array(
							'email' => $email
						)
					)
				);

				if($c > 0) {

					$data['error'] = 'There is already a user with this e-mail address';

				} else if($group == 'company') {

					if($company == '') {

						$data['error'] = 'Please enter a partner name';

					} else {

						// Determine if bss owner is valid
						$valid = Core::r('users')->user_valid(array(
								'user_id' => $bss_owner,
								'has' => 0
							)
						);

						if(!isset($valid['valid']) || $valid['valid'] != 1) {

							$data['error'] = 'Please select a valid BSS owner';

						}

					}

				} else if($group == 'pm' || $group == 'ps') {

					// Determine if company is valid
					$valid = Core::r('users')->user_valid(array(
							'user_id' => $partner,
							'has' => 0
						)
					);

					if(!isset($valid['valid']) || $valid['valid'] != 1) {

						$data['error'] = 'Please select a valid partner company';

					}

				}

			}

		}

		if($data['error'] == '') {

			if($group == 'pm' || $group == 'ps') {

				$company_user = Core::r('users')->get_user(array(
						'user_id' => $partner
					)
				);

				$company_name = $company_user['company'];

			} else {

				$company_name = $company;

			}

			$user = Core::r('users')->create_user(array(
					'first_name' => $first_name,
					'last_name' => $last_name,
					'email' => $email,
					'phone' => $phone,
					'company' => $company_name,
					'title' => $title,
					'user_group' => $group
				)
			);

			if(Core::has_error($user)) {

				$data['error'] = $user['error_msg'];
				$data['errors'] = (isset($user['errors'])) ? $user['errors'] : '';

			} else {

				$data['user_id'] = $user['user_id'];

				if($group == 'company') { // User was created and is a company. Set company properties

					Core::r('users')->create_user_info(array(
							'user_id' => $data['user_id'],
							'info_type' => 'bss_owner',
							'int_info' => $bss_owner
						)
					);

					$valid_cert_levels = array(
						array(
							'level' => 'no_certification',
							'action_types_id' => 0
						),
						array(
							'level' => 'affiliate',
							'action_types_id' => 15
						),
						array(
							'level' => 'affiliate_elite',
							'action_types_id' => 16
						),
						array(
							'level' => 'premier',
							'action_types_id' => 17
						),
						array(
							'level' => 'signature',
							'action_types_id' => 18
						)
					);

					$k = Core::multi_find($valid_cert_levels, 'action_types_id', $cert_level);
					
					if($cert_level != 0
						&& $k != -1) {

						require_once(DIR_CONTROLS . '/control.admin_partner_level.php');
						$admin_partner_level = new Control_Admin_Partner_Level();
						$admin_partner_level->run(array(
								'partner_id' => $user['user_id'],
								'level' => $cert_level
							)
						);

					}

				} else if($group == 'pm' || $group == 'ps') { // Save company for this user

					Core::r('users')->create_user_info(array(
							'user_id' => $data['user_id'],
							'info_type' => 'partner',
							'int_info' => $partner
						)
					);

					Core::r('users')->create_user_info(array(
							'user_id' => $data['user_id'],
							'info_type' => 'link_action_to',
							'info' => 'company'
						)
					);

				}

				Core::r('users')->create_user_info(array(
						'user_id' => $data['user_id'],
						'info_type' => 'access_level',
						'info' => $group
					)
				);

			}

		}

		if(isset($data['errors'])) {

			$data['error'] = $data['errors'][0];

		}
		return $data;

	}

}
?>