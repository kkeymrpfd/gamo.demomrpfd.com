<?php
require_once('class.Social_Account.php');
require_once('class.Options.php');
require_once('class.Curl_Provider.php');

class Instagram_Service extends Social_Account{
	
	const ACCOUNT_TYPE = 'is_account';
	
	protected $errors = array(
			array(
					'error_code' => '1',
					'error_message' => 'Error (Instagram Connect Account): Connection error'
			),
			array(
					'error_code' => '2',
					'error_message' => 'Error (Instagram Connect Account): OAuth error (Grant Access)'
			),
			array(
					'error_code' => '3',
					'error_message' => 'Error (Instagram Connect Account): OAuth error (User info)'
			),
			array(
					'error_code' => '4',
					'error_message' => ''
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
	
	public function get_connection(){
		return $this->connection;
	}
	
	public function get_game(){
		return $this->game;
	}
	
	public function get_action_names(){
		return array('actions' => array('hashtags_user'));
	}
	
	public function __construct(){
		$this->start = strtotime('05/13/2013');
		
		$this->connection = array('is_connection' => array(
				'client_id' => IS_CLIENT_ID,
				'client_secret' => IS_CLIENT_SECRET
		));
	
		$this->game['game_desc'] = array('accounts' => array());
		$this->game['game_desc'] = array('hashtags' => array());
		
		for($i=0;$i<IS_ACCOUNT_COUNT;$i++){
			$this->game['game_desc']['accounts'][$i]['id'] = constant('IS_ACCOUNT_ID'.($i+1));
			$this->game['game_desc']['accounts'][$i]['label'] = constant('IS_ACCOUNT_LABEL'.($i+1));
		}
		
		for($i=0;$i<IS_HASHTAG_COUNT;$i++){
			$this->game['game_desc']['hashtags'][$i] = constant('IS_HASHTAG_ID'.($i+1));
		}
	}
	
	public function get_actions($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('is_connection', 'game_desc', 'actions')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['is_connection'], 'req_args' => array('client_id','client_secret')));
		if(Core::has_error($result))
			return $result;
		

		if(in_array('follows', $options['actions']))
			$resultF = $this->get_follows($options);
		
		if(in_array('hashtags', $options['actions']))
			$resultH = $this->get_hashtags($options);
		
		if(in_array('hashtags_user', $options['actions']))
			$resultHU = $this->get_hashtags_user($options);
		
		if(Core::has_error($resultF))
			return $resultF;
		if(Core::has_error($resultH))
			return $resultH;
		if(Core::has_error($resultHU))
			return $resultHU;
		
		return true;
	}
	
	
	//DONE
	protected function init_scrape($options=array()){
		/*Arguments:
			scraper_slug:
			game_desc: array(
				'actions' => array(array('id' => '', 'screen_name' => ''))
				'hashtags' => array('') 
			)
			is_account: array('client_id' => '', 'client_secret' => '')
		*/
		$this->scrape = new stdClass();
		
		$this->scrape->is_media = $options['game_desc'];
		$this->scrape->is_app = $options['is_connection'];
		$this->scrape->slug = $options['scraper_slug'];
		
		//TODO: Get all the accounts twitter id
		$is_accounts = $this->find_accounts();
		if(!is_array($is_accounts))
			return false;

		foreach($is_accounts as $is_account){
			$this->scrape->is_accounts[$is_account['s_user_id']] = $is_account;
			$this->scrape->is_accnts_ids[] = $is_account['s_user_id'];
		}
		
		$this->hashtags = array();
		foreach($this->scrape->is_media['hashtags'] as $hashtag){
			$this->hashtags[] = $hashtag;
		}
	
		//TODO: Add way to limit the call to the function by introducing lock
		$this->option = new Options();
		
		$last_run_from_db = $this->option->get_last_run($options);
		if($last_run_from_db){
			$this->scrape->last_run = $last_run_from_db;
		}else{
			$this->scrape->last_run = $this->start;
		}
		
		if($this->option->is_scraper_locked($options))
			return false;
		$this->option->lock_scraper($options);
	
		$this->scrape->actions_new = array();
	
	
		return true;
	}
	
	//DONE
	protected function finalize_scrape($options=array()) {
		//TODO: Set the time of last run
		$this->option->unlock_scraper($options);
		$this->option->set_last_run($options);
	}
	
