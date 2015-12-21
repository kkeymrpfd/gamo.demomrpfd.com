<?php
require_once('class.Social_Account.php');
require_once('class.Options.php');
require_once('class.Curl_Provider.php');

class Linkedin_Service extends Social_Account{
	const WEEK = 604800;
	const MONTH = 2592000;
	
	
	const ACCOUNT_TYPE = 'li_account';
	
	protected $errors = array(
			array(
					'error_code' => '1',
					'error_message' => ''
			),
			array(
					'error_code' => '2',
					'error_message' => ''
			),
			array(
					'error_code' => '3',
					'error_message' => ''
			),
			array(
					'error_code' => '4',
					'error_message' => 'No Shared Posts found'
			),
			array(
					'error_code' => '5',
					'error_message' => 'Report already has account'
			),
			array(
					'error_code' => '6',
					'error_message' => 'Failed saving account'
			),
			array(
					'error_code' => '7',
					'error_message' => 'Failed deleting account'
			),
			array(
					'error_code' => '8',
					'error_message' => ''
			),
			array(
					'error_code' => '9',
					'error_message' => 'Failed to initialize the scrapper'
			)
	);
	
	/*
	 * Class (inline) that handles the scrapping of data from facebook
	*/
	protected $scrape;
	
	/*
	 * Class of option model to handle scraper locking
	*/
	protected $option;
	
	/*
	 * Array of all fb_accounts from DB
	*/
	protected $fb_accounts;
	
	public function get_connection(){
		return $this->connection;
	}
	
	public function get_game(){
		return $this->game;
	}
	
	public function get_action_names(){
		//return array('actions' => array('shares', 'page_likes', 'likes_comments_wposts'));
		return array('actions' => array('ismember'));
	}
	 
	public function __construct(){
		$this->start = strtotime('04/12/2013');
	
		$this->connection = array('li_connection' => array(
				'app_id' => LI_APP_KEY,
				'app_secret' => LI_SECRET
		));
	
		$this->game['game_desc'] = array('pages' => array());
		for($i=0;$i<LI_SUBSCRIPTION_COUNT;$i++){
			$this->game['game_desc']['pages'][$i]['id'] = constant('LI_SUBSCRIPTION_ID'.($i+1));
			$this->game['game_desc']['pages'][$i]['name'] = constant('LI_SUBSCRIPTION_NAME'.($i+1));
			$this->game['game_desc']['pages'][$i]['label'] = constant('LI_SUBSCRIPTION_LABEL'.($i+1));
		}
	}
	
	public function get_login_url($options=array()){
		
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('li_connection', 'redirect_url')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['li_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		
		$url = sprintf(
				'https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=%s&state=%s&redirect_uri=%s',
				$options['li_connection']['app_id'],
				md5('small randomstr'),
				urlencode($options['redirect_url'])
		);
		
		return $url."&scope=rw_groups%20r_emailaddress%20r_fullprofile";
	}
	
	public function get_actions($options=array()){;
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('li_connection', 'game_desc', 'actions')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['li_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		
		if(in_array('ismember', $options['actions']))
			$resultF = $this->get_follows($options);
		
		if(Core::has_error($resultF))
			return $resultF;
		
		return true;
	}
	
	public function get_group_member($options=array()){
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('pages')));
		if(Core::has_error($result))
			return $result;
	
		$curr_slug = 'linkedinJoinGroup';
		$options['scraper_slug'] = $curr_slug;
	
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
	
		if(count($this->scrape->is_accounts) > 0){
			// For each Twitter Hashtag, iterate through possible activities
			//TODO: VERY IMPORTANT - we must get all users that are already in a group not to make calls on their behalf
			foreach($this->scrape->is_accounts as $account) {
				$groups = $this->fetch('GET', '/v1/people/~:(group-memberships)', $account['access_token']);
	
				// For each found tagged photo
				if( isset($groups->groupMemberships->values) ){
						
					foreach($groups->groupMemberships->values as $group) {
							
						$object_id = $group->group->id;
						if(array_key_exists($object_id, $this->scrape->pages)) {
							// Check if the Instagram user ID is already in the logs for this activity
								
							$platform_user_id = $account['s_user_id'];
							$this->actions_new[] = array(
									'user_id' => $account['user_id'],
									'activity_slug' => $curr_slug,
									'object_id' => $object_id,
									'sv_user_id' => $platform_user_id,
									'game_obj_id' => $this->scrape->pages[$object_id]['label']
							);
						}
							
					}
						
				}else{
					var_dump($groups);
				}
	
	
			}
	
		}
	
		$this->finalize_scrape($options);
	
		return true;
	
	}
	
