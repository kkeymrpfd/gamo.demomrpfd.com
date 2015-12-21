<?

class Control_Demandgen_Register {

	function run() {

		global $gamo, $session, $dbh, $page_settings, $data;

		$page_settings['allow_json'] = 1;

		$register['name'] = ltrim(rtrim(Core::get_input('name')));
		$register['email'] = ltrim(rtrim(Core::get_input('email')));
		$register['company'] = Core::get_input('company');
		$register['title'] = Core::get_input('title');
		$register['phone'] = Core::get_input('phone');
		$register['hash'] = Core::get_input('hash');

		$data['msg'] = '';

		$demandgen_contact_id = Core::fetch_column(
			"SELECT demandgen_contact_id FROM " . GAMO_DB . ".demandgen_contacts WHERE hash = :hash",
			array(
				':hash' => $register['hash']
			)
		);

		if(!is_numeric($demandgen_contact_id)) {

			$data['msg'] = "The URL you have tried registering from no longer appears valid. Please refresh the page and try again.";

		} else {

			if($register['name'] == '') {

				$data['msg'] = "Please enter your name";

			} else {

		       	$name_split = explode(' ', $register['name']);

		       	if(!isset($name_split[1])) {

		       		$data['msg'] = "Please enter your first and last name";

		       	} else {

		       		$first_name = $name_split[0];

		       		unset($name_split[0]);

		       		$last_name = implode(' ', $name_split);

	       			$valid = Core::r('users')->validate_email(array(
	       					'email' => $register['email'],
	       					'unique_check' => 0
	       				)
	       			);

	       			if(Core::has_error($valid)) {

	       				if($valid['error_code'] == 2) {

	       					$data['msg'] = "Please enter a valid e-mail address";

	       				} else if($valid['error_code'] == 3) {

	       					$data['msg'] = "That e-mail address is already registered";

	       				}

	       			} else if(Core::pro_email($register['email']) == false) {

	       				$data['msg'] = "You must use your professional, company e-mail address to register.";

	       			} else if($register['company'] == '') {

	       				$data['msg'] = "Please enter your company name";

	       			} else if($register['title'] == '') {

	       				$data['msg'] = "Please enter your professional title";

	       			} else if($register['phone'] == '') {

	       				$data['msg'] = "Please enter your phone number";

	       			}

		       	}

		    }

		}
	    
	    if($data['msg'] == '') {

		    $update = Core::db_update(array(
		    		'table' => GAMO_DB . ".demandgen_contacts",
		    		'values' => array(
		    			'data' => json_encode($register),
		    			'profiled' => Core::datetime()
		    		),
		    		'where' => array(
		    			'demandgen_contact_id' => $demandgen_contact_id
		    		)
		    	)
		    );

		    $data['msg'] = 'success';

		}

        return $data;

	}

}
?>