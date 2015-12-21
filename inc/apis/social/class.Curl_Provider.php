<?php
class Curl_Provider {
	
	  /* Contains the last HTTP status code returned. */
	  public $http_code;
	  /* Contains the last API call. */
	  public $url;
	  /* Set up the API root URL. */
	  public $host;
	  /* Set timeout default. */
	  public $timeout = 30;
	  /* Set connect timeout. */
	  public $connecttimeout = 30; 
	  /* Verify SSL Cert. */
	  public $ssl_verifypeer = FALSE;
	  /* Respons format. */
	  public $format = 'json';
	  /* Decode returned json data. */
	  public $decode_json = TRUE;
	  /* Contains the last HTTP headers returned. */
	  public $http_info;
	  /* Set the useragnet. */
	  public $useragent = 'Curl v0.1';
	  /* Immediately retry the API call if the response was not successful. */
	  //public $retry = TRUE;
	  
	  function __construct($options=array()){
  		$this->host = $options['host_url'];
  	  }
  	  
  	 protected function build_query_string($data) {
  	  	$querystring = '';
  	  	if (is_array($data)) {
  	  		// Change data in to postable data
  	  		foreach ($data as $key => $val) {
  	  			if (is_array($val)) {
  	  				foreach ($val as $val2) {
  	  					$querystring .= urlencode($key).'='.urlencode($val2).'&';
  	  				}
  	  			} else {
  	  				$querystring .= urlencode($key).'='.urlencode($val).'&';
  	  			}
  	  		}
  	  		$querystring = substr($querystring, 0, -1); // Eliminate unnecessary &
  	  	} else {
  	  		$querystring = $data;
  	  	}
  	  	return $querystring;
  	  }
  	  
  	public function http($url, $method, $postfields = NULL){
  		
  		switch($method){
  			case 'GET':
  				$post_data_url = $this->build_query_string($postfields);
  				return $this->get($url."/?".$post_data_url);
  				break;
  			case 'POST':
  				return $this->post($url,$postfields);
  				break;
  			default:
  				break;
  		}
  	}
  	
  	public function post($url, $post_values){
  		$this->http_info = array();
  		$ci = curl_init();
  		$ferr = fopen('/tmp/request.txt','w');
  	
  		curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
  		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
  		curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
  		curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
  		curl_setopt($ci, CURLOPT_HEADER, FALSE);
  		curl_setopt($ci, CURLOPT_POST, true);
  		curl_setopt($ci, CURLOPT_POSTFIELDS, $post_values);
  		curl_setopt($ci, CURLOPT_URL, $url);
  		curl_setopt($ci, CURLOPT_STDERR, $ferr);
  	
  	
  		$response = curl_exec($ci);
  		$this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
  		$this->http_info = array_merge($this->http_info, curl_getinfo($ci));
  		$this->url = $url;
  	
  		curl_close ($ci);
  		return $response;
  	}
  	
  	public function get($url){
  		$this->http_info = array();
  		$ci = curl_init();
  		
  		curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
  		curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
  		curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
  		curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
  		curl_setopt($ci, CURLOPT_HEADER, FALSE);		
  		curl_setopt($ci, CURLOPT_URL, $url);
  		
  		
  		$response = curl_exec($ci);
  		$this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
  		$this->http_info = array_merge($this->http_info, curl_getinfo($ci));
  		$this->url = $url;
  		
  		curl_close ($ci);
  		return $response;
  	}
	
	public function get_http_info(){
		return $this->http_info;
	}
	
	public function get_http_code(){
		return $this->http_code;
	}
}