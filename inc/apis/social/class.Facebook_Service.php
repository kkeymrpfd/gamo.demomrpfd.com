<?php
/*
 * Responsible for Facebook related functionality. To obtain the authentication tokens to be able to retrive user activities 
 * controller needs to get the facebook url to authenticate the user. The authentication process is not based on the user providing 
 * the password, but by logging in on the facebook page facebook redirects back to the caller. The redirect url need to be given.
 * 
 * User perspective: User gets on the site and signs in to the facebook account, during this process security/authorization data is provided to the library
 * through login_user(). This authorization data will be used to see user activitieds in relation to graph API elements ex: facebook graph API root node ID
 * of the client.
 */
require_once('class.Social_Account.php');
require_once(DIR_VENDOR.'/facebook-php-sdk/src/Facebook.php');
require_once('class.Options.php');

class Facebook_Service extends Social_Account{
	
	const WEEK = 604800;
	const MONTH = 2592000;

	
	const ACCOUNT_TYPE = 'fb_account';
	
	protected $errors = array(
			array(
					'error_code' => '1',
					'error_message' => 'Error (Facebook Connect Account): User profile error'
			),
			array(
					'error_code' => '2',
					'error_message' => 'Error (Facebook Connect Account): User access token error'
			),
			array(
					'error_code' => '3',
					'error_message' => 'Error (Facebook Page User Posts): Facebook Exception'
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
	
	protected $actions_new = array();
	
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
	
	protected $current_slug = '';
	
	protected $current_action_slugs = array();
	
	
	
	
	
	public function get_connection(){
		return $this->connection;
	}
	
	public function get_options(){
		return $this->option;
	}
	
	public function get_game(){
		return $this->game;
	}
	
	public function get_new_actions(){
		return $this->actions_new;
	}
	
	
	
	
	public function get_action_names(){
		//return array('actions' => array('shares', 'page_likes', 'likes_comments_wposts'));
		return array('actions' => array('page_likes'));
	}
	
	
	
	public function __construct($options=array()){
		$this->start = strtotime(EVENT_START_TIME);
		
		$this->connection = array('fb_connection' => array(
			'app_id' => FB_APP_ID,
			'app_secret' => FB_SECRET
		));
		
		$this->game['game_desc'] = array('pages' => array());
		for($i=0;$i<FB_PAGE_COUNT;$i++){
			$this->game['game_desc']['pages'][$i]['id'] = constant('FB_PAGE_ID'.($i+1));
			$this->game['game_desc']['pages'][$i]['name'] = constant('FB_PAGE_NAME'.($i+1));
			$this->game['game_desc']['pages'][$i]['label'] = constant('FB_PAGE_LABEL'.($i+1));
		}
		
		if(!empty($options['current_slug'])){
			$this->current_slug = $options['current_slug'];
			
			foreach($this->game['game_desc']['pages'] as $page){
				$this->current_action_slugs[] = $this->current_slug.$page['label'];
			}
		}
		
	}
	
	public function get_action_slugs(){
		return $this->current_action_slugs;
	}
	
	public function get_login_url($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('fb_connection', 'redirect_url')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['fb_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		/*
		Arguments:
		{
			redirec_url: Url which facebook should use to redirect to after successfull login
			fb_connection: array('app_id' => '', 'app_secret' => '')
		}
		Return:
		if successful:DIR_INC . 
		{
		}
		if error:
		{
		}
		*/
		
		//TODO:Check if the user already connected
		$facebook = new Facebook(array('appId' => $options['fb_connection']['app_id'], 'secret' => $options['fb_connection']['app_secret']));
		$facebookLoginUrl = $facebook->getLoginUrl(array(
				'scope' => array('user_likes', 'read_stream'),
				'redirect_uri' => $options['redirect_url']
		));
		return $facebookLoginUrl;
	}
	
	public function get_actions($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('fb_connection', 'game_desc', 'actions')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['fb_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		
		if(in_array('shares', $options['actions']))
			$resultS = $this->get_shares($options);
		//TODO: Modify the actions_new so we return the action type slug so the lib user knows how to assign points base on the action type
		//use action slug for that and scrape slug for the lock name mapping
		//TODO: Mod code to introduce sane error checking
		//TODO: IMPORTANT if the code crashes and the flag was set we NEED find a way to clear it before we crash - or it will be
		//in such a state and no new scraping will occur
		if(in_array('likes_comments_wposts', $options['actions']))
			$resultC = $this->get_likes_comments_wposts($options);
		
		if(in_array('page_likes', $options['actions']))
			$resultP = $this->get_page_likes($options);
		
		if(Core::has_error($resultS))
			return $resultS;
		
		if(Core::has_error($resultC))
			return $resultC;
		
		if(Core::has_error($resultP))
			return $resultP;
		
		return true;
	}
	
	/*
	 * Function to set the data returned during facebook authentication. The facebook API relies on availability of the $_REQUEST[],
	 * thus this must be run in side web server
	 */
	public function login_user($options=array()){
		global $gamo;
		
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('fb_connection', 'user_id')));
		if(Core::has_error($result))
			return $result;
		
		$result = Social::ch_args(array('options' => $options['fb_connection'], 'req_args' => array('app_id','app_secret')));
		if(Core::has_error($result))
			return $result;
		/*
		 Arguments:
		{
		user_id: Id of the user we are doing the authentication for
		}
		Return:
		if successful:
		{
		}
		if error:
		{
		}
		*/
		
		//TODO: Add the type of tokens
		$facebook = new Facebook(array('appId' => $options['fb_connection']['app_id'], 'secret' => $options['fb_connection']['app_secret']));
		$facebookUser = $facebook->getUser();
		try {
			$facebookUserProfile = $facebook->api('/me');
			if(!$facebookUserProfile) {
				return Core::error($this->errors, 1);
			}
			
			$facebook->setExtendedAccessToken();
			$access_token = $facebook->getAccessToken();
			if(empty($access_token)) {
				return Core::error($this->errors, 2);
			}
		} catch (FacebookApiException $e) {
			return Core::error($this->errors, 3);
		}
		
		
		
		if($this->has_account(array('user_id' => $options['user_id'] ))) {
			return Core::error($this->errors, 5);
		}
		
		//TODO: Save the FB account info into the DB
		//var_dump($facebookUserProfile);
		$facebookAccount = array(
			'user_id' => $options['user_id'],
			'facebook_user_id' => $facebookUserProfile['id'],
			'facebook_username' => $facebookUserProfile['username'],
			'access_token' => $access_token
		);
		if(!$this->create_account($facebookAccount)) {
			return Core::error($this->errors, 6);
		}
		
		/*
		$return = $gamo->lib('image')->save_user_image(array(
				'location' => 'http://graph.facebook.com/'.$facebookUserProfile['username'].'/picture?type=large',
				'user_id' => $options['user_id'],
				'dir' => '/www/sites/emcworld/store'
			)
		);
		
		if(Core::has_error($return)){
			error_log(print_r($return,true));
		}
		*/
		
		return true;
	}
	
	public function logoff_user($options=array()){
		$result = Social::ch_args(array('options' => $options, 'req_args' => array('user_id')));
		if(Core::has_error($result))
			return $result;
		/*
		 Arguments:
		{
			user_id: Id of the user we are doing the authentication for
		}
		Return:
		if successful:
		{
		}
		if error:
		{
		}
		*/
		//TODO: Improve the error checking on the code
		if(!$this->delete_account($options)) {
			return Core::error($this->errors, 7);
		}
		
		return true;
	}
	
	public function get_liked_comented_wposts($options=array()){
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('pages')));
		if(Core::has_error($result))
			return $result;
		
		foreach($options['game_desc']['pages'] as $page){
			$result = Social::ch_args(array('options' => $page, 'req_args' => array('id', 'name', 'label')));
			if(Core::has_error($result))
				return $result;
		}
		
		$curr_slug = 'facebookGoodPostsActivities';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		foreach($this->scrape->fb_media['pages']  as $page) {
			try {
				// Get Facebook Page Posts
				$graph_url = sprintf(
						'/%s?fields=feed.since(%d).limit(50).fields(from.since(%d).fields(id),comments.since(%d).limit(200).fields(message,from.fields(id)),likes.since(%d).limit(200).fields(id),type,message)',
						$page['id'],
						$this->start,
						$this->scrape->last_run,
						$this->scrape->last_run,
						$this->scrape->last_run
				);
				$pagePosts = $this->scrape->fb->api($graph_url);
				//var_dump($pagePosts);
				//var_dump($this->scrape->fb_user_ids);
				if(isset($pagePosts['feed']['data'])) {
					foreach($pagePosts['feed']['data'] as $pagePost) {
						$object_id = $this->get_post_id($pagePost['id']);
						//var_dump('COMMENTS',$pagePost['comments']['data']);
						
						if(isset($pagePost['from']['id'])) {
							$act_slug = 'facebookPostWall';
							if(in_array($pagePost['from']['id'], $this->scrape->fb_user_ids)) {
								if( isset($pagePost['comments']['data']) or isset($pagePost['likes']['data']) ){
									$user_id = $this->get_user_id(array('facebook_user_id' => $pagePost['from']['id']));
									$this->actions_new[] = array(
											'user_id' => $user_id,
											'activity_slug' => $act_slug,
											'object_id' => $pagePost['id'],
											'sv_user_id' => $pagePost['from']['id'],
											'game_obj_id' => $page['label']
									);
								}
							}
						
						}
						
					}
				}
			} catch (FacebookApiException $e) {
				//TODO: Log the error
				echo $e->getMessage().' get_likes_comments_posts '.$user_id;
			}
		}
		
		$this->finalize_scrape($options);
		
		return true;
	}

