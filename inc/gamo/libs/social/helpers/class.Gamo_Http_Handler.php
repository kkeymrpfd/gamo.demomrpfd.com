<?php
$path = pathinfo(__FILE__, PATHINFO_DIRNAME);
require_once($path.'/../interfaces/interface.Gamo_IHttp_Handler.php');

class Gamo_Http_Handler implements Gamo_IHttp_Handler{
	
	function fetch($options){
		
		if( empty($options['method']) )
			
			throw new Exception('Missing required parameters. Parameters['.print_r($options.true).']');
	
		$context_vars = array(
			'https' => array(
				'method' => $options['method']
			)
		);
		
		$param_str = !empty($options['params']) ? http_build_query($options['params']) : '';
			
		$url = $options['url'] . '?' . $param_str;

		$context = stream_context_create( $context_vars ) ;

		$response = @file_get_contents($url, false, $context );
		
		return $response;
		
	}
	
}