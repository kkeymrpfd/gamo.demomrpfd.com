<?php
require_once('interfaces/interface.Gamo_IAccount_Updatable.php');
require_once('interfaces/interface.Gamo_IHttp_Fetchable.php');
require_once('interfaces/interface.Gamo_IScrapable.php');
require_once('helpers/class.Gamo_Social_Service.php');


class Gamo_Facebook_Service extends Gamo_Social_Service {

	protected $service = 'facebook';
	
	/*
	 * Array 'app_id', 'app_secret', 'redirect_url'
	 */
	protected $redirect_url = null;
	
	/*
	 * Object reference to the handler of requests
	 */
	protected $http_handler = null; 
	
	/*
	 * Array of pages that the 
	 */
	private $pages = null;
	
	private $contents = array();
	
	// 'error', 'warning', 'notice', 'dump'
	private $error_level = 'none';
	
	
	private $errors = array(
			array(
					'error_code' => '1',
					'error_msg' => 'Error (Facebook Connect Account): User profile error',
					'error_level' => 'error'
			),
			array(
					'error_msg' => '2',
					'error_message' => 'Error (Facebook Connect Account): User access token error',
					'error_level' => 'error'
			),
			array(
					'error_code' => '3',
					'error_msg' => 'Facebook Exception',
					'error_level' => 'error'
			),
			array(
					'error_code' => '4',
					'error_msg' => 'No Shared Posts found',
					'error_level' => 'dump'
			),
			array(
					'error_code' => '5',
					'error_msg' => 'Report already has account',
					'error_level' => 'error'
			),
			array(
					'error_code' => '6',
					'error_msg' => 'Failed saving account',
					'error_level' => 'error'
			),
			array(
					'error_code' => '7',
					'error_msg' => 'Failed deleting account',
					'error_level' => 'error'
			),
			array(
					'error_code' => '8',
					'error_msg' => 'No Accounts found for facebook.',
					'error_level' => 'dump'
			),
			array(
					'error_code' => '9',
					'error_msg' => 'Game description is not in the database',
					'error_level' => 'error'
			),
			array(
					'error_code' => '10',
					'error_msg' => 'No actions found.',
					'error_level' => 'dump'
			),
			array(
					'error_code' => '11',
					'error_msg' => 'No match for the element.',
					'error_level' => 'dump'
			),
			array(
					'error_code' => '12',
					'error_msg' => 'Failed to retrive the definition for facebook connection',
					'error_level' => 'warning'
			)
	);
	
	public function init_pages_test(){
		$this->pages = array(
				
				array(
						'id' => '69182975870',
						'name' => 'Emccorp',
						'label' => 'Emccorp'
				)
				
		);
	}
	
	public function init_contents_test(){
		$this->contents = array(
				array(
						'text' => "I'm participating in Netech rewards. If you're an IT professional you should too!",
						'label' => 'EntermarketingContentUserFbWallNetechGameonLink'
				)
		);
	}
	
	public function init_contents(){
		
		global $gamo;
		
		$content_count = Core::r('options')->get_option( array('key' => 'fb_content_count') );
		
		if(Core::has_error( $content_count) or empty($content_count)){
		
			error_log("Game content description is not in the database."." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]");
			$content_count = 0;
		
		}
		
		
		$this->contents = array();
		for( $i=1; $i<=$content_count; $i++ ){
				
			//$id = Core::r('options')->get_option( array('key' => 'fb_content_id_'.$i) );
			$name = Core::r('options')->get_option( array('key' => 'fb_content_name_'.$i) );
			$label = Core::r('options')->get_option( array('key' => 'fb_content_label_'.$i) );
			//Core::has_error($id) or empty($id) or 
		
			if( Core::has_error($name) or empty($name) or Core::has_error($label) or empty($label) ){
		
				error_log("Bad description for content[fb_page_id_".$i."] CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]");
				continue;
		
			}
		
		
			$this->contents[$i]['text'] = $name;
			$this->contents[$i]['label'] = $label;
				
		}
		
	}
	
