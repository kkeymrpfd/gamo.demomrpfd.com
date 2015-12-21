<?php
require_once('twitteroauth.php');

class Gamo_Twitteroauth_Handler  implements Gamo_IHttp_Handler{
	
	private $tw_oauth = null;
	
	public function init($tw_api_id, $tw_api_secret, $ouath_token_id, $outh_token_secret){
		
		$this->tw_oauth = new TwitterOAuth($tw_api_id, $tw_api_secret, $ouath_token_id, $outh_token_secret);
		
	}
	
	public function fetch( $options=array() ){
		
		return $this->tw_oauth->get( $options['url'], $options['params'] );
		
	}
	
}