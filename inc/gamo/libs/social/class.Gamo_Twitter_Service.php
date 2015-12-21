<?php
require_once('interfaces/interface.Gamo_IAccount_Updatable.php');
require_once('interfaces/interface.Gamo_IHttp_Fetchable.php');
require_once('interfaces/interface.Gamo_IScrapable.php');
require_once('helpers/class.Gamo_Social_Service.php');

class Gamo_Twitter_Service extends Gamo_Social_Service {
	
	const ACCOUNT_TYPE = 'tw_account';
	
	static $format = array('format' => 'json');
	static $url = '';
	static $version = '';
	public $link_prefix = 'twitter.com/';
	
	static $start_date = '04/12/2013';
	
	static $connection_desc = array(
			
			'app_id' => 'JewU0B1JngVpcE2buSYAQ',
			'app_secret' => '2xbBQSYRVLsdEM4Z7jBn5QF4pnZ9hTYgwB96tR390',
			'access_token' => '1548476659-qMhJm36xcBtAxk220Xxs0UaGaPTAf8d7BrYjmqJ',
			'access_token_secret' => 'hi4Huah5jvjuWV0I5RrPhtDWxP6V9qJHI8gGiepXE'
			
	);
	
	static $game = array(
			
		'accounts' => array(
			array('id' => '10005212', 'name' => 'EmcCorp', 'label' => 'EmcCorp'),
			array('id' => '716091404', 'name' => 'ArrowGlobal', 'label' => 'ArrowGlobal')
		),
			
		'hastags' => array(
			'Emc'
		)
			
	);
	
	static function get_start_date(){
	
		strtotime(self::$start_date);
	
	}
	
	public function get_actions($options=array()){
		throw new Exception('Method is not yet implemented');
	}
	
	public function get_hashtags_user($options=array()) {
		throw new Exception('Method is not yet implemented');
	}
	
	public function get_follows($options) {
		throw new Exception('Method is not yet implemented');
	}

	public function get_hashtags($options=array()) {
		throw new Exception('Method is not yet implemented');
	}
	
	public function get_world_hashtags($options=array()){
		throw new Exception('Method is not yet implemented');
	}
	
	public function get_login_url($options=array()){
		throw new Exception('Method is not yet implemented');
	}

	public function login_user($options=array()){
		throw new Exception('Method is not yet implemented');
	}
	
	public function logoff_user($options=array()){
		throw new Exception('Method is not yet implemented');
	}
	
	public function get_posts_about_account( $options=array() ){
		
		if( empty( $options['account_string'] ) )
		
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		return $this->get_posts_for_query( array('query' => '@'.$options['account_string'] ) );
		
	}
	
	public function get_posts_about_hashtag( $options=array() ){
		
		if( empty( $options['hashtag_string'] ) )
		
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		return $this->get_posts_for_query( array('query' => '#'.$options['hashtag_string']) );
	
	}
	
