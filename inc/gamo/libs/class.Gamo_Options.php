<?php
define("OPTIONS_TABLE_NAME",GAMO_DB.'.`options`');

class Gamo_Options{
	
	
	static $table_name = OPTIONS_TABLE_NAME;
	
	private $errors = array(
			array(
					'error_code' => 1,
					'error_msg' => 'Missing required arguments',
					'error_level' => 'error'
			)
	);
	
	public function get_option($options=array()){

		Core::ensure_defaults(array(
				'key' => ''
		),$options);
		
		$sql = "SELECT value FROM ".self::$table_name." WHERE `tkey` = :tkey";
		
		$result = Core::db_execute(
				array(
						'sql' => $sql,
						'params' => array(
								':tkey' => $options['key']
						),
						'get_method' => 'fetchColumn'
				)
		);
		
		if( Core::has_error($result) ){
			$result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		}
		
		return $result;
		
	}
	
 	function set_option( $options=array() ){
 		
 		if( empty($options['key']) or empty($options['value']) ){
 			
 			$error = Core::error($this->errors, 2);
 			$error['error_msg'] .= "PARAMS[".print_r($options,true)."] CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
 			return $error;
 			
 		}
 		
 		$sql = "INSERT INTO ".self::$table_name." (`tkey`, `value`) VALUES (:tkey, :value) ON DUPLICATE KEY UPDATE `value` = :tvalue ";
 		
		$result = Core::db_execute(array(
				'sql' => $sql,
				'params' => array(
						':tkey' => $options['key'],
						':value' => $options['value'],
						':tvalue' => $options['value']
				),
				'query_type' => 'insert to update'
		));
		
		if( Core::has_error($result) ){
			$result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		}
		
		return $result;
 		
 	}
	
}