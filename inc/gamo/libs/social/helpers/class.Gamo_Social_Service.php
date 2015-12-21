<?php
class Gamo_Social_Service implements Gamo_IAccount_Updatable, Gamo_IHttp_Fetchable, Gamo_IScrapable{
	
	protected $account_handler = null;
	protected $http_handler = null;
	protected $scraper = null;
	protected $account_type = null;
	protected $redirect_url = null;
	
	public function __construct($options=array()){
		
		global $gamo;
		
		$start_date = Core::r('options')->get_option( array('key' => 'event_start_time') );
		if( empty($start_date) or Core::has_error($start_date) ){
			$this->start = strtotime('2013-07-01');
		}else{
			$this->start = strtotime($start_date);
		}
			
		
		$this->redirect_url = PROTOCOL."://".URL.'/?a='.$this->service.'_connect';
		
	}
	
	public function add_account_handler(Gamo_IAccount_Handler $ah){
	
		$this->account_handler = $ah;
	
	}
	
	public function add_http_handler(Gamo_IHttp_Handler $hh){
	
		$this->http_handler = $hh;
	
	}
	
	public function add_scraper(Gamo_IScraper $sc){
	
		$this->scraper = $sc;
	
	}
	
	public function get_account_name_from_link( $options=array() ){
	
		if( empty( $options['account_link'] ) )
	
			throw new Exception('Missing required elements. Parameters['.print_r($options,true).']');
	
		preg_match('$'.$this->link_prefix.'(?<account_name>[^/]*)$', $options['account_link'], $matches);
	
		return $matches['account_name'];
	
	}
	
	public function is_scraper_locked($options=array()) {

		$isLocked = Core::get($lock_name);
	
		return $isLocked ? true : false;
	}
	
	public function lock_scraper($options=array()) {

		if(!Core::set($lock_name,1,0,1200))
			return false;
	
		return true;
	}
	
	public function unlock_scraper($options=array()) {

		if(!Core::set($lock_name,0,0,1200))
			return false;
	
		return true;
	}
	
	public function logoff_user($options=array()){
	
		global $gamo;
	
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('user_id')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		$result = Core::r('social_account', '/social/')->delete_account( array('account_type' => $this->account_type, 'user_id' => $options['user_id']) );
	
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		if(!$result) {
			$error = Core::error($this->errors,7);
			$error['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
	
		return true;
	
	}
	
	
}