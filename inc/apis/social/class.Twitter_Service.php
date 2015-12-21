<?php
require_once('class.Social_Account.php');
require_once(DIR_VENDOR.'/twitteroauth/twitteroauth.php');
require_once('class.Options.php');

class Twitter_Service extends Social_Account{
	
	const ACCOUNT_TYPE = 'tw_account';
	
	protected $errors = array(
		array(
				'error_code' => '1',
				'error_message' => 'Error (Twitter Connect Account): Connection error'
		),
		array(
				'error_code' => '2',
				'error_message' => 'Error (Twitter Connect Account): OAuth error (Token) {DONT MATCH}'
		),
		array(
				'error_code' => '3',
				'error_message' => 'Error (Twitter Connect Account): OAuth error'
		),
		array(
				'error_code' => '4',
				'error_message' => 'Error (Twitter Connect Account): OAuth error (User Info)'
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
				'error_message' => 'Failed retriving access_token'
		),
		array(
				'error_code' => '9',
				'error_message' => 'Failed to initialize the scrapper'
		),
		array(
				'error_code' => '10',
				'error_message' => 'No twitts found'
		)
	);
	
	public function get_connection(){
		return $this->connection;
	}
	
	public function get_game(){
		return $this->game;
	}
	
	public function get_action_names(){
		//return array('actions' => array('follows', 'hashtags'));
		return array('actions' => array('hashtags_user'));
	}
	
	public function __construct(){
		$this->start = strtotime('05/13/2014');
		
		$this->connection = array('tw_connection' => array(
				'consumer_key' => TW_CONSUMER_KEY,
				'consumer_secret' => TW_CONSUMER_SECRET,
				'access_token' => TW_ACCESS_TOKEN,
				'access_token_secret' => TW_ACCESS_TOKEN_SECRET
		));
	
		//$this->game['game_desc'] = array('accounts' => array());
		$this->game['game_desc'] = array('hashtags' => array());
	
		for($i=0;$i<TW_ACCOUNT_COUNT;$i++){
			$this->game['game_desc']['accounts'][$i]['id'] = constant('TW_ACCOUNT_ID'.($i+1));
			$this->game['game_desc']['accounts'][$i]['screen_name'] = constant('TW_ACCOUNT_NAME'.($i+1));
			$this->game['game_desc']['accounts'][$i]['label'] = constant('TW_ACCOUNT_LABEL'.($i+1));
		}
	
		for($i=0;$i<TW_HASHTAG_COUNT;$i++){
			$this->game['game_desc']['hashtags'][$i]['hashtag'] = constant('TW_HASHTAG_ID'.($i+1));
			$this->game['game_desc']['hashtags'][$i]['hashtag_label'] = constant('TW_HASHTAG_LABEL'.($i+1));
		}
	}
	
