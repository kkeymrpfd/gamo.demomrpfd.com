<?php
require_once('class.Social_Account.php');
require_once(DIR_VENDOR.'/google-service/Google_Client.php');
require_once(DIR_VENDOR.'/google-service/contrib/Google_YouTubeService.php');
require_once(DIR_VENDOR.'/google-service/contrib/Google_Oauth2Service.php');
require_once(DIR_VENDOR.'/Zend/Loader.php');
require_once('class.Options.php');

$old_path = get_include_path();
set_include_path(DIR_VENDOR.PATH_SEPARATOR.$old_path);

class Youtube_Service extends Social_Account{
	const ACCOUNT_TYPE = 'yt_account';
	
	protected $scrape;
	protected $option;
	protected $fb_accounts;
	protected $connection;
	protected $game;
	protected $redirect_url;
	
	protected $errors = array(
			array(
					'error_code' => '1',
					'error_message' => 'Zend_HttpException occured'
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
					'error_message' => ''
			),
			array(
					'error_code' => '5',
					'error_message' => 'Already has account'
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
		return array('actions' => array('channel_subscriptions', 'favorites'));
	}
	
	public function get_redirect_url(){
		return $this->redirect_url;
	}
	
	public function __construct(){
		$this->start = strtotime('04/12/2013');
		
		$this->connection = array('yt_connection' => array(
				'app_id' => YT_CLIENT_ID,
				'app_secret' => YT_CLIENT_SECRET
		));
		
		$this->game['game_desc'] = array('pages' => array());
		for($i=0;$i<YT_SUBSCRIPTION_COUNT;$i++){
			$this->game['game_desc']['pages'][$i]['id'] = constant('YT_SUBSCRIPTION_ID'.($i+1));
			$this->game['game_desc']['pages'][$i]['name'] = constant('YT_SUBSCRIPTION_NAME'.($i+1));
			$this->game['game_desc']['pages'][$i]['label'] = constant('YT_SUBSCRIPTION_LABEL'.($i+1));
		}
		
		$this->redirect_url = YT_REDIRECT_URL;
		
		Zend_Loader::loadClass('Zend_Gdata_AuthSub');
		Zend_Loader::loadClass('Zend_Gdata_YouTube');
		
	}
	
	public function get_login_url($options=array()){
		
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('yt_connection', 'redirect_url')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['yt_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		
		$client = new Google_Client();
		$client->setScopes(array('http://gdata.youtube.com', 'https://www.googleapis.com/auth/userinfo.profile'));
		$url = $client->createAuthUrl();
		error_log(print_r($url,true));
		
		return $url;

	}
	
	public function get_actions($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('yt_connection', 'game_desc', 'actions')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['yt_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		
		if(in_array('channel_subscriptions', $options['actions']))
			$resultS = $this->get_subscriptions($options);
		
		if(in_array('favorites', $options['actions']))
			$resultF = $this->get_favorites($options);
		
		if(Core::has_error($resultS))
			return $resultS;
		
		if(Core::has_error($resultF))
			return $resultF;
		
		return true;
	}
	
	public function get_subscriptions($options=array()){
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('pages')));
		if(Core::has_error($result))
			return $result;
		
		foreach($options['game_desc']['pages'] as $page){
			$result = Social::ch_args(array('options' => $page, 'req_args' => array('id', 'name', 'label')));
			if(Core::has_error($result))
				return $result;
		}
		
		$curr_slug = 'scraperYoutubeFollowAccount';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		// For each Facebook Page, iterate through possible activities
		$act_slug = 'youtubeSubscribeChannel';
		
		foreach($this->scrape->yt_media['pages'] as $page) {
			$object_id = $page['id'];
				
			// Iterate through each Facebook user
			foreach($this->scrape->yt_accounts as $facebookAccount) {
				$platform_user_id = $facebookAccount['s_user_id'];
				$user_id = $facebookAccount['user_id'];
				
				try{
					$httpClient = Zend_Gdata_AuthSub::getHttpClient($facebookAccount['access_token']);
				
					$yt = new Zend_Gdata_YouTube($httpClient);
					$yt->setMajorProtocolVersion(2);
					$subFeed = $yt->getSubscriptionFeed('default');
		
					foreach($subFeed as $subEntry){
						$subType = null;
						
						$categories = $subEntry->getCategory();
						foreach($categories as $category){
							if($category->getScheme() == 'http://gdata.youtube.com/schemas/2007/subscriptiontypes.cat'){
								$subType = $category->getTerm();
							}
						}

						switch($subType){
							case 'channel':
							case 'user':
								$channel = $subEntry->getUsername()->text;

								if( strtolower($channel) == strtolower($page['name'])){
									$this->actions_new[] = array(
											'user_id' => $user_id,
											'activity_slug' => $act_slug,
											'object_id' => $channel,
											'sv_user_id' => $facebookAccount['s_user_id'],
											'game_obj_id' => $page['label']
									);
								}
								break;
						}
					}
					
				}catch(Exception $e){
					error_log($e->getMessage());
					return Core::error($this->errors, 1);
				}
				
			}
		}
			
		$this->finalize_scrape($options);
		
		return true;
			
	}
	
	public function get_favorites($options=array()){
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('pages')));
		if(Core::has_error($result))
			return $result;
		
