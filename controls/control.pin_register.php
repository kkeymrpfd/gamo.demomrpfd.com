<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Reserve_Slot_Meeting {

	function run($options = array()) {

		global $data, $page_settings, $models, $session, $gamo;

		Core::ensure_defaults(array(
				'pin' => Core::get_input('pin', 'get')
			)
		, $options);

		// Slots available. See if the user is already in the system
		$user_id = Core::fetch_column(
			"SELECT user_id FROM " . GAMO_DB . ".users_info WHERE info_type = 'ct_pin' AND info = :info",
			array(
				':info' => $options['pin']
			)
		);

		if($user_id === FALSE) { // user does not exist. Import them from CT

			// Get user by pin
			$ct_user = Core::r('ct')->check_pin(array(
					'ct_id' => 3404,
					'pin' => $options['pin']
				)
			);

			if($ct_user['pin_valid'] == 0) {

				echo "Invalid pin";
				die();

			} else {

				// User is in ct. See if they exist in the Spark system already
				$user_id = Core::fetch_column(
					"SELECT user_id FROM " . GAMO_DB . ".users WHERE email = :email",
					array(
						':email' => $ct_user['user_data']['Email']
					)
				);

				if($user_id === FALSE) {

					$name = explode(' ', $ct_user['user_data']['ContactName']);
					$first_name = $name[0];

					$last_name = '';

					if(isset($name[1])) {

						unset($name[0]);
						$last_name = implode(' ', $name);

					}

					$create_user = Core::r('users')->create_user(array(
							'first_name' => $first_name,
							'last_name' => $last_name,
							'email' => $ct_user['user_data']['Email'],
							'title' => $ct_user['user_data']['Title'],
							'company' => $ct_user['user_data']['Company'],
							'phone' => $ct_user['user_data']['Phone']
						)
					);

					$user_id = $create_user['user_id'];

				}

			}

		}

		echo $pin;

		return $data;

	}

}
?>
