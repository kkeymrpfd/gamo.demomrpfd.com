<?php
require_once('config.php');
/**
 * 
 * This class is the kinda factory for the framework. This should be the only class neeeded to be loaded. The constructor accepts
 * an array with 'service' key that contains an array of service to instantiate (make available). The values are defined as constants
 * in Social.
 * 
 * The framework exposes four main API methods:
 * 		
 * 		get_login_url()
 * 		login_user()
 * 		logoff_user()
 * 		get_actions()
 * 
 * Each method based on the type of service used will require a different values present in the array. The functions confirm that all required
 * values are present in the array provided for the method. To get details on values for each, check the function with the same name
 * for each of the services. One value 'service' must be a string corresponding to the name of the service defined in Social constants.
 *
 */
class Social{
	
	const SV_FACEBOOK = 'fb_service';
	const SV_TWITTER = 'tw_service';
	const SV_INSTAGRAM = 'is_service';
	const SV_YOUTUBE = 'yt_service';
	const SV_LINKEDIN = 'li_service';
	
	protected $fb_service;
	protected $tw_service;
	protected $is_service;
	protected $yt_service;
	protected $li_service;
	
	static $errors = array(
		array(
			'error_code' => '1',
			'error_message' => 'No Service Name was provided.'
		),
		array(
			'error_code' => '2',
			'error_message' => 'Service Name provided does not match any defined'
		),
		array(
			'error_code' => '3',
			'error_message' => 'Requred option/argument was not provided'
		),
		array(
			'error_code' => '4',
			'error_message' => 'No actions were found'
		)	
	);
	
	protected $class_ref = array(
		self::SV_FACEBOOK => 'Facebook_Service', 
		self::SV_TWITTER => 'Twitter_Service', 
		self::SV_INSTAGRAM => 'Instagram_Service',
		self::SV_YOUTUBE => 'Youtube_Service',
		self::SV_LINKEDIN => 'Linkedin_Service'
	);
	
	
	public function __construct($options=array()){
		
		/*
		 * Arguments:
		 * {
		 * 		'services: array('fbService', 'twService', 'isService);
		 * }
		 */
		$result = self::ch_args(array('options' => $options, 'req_args' => array('services')));
		if(Core::has_error($result))
			die($result['error_msg']);
		$result = $this->init($options);
		if(Core::has_error($result))
			die($result['error_msg']);
	}
	
	public function get_connection($options=array()){
		$result = self::ch_args(array('options' => $options, 'req_args' => array('service')));
		if(Core::has_error($result))
			return $result;
		
		$service = $options['service'];
		return $this->$service->get_connection();
	}
	
	public function get_game($options=array()){
		$result = self::ch_args(array('options' => $options, 'req_args' => array('service')));
		if(Core::has_error($result))
			return $result;
	
		$service = $options['service'];
		return $this->$service->get_game();
	}
	
	public function get_action_names($options=array()){
		$result = self::ch_args(array('options' => $options, 'req_args' => array('service')));
		if(Core::has_error($result))
			return $result;
	
		$service = $options['service'];
		return $this->$service->get_action_names();
	}
	
	protected function init($options=array()){
		return $this->load_classes($options);
	}
	
	private function load_classes($options){
		foreach($options['services'] as $service_name){
			if(!array_key_exists($service_name, $this->class_ref))
				return Core::error(self::$errors, 2);
			$name = $this->class_ref[$service_name];
			
			require_once('class.'.$name.'.php');
			$this->$service_name = new $name();
			
			return true;
		}
	}
	
	static function ch_args($options=array()){
		if(!isset($options['options']))
			return Core::error(self::$errors, 3);
		if(!isset($options['req_args']))
			return Core::error(self::$errors, 3);
		
		foreach($options['req_args'] as $arg_name){
			if(!isset($options['options'][$arg_name])){
				error_log($arg_name);
				return Core::error(self::$errors, 3);
			}
				
		}
		return true;
	}
	
	/**
	 * 
	 * @param array $options array('service' => Social::SV_TWITTER). Also it includes all the key needed for the specific method of the 
	 * framework for a specific class. Check the commet for that method. Ex: check Twitter_Service get_actions() for additional values
	 * for that method
	 * @return array array('error_code' => '', 'error_message' => '')
	 */
	public function get_actions($options=array()){
		$result = self::ch_args(array('options' => $options, 'req_args' => array('service')));
		if(Core::has_error($result))
			return $result;
		
		$service = $options['service'];
		$result = $this->$service->get_actions($options);
		if(Core::has_error($result))
			return $result;
		

		if(isset($this->$service->actions_new)){
			return $this->$service->actions_new;
		}else{
			return Core::error(self::$errors, 4);
		}

	}
	
	public function has_account($options=array()){
		$result = self::ch_args(array('options' => $options, 'req_args' => array('service','user_id')));
		if(Core::has_error($result))
			return $result;
		
		$service = $options['service'];
		return $this->$service->has_account($options);
	}
	
	/**
	 *
	 * @param array $options array('service' => Social::SV_TWITTER). Also it includes all the key needed for the specific method of the
	 * framework for a specific class. Check the commet for that method. Ex: check Twitter_Service get_actions() for additional values
	 * for that method
	 * @return array array('error_code' => '', 'error_message' => '')
	 */
	public function get_login_url($options=array()){
		$result = self::ch_args(array('options' => $options, 'req_args' => array('service')));
		if(Core::has_error($result))
			return $result;
		
		$service = $options['service'];
		return $this->$service->get_login_url($options);
	}
	
	/**
	 *
	 * @param array $options array('service' => Social::SV_TWITTER). Also it includes all the key needed for the specific method of the
	 * framework for a specific class. Check the commet for that method. Ex: check Twitter_Service get_actions() for additional values
	 * for that method
	 * @return array array('error_code' => '', 'error_message' => '')
	 */
	public function login_user($options=array()){
		$result = self::ch_args(array('options' => $options, 'req_args' => array('service')));
		if(Core::has_error($result))
			return $result;
		
		$service = $options['service'];
		return $this->$service->login_user($options);
	}
	
	/**
	 *
	 * @param array $options array('service' => Social::SV_TWITTER). Also it includes all the key needed for the specific method of the
	 * framework for a specific class. Check the commet for that method. Ex: check Twitter_Service get_actions() for additional values
	 * for that method
	 * @return array array('error_code' => '', 'error_message' => '')
	 */
	public function logoff_user($options=array()){
		$result = self::ch_args(array('options' => $options, 'req_args' => array('service')));
		if(Core::has_error($result))
			return $result;
		
		$service = $options['service'];
		return $this->$service->logoff_user($options);
	}
	
	protected function get_scrape($options=array()){
		$service = $options['service'];
		return $this->$service->scrape;
	}
	
}