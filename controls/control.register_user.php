<?
/*
Looks up a user based on e-mail address to see if they are already registered, needs a password, or can log in
*/
class Control_Register_User {

	function run() {

		global $gamo, $session, $dbh, $data, $page_settings;

		$page_settings['allow_json'] = 1;

		$name = ltrim(rtrim(Core::get_input('name')));
		
		$title = ltrim(rtrim(Core::get_input('title')));
		$company = ltrim(rtrim(Core::get_input('company')));
		$phone = ltrim(rtrim(Core::get_input('phone')));
		//$city = ltrim(rtrim(Core::get_input('city')));
		//$state = ltrim(rtrim(Core::get_input('state')));
		$email = ltrim(rtrim(Core::get_input('email')));
		$password = ltrim(rtrim(Core::get_input('password')));
		$password2 = ltrim(rtrim(Core::get_input('password2')));
		$user_id = ltrim(rtrim(Core::get_input('user_id')));
		$country = ltrim(rtrim(Core::get_input('country')));
		$terms = ltrim(rtrim(Core::get_input('terms')));
		$zip = ltrim(rtrim(Core::get_input('zip')));
		//$group = Core::get_input('user_group');
		
		


		$data['error'] = '';
		$data['update_user'] = (is_numeric($user_id)) ? 1 : 0;
		
		$first_name = '';
		$last_name = '';

		$name = explode(' ', $name);

		if(count($name) >= 2) {

			$first_name = ucwords($name[0]);
			unset($name[0]);
			$last_name = ucwords(implode(' ', $name));

		}

		if(isset($_POST['first_name'])) {

			$first_name = Core::get_input('first_name');
			$last_name = Core::get_input('last_name');

		}

		//$valid_groups = array('clinical', 'fraud', 'identity');

		if($first_name == '' || $last_name == '') {

			$data['error'] = 'Please enter your first and last name' . $first_name;

		} else if($company == '') {

			$data['error'] = 'Please enter your company';

		} else if(trim($password) == '') {

			$data['error'] = 'Please enter a password';

		} else if(strlen(trim($password)) < 4) {

			$data['error'] = 'Please choose a longer password';

		} else if($password != $password2) {

			$data['error'] = 'Please make sure that your password matches in both fields';

		} {
				
			$email_check = Core::r('users')->validate_email(array(
					'email' => $email
				)
			);

			if(Core::has_error($email_check)) {

				if($email_check['error_code'] == 2) {

					$email_check['error_msg'] = "Please enter a valid e-mail address";

				} 

				$data['error'] = $email_check['error_msg'];

			} else if(!Validate::pro_email($email)) { // Not a professional e-mail

				$data['error'] = "Please use a professional e-mail address to register";

			} 

		}

		if($data['error'] == '' && $zip == '') {

			$data['error'] = "Please enter your company's zip code";

		}

		if($data['error'] == '' && $data['update_user'] != 1 && $terms != 1) {

			$data['error'] = 'You must agree to the terms of service';

		} 
		
		if( $data['error'] == "This e-mail address is already in use" and $data['update_user'] == 1 ) {
		
			$data['error'] = '';
			
		}


		if($data['error'] == '') {

			if($data['update_user'] == 0) {
				

				$user = Core::r('users')->create_user(array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'email' => $email,
						'phone' => $phone,
						'company' => $company,
						'title' => $title,
						'password' => $password,
						'country' => $country,
						'zip' => $zip
					)
				);
				

				if(Core::has_error($user)) {

					$data['error'] = "There was an error while processing your request. Please refresh the page and try again.";
					$data['error'] = json_encode($user);
					return $data;

				} else { 
					
					$action_types_id = Core::r('actions')->action_types_id(array(
							'action_key' => 'register_portal'
						)
					);
					
					$result = Core::r('actions')->create_action(array(
							'user_id' => $user['user_id'],
							'action_types_id' => $action_types_id
						)
					);
					
					/*
					$msg_html = "Hi, " . $first_name . " " . $last_name . ".
					<br><br>
					Thanks for joining Sparkmotive Sales Enablement, the sales enablement platform that rewards you with Visa Gift Cards for the activities you perform and record on the site!
					<br><br>
					Log back in any time at  <a href='http://www.salesenablement.sparkmotive.com' target='_bank'>www.salesenablement.sparkmotive.com</a>.
					<br><br>
					Earn points right now for reading training resources or sending product resources to prospects. Get automatic Visa rewards for recording transacted meetings and deals on the site!
					<br><br>
					Thank you,
					<br>
					The <a href='http://www.salesenablement.sparkmotive.com' target='_bank'>www.salesenablement.sparkmotive.com</a> team.
					";

					
					Core::email(array(
							'email_to' => $email,
							'name_to' => $user['first_name'] . " " . $user['last_name'],
							'email_from' => 'contact@salesenablement.sparkmotive.com',
							'name_from' => 'Sparkmotive Sales Enablement',
							'subject' => 'Welcome to Sparkmotive Sales Enablement',
							'message' => $msg_html
					)
					);
					*/

					Core::r('users')->login(array(
							'user_id' => $user['user_id']
						)
					);

				}

			} else{

				$update = array(
						'first_name' => $first_name,
						'last_name' => $last_name,
						'display_name' => ucfirst($first_name) . ' ' . strtoupper(substr($last_name, 0, 1)),
						'email' => $email,
						'phone' => $phone,
						'company' => $company,
						'title' => $title,
						'country' => $country,
						'zip' => $zip
				);
				
				if(trim($password) != '') {
				
					$update['password'] = $password;
				
					if(strlen($password) < 4) {
				
						$data['error'] = "Your password must be at least 4 characters long";
				
					} else if($password != $password2) {
				
						$data['error'] = "Please ensure that your password matches in both fields";
				
					}
				
				}
				
				if($password != '') {
				
					$update['password'] = $password;
				
				}
				
				if($data['error'] == '') {
				
					$user = Core::r('users')->update_user(array(
							'user_id' => $user_id,
							'values' => $update
					)
					);
				
				}
				
			}
			
			
			if(Core::has_error($user) || $data['error'] != '') {

				$data['error'] = $user['error_msg'];
				$data['errors'] = (isset($user['errors'])) ? $user['errors'] : '';

			} else {

				$data['user_id'] = $user['user_id'];

			}

		}

		if(isset($data['errors'])) {

			$data['error'] = (isset($data['errors'][0])) ? $data['errors'][0] : $data['errors'];

		}


		$data['redirect'] = '/?p=whatsnew';

		$cookie_redirect = Core::get_cookie('login_redirect');

		if($cookie_redirect !== FALSE) {

			$data['redirect'] = $cookie_redirect;
			Core::set_cookie(array(
					'key' => 'login_redirect',
					'delete' => 1
				)
			);

		}

		return $data;

	}

}
?>