	public function get_follows($options=array()){
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('pages')));
		if(Core::has_error($result))
			return $result;
		
		$curr_slug = 'linkedinFollowCompany';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		if(count($this->scrape->is_accounts) > 0){
			// For each Twitter Hashtag, iterate through possible activities
			//TODO: VERY IMPORTANT - we must get all users that are already in a group not to make calls on their behalf
			foreach($this->scrape->is_accounts as $account) {
				$groups = $this->fetch('GET', '/v1/people/~/following/companies', $account['access_token']);

				// For each found tagged photo
				if( isset($groups->values) ){
					
					foreach($groups->values as $group) {
					
						$object_id = $group->id;
						if(array_key_exists($object_id, $this->scrape->pages)) {
							// Check if the Instagram user ID is already in the logs for this activity
					
							$platform_user_id = $account['s_user_id'];
							$this->actions_new[] = array(
									'user_id' => $account['user_id'],
									'activity_slug' => $curr_slug,
									'object_id' => $object_id,
									'sv_user_id' => $platform_user_id,
									'game_obj_id' => $this->scrape->pages[$object_id]['label']
							);
						}
					
					}
					
				}else{
					//var_dump($groups);
				}
				
		
			}
				
		}

		$this->finalize_scrape($options);
		
		return true;

	}
	
	public function login_user($options=array()){
		//TODO: 1. Get the social request token and convert to the authtoken
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('li_connection', 'redirect_url', 'user_id')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['li_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		
		$requestData = $_REQUEST; 
		
		//error_log(print_r($requestData,true));

		if(!isset($requestData['code'])) {
			return Core::error($this->errors, 1);
		}
		
		$curl_provider = new Curl_Provider(array('host_url' => 'https://www.linkedin.com'));
		$url = sprintf(
				'https://www.linkedin.com/uas/oauth2/accessToken?grant_type=authorization_code&code=%s&redirect_uri=%s&client_id=%s&client_secret=%s',
				$requestData['code'],
				urlencode($options['redirect_url']),
				$options['li_connection']['app_id'],
				$options['li_connection']['app_secret']
		);
		
		$request_body = $curl_provider->http($url, 'POST');

		//error_log(print_r($request_body,true));
		
		$request_obj = json_decode($request_body);
		if(!isset($request_obj->access_token)) {
			return Core::error($this->errors, 2);
		}
		
		$user = $this->fetch('GET', '/v1/people/~:(id,email-address)', $request_obj->access_token);
		 
		if(!isset($user->emailAddress) or !isset($user->id)) {
			return Core::error($this->errors, 2);
		}
		
		$is_account = array(
				'user_id' => $options['user_id'],
				'linkedin_user_id' => $user->id,
				'linkedin_username' => $user->emailAddress,
				'access_token' => $request_obj->access_token
		);
		
		if(!$this->create_account($is_account)) {
			//TODO: Failed saving account
			return Core::error($this->errors, 6);
		}
		
		return true;
	}
	
	private function fetch($method, $resource, $access_token, $body = '') {
		$params = array('oauth2_access_token' => $access_token,
				'format' => 'json',
		);
		 
		// Need to use HTTPS
		$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
		// Tell streams to make a (GET, POST, PUT, or DELETE) request
		$context = stream_context_create(
				array('http' =>
						array('method' => $method,
						)
				)
		);
	
	
		// Hocus Pocus
		$response = @file_get_contents($url, false, $context);
	
		// Native PHP object, please
		return json_decode($response);
	}
	
	public function logoff_user($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('user_id')));
		if(Core::has_error($result))
			return $result;
		if(!$this->delete_account($options)) {
			return Core::error($this->errors, 7);
		}
		
		return true;
	}
	
	protected function init_scrape($options=array()){
		$this->scrape = new stdClass();
		
		$this->scrape->is_media = $options['game_desc'];
		$this->scrape->is_app = $options['li_connection'];
		$this->scrape->slug = $options['scraper_slug'];
		
		//TODO: Get all the accounts twitter id
		$is_accounts = $this->find_accounts();
		if(!is_array($is_accounts))
			return false;
		
		foreach($is_accounts as $is_account){
			$this->scrape->is_accounts[$is_account['user_id'].$is_account['username']] = $is_account;
			$this->scrape->is_accnts_ids[] = $is_account['s_user_id'];
		}
		
		foreach($this->scrape->is_media['pages'] as $page){
			$this->scrape->pages[$page['id']] = $page;
		}
		
		//TODO: Add way to limit the call to the function by introducing lock
		$this->option = new Options();
		
		$last_run_from_db = $this->option->get_last_run($options);
		if($last_run_from_db){
			$this->scrape->last_run = $last_run_from_db;
		}else{
			$this->scrape->last_run = $this->start;
		}
		
		$this->option->unlock_scraper($options);
		if($this->option->is_scraper_locked($options))
			return false;
		$this->option->lock_scraper($options);
		
		$this->scrape->actions_new = array();
		
		
		return true;
	}
	
	protected function finalize_scrape($options=array()){
		$this->option->unlock_scraper($options);
		$this->option->set_last_run($options);
	}
	
	public function create_account($options=array()){
		$inputs['user_info'] = array(
				'user_id' => intval($options['user_id']),
				'info_type' => self::ACCOUNT_TYPE,
				'int_info' => $options['linkedin_user_id'],
				'info' => $options['linkedin_username'],
				'info_b' => $options['access_token'],
				'time' => date('Y-m-d H:i:s')
		);
	
		return parent::create_account($inputs['user_info']);
	}
	
	public function delete_account($options=array()){
		$options['account_type'] = self::ACCOUNT_TYPE;
		return parent::delete_account($options);
	}
	
	public function find_accounts($options=array()){
		$options['account_type'] = self::ACCOUNT_TYPE;
		return parent::find_accounts($options);
	}
	
	public function has_account($options=array()){
		$options['account_type'] = self::ACCOUNT_TYPE;
		return parent::has_account($options);
	}
	
	
}