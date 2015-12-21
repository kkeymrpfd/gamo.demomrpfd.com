<?

class Control_Register {

	function run() {

		global $gamo, $session, $dbh, $page_settings, $data;

		$page_settings['allow_json'] = 1;

		$name = ltrim(rtrim(Core::get_input('name')));
		$email = ltrim(rtrim(Core::get_input('email')));
		$password = Core::get_input('password');
		$tos = (Core::get_input('tos') == 1) ? 1 : 0;

		$data['msg'] = '';

		if(strlen($password) < 4) {

			$data['msg'] = "Your password must be at least 4 characters long";

		} else {

			if($name == '') {

				$data['msg'] = "Please enter your name";

			} else {

		       	$name_split = explode(' ', $name);

		       	if(!isset($name_split[1])) {

		       		$data['msg'] = "Please enter your first and last name";

		       	} else {

		       		$first_name = $name_split[0];

		       		unset($name_split[0]);

		       		$last_name = implode(' ', $name_split);

		       		if($tos == 0) {

		       			$data['msg'] = "You must accept the terms of service to continue";

		       		} else {

		       			$valid = Core::r('users')->validate_email(array(
		       					'email' => $email
		       				)
		       			);

		       			if(Core::has_error($valid)) {

		       				if($valid['error_code'] == 2) {

		       					$data['msg'] = "Please enter a valid e-mail address";

		       				} else if($valid['error_code'] == 3) {

		       					$data['msg'] = "That e-mail address is already registered";

		       				}

		       			} else if(Core::pro_email($email) == false) {

		       				$data['msg'] = "You must use your professional, company e-mail address to register.";

		       			}

		       		}

		       	}

		    }

	    }

	    if($data['msg'] == '') {

	    	$user = Core::r('users')->create_user(array(
	    			'first_name' => $first_name,
	    			'last_name' => $last_name,
	    			'email' => $email,
	    			'password' => $password
	    		)
	    	);

	    	if(Core::has_error($user) || !isset($user['user_id']) || !is_numeric($user['user_id']) ) {

	    		$data['msg'] = "There was an error while processing your request. Please refresh the page and try again.";

	    	} else {

	    		copy(DIR . '/pub/img/profile-picture.png', DIR . '/pub/img/user_images/' . $user['user_id'] . '.png');

	    		// Login user
	    		Core::r('users')->login(array(
	    				'user_id' => $user['user_id']
	    			)
	    		);

	    		$data['msg'] = 1;

	    	}

	    }

        return $data;

	}

}
?>