	public function init_pages(){
		
		global $gamo;
		
		$page_count = Core::r('options')->get_option( array('key' => 'fb_page_count') );
			
		if(Core::has_error( $page_count) or empty($page_count)){
		
			error_log("Game page description is not in the database."." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]");
			$page_count = 0;
		
		}
			
			
		$this->pages = array();
		for( $i=1; $i<=$page_count; $i++ ){
				
			$id = Core::r('options')->get_option( array('key' => 'fb_page_id_'.$i) );
			$name = Core::r('options')->get_option( array('key' => 'fb_page_name_'.$i) );
			$label = Core::r('options')->get_option( array('key' => 'fb_page_label_'.$i) );
		
		
			if( Core::has_error($id) or empty($id) or Core::has_error($name) or empty($name) or Core::has_error($label) or empty($label) ){
					
				error_log("Bad description for page[fb_page_id_".$i."] CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]");
				continue;
		
			}
		
		
			$this->pages[$i]['id'] = $id;
			$this->pages[$i]['name'] = $name;
			$this->pages[$i]['label'] = $label;
				
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	public function __construct($options=array()){
		
		global $gamo;
		
		parent::__construct($options);
		
		$app_id = Core::r('options')->get_option( array('key' => 'fb_api_id') );
		$app_secret = Core::r('options')->get_option( array('key' => 'fb_api_secret') );
		
		$data = array('app_id' => '144758945725323','app_secret' => 'cdaf6ec53ff709afd3dc55a43ea12b97');
		
		if( Core::has_error($app_id) ){
			
			Core::error_log( $this->error_level, $app_id );
			
		}elseif( empty($app_id) ){

			$error = Core::error($this->errors,12);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			Core::error_log( $this->error_level, $error );
			
		}elseif( Core::has_error($app_secret) ){
			
			Core::error_log( $this->error_level, $app_secret );
			
		}elseif( empty($app_secret) ){

			$error = Core::error($this->errors,12);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			Core::error_log( $this->error_level, $error );

		}else{
			
			$data = array('app_id' => $app_id,'app_secret' => $app_secret);
			
		}
	
		$http_handler = Core::r( 'facebook_handler','/social/helpers/' );
		$http_handler->init( $data['app_id'], $data['app_secret'] );
		$this->add_http_handler($http_handler);
	
		
		if(!empty($options['set_page'])){
			
			if(!empty($options['test'])){
				$this->init_pages_test();
			}else{
				$this->init_pages();
			}

		}
		
		if(!empty($options['set_content'])){
				
			if(!empty($options['test'])){
				$this->init_contents_test();
			}else{
				$this->init_contents();
			}
			

		}
		
		if( !empty( $options['error_level'] ) ){
			
			$this->error_level = $options['error_level'];
			
		}else{
			
			$this->error_level = 'none';
			
		}
	
	}
	
	
	
	
	
	
	
	
	public function is_page_set(){
		
		if( isset($this->pages) ){
			return true;
		}else{
			return false;
		}
		
	}
	
	public function is_content_set(){
	
		if( isset($this->contents) ){
			return true;
		}else{
			return false;
		}
	
	}
	
	
	
	
	
	
	
	
	
	public function get_login_url(){

		$loginUrl =  $this->http_handler->getLoginUrl(array(
				'scope' => array('user_likes', 'read_stream'),
				'redirect_uri' => $this->redirect_url
		));
		
		return $loginUrl;
		
	}
	
	public function logoff_user($options=array()){
		
		global $gamo;
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('user_id')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if(!Core::r('social_account', '/social/')->delete_account($options)) {
			return Core::error($this->errors, 7);
		}
	
		return true;
	}
	
	public function login_user($options=array()){
		
		global $gamo;
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('user_id')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		$facebookUser = $this->http_handler->getUser();
		
		try {
			$facebookUserProfile = $this->api_get_profile();
			
			if(!$facebookUserProfile) {
				
				$error = Core::error($this->errors,1);
				$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
				return $error;
				
			}
				
			$this->http_handler->setExtendedAccessToken();
			$access_token = $this->http_handler->getAccessToken();
			if(empty($access_token)) {
				
				$error = Core::error($this->errors,2);
				$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
				return $error; 
				
			}
		} catch (FacebookApiException $e) {
			
			$error = Core::error($this->errors,3);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;

		}
		
		
		
		if( Core::r('social_account', '/social/')->has_account(array('user_id' => $options['user_id'], 'account_type' => $this->service.'_account' )) ) {
			
			$error = Core::error($this->errors,5);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
			
		}
		

		$facebookAccount = array(
				'user_id' => intval($options['user_id']),
				'int_info' => $facebookUserProfile['id'],
				'info' => $facebookUserProfile['username'],
				'info_b' => $access_token,
				'info_type' => $this->service.'_account',
				'time' => date('Y-m-d H:i:s')
		);
		if(!Core::r('social_account', '/social/')->create_account($facebookAccount)) {
			
			$error = Core::error($this->errors,6);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;

		}
		
		return true;
		
	}
	
	
	
	
	
	
	
	public function api_get_user_posts_stats( $options=array() ){
		
		$result = Core::check_required_arguments( array('options' => $options, 'req_args' => array('user_access_token', 'connection', 'post_id') ) );
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		$this->http_handler->setAccessToken( $options['user_access_token'] );
		$url = '/'.$options['post_id'].'/'.$options['connection'].'?summary=1';
		
		$data = $this->api_get_url_same_accesstoken( array( 'url' => $url ) );
		
		if( !empty($data['summary'] ) and !empty($data['summary']['total_count'] ) ){
			
			return $data['summary']['total_count'];
			
		}else{
			
			return 0;
			
		}
		
	}

	public function api_get_user_posts( $options=array() ){
		
		$result = Core::check_required_arguments( array('options' => $options, 'req_args' => array('user_access_token', 'since_timestamp', 'fields') ) );
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		
		$this->http_handler->setAccessToken( $options['user_access_token'] );
		$url = sprintf( '/me?fields=feed.since(%d).limit(200).fields('.$options['fields'].')',$options['since_timestamp']);
		
		$userPosts = $this->api_get_data_paginated( array( 'url' => $url, 'endpoint' => 'feed') );
		
		return $userPosts;
			
	}
	
	public function api_get_page_posts( $options=array() ){
		
		$result = Core::check_required_arguments( array('options' => $options, 'req_args' => array('page_id', 'since_timestamp', 'fields') ) );
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		//Those are fields for retrieving posts on page wall
		/*
		$options['fields'] = 'id,object_id,link,message,status_type,application,story_tags,story,type,actions'.
				',properties,source,description,caption,name,message_tags,from,to';
		*/
		
		$url = sprintf( '/%s?fields=feed.since(%d).limit(200).fields('.$options['fields'].')', $options['page_id'], $options['since_timestamp']);

		//var_dump($url);
		
		$pagePosts = $this->api_get_data_paginated( array( 'url' => $url, 'endpoint' => 'feed') );
		
		return $pagePosts;
		
	}
	
	public function api_get_data_paginated_cursors( $options=array() ){
		
		$result = Core::check_required_arguments( array('options' => $options, 'req_args' => array( 'url' ) ) );
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		$data = array();
		$after = '';
		//var_dump("HER",$url_in);
		
		$url_ar = parse_url( $options['url'] );

		parse_str( $url_ar['query'],$vals );
		foreach( $vals as $name => $val ){
			
			if( $name == 'after' ){
				
				$after = '&after='.$val;
			
			}else{
				
				$q_string = "&".$name."=".$val;
				
			}
			
		}
		
		do{
			//var_dump($after);
			$options['url'] = $url_ar['path']."?".$q_string.$after;
			//var_dump($options['url'] .= $after);
			$userPosts = $this->api_get_url_same_accesstoken( $options );
			//error_log(print_r($userPosts ,true));
				
			if( !empty( $userPosts['data'] ) ){
				$data = array_merge($data, $userPosts['data']);
			}
				
			if( isset( $userPosts['paging'] ) and !empty( $userPosts['paging']['next'] ) ){
		
				//var_dump($userPosts['paging']['next']);
				$temp_query = parse_url( $userPosts['paging']['next'], PHP_URL_QUERY);
				parse_str($temp_query,$vals);
				//error_log(print_r($vals,true));
				//error_log(print_r($userPosts[$options['endpoint']]['paging'] ,true));
				//error_log(print_r($userPosts ,true));
				//var_dump(count($userPosts[$options['endpoint']]['data']));
				$after = '&after='.$vals['after'];
			}else{
				break;
			}
				
		}while(!empty($userPosts['data']));
		
		return $data;
		
	}
	
	public function api_get_data_paginated( $options=array() ){
		
		$result = Core::check_required_arguments( array('options' => $options, 'req_args' => array('url', 'endpoint') ) );
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		$data = array();
		$until = '';
		do{
			$options['url'] .= $until;
			$userPosts = $this->api_get_url_same_accesstoken( $options );
			//error_log(print_r($userPosts ,true));
			
			if( !empty( $userPosts[$options['endpoint']]['data'] ) ){
				$data = array_merge($data, $userPosts[$options['endpoint']]['data']);
			}
			
			if( isset( $userPosts[$options['endpoint']]['paging'] ) and !empty( $userPosts[$options['endpoint']]['paging']['next'] ) ){
				
				$temp_query = parse_url( $userPosts[$options['endpoint']]['paging']['next'], PHP_URL_QUERY);
				parse_str($temp_query,$vals);
				//error_log(print_r($vals,true));
				//error_log(print_r($userPosts[$options['endpoint']]['paging'] ,true));
				//error_log(print_r($userPosts ,true));
				//var_dump(count($userPosts[$options['endpoint']]['data']));
				$until = '.until('.$vals['until'].")";
			}else{
				break;
			}
			
		}while(!empty($userPosts[$options['endpoint']]['data']));
		
		return $data;
		
	}
	
	public function api_get_url_same_accesstoken( $options=array() ){
		
		$result = Core::check_required_arguments( array('options' => $options, 'req_args' => array('url') ) );
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		

		//error_log($options['url']);
		$results = $this->http_handler->fetch( $options );
		//var_dump($results);
		
		return $results;
		
	}
	
	public function api_get_profile(){
		
		return $this->http_handler->fetch( array( 'url' => '/me' ) );
		
	}
	
	public function api_user_likes_page( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page_id', 'user_access_token', 'since_timestamp')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		$this->http_handler->setAccessToken( $options['user_access_token'] );
		
		$userLikesPage = $this->http_handler->fetch( array( 
				'url' => sprintf('/me/likes/%s', $options['page_id']), 
				'params' => array('since' => $options['since_timestamp']) ) );
			
		return $userLikesPage;
		
	}
	
	public function compare_is_like_from_user( $options=array() ){
	
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('s_user_id', 'data_item')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		if( !empty( $options['data_item']['likes']['data']) ){
			
			$data = $options['data_item']['likes']['data'];
			
			if( !empty( $options['data_item']['likes']['paging'] )
					and !empty( $options['data_item']['likes']['paging']['next'] ) ){
			
				$next = $options['data_item']['likes']['paging']['next'];
				//var_dump($next);
			
				$new = $this->api_get_data_paginated_cursors( array( 'url' => $next ) );
				//var_dump($new);
				$data = array_merge($data, $new);
			
			}
				
			foreach( $data as $like){
				
				if( !empty( $like['id'] ) ){ 
				
					if( $like['id'] == $options['s_user_id'] ){
							
						$like['message'] = '';
						$like['id'] = $options['data_item']['id'];
						return $like;
						
					}
				
				}
				
			}
	
		}
	
		return false;
	
	}
	
	public function get_user_page_posts_likes( $options=array() ){
	
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
	
		return $this->get_user_page_posts_actions( array(
				'fields' => 'id,likes.limit(200).since(%s)',
				'page' => $options['page'],
				'accounts' => $options['accounts'],
				'compare' => 'compare_is_like_from_user'
		) );
	
	}
	
	public function compare_is_comment_from_user( $options=array() ){
	
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('s_user_id', 'data_item')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		if( !empty( $options['data_item']['comments']['data'] ) ){
			
			//var_dump( $options['data_item']['message'] );
			
			//TODO: Retrive all the comments first before looping
			$data = $options['data_item']['comments']['data'];
			
			//var_dump($data);
			
			if( !empty( $options['data_item']['comments']['paging'] ) 
					and !empty( $options['data_item']['comments']['paging']['next'] ) ){
				
				$next = $options['data_item']['comments']['paging']['next'];
				//var_dump($next);

				$new = $this->api_get_data_paginated_cursors( array( 'url' => $next ) );
				//var_dump($new);
				$data = array_merge($data, $new);
				
			}
			
			//var_dump($data);
			
			foreach( $data as $comment){
				
				//var_dump($comment['message'],$comment['from']['name']);
				
				if( $comment['from']['id'] == $options['s_user_id'] ){
					
					return $comment;
				}
				
			}

		}
		
		return false;
	
	}
	
	public function get_user_page_posts_comments( $options=array() ){
	
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
	
		return $this->get_user_page_posts_actions( array(
				'fields' => 'id,comments.limit(200).since(%s).fields(message,from.fields(id,name))',
				'page' => $options['page'],
				'accounts' => $options['accounts'],
				'compare' => 'compare_is_comment_from_user'
		) );
	
	}
	
	
	
	public function compare_is_post_from_user( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('s_user_id', 'data_item')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( !empty( $options['data_item']['from']['id']) and $options['data_item']['from']['id'] == $options['s_user_id'] ){
			return $options['data_item'];
		}else{
			return false;
		}
		
	}
	
	
	public function get_user_page_posts( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		return $this->get_user_page_posts_actions( array( 
				'fields' => 'id,from,message', 
				'page' => $options['page'], 
				'accounts' => $options['accounts'],
				'compare' => 'compare_is_post_from_user' 
		) );
		
	}
	
	
	public function get_user_page_posts_actions( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts', 'fields', 'compare')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		$user_shared_posts = array();
		
		foreach( $options['accounts'] as $fb_account ){
		
			try{
				
				//This should be replaced with the last date we run this on the account
				$options['fields'] = sprintf( $options['fields'], $this->start );
			
				$page_posts = $this->api_get_page_posts( array( 'since_timestamp' => $this->start, 'page_id' => $options['page']['id'], 'fields' => $options['fields'] ) );
				
				if( !Core::has_error($page_posts) ){
						
					if( !empty($page_posts) ){
						
						foreach( $page_posts as $data_item ){
							
							if( $data_item = $this->$options['compare']( array( 's_user_id' => $fb_account['s_user_id'], 'data_item' => $data_item ) ) ){
								
								$user_shared_posts[] = array(
										'user_id' => $fb_account['user_id'],
										'activity_slug' => $options['page']['label'],
										'object_id' => $data_item['id'],
										'message' => $data_item['message']
								);
								
							}
							
						}
						
					}
					
				}
				
			} catch (FacebookApiException $e) {
			
				error_log($e->getMessage()." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]");
		
			}
	
		}
		
		return $user_shared_posts;
		
	}
	
	
	
	
	
	/**
	 * Used to retrieve all the actions of all the users related to sharing sharable posts on the page. This is a wrapper that helps the
	 * get_shared_posts by finding all the items on the page's wall that could be shared
	 * 
	 * @param unknown_type $options
	 * @return string|multitype:
	 */
	public function get_user_shared_page_posts( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		$user_shared_posts = array();
		
		try{
		
			$page_posts = $this->api_get_page_posts( array( 'since_timestamp' => $this->start, 'page_id' => $options['page']['id'], 'fields' => 'id,object_id,link') );
			
			if( !Core::has_error($page_posts) ){
				
				if( !empty($page_posts) ){
					
					$shareable_objects = array( 'object_ids' => array(), 'links' => array() );
					foreach( $page_posts as $data_item ){
						
						if( !empty( $data_item['object_id'] ) ){
							
							$shareable_objects['object_ids'][] = $data_item['object_id'];
							
						}
						
						if( !empty( $data_item['link'] ) ){
							
							$shareable_objects['links'][] = $data_item['link'];
						}
						
					}
					
					if( !empty( $shareable_objects['object_ids'] ) or !empty( $shareable_objects['links'] ) ){
						
						$user_shared_posts = array_merge( $user_shared_posts, $this->get_user_shared_posts( array( 
								'page' => $options['page'], 
								'accounts' => $options['accounts'], 
								'shareable_objects' => $shareable_objects 
						) ) );
						
					}
					
				}
				
			}
			
		} catch (FacebookApiException $e) {
		
			error_log($e->getMessage()." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]");
	
		}
		
		return $user_shared_posts;
	}
	
	
	
	/**
	 * Used to retrive all the objects that user shared on his wall for $options['shareable_actions]
	 * 
	 * @param unknown_type $options
	 * @return string|multitype:multitype:NULL unknown  
	 */
	public function get_user_shared_posts( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts', 'shareable_objects')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		$actions_new = array();
		
		foreach( $options['account'] as $fb_account ){
			
			try{
				
				$input_ar = array( 
						'since_timestamp' => $this->start, 
						'user_access_token' => $fb_account['access_token'],
						'fields' => 'id,message,object_id,link'
				);
				
				$result = $this->api_get_user_posts( $input_ar );
				
				if( !Core::has_error( $result ) ){
					
					if( !empty( $result ) ){
						
						foreach( $result as $data_item ){
							
							if( !empty( $data_item['message'] ) ) {
								$message = $data_item['message'];
							}else{
								$message = '';
							}
							
							if( 
									( !empty( $data_item['object_id'] ) and in_array($data_item['object_id'], $options['shareable_objetcs']['object_ids'] ) ) or
									( !empty( $data_item['link'] ) and in_array( $data_item['link'], $options['shareable_objects']['links'] ) )
							){
								
								$actions_new[] = array(
										'user_id' => $fb_account['user_id'],
										'activity_slug' => $options['page']['label'],
										'object_id' => $data_item['id'],
										'message' => $message
								);
								
							}
		
						}
						
					}
					
				}
				
			} catch (FacebookApiException $e) {
		
				error_log($e->getMessage()." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]");
		
			}
			
		}
		
		return $actions_new;
		
	}
	
	public function get_user_shared_content_stats( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		$actions_new = $this->get_posts_for_content( $options );
		if( !Core::has_error($actions_new ) and !empty($actions_new) ){
			foreach($actions_new as $index => $action){
				
				
				$stats = array();
				$stats['share'] = $action['shares'];
				$stats['like'] = $this->api_get_user_posts_stats(array(
						'user_access_token' => $action['user_access_token'],
						'connection' => 'likes',
						'post_id' => $action['object_id']
				));
				
				$stats['comment'] = $this->api_get_user_posts_stats(array(
						'user_access_token' => $action['user_access_token'],
						'connection' => 'comments',
						'post_id' => $action['object_id']
				));
				
				$actions_new[$index]['stats'] = $stats;
				
			}
		}else{
			$actions_new = array();
		}
		
		return $actions_new;
		
	}
	
	
	/**
	 * Retrives all the actions that are based on the user posting on his wall something with specific content(text)
	 * 
	 * @param unknown_type $options
	 * @return string|multitype:multitype:NULL unknown  
	 */
	public function get_posts_for_content( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		$actions_new = array();
		
		foreach( $options['accounts'] as $fb_account) {

			try {
		
				$input_ar = array( 
						'since_timestamp' => $this->start, 
						'user_access_token' => $fb_account['access_token'],
						'fields' => 'id,message,name,shares,application'
				);
				
				$result = $this->api_get_user_posts( $input_ar );
		
				if( !Core::has_error($result) ) {
		
					if( !empty( $result ) ){
						
						foreach($result as $data_item){
							
							if( !empty( $data_item['shares'] ) ){
							
								$shares = $data_item['shares']['count'];
								
							}else{
								
								$shares = 0;
								
							}
							
							if( !empty( $data_item['application']['name'] ) and $data_item['application']['name'] == 'Share_bookmarklet' and !empty( $data_item['name'] ) and substr_count( strtolower( $data_item['name'] ), strtolower( $options['page']['text'] ) ) ) {
									
								$actions_new[] = array(
										'user_id' => $fb_account['user_id'],
										'activity_slug' => $options['page']['label'],
										'object_id' => $data_item['id'],
										'message' => $data_item['message'],
										'user_access_token' => $fb_account['access_token'],
										'shares' => $shares
								);
							
							}else{
									
								$error = Core::error($this->errors,11);
								$error['error_msg'] .= "PAGE[".print_r($options['page'],true)."]". " DATA[".print_r($data_item,true)."]"." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
								Core::error_log( $this->error_level, $error );
									
							}
							
						}
						
					}else{
						
						$error = Core::error($this->errors,10);
						$error['error_msg'] .= "PAGE[".print_r($options['page'],true)."]". " ACCOUNT[".print_r($fb_account,true)."]"." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
						Core::error_log( $this->error_level, $error );
						
					}

				}else{
					
					Core::error_log( $result, $this->error_level );
					
				}
		
			} catch (FacebookApiException $e) {
		
				$error = Core::error($this->errors,3);
				$error['error_msg'] .= $e->getMessage()."PAGE[".print_r($options['page'],true)."]". " ACCOUNT[".print_r($fb_account,true)."]"." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
				Core::error_log( $this->error_level, $error );
		
			}
			
		}
		
		return $actions_new; 
	}
	
	/**
	 * Finds all the accounts that like a specific page
	 *  
	 * @param unknown_type $options
	 * @return string|multitype:unknown 
	 */
	public function get_page_likes( $options=array() ){
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('page', 'accounts')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty($options['accounts'] ) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		$page = $options['page'];
		$actions_new = array();
		
		foreach( $options['accounts'] as $facebookAccount) {
			$user_id = $facebookAccount['user_id'];
		
		
			try {
				
				//NOTE: The since_timestamp should be set to the start of the event since we getting all the likes for a specific page thus the return can only be 1 at most
				//TODO: We might get an error related to the account not being valid - we need to remove the account - pass back the accounts as in array(bad_accounts, actions)
				$result = $this->api_user_likes_page( array( 'page_id' => $page['id'], 'user_access_token' => $facebookAccount['access_token'], 'since_timestamp' => $this->start) );
		
				if( !Core::has_error($result) ) {

					if( isset($result['data'][0]['id']) and $result['data'][0]['id'] == $page['id'] ){
				
		
						$actions_new[] = array(
								'user_id' => $user_id,
								'activity_slug' => $page['label'],
								'object_id' => $page['id'],
								'message' => ''
						);
					
					}else{
						
						$error = Core::error($this->errors,10);
						$error['error_msg'] .= "PAGE[".print_r($options['page'],true)."]". " ACCOUNT[".print_r($result,true)."]"." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
						Core::error_log( $this->error_level, $error );
						
					}
		
				}else{
					
					Core::error_log( $result, $this->error_level );
					
				}
		
			} catch (FacebookApiException $e) {
				
				$error = Core::error($this->errors,3);
				$error['error_msg'] .= $e->getMessage()." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
				Core::error_log( $error, $this->error_level );
				
					
			}
			
		}
		
		return $actions_new;
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function job_get_data_for_entity( $options=array() ){
		
		if( empty($options['accounts'] ) or empty($options['entity']) or empty($options['function_name']) ){
			$error = Core::error(self::$errors, 8);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		$fname = $options['function_name'];
		$ename = $options['entity'];
		$actions = array();
		
		foreach($this->$ename as $page) {
		
			$actions = array_merge($actions, $this->$fname( array( 'page' => $page, 'accounts' => $options['accounts'] ) ) );
		
		}
		
		return $actions;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	

	
	/*
	 * Functions used for dossier
	 */
	public function get_posts_about_account( $options=array() ){
		
		if( empty($options['account_name']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			throw new Exception('The http handler was not initialized before calling get_company_id_by_email_domain().');
		
		$url = "search";
		$params = array(
				//'fields' => 'type,message,id',
				'q' => $options['account_name']
		);
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
			)
		);
		
		foreach($raw_response['data'] as $index => $response){
			
			if( $response['type'] == 'photo' ){
				unset($raw_response['data'][$index]);
			}
			
			if( empty($response['message']) ){
				unset($raw_response['data'][$index]);
			}
			
			$scount = substr_count( strtolower( $response['message'] ) , strtolower( $options['account_name'] ) );
			if( $scount  == 0 ){
				unset($raw_response['data'][$index]);
			}
			
		}
		
		if( !empty($raw_response['data']) ){
		
			return $raw_response['data'];
		
		}else{
		
			return false;
		
		}
	}
	
	public function get_posts_by_account( $options=array() ){
		
		if( empty($options['account_id']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			throw new Exception('The http handler was not initialized before calling get_company_id_by_email_domain().');
		
		$url = $options['account_id']."/posts";
		$params = array(
				'fields' => 'id,updated_time,message'
		);
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
			)
		);
		
		if( !empty($raw_response['data']) ){
				
			return $raw_response['data'];
				
		}else{
				
			return false;
				
		}
		
	}
	
	public function get_account_by_email_domain( $options=array() ){
		
		if( empty($options['email_domain']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		$result = $this->get_account_by_query( array('query' => $options['email_domain']) );
		
		if( $result ){
			
			$accounts = array();
			$index = 0;
			foreach( $result as $account ){
				
				if( (!empty( $account['website'] )) and stristr( $account['website'], $options['email_domain'] ) ){
					
					$accounts[$index] = $account;
					$index++;
					
				}
				
			}	
			
			return $accounts;
			
		}else{
			
			return false;
			
		}
		
	}
	
	public function get_account_by_name( $options=array() ){
		
		if( empty($options['universal_name']) or empty($options['c_url']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			throw new Exception('The http handler was not initialized before calling linkedin_service::get_company_id_by_email_domain().');
		
		$url = "/".$options['universal_name'];
		$params = array(
		);
		
		
		try{
			
			$result = $this->http_handler->fetch( array(
					'method' => 'POST',
					'params' => $params,
					'url' => $url
				)
			);
			
			if( $result ){
					
				$account = array();

				if( (!empty( $result['website'] )) and stristr( $result['website'], $options['c_url'] ) ){
						
					$account['id'] = $result['id'];
					$account['name'] = $result['username'];
					$account['link'] = 'www.facebook.com/'.$result['id'];
					$account['website'] = $result['website'];
					
					return $account;
						
				}else{
					
					return false;
					
				}

					

					
			}else{
					
				return false;
					
			}

			
		}catch(Exception $e){
			
			return false;
			
		}

	}
	
	public function get_account_by_query( $options=array() ){
		
		if( empty($options['query']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			throw new Exception('The http handler was not initialized before calling get_company_id_by_email_domain().');
		
		$url = "search";
		$params = array(
			'q' => $options['query'],
			'type' => 'page',
			'fields' => 'website,name,link'
		);
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
			)
		);
		
		if( $raw_response ){
			
			$accounts = array();
			foreach( $raw_response['data'] as $index => $account){
				
				$accounts[$index] = $account;
				
			}
			
			return $accounts;
			
		}else{
			
			return false;
			
		}
		
	}

}
