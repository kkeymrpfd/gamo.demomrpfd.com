<?
require_once(DIR_INC . '/ct/class.CT_Campaign.php');
require_once(DIR_INC . '/ct/class.impack.php');
require_once(DIR_INC . '/ct/class.meeting_requester.php');
require_once(DIR_INC . '/ct/class.CT_Snoopy.php');

/*
This class handles interaction with CT and meeting maker
*/
class Gamo_Ct {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Could not find user'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Could not create user in CT'
			)
		);

	}

	/*
	Retrieve pin for a user
	*/
	function get_pin($options = array()) {

		/*
		args:
		{
			
		}
		*/
		Core::ensure_defaults(array(
				'email' => '',
				'ct_id' => CT_ID
			)
		, $options);

		$campaign = new Campaign();
        $campaign
                ->setCampaignID($options['ct_id'])
                ->setCampaignURL('http://ct30.entermarketing.com');

        $pin = $campaign->getPinByEmail($options['email']);

        $data = 0;

		if($pin !== FALSE) {

			return array(
				'pin' => $pin
			);

		}

		return Core::error($this->errors, 1);

	}

	function check_pin($options) {

		/*
		args:
		{
			ct_id
			pin: the pin to use for registration
		}
		*/

		Core::ensure_defaults(array(
				'ct_id' => CT_ID
			)
		, $options);

		$data['pin_valid'] = 0;

		$campaign = new Campaign();
        $campaign
                ->setCampaignID($options['ct_id'])
                ->setCampaignURL('http://ct30.entermarketing.com');

		if(!$campaign->checkPin($options['pin'])) {

			$campaign = new Campaign();
	        $campaign
	                ->setCampaignID($options['ct_id'])
	                ->setCampaignURL('http://ct30.entermarketing.com');

			if($campaign->checkPin($options['pin'])) {

				$data['pin_valid'] = 1;

			}

		} else {

			$data['pin_valid'] = 1;

		}

		if($data['pin_valid'] == 1) {

			$data['user_data'] = $campaign->getData($options['pin']);
			$data['pin'] = $options['pin'];

		}
		
		return $data;

	}

	function new_pin($options = array()) {

		Core::ensure_defaults(array(
				'ct_id' => CT_ID
			)
		, $options);

		$campaign = new Campaign();
        $campaign
                ->setCampaignID($options['ct_id'])
                ->setCampaignURL('http://ct30.entermarketing.com');

		return $campaign->getNewPin();

	}

	/*
	Save questions and answers for a CT user
	*/
	function save_questions($options = array()) {

		/*
		args:
		{
			pin: ct pin for user,
			ct_id: the ct id to push to
			questions: { // array of questions/answers
				{
					question:
					answer:
				},
				{
					question:
					answer:
				},
				{
					question:
					answer:
				},
				..
				..
			}
		}

		returns:
			if success:
			{
				saved: 1
			}

			error: std error
		*/

		Core::ensure_defaults(array(
				'pin' => '',
				'ct_id' => CT_ID,
				'questions' => array()
			)
		, $options);

		global $gamo;

		$campaign = new Campaign();
        $campaign
                ->setCampaignID($options['ct_id'])
                ->setCampaignURL('http://ct30.entermarketing.com');
       	
		$result = $campaign->saveQuestions($options['pin'], $options['questions'], 2);
		
		return $result;

	}

	function register_user($options = array()) {

		/*
		args:
		{
			pin: the pin to use for registration,
			ct_id'
		}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'pin' => '',
				'password' => '',
				'ct_id' => CT_ID
			)
		, $options);

		global $gamo;

		// Ensure that pin is valid
		$pin = Core::r('ct')->check_pin(array(
				'pin' => $options['pin'],
				'ct_id' => $options['ct_id']
			)
		);

		if($pin['pin_valid'] == 0) {

			return Core::error($this->errors, 1);

		}

		// Determine if the pin already belongs to a user
   		$c = Core::db_count(array(
   				'table' => GAMO_DB . '.users_info',
   				'values' => array(
   					'info_type' => 'register_pin',
   					'info' => $options['pin']
   				)
   			)
   		);

   		if($c > 0) { // This pin is already in use

   			return Core::error($this->errors, 7);

   		}

   		// Try to register user
   		global $gamo;

   		$names = explode(' ', $pin['user_data']['ContactName']);
   		$first_name = $names[0];
   		
   		$names_c = count($names);

   		if($names_c == 3) {

   			$last_name = $names[2];

   		} else if($names_c > 0) {

   			unset($names[0]);
   			$last_name = implode(' ', $names);

   		}

   		$user = Core::r('users')->create_user(array(
   				'first_name' => $first_name,
   				'last_name' => $last_name,
   				'company' => $pin['user_data']['Company'],
   				'country' => '',
				'city' => '',
				'state' => '',
				'zip' => '',
				'locale' => '',
				'email' => $pin['user_data']['Email'],
				'password' => $options['password'],
				'int_other' => '',
				'other' => '',
				'other_b' => '',
				'user_id_alias' => ''
   			)
   		);

   		$role = 0;

   		if(!Core::has_error($user)) {

   			$pin_log = Core::r('users')->create_user_info(array(
   					'user_id' => $user['user_id'],
   					'info_type' => 'register_pin',
   					'info' => $options['pin']
   				)
   			);

   			Core::r('users')->create_user_info(array(
   					'user_id' => $user['user_id'],
   					'info_type' => 'access_level'
   				)
   			);

   		}

   		return array(
   			'user' => $user
   		);

	}

	/*
	Create a new user in CT
	*/
	function create_ct_user($options = array()) {

		Core::ensure_defaults(array(
				'first_name' => '',
				'last_name' => '',
				'title' => '',
				'company' => '',
				'phone' => '',
				'email' => '',
				'address' => '',
				'city' => '',
				'state' => '',
				'zip' => '',
				'pin' => '',
				'ct_id' => CT_ID
			)
		, $options);

		if($options['pin'] == '' || $options['pin'] === FALSE) { // No pin specified. Create a new CT pin

			$pin = $this->get_pin(array(
					'email' => $options['email'],
					'ct_id' => $options['ct_id']
				)
			);
			
			if(Core::has_error($pin)) { // User not found. Try creating a new pin

				$options['pin'] = $this->new_pin();

			} else { // User already exists. Do not recreate them

				$options['pin'] = $pin['pin'];

				return array(
					'created' => 'already_exists',
					'pin' => $options['pin']
				);

			}

			if(isset($options['pin']['pin']) && is_array($options['pin'])) {

				$options['pin'] = $options['pin']['pin'];

			}

		}

		$send = array(
			'firstname' => $options['first_name'],
			'lastname' => $options['last_name'],
			'title' => $options['title'],
			'company' => $options['company'],
			'phone' => $options['phone'],
			'email' => $options['email'],
			'address' => $options['address'],
			'city' => $options['city'],
			'state' => $options['state'],
			'zip' => $options['zip']
		);

		$campaign = new Campaign();
        $campaign
                ->setCampaignID($options['ct_id'])
                ->setCampaignURL('http://ct30.entermarketing.com');
       	
		$result = $campaign->addNewUser($options['pin'], $send, 0);

		$result = array(
			'created' => $result,
			'pin' => $options['pin']
		);

		return $result;

	}

	/*
	Send a meeting invite
	*/
	function send_meeting($options = array()) {

		Core::ensure_defaults(array(
				'username' => sha1(IT_MEETING_USER),
				'password' => sha1(IT_MEETING_PASS),
				'summary' => '',
				'location' => 'phone',
				'descrip' => '',
				'datetime' => '',
				'length' => '+1 hour',
				'organizer' => IT_MEETING_EMAIL,
				'attendees' => array()
			)
		, $options);

		$send = array(
			'username' => $options['username'],
			'password' => $options['password'],
			'summary' => $options['summary'],
			'location' => $options['location'],
			'description' => $options['descrip'],
			'dateTime' => $options['datetime'],
			'length' => '+1 hour',
			'organizer' => $options['organizer'],
			'attendees' => $options['attendees']
		);
		
		$url = 'http://create.itmeetingmaker.com';

		$query = http_build_query($send, '', '&');

		// Send the actual request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		$raw_result = curl_exec($ch);

		$result = @json_decode($raw_result, TRUE);

		if(!is_array($result)) {

			$result = array();

		}

		return array(
			'sent' => (isset($result['response']) && $result['response'] == 'create_success') ? 1 : 0,
			'parsed' => $result,
			'raw' => $raw_result
		);

	}

	/*
	Send a meeting to CT
	*/
	function send_meeting_ct($options = array()) {

		/*
		{
			ct_id: the ct_id used
			'first_name' => '',
			'last_name' => '',
			'title' => '',
			'company' => '',
			'phone' => '',
			'email' => '',
			datetime_a
		}
		*/

		Core::ensure_defaults(array(
				'ct_id' => CT_ID,
				'user_id' => -1,
				'datetime_a' => '', // utc time
				'datetime_b' => '', // utc time
				'name' => '',
				'company' => '',
				'title' => '',
				'email' => '',
				'phone' => '',
				'topic' => ''
			)
		, $options);

		$datetime_b = date("l F j, Y @ g:i a ", strtotime(Validate::east_time($options['datetime_b']))) . 'EST';

		if(strpos($datetime_b, '1969') !== FALSE) {

			$datetime_b = '';
			

		}

		$questions = array(
	    	array(
	    		'question' => 'First meeting time',
	    		'answer' => date("l F j, Y @ g:i a ", strtotime(Validate::east_time($options['datetime_a']))) . 'EST',
	    	),
	    	array(
	    		'question' => 'Second meeting time',
	    		'answer' => $datetime_b,
	    	),
	    	array(
	    		'question' => 'Meeting with',
	    		'answer' => strip_tags($options['name']),
	    	),
	    	array(
	    		'question' => 'Company name',
	    		'answer' => strip_tags($options['company']),
	    	),
	    	array(
	    		'question' => 'Title',
	    		'answer' => strip_tags($options['title']),
	    	),
	    	array(
	    		'question' => 'Meeting e-mail',
	    		'answer' => strip_tags($options['email']),
	    	),
	    	array(
	    		'question' => 'Meeting phone',
	    		'answer' => strip_tags($options['phone']),
	    	),
	    	array(
	    		'question' => 'Meeting topic',
	    		'answer' => strip_tags($options['topic']),
	    	)
	    );

	    global $gamo;

	    $user = Core::r('users')->get_user(array(
	    		'user_id' => $options['user_id'],
	    		'get_has' => 0
	    	)
	    );

	    if(Core::has_error($user)) { // Could not find user

	    	return Core::error($this->errors, 1);

	    }

	    $name = explode(" ", $options['name']);
	    $last_name = '';
	    foreach($name as $k => $part) {

	    	if($k > 0) {

	    		$last_name .= ' ' . $part;

	    	}

	    }

	    $ct_user = Core::r('ct')->create_ct_user(array(
	    		'first_name' => $name[0],
				'last_name' => $last_name,
				'title' => $options['title'],
				'company' => $options['company'],
				'phone' => $options['phone'],
				'email' => $options['email'],
				'ct_id' => $options['ct_id']
	    	)
	    );
	    
	    if(Core::has_error($ct_user)) { // Could not create/find user in ct

	    	return Core::error($this->errors, 2);

	    }

	    // Set user to profile engagement requested
	   $result = Core::r('ct')->set_status(array(
	    		'pin' => $ct_user['pin'],
	    		'status' => 4,
	    		'ct_id' => $options['ct_id']
	    	)
	    );

	    $result = Core::r('ct')->save_questions(array(
	    		'pin' => $ct_user['pin'],
	    		'ct_id' => $options['ct_id'],
	    		'questions' => $questions
	    	)
	    );

	   	return array(
	   		'sent' => 1
	   	);

	}

	/*
	Set status for a ct user
	*/
	function set_status($options = array()) {

		/*
		args:
		{
			pin:
			ct_id:
			status:
		}
		*/
		Core::ensure_defaults(array(
				'pin' => '',
				'status' => '',
				'ct_id' => CT_ID
			)
		, $options);

		$campaign = new Campaign();
        $campaign
                ->setCampaignID($options['ct_id'])
                ->setCampaignURL('http://ct30.entermarketing.com');

        $campaign->updateStatus($options['pin'], $options['status']);

        return 1;

	}

}
?>
