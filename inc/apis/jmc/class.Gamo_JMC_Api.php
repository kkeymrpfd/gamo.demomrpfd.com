<?
/*
This class interfaces with averetek to pull information for JMC
*/
class Gamo_JMC_Api {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Could not pull data succesfully from Averetek'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid data type selected for retrieving info from Averetek'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Could not map locale'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'No image specified'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'Invalid user specified'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'The file specified does not appear to be a valid image'
			)
		);

	}

	/*
	Make a request to averetek for some information
	*/
	function make_request($options = array()) {

		/*
		arguments:
		{
			type: the typ$options['params']['authKey'] = '04AC3FA693D63E3500294F91F9277516D0CFCDCD'; // Our auth keye of request (get actions, get users, get local info, etc). Potential values are below
				GetActionItemTypes: All gamification actions by language. Use the GetLanguages() method for a list of all language cultures.
									If a translation does not exist for the specified language the English translation is returned.
				GetActions: All gamification actions within the specified period, with the option to restrict the query to a specific OrganizationID or UserID.
				GetLanguages: All supported interface languages.
				GetAllPartnersAndUsers: Returns all partners and users that have taken a qualifying action.
			params: the parameters to pass
		}

		Return:
			if successful:
			{
				valid: 1 = request succesful, 0 = request failed
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'type' => 'actions',
				'params' => array()
			)
		, $options);

		$options['params']['authKey'] = '04AC3FA693D63E3500294F91F9277516D0CFCDCD'; // Our auth key

		$types = array(
			'GetActionItemTypes' => 'https://jmc.juniper.net/Services/Gamify.asmx/GetActionItemTypes',
			'GetActions' => 'https://jmc.juniper.net/Services/Gamify.asmx/GetActions',
			'GetLanguages' => 'https://jmc.juniper.net/Services/Gamify.asmx/GetLanguages',
			'GetAllPartnersAndUsers' => 'https://jmc.juniper.net/Services/Gamify.asmx/GetAllPartnersAndUsers'
		);

		if(!isset($types[$options['type']])) { // The requested information type has no url associate with it. Error.

			return Core::error($this->errors, 2);

		}

		// Set defaults for each info type
		if($options['type'] == 'GetActions') {

			Core::ensure_defaults(array(
					'start' => date("Y-m-d", time()-86400*2),
					'end' => date("Y-m-d", time()+86400),
					'organizationId' => '',
					'userId' => ''
				)
			, $options['params']);

		} else if($options['type'] == 'GetActionItemTypes') {

			Core::ensure_defaults(array(
					'culture' => ''
				)
			, $options['params']);

		}

		// Make the actual request
		// Create map with request parameters
		$url = $types[$options['type']];

		// Store the parameters in a string or else there is an encoding error when sending the request
		$params_store = array();

		foreach($options['params'] as $k => $param) {

			array_push($params_store, $k . '=' . urlencode($param));

		}

		$params_str = implode('&' , $params_store);
		echo $url . "\n";
		echo $params_str;
		// Send the actual request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params_str);
		$raw_result = curl_exec($ch);
		
		echo $url . "\n" . $params_str . "\n";
		// The request comes back with some xml tags. Remove them.
		$raw_result = substr($raw_result, strpos($raw_result, '">') + 2);

		$last = strrpos($raw_result, '</');
		if(!is_numeric($last)) { $last = 0; }

		$raw_result = substr($raw_result, 0, $last);

		$result = json_decode($raw_result, true);

		if(!is_array($result)) { // The returned data was not in json format

			return Core::error($this->errors, 1);

		}

		return $result;

	}

	/*
	Retrieve all locales from averetek and save them to gamo as locales
	*/
	function pull_locales() {

		/*
		arguments:
			none
		
		Ensure that languages are not double saved

		Return:
			if successful:
			{
				valid: 1 = request succesful, 0 = request failed
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Retrieve locales from Averetek
		$locales = $this->make_request(array(
				'type' => 'GetLanguages'
			)
		);

		if(Core::has_error($this->errors, $locales)) { // Could not retreive locales

			return $locales;

		}

		global $gamo;

		// Locales were retrieved. Save them to the database
		foreach($locales as $k => $locale) {

			$result = Core::r('locale')->create_locale(array(
					'locale' => $locale['Culture'],
					'locale_name' => $locale['Description'],
					'locale_id_alias' => $locale['LanguageID']
				)
			);

			$locales[$k]['result'] = $result;

		}

		return $locales;

	}

	/*
	Retrieve all users from Averetek and save them to gamo as users
	*/
	function pull_users() {

		/*
		arguments:
			none
		
		Ensure that users are not saved multiple times

		Return:
			if successful:
			{
				valid: 1 = request succesful, 0 = request failed
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Retrieve locales from Averetek
		$users = $this->make_request(array(
				'type' => 'GetAllPartnersAndUsers'
			)
		);

		if(Core::has_error($this->errors, $users)) { // Could not retreive users

			return $users;

		}

		global $gamo;

		//pendo Map users to the correct locale since the retrieved locale id might not map correctly
		$user_qty = count($users);

		foreach($users as $k => $user) {

			echo "Processing " . ($k*1+1) . " of " . $user_qty . "\n";

			$locale = Core::r('locale')->map_locale($user['LanguageID']);

			if(Core::has_error($locale)) {

				$result = $locale;

			} else {

				$result = Core::r('users')->create_user(array(
						'first_name' => $user['FName'],
						'last_name' => $user['LName'],
						'company' => $user['OrganizationName'],
						'locale' => $locale['locale_id'],
						'email' => $user['Email'],
						'password' => 'something',
						'int_other' => $user['OrganizationID'],
						'user_id_alias' => $user['UserID']
					)
				);


			}
			
			if(!Core::has_error($result)
				|| in_array('This user id alias is already in use', $result['errors'])) { // The user exists. Update their info and pull images

				// Map the provided user id to the gamo user id
				$map_user = Core::r('users')->map_user($user['UserID']);

				if(Core::has_error($map_user)) { // Could not map user id

					$result['updated'] = 0;

				} else { // user id was mapped. Continue updating user info

					// Update image
					if(isset($user['ProfilePicture'])) {

						$img_result = $this->save_picture(array(
								'url' => $user['ProfilePicture'],
								'user_id' => $map_user['user_id']
							)
						);

						$result['img_result'] = $img_result;

					} else {

						$result['img_result'] = 0;

					}

					// Update info
					$result['updated'] = Core::r('users')->update_user(array(
							'user_id' => $map_user['user_id'],
							'values' => array(
								'first_name' => $user['FName'],
								'last_name' => $user['LName'],
								'company' => $user['OrganizationName'],
								'locale' => $locale['locale_id'],
								'email' => $user['Email'],
								'password' => 'something',
								'int_other' => $user['OrganizationID'],
								'user_id_alias' => $user['UserID']
							)
						)
					);

				}

			}

			$users[$k]['result'] = $result;

			if(Core::has_error($map_user)) {

				$result = $map_user;

			}

		}

		Core::print_r($users);

	}

	/*
	Save the picture for user
	*/
	function save_picture($options = array()) {

		/*
		arguments:
		{
			url: the url of the image
		}

		returns
		if successful:
			{
				valid: 0
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/
		
		// Ensure defaults
		Core::ensure_defaults(array(
				'url' => '',
				'user_id' => '',
				'dir' => DIR_STORE
			)
		, $options);

		// Determine if the user id is valid
		$c = Core::db_count(array(
				'table' => GAMO_DB . '.users',
				'values' => array(
					'user_id' => $options['user_id']
				)
			)
		);

		if($c == 0) { // the user id is not valid

			return Core::error($this->errors, 5);

		}

		$img_file = $options['dir'] . '/user_img/' . $options['user_id'] . '.png'; // What to save the image as

		$extension = explode('.', $options['url']);
		$last_k = count($extension) - 1;

		// Determine if a url was specified
		if($options['url'] == ''
			|| $last_k == 0
			|| $extension[$last_k] != 'png' && $extension[$last_k] != 'gif' && $extension[$last_k] != 'jpg') {

			copy(DIR_STORE . '/user_img/blank.png', $img_file);

			return Core::error($this->errors, 4);

		}

		// Save the image		
		@file_put_contents($img_file . '.tmp', @file_get_contents($options['url']));

		if(!@getimagesize($img_file . '.tmp')) { // The file specified is not an image

			unlink($img_file . '.tmp');
			copy(DIR_STORE . '/user_img/blank.png', $img_file);
			return Core::error($this->errors, 6);

		}

		imagepng(imagecreatefromstring(file_get_contents($img_file . '.tmp')), $img_file);

		unlink($img_file . '.tmp');

		return array(
			'file' => $img_file,
			'name' => $options['user_id'] . '.png'
		);

	}

	/*
	Retrieve all actions and save them to the actions log
	*/
	function pull_actions($options = array()) {

		/*
		arguments:
		{
			start_date: the start of the range (lower bound) for which to pull actions. Defaults to 2 days ago
			end_date:: the end of the range (upper bound) for which to pull actions. Defaults to 2 days in the future (avoids timezone issues)
		}
		
		Ensure that users are not saved multiple times

		Return:
			if successful:
			{
				actions: 
				{
					{
						action_id_alias: the id of the action in Averetek
						status: wether the action was saved
					},
					{
						action_id_alias: the id of the action in Averetek
						status: wether the action was saved
					},
					{
						action_id_alias: the id of the action in Averetek
						status: wether the action was saved
					}
					..
					..
				}
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/
		
		// Ensure defaults
		Core::ensure_defaults(array(
				'start' => date("Y-m-d", time()-86400*10),
				'end' => date("Y-m-d", time()+86400),
			)
		, $options);

		// Retrieve locales from Averetek
		$actions = $this->make_request(array(
				'type' => 'GetActions'
			)
		);

		if(Core::has_error($this->errors, $actions)) { // Could not retreive users

			return $actions;

		}

		global $gamo;

		foreach($actions as $k => $action) {

			$map_user = Core::r('users')->map_user($action['UserID']);

			if(Core::has_error($map_user)) {

				$result = $map_user;

			} else {

				$map_action_type = Core::r('actions')->map_action_type($action['ActionTypeID']);

				if(Core::has_error($map_action_type)) {

					$result = $map_action_type;

				} else {

					$action['Created'] = substr(str_replace(array('/Date(', '/', ')'), '', $action['Created'])*1, 0, 10);
					
					$result = Core::r('actions')->create_action(array(
							'action_types_id' => $map_action_type['action_types_id'],
							'user_id' => $map_user['user_id'],
							'action_id_alias' => $action['ActionID'],
							'time' => date("Y-m-d h:i:s", $action['Created'])
						)
					);

				}

			}

			$actions[$k]['result'] = $result;

		}

		Core::print_r($actions);

	}

	/*
	Pull different action types from Averetek
	*/
	function pull_action_types() {

		/*
		arguments:
		{
			save: 1 = save the action types, 0 = do not save the action types
		}
	
		returns
		if successful:
			{
				valid: 1
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'save' => 1
			)
		, $options);

		$action_types = $this->make_request(array(
				'type' => 'GetActionItemTypes',
			)
		);

		if(Core::has_error($action_types)) {

			return $action_types;

		}

		if($options['save'] == 1) {

			global $gamo;

			foreach($action_types as $k => $action_type) {

				$result = Core::r('reward_manager')->create_action_type(array(
						'action_name' => $action_type['ItemTypeName'],
						'points' => 10,
						'action_types_id_alias' => $action_type['ItemTypeID']
					)
				);

				$action_types[$k]['result'] = $result;

			}

		}

		return $action_types;

	}

}

/*
Sample use:

$result = '';

$jmc = new Gamo_JMC_Api();
$result = $jmc->make_request(array(
		'type' => 'GetPartnersAndUsers',
		'params' => array(
			'start' => '2013-03-06',
			'end' => '2013-03-12'
		)
	)
);

Core::print_r($result);

$result = $jmc->pull_locales();

$result = $jmc->pull_action_types();

$result = $jmc->pull_users();

$result = $jmc->pull_actions();

*/
$jmc = new Gamo_JMC_Api();

?>