	//scrapePagePostActivities() Like the post, comment on the post
public function get_likes_comments_wposts($options=array()){
	$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('pages')));
	if(Core::has_error($result))
		return $result;
	
	foreach($options['game_desc']['pages'] as $page){
		$result = Social::ch_args(array('options' => $page, 'req_args' => array('id', 'name', 'label')));
		if(Core::has_error($result))
			return $result;
	}
	
		$curr_slug = 'facebookPagePostActivities';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		foreach($this->scrape->fb_media['pages']  as $page) {
			try {
				// Get Facebook Page Posts
				$graph_url = sprintf(
						'/%s?fields=feed.since(%d).limit(50).fields(from.since(%d).fields(id),comments.since(%d).limit(200).fields(message,from.fields(id)),likes.since(%d).limit(200).fields(id),type,message)',
						$page['id'],
						$this->start,
						$this->scrape->last_run,
						$this->scrape->last_run,
						$this->scrape->last_run
				);
				$pagePosts = $this->scrape->fb->api($graph_url);	
				//var_dump($pagePosts);
				//var_dump($this->scrape->fb_user_ids);
				if(isset($pagePosts['feed']['data'])) {
					foreach($pagePosts['feed']['data'] as $pagePost) {
						$object_id = $this->get_post_id($pagePost['id']);
						//var_dump('COMMENTS',$pagePost['comments']['data']);
						if(isset($pagePost['comments']['data'])) {
							$act_slug = 'facebookCommentPost';
							foreach($pagePost['comments']['data'] as $comment) {
								if(in_array($comment['from']['id'], $this->scrape->fb_user_ids)) {
									$user_id = $this->get_user_id(array('facebook_user_id' => $comment['from']['id']));
									$this->actions_new[] = array(
											'user_id' => $user_id,
											'activity_slug' => $act_slug,
											'object_id' => $comment['id'],
											'sv_user_id' => $comment['from']['id'],
											'game_obj_id' => $page['label']
									);
								}
							}
						}
						//var_dump('WALLP',$pagePost['from']['id']);
						if(isset($pagePost['from']['id'])) {
							$act_slug = 'facebookPostWall';
							if(in_array($pagePost['from']['id'], $this->scrape->fb_user_ids)) {
								$user_id = $this->get_user_id(array('facebook_user_id' => $pagePost['from']['id']));
								$this->actions_new[] = array(
										'user_id' => $user_id,
										'activity_slug' => $act_slug,
										'object_id' => $pagePost['id'],
										'sv_user_id' => $pagePost['from']['id'],
										'game_obj_id' => $page['label']
								);
							}

						}
						//var_dump('LIKES',$pagePost['likes']['data']);
						if(isset($pagePost['likes']['data'])) {
							$act_slug = 'facebookLikePost';
							foreach($pagePost['likes']['data'] as $like) {
								if(in_array($like['id'], $this->scrape->fb_user_ids)) {
									$user_id = $this->get_user_id(array('facebook_user_id' => $like['id']));
									$this->actions_new[] = array(
											'user_id' => $user_id,
											'activity_slug' => $act_slug,
											'object_id' => $pagePost['id'],
											'sv_user_id' => $like['id'],
											'game_obj_id' => $page['label']
									);
								}
							}
						}
					}	
				}
			} catch (FacebookApiException $e) {
				//TODO: Log the error
				echo $e->getMessage().' get_likes_comments_posts '.$user_id;
			}
		}
		
		$this->finalize_scrape($options);
		
		return true;
	}
	
	public function get_shares($options=array()){
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('pages')));
		if(Core::has_error($result))
			return $result;
		
		foreach($options['game_desc']['pages'] as $page){
			$result = Social::ch_args(array('options' => $page, 'req_args' => array('id', 'name', 'label')));
			if(Core::has_error($result))
				return $result;
		}
		/*
		Arguments:
		Return:
		if successful:
		{
		 return array of new actions in format
		}
		if error:
		{
			returns false;
		}
		*/
		$curr_slug = 'facebookShare';
		$options['scraper_slug'] = $curr_slug;
		
		//TODO:Implement the facebook share functionality as folows
		//1. Check the shared_story is the value of status_type, and parse link to obtain value for the story_fbid - to get the value for the original story - 
		//While retriving the sharable objects get the id and retrive the status part of the post
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		//$sharables = $this->get_shareable_objects();
		$sharables = $this->get_shareable_objects_cake();
		
		if($sharables){
			//$result = $this->add_shared($sharables);
			$result = $this->add_shared_cake($sharables);
		}
		
		$this->finalize_scrape($options);
		
		if(!$sharables && !$result){
			return true;
		}
	}
	
	protected function add_shared($options=array()){
	
		/*
		 arguments:
		posts: Object id for the postsarray('scraper_slug' => $curr_slug)
		links: Object id for the links
			
		Return:
		if successful:
		{
		return 1;	protected function has_account($options=array()){
		}
		if error:
		{
		return 0;
		}
		*/
		$act_slug = 'facebookShare';
		foreach($this->scrape->fb_accounts as $fb_account) {
			$platform_user_id = $fb_account['s_user_id'];
			$user_id = $fb_account['user_id'];
	
			// All object_ids added already
			$object_ids = array();
			foreach($options['links'] as $link){
				$object_ids[] = $link['object_id'];
			}
	
			// Set access token
			$this->scrape->fb->setAccessToken($fb_account['access_token']);
			$object_ids;
			$page = null;
	
			try {
				// Get all user posts in the last 7 days
				$userPosts = $this->scrape->fb->api(sprintf(
						'/me?fields=posts.since(%d).limit(20).fields(id,object_id,link,message,status_type)',
						$this->scrape->last_run
				));

				if(isset($userPosts['posts']['data'])) {
					foreach($userPosts['posts']['data'] as $userPost) {
						$object_id = false;
						// The object ID is set and in the posts array
						if( isset($userPost['status_type']) && !empty($userPost['status_type']) && $userPost['status_type'] == 'shared_story'
								 && isset($userPost['link']) && !empty($userPost['link'])) 
						{
							//We found the link that represents a shared story, now we need to make sure the object_id corresponds to one of the items we are looking for
							$object_id = $this->get_post_id_from_link(array('link' => $userPost['link']));
						}
	
						// There is an object_id and it is in the links url
						if( ($object_id && in_array($object_id, $object_ids) ) ) {
							//TODO: Make sure we are not adding like of the same post
							$this->actions_new[] = array(
									'user_id' => $user_id,
									'activity_slug' => $act_slug,
									'object_id' => $object_id,
									'sv_user_id' => $fb_account['s_user_id'],
									'game_obj_id' => ''
							);
						}
					}
				}
			} catch (FacebookApiException $e) {
				//TODO: Log the error
				echo $e->getMessage().' add_share '.$user_id;
			}
		}
	
		return true;
	
	}
	
	protected function get_post_id_from_link($options=array()){
		preg_match('/.*story_fbid=(?<object_id>[0-9]+)/', $options['link'], $results);
		return isset($results['object_id']) ? $results['object_id'] : false;
	}
	
	protected function get_shareable_objects_cake(){
		$posts = array();
		$links = array();
		
		//TODO: get all posts and links shared by the page
		foreach($this->scrape->fb_media['pages'] as $page){
			try {
				$pagePosts = $this->scrape->fb->api(sprintf('/%s?fields=feed.since(%d).limit(50).fields(id,object_id,link)', $page['id'], $this->start));
		
				if(isset($pagePosts['feed']['data'])) {
					foreach($pagePosts['feed']['data'] as $pagePost) {
						if(isset($pagePost['object_id']) && !empty($pagePost['object_id']))
							$posts[$pagePost['object_id']] = $page;
						if(isset($pagePost['link']) && !empty($pagePost['link']) && !array_key_exists($pagePost['link'], $links))
							$links[$pagePost['link']] = array(
									'page' => $page,
									'object_id' => $this->get_post_id(array( 'post_id' => $pagePost['id']))
							);
					}
				}
			}catch (FacebookApiException $e) {
				echo $e->getMessage().' get_sharable_cake ';
			}
		}
		
		return $sharable = array('posts' => $posts, 'links' => $links);
	}
	
	protected function get_shareable_objects(){
		$posts = array();
		$links = array();
	
		foreach($this->scrape->fb_media['pages'] as $page){
			try {
				$pagePosts = $this->scrape->fb->api(sprintf('/%s?fields=feed.since(%d).limit(50).fields(id,object_id,link)', $page['id'], $this->scrape->last_run));
				
				if(isset($pagePosts['feed']['data'])) {
					foreach($pagePosts['feed']['data'] as $pagePost) {
						if(!array_key_exists($pagePost['id'], $links)){
							$links[$pagePost['id']] = array(
									'page' => $page,
									'object_id' => $this->get_post_id( array('post_id' => $pagePost['id']) )
							);	
						}
					}
				}
			}catch (FacebookApiException $e) {
				return false;
			}
		}
	
		return $sharable = array('posts' => $posts, 'links' => $links);
	}
	
	protected function add_shared_cake($options=array()){
		
		/*
		 arguments:
			posts: Object id for the postsarray('scraper_slug' => $curr_slug)
			links: Object id for the links
			
		Return:
		if successful:
		{
			return 1;
		}
		if error:
		{
			return 0;
		}
		*/
		$act_slug = 'facebookShare';
		foreach($this->scrape->fb_accounts as $fb_account) {
			$platform_user_id = $fb_account['s_user_id'];
			$user_id = $fb_account['user_id'];
		
			// All object_ids added already
			$object_ids = array();
		
			// Set access token
			$this->scrape->fb->setAccessToken($fb_account['access_token']);
		
			try {
				// Get all user posts in the last 7 days
				$userPosts = $this->scrape->fb->api(sprintf(
						'/me?fields=posts.since(%d).limit(20).fields(id,object_id,link,message)',
						$this->scrape->last_run
				));
				if(isset($userPosts['posts']['data'])) {
					foreach($userPosts['posts']['data'] as $userPost) {
						$object_id = false;
						$page = null;
		
						// The object ID is set and in the posts array
						if(isset($userPost['object_id']) && !empty($userPost['object_id']) && array_key_exists($userPost['object_id'], $options['posts'])) {
							$object_id = $userPost['object_id'];
							$slug = $options['posts'][$userPost['object_id']]['label'];
							// The link is set and in the links array
						} else if(isset($userPost['link']) && !empty($userPost['link']) && array_key_exists($userPost['link'], $options['links'])) {
							$object_id = $options['links'][$userPost['link']]['object_id'];
							$slug = $options['links'][$userPost['link']]['page']['label'];
						}
		
						// There is an object_id for this post, it is not already in the array, and it is not already logged or the platform user is not in the logs
						if( ($object_id && !in_array($object_id, $object_ids) ) ) {
							// Add the object ID to the list of previously added
							$this->actions_new[] = array(
									'user_id' => $user_id,
									'activity_slug' => $act_slug,
									'object_id' => $object_id,
									'sv_user_id' => $fb_account['s_user_id'],
									'game_obj_id' => $slug
							);
						}
					}
				}
			} catch (FacebookApiException $e) {
				//TODO: Log the error
				echo $e->getMessage().' add_sharable_cake '.$user_id;
			}
		}
		
		return true;
		
	}
	
	protected function init_scrape($options=array()){
		/*
		 Arguments:
		{
			scraper_slug: 
		}
		Return:
		if successful:
		{
			returns true;
		}
		if error:
		{
			returns false;
		}
		*/
		

		$this->scrape = new stdClass();
		$this->scrape->fb = new Facebook(array('appId' => $options['fb_connection']['app_id'], 'secret' => $options['fb_connection']['app_secret']));
		$this->scrape->fb_media = $options['game_desc'];
		$this->scrape->slug = $options['scraper_slug'];
		$this->scrape->fb_accounts = $this->find_accounts();
		$this->scrape->fb_user_ids = array();
		
		if( !is_array($this->scrape->fb_accounts) ){
			return false;
		}
		
		foreach($this->scrape->fb_accounts as $fb_account){
			$this->scrape->fb_user_ids[] = $fb_account['s_user_id'];
		}
		 
		
		
		
		//TODO: Add way to limit the call to the function by introducing lock
		$this->option = new Options();
		
		//TODO: Set the scraper to select to either get all from last run or get all from predefined time in the past (last must be configurabel)
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
	
	protected function finalize_scrape($options=array()) {
		//TODO: Set the time of last run
		//$this->Option->saveKey(__('%s-last_run', $this->scrape->slug), $this->scrape->startTime);
		$this->option->unlock_scraper($options);
		$this->option->set_last_run($options);
	}
	
	//scrapePageLikes
	public function get_page_likes($options=array()){
		$result = Social::ch_args(array('options' => $options['game_desc'], 'req_args' => array('pages')));
		if(Core::has_error($result))
			return $result;
		
		foreach($options['game_desc']['pages'] as $page){
			$result = Social::ch_args(array('options' => $page, 'req_args' => array('id', 'name', 'label')));
			if(Core::has_error($result))
				return $result;
		}
		
		$curr_slug = 'scraperFacebookLikePage';
		$options['scraper_slug'] = $curr_slug;
		
		if(!$this->init_scrape($options))
			return Core::error($this->errors, 9);
		
		// For each Facebook Page, iterate through possible activities
		$act_slug = 'facebookLikePage';

		//error_log(print_r($this->scrape->fb_media,true));
		
		foreach($this->scrape->fb_media['pages'] as $page) {
			$object_id = $page['id'];
			
			// Iterate through each Facebook user
			foreach($this->scrape->fb_accounts as $facebookAccount) {
				// Check if the Facebook user ID is already in the logs for this page
				$platform_user_id = $facebookAccount['s_user_id'];
				$user_id = $facebookAccount['user_id'];
				
				$this->scrape->fb->setAccessToken($facebookAccount['access_token']);
				try {
					$userLikesPage = $this->scrape->fb->api(sprintf('/me/likes/%s', $object_id), array('since' => $this->start));
					//error_log(print_r($userLikesPage,true));
					
					if(isset($userLikesPage['data'][0]['id']) && $userLikesPage['data'][0]['id'] == $object_id) {
						$this->actions_new[] = array(
								'user_id' => $user_id,
								'activity_slug' => $act_slug,
								'object_id' => $object_id,
								'sv_user_id' => $facebookAccount['s_user_id'],
								'game_obj_id' => $page['label']
						);
					}
					
				} catch (FacebookApiException $e) {
					//TODO: Log the error
					echo $e->getMessage().' get_pages_likes '.$user_id;
				}
			}
		}
		
		$this->finalize_scrape($options);
		
		return true;
	}


	public function create_account($options=array()){
		$inputs['user_info'] = array(
				'user_id' => intval($options['user_id']),
				'info_type' => self::ACCOUNT_TYPE,
				'int_info' => $options['facebook_user_id'],
				'info' => $options['facebook_username'],
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
	
	// Get Facebook Post ID from doubled ID
	private function get_post_id($options=array()) {
		/*
		 Arguments:post_id
		{
			post_id:
		}
		Return:
		if successful:
		{
			returns object_id part of the facebook graph id
		}
		*/
		return substr($options['post_id'], strpos($options['post_id'], '_') + 1, strlen($options['post_id']));
	}
	
	protected function get_user_id($options=array()){
		/*
		 Arguments:
		{
			facebook_user_id:
		}
		Return:
			if successful:
		{
			returns user_id
		}
		if error:
		{
			returns false;
		}
		*/
		foreach($this->scrape->fb_accounts as $fb_account){
			if($fb_account['s_user_id'] == $options['facebook_user_id'])
				return $fb_account['user_id'];
		}
		
		return false;
	}

}