	public function get_posts_for_query( $options=array() ){
		
		if( empty($options['query']) )
				
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
				
			throw new Exception('The http handler was not initialized before calling get_company_id_by_email_domain().');
		
		
		$url = "search/tweets";
		$params = array(
				'q' => $options['query'],
				'count' => 50,
				'lang' => 'en',
				'result-type' => 'recent'
		);
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
			)
		);
		
		
		//TODO: Handle the twitter errors:
		/*
		 * $raw_response = 
		 * 
		 * object(stdClass)#12 (1) {
			  ["errors"]=>
			  array(1) {
			    [0]=>
			    object(stdClass)#13 (2) {
			      ["message"]=>
			      string(19) "Rate limit exceeded"
			      ["code"]=>
			      int(88)
			    }
			  }
			}
		 */
		/*
		 * object(stdClass)#12 (1) {
  ["errors"]=>
  array(1) {
    [0]=>
    object(stdClass)#13 (2) {
      ["message"]=>
      string(31) "Sorry, that page does not exist"
      ["code"]=>
      int(34)
    }
  }
}
		 */
		
		if( $raw_response->statuses ) {
		
			$tweets = array();
			foreach($raw_response->statuses as $index => $tweet){
		
				$tweets[$index] = array();
				$tweets[$index]['message'] = $tweet->text;
				$tweets[$index]['id'] = $tweet->id_str;
				$tweets[$index]['created_time'] = $tweet->created_at;
		
			}
				
			return $tweets;
		
		}else{
		
			return false;
		
		}
		
	}
	
	public function get_posts_by_account(  $options=array()  ){
		
		if( empty($options['account_id']) )
			
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			
			throw new Exception('The http handler was not initialized before calling get_company_id_by_email_domain().');
		
		$url = "statuses/user_timeline";
		$params = array(
				'user_id' => $options['account_id'],
				'count' => 50
		);
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
			)
		);
		
		if( $raw_response ) {
				
			$tweets = array();
			foreach($raw_response as $index => $tweet){
				
				$tweets[$index] = array();
				$tweets[$index]['message'] = $tweet->text;
				$tweets[$index]['id'] = $tweet->id_str;
				$tweets[$index]['created_time'] = $tweet->created_at;
				
			}
			
			return $tweets;
				
		}else{
				
			return false;
				
		}
		
	}
	
	
	public function get_account_by_name( $options=array() ){
		
		if( empty($options['universal_name']) or empty($options['c_url']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			throw new Exception('The http handler was not initialized before calling linkedin_service::get_company_id_by_email_domain().');
		
		$url = "users/lookup";
		$params = array(
				'screen_name' => $options['universal_name']
		);
		
		$resp = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
			)
		);
		
		if( !empty($resp->errors) ){
			return false;
		}
		
		$resp = $resp[0];
		
		if( isset( $resp->entities->url->urls ) ) {
				
			foreach($resp->entities->url->urls as $t_url){
				
				if( isset($t_url->expanded_url ) and stristr( $t_url->expanded_url , $options['c_url'] ) ){
					$user = array();
					$user['id'] = $resp->id_str;
					$user['company_name'] = $resp->name;
					$user['name'] = $resp->screen_name;
					$user['website'] = $t_url->expanded_url;
					$user['link'] = 'www.twitter.com/'.$resp->screen_name;
					
					
					return $user;
				}
				
			}
			
			return false;
				
		}else{
				
			return false;
				
		}
		
	}
	
	public function get_account_by_email_domain( $options=array() ){
		
		if( empty($options['email_domain']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		$result = $this->get_user_for_query( array('query' => $options['email_domain']) );

		if( $result ){
			
			$accounts = array();
			$index = 0;
			foreach($result as $account){
				
				if( stristr( $account['website'], $options['email_domain'] ) ){
					
					$accounts[$index] = $account;
					$index++;
					
				}
				
			}
			
			return $accounts;
			
		}else{
			
			return false;
			
		}
		
	}
	
	public function get_user_for_query( $options=array() ){
		
		if( empty($options['query']) )
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
		
		if( !is_object( $this->http_handler ) )
			throw new Exception('The http handler was not initialized before calling get_company_id_by_email_domain().');
		
		$url = "users/search";
		$params = array(
			'q' => $options['query']
		);
		
		$raw_response = $this->http_handler->fetch( array(
				'method' => 'POST',
				'params' => $params,
				'url' => $url
			)
		);
		
		if( $raw_response ) {
			
			$users = array();
			foreach($raw_response as $index => $resp){
				
				$users[$index] = array();
				$users[$index]['id'] = $resp->id_str;
				$users[$index]['company_name'] = $resp->name;
				$users[$index]['name'] = $resp->screen_name;
				if( isset( $resp->entities->url->urls[0]->expanded_url ) ){
					$users[$index]['website'] = $resp->entities->url->urls[0]->expanded_url;
				}else{
					$users[$index]['website'] = '';
				}
				
				$users[$index]['link'] = 'www.twitter.com/'.$resp->screen_name;
				
			}
			
			return $users;
			
		}else{
			
			return false;
			
		}

	}

}