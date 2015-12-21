<?php
require_once('Facebook.php');

class Gamo_Facebook_Handler implements Gamo_IHttp_Handler{
	
	private $fb_app = null;
	
	public $errors = array(
			array(
					'error_code' => 0,
					'error_msg' => 'The facebook object was not initialized yet',
					'error_level' => 'warning'
			)
	);
	
	public function init( $app_id, $app_secret ){
		
		$this->fb_app = new Facebook( array( 'appId' => $app_id, 'secret' => $app_secret ) );
		
	}
	
	public function fetch( $options=array() ){
		
		if( !$this->check_fb_object() ){
			$error = Core::error($this->errors,0);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		if(!empty($options['params'])){
			$response = $this->fb_app->api( $options['url'], $options['params'] );
		}else{
			$response = $this->fb_app->api( $options['url'] );
		}
		
		if(!isset($response)){
			throw new FacebookApiException( array( 'error_description' => 'Fasebook api return false json_encode parsing.') );
		}
		
		return $response;
		
	}
	
	public function __call($method_name, $arguments){
		
		if( !$this->check_fb_object() )
			return false;
		
		return call_user_func_array( array( &$this->fb_app, $method_name ), $arguments );
		
	}
	
	private function check_fb_object(){
		
		if( !is_object( $this->fb_app ) ){
			
			return false;
			
		}else{
			
			return true;
			
		}
	}
	
}