		foreach($options['game_desc']['pages'] as $page){
			$result = Social::ch_args(array('options' => $page, 'req_args' => array('id', 'name', 'label')));
			if(Core::has_error($result))
				return $result;
		}
		
		$curr_slug = 'scraperYoutubeFavorite';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		// For each Facebook Page, iterate through possible activities
		$act_slug = 'youtubeFavoriteVideo';
		
		foreach($this->scrape->yt_media['pages'] as $page) {
			$object_id = $page['id'];
		
			// Iterate through each Facebook user
			foreach($this->scrape->yt_accounts as $facebookAccount) {
				$platform_user_id = $facebookAccount['s_user_id'];
				$user_id = $facebookAccount['user_id'];
		
				try{
					//$httpClient = Zend_Gdata_AuthSub::getHttpClient($facebookAccount['access_token']);
		
					//$yt = new Zend_Gdata_YouTube($httpClient);
					//$yt->setMajorProtocolVersion(2);
					//$favoritesFeed = $yt->getUserFavorites('default');
					
					foreach($favoritesFeed as $favorite){
						$channel_name = $favorite->getMediaGroup()->getMediaCredit()->getText();
						$vid = $favorite->getVideoId();
						
						if( strtolower($channel_name) == strtolower($page['name'])){
							$this->actions_new[] = array(
									'user_id' => $user_id,
									'activity_slug' => $act_slug,
									'object_id' => $channel_name.$vid,
									'sv_user_id' => $facebookAccount['s_user_id'],
									'game_obj_id' => $page['label']
							);
						}
					}
					
						
				}catch(Exception $e){
					error_log($e->getMessage());
					return Core::error($this->errors, 1);
				}
		
			}
		}
			
		$this->finalize_scrape($options);
		
		return true;
	}
	
	protected function init_scrape($options=array()){
		
		$this->scrape = new stdClass();
		
		
		//TODO: Make sure that we init it so it can be used adequately
		//$this->scrape->yt;
		
		
		
		$this->scrape->yt_media = $options['game_desc'];
		$this->scrape->slug = $options['scraper_slug'];
		$this->scrape->yt_accounts = $this->find_accounts();
		$this->scrape->yt_user_ids = array();
		
		if( !is_array($this->scrape->yt_accounts) ){
			echo "No Accounts";
			return false;
		}
		
		foreach($this->scrape->yt_accounts as $fb_account){
			$this->scrape->yt_user_ids[] = $fb_account['s_user_id'];
		}

		$this->option = new Options();
		
		//TODO: Set the scraper to select to either get all from last run or get all from predefined time in the past (last must be configurabel)
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
	
	public function login_user($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('yt_connection', 'user_id', 'yt_token')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['yt_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		
		if($this->has_account(array('user_id' => $options['user_id'] ))) {
			return Core::error($this->errors, 5);
		}
		
	
		
		try{
			$client = new Google_Client();
			$outh2user = new Google_Oauth2Service($client);
			$client->authenticate($options['yt_token']);
			
			$token = $client->getAccessToken();
			$user_info = $outh2user->userinfo->get();

		}catch(Exception $e){
			error_log($e->getMessage());
			return Core::error($this->errors, 1);
		}
		
		$account = array(
				'user_id' => $options['user_id'],
				'youtube_user_id' => $user_info['id'],
				'youtube_username' => $user_info['name'],
				'access_token' => $token
		);
		
		if(!$this->create_account($account)) {
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
				'int_info' => $options['youtube_user_id'],
				'info' => $options['youtube_username'],
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