	//DONE
	// Scrape for account follows
	public function get_follows($options) {
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('accounts')));
		if(Core::has_error($result))
			return $result;
		
		$curr_slug = 'instagramFollowAccount';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		// Initialize HTTP Socket for requests
		$curl_provider = new Curl_Provider(array('host_url' => 'https://api.instagram.com/v1/'));
	
		if(count($this->scrape->is_accounts) > 0){
			// For each Twitter Hashtag, iterate through possible activities
			foreach($this->scrape->is_media['accounts'] as $account) {
				$followedUsers = array();
				$count = 5;
				$url = sprintf('https://api.instagram.com/v1/users/%s/followed-by', strtolower($account['id']));
				
				do {
					$tagRequest = $curl_provider->http($url, 'GET', array(
							'client_id' => $this->scrape->is_app['client_id'],
							'client_secret' => $this->scrape->is_app['client_secret']
					));
					
					if($curl_provider->get_http_code() != 200) {
						//TODO: 'Error (Instagram Tagged Photos): Response error. Exception info: %s', print_r($tagRequest, true)), 'scrape');
						break;
					}
					
					$instagramUsers = json_decode($tagRequest);
					
					$followedUsers = array_merge($followedUsers, $instagramUsers->data);
					// If there is no next URL, break the loop
					if(!isset($instagramUsers->pagination->next_url)) {
						break;
					}
					//TODO: Test the use of theos API when we have more than 1 page
					$url = $instagramUsers->pagination->next_url;
					$count--;
					
				} while($count > 1);
				
				// For each found tagged photo
				foreach($followedUsers as $taggedPhoto) {
					// Check if the Instagram User ID is in the system
					if(array_key_exists($taggedPhoto->id, $this->scrape->is_accounts)) {
						// Check if the Instagram user ID is already in the logs for this activity
						$platform_user_id = $taggedPhoto->id;
						if(isset($this->scrape->is_accounts[$platform_user_id])){
							$this->actions_new[] = array(
									'user_id' => $this->scrape->is_accounts[$platform_user_id]['user_id'],
									'activity_slug' => $curr_slug,
									'object_id' => $account['id'],
									'sv_user_id' => $platform_user_id,
									'game_obj_id' => $account['label']
							);
						}
					}
				}
				
			}
			
		}
	
		$this->finalize_scrape($options);
		
		return true;
	}
	
	public function get_hashtags_user($options=array()) {
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('hashtags')));
		if(Core::has_error($result))
			return $result;
	
		$curr_slug = 'instagramTagPhoto';
		$options['scraper_slug'] = $curr_slug;
	
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
	
		if($this->start > time())
			return false;
	
	
		// For each Twitter Hashtag, iterate through possible activities
		//TODO: Retrive all tweets from "DATE"
		$curl_provider = new Curl_Provider(array('host_url' => 'https://api.instagram.com/v1/'));
		foreach($this->scrape->is_accounts as $account) {
			
			$url = sprintf('https://api.instagram.com/v1/users/%d/media/recent',$account['s_user_id']);

			$get_hashes = $curl_provider->http($url, 'GET', array(
						'access_token' => $account['access_token'],
						'min_timestamp' => $this->start
					));
			
			$get_hashes = json_decode($get_hashes);
			
			if(is_array($get_hashes->data)) {
				foreach($get_hashes->data as $obj_tag) {
					//id_str = $object_id
					//text

					if( isset($obj_tag->tags) ) {
						
						$tags = array();
						foreach($obj_tag->tags as $tag_name){
							$tags[] = strtolower($tag_name);
						}
						
						foreach($this->hashtags as $hashtag){
		
							if( in_array( strtolower($hashtag) , $tags) ){
		
								$this->actions_new[] = array(
										'user_id' => $account['user_id'],
										'activity_slug' => $curr_slug,
										'object_id' => $obj_tag->id,
										'sv_user_id' => $account['s_user_id'],
										'game_obj_id' => $hashtag
								);
									
							}
		
						}
						
					}
						
				}
			}
		}
	
		//var_dump($this->actions_new);
		$this->finalize_scrape($options);
	
		return true;
	}
	
	// Scrape for tweet hashtags
	public function get_hashtags($options=array()) {
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('hashtags')));
		if(Core::has_error($result))
			return $result;
		
		$curr_slug = 'instagramTagPhoto';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		$curl_provider = new Curl_Provider(array('host_url' => 'https://api.instagram.com/v1/'));
	
		// For each Twitter Hashtag, iterate through possible activities
		foreach($this->scrape->is_media['hashtags'] as $tag) {
			$taggedPhotos = array();
			$count = 5;
			$url = sprintf('https://api.instagram.com/v1/tags/%s/media/recent', strtolower($tag));
			
			do {
				$tagRequest = $curl_provider->http($url, 'GET', array(
						'client_id' => $this->scrape->is_app['client_id'],
						'client_secret' => $this->scrape->is_app['client_secret']
				));
				
				if($curl_provider->get_http_code() != 200) {
					//TODO: 'Error (Instagram Tagged Photos): Response error. Exception info: %s', print_r($tagRequest, true)), 'scrape');
					break;
				}
				
				$instagramTagged = json_decode($tagRequest);
				$taggedPhotos = array_merge($taggedPhotos, $instagramTagged->data);
				// If there is no next URL, break the loop
				if(!isset($instagramTagged->pagination->next_url)) {
					break;
				}
				$url = $instagramTagged->pagination->next_url;
				$count--;
				
			} while($count > 1);
			
			// For each found tagged photo
			$photo_ids = array();
			foreach($taggedPhotos as $taggedPhoto) {
				// Check if the Instagram User ID is in the system
				if(array_key_exists($taggedPhoto->user->id, $this->scrape->is_accounts)) {
					// Check if the Instagram user ID is already in the logs for this activity
					$object_id = $taggedPhoto->id;
					$platform_user_id = $taggedPhoto->user->id;
					if(!in_array($taggedPhoto->id,$photo_ids)){
						$photo_ids[] = $taggedPhoto->id;
						$this->actions_new[] = array(
								'user_id' => $this->scrape->is_accounts[$platform_user_id]['user_id'],
								'activity_slug' => $curr_slug,
								'object_id' => $object_id,
								'sv_user_id' => $platform_user_id,
								'game_obj_id' => ''
						);
					}
					
				}
			}
			
		}
	
		$this->finalize_scrape($options);
		
		return true;

	}
	
	
	
	
	public function get_login_url($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('is_connection', 'redirect_url')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['is_connection'], 'req_args' => array('client_id','client_secret')));
		if(Core::has_error($result))
			return $result;
		
		$url = sprintf(
            'https://api.instagram.com/oauth/authorize/?client_id=%s&redirect_uri=%s&response_type=code',
                $options['is_connection']['client_id'],
                urlencode($options['redirect_url'])
        );
		
		return $url;
	}
	
	public function login_user($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('is_connection', 'redirect_url', 'user_id')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['is_connection'], 'req_args' => array('client_id','client_secret')));
		if(Core::has_error($result))
			return $result;
		
		$requestData = $_REQUEST;
		
		//TODO: add the value for user id into the redirect url to confirm that the user logged in and the user requesting the auth are the same
		if(!isset($requestData['code'])) {
			return Core::error($this->errors, 1);
		}
		
		$curl_provider = new Curl_Provider(array('host_url' => 'https://api.instagram.com/v1/'));
		$request_body = $curl_provider->http('https://api.instagram.com/oauth/access_token', 'POST', array(
				'grant_type' => 'authorization_code',
				'client_id' => $options['is_connection']['client_id'],
				'client_secret' => $options['is_connection']['client_secret'],
				'redirect_uri' => $options['redirect_url'],
            	'code' => $requestData['code']
			)
		);
		
		$request_obj = json_decode($request_body);
		if(!isset($request_obj->user)) {
			return Core::error($this->errors, 2);
		}
		
		$instagramUser = $request_obj->user;
		if( !isset($instagramUser->id) || !isset($instagramUser->username) || !isset($request_obj->access_token) ) {
			return Core::error($this->errors, 3);
		}
		
		 
		if($this->has_account(array('user_id' => $options['user_id'] ))){
			//TODO: Report already has account
			return Core::error($this->errors, 5);
		}
		
		$is_account = array(
				'user_id' => $options['user_id'],
				'instagram_user_id' => $instagramUser->id,
				'instagram_username' => $instagramUser->username,
				'access_token' => $request_obj->access_token
		);
		if(!$this->create_account($is_account)) {
			//TODO: Failed saving account
			return Core::error($this->errors, 6);
		}
		
		return true;
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
	
	public function create_account($options=array()){
		$inputs['user_info'] = array(
			'user_id' => intval($options['user_id']),
			'info_type' => self::ACCOUNT_TYPE,
			'int_info' => $options['instagram_user_id'],
			'info' => $options['instagram_username'],
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