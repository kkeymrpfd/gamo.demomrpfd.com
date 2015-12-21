<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Ct_Import {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$fields = array(
			'first_name' => 5,
			'last_name' => 6,
			'title' => 7,
			'company' => 8,
			'address' => 9,
			'city' => 10,
			'state' => 11,
			'zip' => 12,
			'country' => 13,
			'phone' => 14,
			'email' => 15,
			'user_group' => 24,
			'reg_source' => 48
		);

		if (($handle = fopen(DIR_STORE . "/ct_leads.csv", "r")) !== FALSE) {
		    while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
		        
		        foreach($row as $k => $v) {

		        	$row[$k] = ltrim(rtrim($v));

		        }

		        echo "<br>------------------------------------<br>";
		        Core::print_r($row);

		        $valid = Core::r('users')->validate_email( array('email' => $row[$fields['email']]) );

		    	if( !Core::has_error( $valid ) ) {

		    		$user = Core::r('users')->create_user(array(
							'first_name' => $row[$fields['first_name']],
							'last_name' => $row[$fields['last_name']],
							'email' => $row[$fields['email']],
							'phone' => $row[$fields['phone']],
							'company' => $row[$fields['company']],
							'title' => $row[$fields['title']],
							'city' => $row[$fields['city']],
							'state' => $row[$fields['state']],
							'zip' => $row[$fields['zip']],
							'country' => $row[$fields['country']],
							'password' => $row[$fields['email']]
						)
					);

					if(!Core::has_error($user)) {

						echo "User created: " . $row[$fields['email']];

						Core::r('users')->create_user_info(array(
								'user_id' => $user['user_id'],
								'info_type' => 'register_source',
								'info' => $row[$fields['reg_source']]
							)
						);

						if($row[$fields['user_group']] != '') {

							$info = Core::r('users')->create_user_info(array(
									'user_id' => $user['user_id'],
									'info_type' => 'user_group',
									'info' => strtolower($row[$fields['user_group']])
								)
							);

						}

					} else {

						echo "Could not create user: " . $row[$fields['email']];
						Core::print_r($user);

					}

		    	} else {

		    		echo "Passing creation of user";
		    		Core::print_r($valid);

		    	}

		    }
		    fclose($handle);
		}

		return $data;

	}

}
?>