	public function get_actions($options=array()){
		/*
		 * 
		'tw_connection' => array(
			'consumer_key'
			'consumer_secret'
			'access_token'
			'access_token_secret'
		) Responsible for the initialization of the twitter connection
		'game_desc' => array(
			'actions' => array(
				array('id' => '', 'screen_name' =>)		
			)
			'hashtags' => array('')	
		) Describes all gamo elements that we expect to track, there must be some to call the get_actions
		 */
		

		//We must have tw_connection 
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('tw_connection', 'game_desc', 'actions')));
		if(Core::has_error($result))
			return $result;

		$result = Social::ch_args(array('options' => $options['tw_connection'], 'req_args' => array('consumer_key','consumer_secret','access_token','access_token_secret')));
		if(Core::has_error($result))
			return $result;

		//NOTE: actions relate to get functions that are available in the API, some get functions retrive data for more than one action type
		//reason is that we can place one single http code to retrieve two different types of actions - thus one function
		if(in_array('follows', $options['actions']))
			$resultF = $this->get_follows($options);
		
		if(in_array('hashtags', $options['actions']))
			$resultH = $this->get_hashtags($options);
		
		if(in_array('hashtags_world', $options['actions']))
			$resultHW = $this->get_world_hashtags($options);
		
		if(in_array('hashtags_user', $options['actions']))
			$resultHU = $this->get_hashtags_user($options);
		
		if(in_array('links_user', $options['actions']))
			$resultLU = $this->get_shared_links_user($options);
		
		if(Core::has_error($resultF))
			return $resultF;
		if(Core::has_error($resultH))
			return $resultH;
		if(Core::has_error($resultHW))
			return $resultHW;
		if(Core::has_error($resultHU))
			return $resultHU;
		if(Core::has_error($resultLU))
			return $resultLU;
		
		return true;
	}
	
	public function get_shared_links_user($options=array()) {
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('hashtags')));
		if(Core::has_error($result))
			return $result;
	
		$curr_slug = 'twitterTweetHashtag';
		$options['scraper_slug'] = $curr_slug;
	
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
	
		if($this->start > time())
			return false;
	
	
		// For each Twitter Hashtag, iterate through possible activities
		//TODO: Retrive all tweets from "DATE"
		foreach($this->scrape->tw_accounts as $account) {
			;
			$cursor = -1;
	
			do {
				$get_hashes = $this->scrape->tw_connection->get('statuses/user_timeline',
						array(
								'user_id' => $account['s_user_id'],
								'cursor' => $cursor,
								'since_id' => $this->start,
								'exclude_replies' => true,
								'include_rts ' => false
						));
	
				//var_dump($get_hashes);
	
				foreach($get_hashes as $obj_tag){
					//id_str = $object_id
					//text
					foreach($this->hashtags as $hashtag){
	
						if( isset($obj_tag->entities->urls[0]->display_url) ){
	
							if( strpos( strtolower($obj_tag->entities->urls[0]->display_url), strtolower( $hashtag['hashtag'] ) ) !== false  ){
								//http://gearupgame.anyplaceworkspace.com
	
								$this->actions_new[] = array(
										'user_id' => $account['user_id'],
										'activity_slug' => $curr_slug,
										'object_id' => $obj_tag->id_str,
										'sv_user_id' => $account['s_user_id'],
										'game_obj_id' => $hashtag['hashtag_label']
								);
									
							}else{
								//var_dump($obj_tag->text,$hashtag['hashtag']);
							}
	
						}else{
							//var_dump($obj_tag);
						}
	
					}
	
				}
	
				$cursor = isset($get_hashes->next_cursor) ? $get_hashes->next_cursor : 0;
	
			} while ($cursor != 0);
	
		}
	
		//var_dump($this->actions_new);
		$this->finalize_scrape($options);
	
		return true;
	}
	
	public function get_hashtags_user($options=array()) {
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('hashtags')));
		if(Core::has_error($result))
			return $result;
	
		$curr_slug = 'twitterTweetHashtag';
		$options['scraper_slug'] = $curr_slug;
	
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
	
		if($this->start > time())
			return false;
	
	
		// For each Twitter Hashtag, iterate through possible activities
		//TODO: Retrive all tweets from "DATE"
		foreach($this->scrape->tw_accounts as $account) {
			;
			$cursor = -1;
				
			do {
				$get_hashes = $this->scrape->tw_connection->get('statuses/user_timeline',
						array(
								'user_id' => $account['s_user_id'],
								'screen_name' => $account['username'],
								'cursor' => $cursor,
								'since_id' => $this->start,
								'exclude_replies' => true,
								'include_rts ' => false
						));
				
				//var_dump($get_hashes);
	
				foreach($get_hashes as $obj_tag){
					//id_str = $object_id
					//text
					foreach($this->hashtags as $hashtag){
	
						if( isset($obj_tag->text) ){
						
							if( strpos( strtolower($obj_tag->text), strtolower( $hashtag['hashtag'] ) ) !== false  ){
								//http://gearupgame.anyplaceworkspace.com
		
								$this->actions_new[] = array(
										'user_id' => $account['user_id'],
										'activity_slug' => $curr_slug,
										'object_id' => $obj_tag->id_str,
										'sv_user_id' => $account['s_user_id'],
										'game_obj_id' => $hashtag['hashtag_label']
								);
									
							}else{
								//var_dump($obj_tag->text,$hashtag['hashtag']);
							}
						
						}else{
							//var_dump($obj_tag);
						}
	
					}
						
				}
	
				$cursor = isset($get_hashes->next_cursor) ? $get_hashes->next_cursor : 0;
	
			} while ($cursor != 0);
				
		}
	
		//var_dump($this->actions_new);
		$this->finalize_scrape($options);
	
		return true;
	}
	
	//DONE
	protected function init_scrape($options=array()){
		/*Arguments:
			scraper_slug:
			game_desc: array(
				'actions' => array(array('id' => '', 'screen_name' => ''))
				'hashtags' => array('') 
			)'twitterFollowAccount'
			tw_connection: array('consumer_key' => '', 'consumer_secret' => '', 'access_token' => '', 'access_token_secret' => '')
		*/
		$this->scrape = new stdClass();
		$this->scrape->tw_connection = new TwitterOAuth(
				$options['tw_connection']['consumer_key'],
				$options['tw_connection']['consumer_secret'],
				$options['tw_connection']['access_token'],
				$options['tw_connection']['access_token_secret']
		);
		
		$this->scrape->tw_media = $options['game_desc'];
		$this->scrape->slug = $options['scraper_slug'];
		
		$tw_accounts = $this->find_accounts();
		if(!is_array($tw_accounts))
			return false;
		
		foreach($tw_accounts as $tw_account){
			$this->scrape->tw_accounts[$tw_account['s_user_id']] = $tw_account;
			$this->scrape->tw_accnts_ids[] = $tw_account['s_user_id'];
		}
		
		$this->hashtags = array();
		foreach($this->scrape->tw_media['hashtags'] as $hashtag){
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
		
		$this->option->unlock_scraper($options);
		if($this->option->is_scraper_locked($options))
			return false;
		$this->option->lock_scraper($options);
	
	
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
		
		foreach($options['game_desc']['accounts'] as $account){
			$result = Social::ch_args(array('options' => $account, 'req_args' => array('id', 'screen_name')));
			if(Core::has_error($result))
				return $result;
		}
		
		
		$curr_slug = 'twitterFollowAccount';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		if(count($this->scrape->tw_accounts) > 0){
		
			foreach($this->scrape->tw_media['accounts'] as $account) {
				$followers = array();
				$cursor = -1;
				$object_id = $account['id'];
				// Get all followers for an account
				do {
					$getFollowers = $this->scrape->tw_connection->get('followers/ids', array('user_id' => $object_id, 'cursor' => $cursor));
					$followers = array_merge($followers, $getFollowers->ids);
					$cursor = $getFollowers->next_cursor;
				} while($cursor != 0);
				
				//TODO: Replace the $userFollowers witht thwe below
				//$twitterAccountIDs = array_flip($this->scrape->platformAccounts);
				//$userFollowers = array_intersect($twitterAccountIDs, $followers);
				
				$userFollowers = $followers;
				
				foreach($userFollowers as $user_id => $platform_user_id) {
					if(isset($this->scrape->tw_accounts[$platform_user_id])){
						$this->actions_new[] = array(
								'user_id' => $this->scrape->tw_accounts[$platform_user_id]['user_id'],
								'activity_slug' => $curr_slug,
								'object_id' => $object_id,
								'sv_user_id' => $platform_user_id,
								'game_obj_id' => $account['label']
						);
					}
				}
			}
		}
	
		$this->finalize_scrape($options);
		return true;
	}
	
	//DONE
	// Scrape for tweet hashtags11
	public function get_hashtags($options=array()) {
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('hashtags')));
		if(Core::has_error($result))
			return $result;
		
		$curr_slug = 'twitterTweetHashtag';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
	
		// For each Twitter Hashtag, iterate through possible activities
	foreach($this->scrape->tw_media['hashtags'] as $hashtag) {
			$all_tweets = array();
			$url = 'http://search.twitter.com/search.json';
			$next_page = "?until=".date("Y-m-d")."&result_type=recent&rpp=100&q=%23{$hashtag}%20since:".date("Y-m-d",strtotime('-1 day'))."-filter:retweets";
			
			do {
				
				$tweets = json_decode(file_get_contents($url.$next_page));
				if(isset($tweets->results) and !empty($tweets->results))
					$all_tweets = array_merge($all_tweets, $tweets->results);
				
				if(isset($tweets->next_page)) $next_page = $tweets->next_page;
				
			} while(isset($tweets->next_page));

			if(empty($all_tweets)) break;

			foreach($all_tweets as $tweet) {
				// Check if the Twitter User ID is in the system
				//TODO: mod replace the $this->scrape->platformAccounts with twiter_is array
				if(array_key_exists($tweet->from_user_id, $this->scrape->tw_accounts)) {
					$object_id = $tweet->id;
					$platform_user_id = $tweet->from_user_id;
					// Check if the Twitter user ID is already in the logs for this activity
					$this->actions_new[] = array(
							'user_id' => $this->scrape->tw_accounts[$platform_user_id]['user_id'],
							'activity_slug' => $curr_slug,
							'object_id' => $object_id,
							'sv_user_id' => $platform_user_id,
							'game_obj_id' => $hashtag
					);
				}
			}

		}
	
		$this->finalize_scrape($options);
		
		return true;
	}
	
	public function get_world_hashtags($options=array()){
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('hashtags')));
		if(Core::has_error($result))
			return $result;
		
		
		$curr_slug = 'twitterTweetHashtag';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		// For each Twitter Hashtag, iterate through possible activities
		$url = 'http://search.twitter.com/search.json';
		foreach($this->scrape->tw_media['hashtags'] as $hashtag) {
			$tweets = array();
			$str = $url."?rpp=100&q=%23{$hashtag}%20since:".date('Y-m-d',$this->scrape->last_run)."-filter:retweets";
			
			do{
				$tweets_temp = json_decode(file_get_contents($str));
				$tweets = array_merge($tweets, $tweets_temp->results);
				if(isset($tweets_temp->next_page)) $str = $url.$tweets_temp->next_page;
			}
			while(isset($tweets_temp->next_page));
			
			if(empty($tweets)) {
				//TODO: Report the error No tweerts results
				$this->finalize_scrape($options);
				return Core::error($this->errors, 10);
			} else {
				
				$sql = "SELECT `unique` FROM ".GAMO_DB.".`tweets`";

				global $dbh;
				$stm = $dbh->prepare($sql);
				$stm->execute();
				$unique = $stm->fetchAll(PDO::FETCH_NUM);
				$ids = array();

				if(!empty($unique)){
					foreach($unique as $id){
						$ids[] = $id[0];
					}
				}

				foreach($tweets as $tweet) {
				
					//Make sure that we save all that are unique
					if(!in_array($tweet->id, $ids)) {
						$unique_id = $tweet->id;
						$handle = $tweet->from_user;
						$created = strtotime($tweet->created_at);
						
						if(!empty($unique_id) and !empty($handle) and !empty($created)){
							$sql_u = "INSERT INTO ".GAMO_DB.".`tweets` (`handle`, `unique`, `created`) VALUES (:handle, :unique, :created)";
							$stm = $dbh->prepare($sql_u);
							$stm->execute(array(':handle' => $handle, ':unique' => $unique_id, ':created' => date('Y-m-d H:i:s' ,$created)));
						}
					}
					
					
					
				}
			}
		}
		
		$this->finalize_scrape($options);
		
		return true;
	}
	
	public function get_login_url($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('tw_connection', 'redirect_url')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['tw_connection'], 'req_args' => array('consumer_key','consumer_secret','access_token','access_token_secret')));
		if(Core::has_error($result))
			return $result;
		
		global $session;
		/*Arguments: 
		 * redirect_url
		*/
		
		$twitterConnection = new TwitterOAuth(
				$options['tw_connection']['consumer_key'],
				$options['tw_connection']['consumer_secret']
		);
		
		$twitterRequestToken = $twitterConnection->getRequestToken($options['redirect_url']);
		$session->set('TwitterRequestToken', $twitterRequestToken);
		
		if($twitterConnection->http_code != 200) {
			return Core::error($this->errors, 8);
		}
		
		return $twitterConnection->getAuthorizeURL($twitterRequestToken['oauth_token']);
	}
	
	/**
	 * 
	 * @param array $options array('tw_connection' => array('consumer_key' => '','consumer_secret' => '','access_token' => '','access_token_secret' => '') , 
	 * 					'user_id' => '')
	 * @return mixed array|bool True if success. Array('error_code' => '', 'error_message' => '')
	 */
	public function login_user($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('tw_connection', 'user_id')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['tw_connection'], 'req_args' => array('consumer_key','consumer_secret','access_token','access_token_secret')));
		if(Core::has_error($result))
			return $result;
		
		global $session;
		$requestData = $_REQUEST;
		$old_request_data = json_decode($session->get('TwitterRequestToken'),true);
		if(isset($requestData['denied'])) {
			//TODO: Error (Twitter Connect Account): Connection error
			return Core::error($this->errors, 1);
		}
		
		if(isset($requestData['oauth_token']) && $old_request_data['oauth_token'] !== $requestData['oauth_token']) {
			//TODO: Error (Twitter Connect Account): OAuth error (Token) {DONT MATCH}
			return Core::error($this->errors, 2);
		}
		$twitterConnection = new TwitterOAuth(
				$options['tw_connection']['consumer_key'],
				$options['tw_connection']['consumer_secret'],
				$old_request_data['oauth_token'],
				$old_request_data['oauth_token_secret']
		);
		$session->remove('TwitterRequestToken');
		$twitterAccessToken = $twitterConnection->getAccessToken($requestData['oauth_verifier']);
		if($twitterConnection->http_code != 200) {
			//TODO: Error (Twitter Connect Account): OAuth error 
			return Core::error($this->errors, 3);
		}

		if(!isset($twitterAccessToken['user_id']) || !isset($twitterAccessToken['screen_name'])) {
			//TODO: 'Error (Twitter Connect Account): OAuth error (User Info)
			return Core::error($this->errors, 4);
		}
		
		if($this->has_account(array('user_id' => $options['user_id'] ))){
			//TODO: Report already has account
			return Core::error($this->errors, 5);
		}
		
		$twitterAccount = array(
				'user_id' => $options['user_id'],
				'twitter_user_id' => $twitterAccessToken['user_id'],
				'twitter_screen_name' => $twitterAccessToken['screen_name'],
				'access_token' => $twitterAccessToken['oauth_token'].":%:".$twitterAccessToken['oauth_token_secret']
		);
		if(!$this->create_account($twitterAccount)) {
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
			'int_info' => $options['twitter_user_id'],
			'info' => $options['twitter_screen_name'],
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