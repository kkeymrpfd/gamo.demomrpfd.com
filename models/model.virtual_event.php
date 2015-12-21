<?php
//this is not an instance from the ORM perspective, rather interface to table
//interface handles the validation? - 
class Model_Virtual_Event{
	
	static $table_name = 'virtual_event';
	static $action_slug = 'attend_virtual_event';
	
	
	//Core::error($this->errors, 10);
	
	function __construct(){
		
		$this->errors = array(
			array(
				'error_code' => 1,
				'error_msg' => 'Missing required paramaters.'
			),
			array(
				'error_code' => 2,
				'error_msg' => 'Failed to prepare DB statement.'
			),
			array(
				'error_code' => 3,
				'error_msg' => 'Failed to execute DB statement.'
			),
			array(
				'error_code' => 4,
				'error_msg' => 'Failed. Received a PDOException.'
			),
			array(
				'error_code' => 5,
				'error_msg' => 'Failed to find the action_types_id.'
			),
			array(
				'error_code' => 6,
				'error_msg' => 'Failed to find the action_types_id.'
			)
		);
	}
	
	public function create_event(){
		//TODO: Validate for title, date/time, description:
			//length = 255, present
		
	}
	
	public function edit_event(){
		//TODO: Validate for title, date/time, description:
			//length = 255
			//must have id
	}
	
	public function add_user( $options=array() ){
		//TODO: Add action to log
			//must event id
			
		
		$actions_type_id = $this->get_action_id_for_slug( array('slug' => 'attend_virtual_event') );
		
	}
	
	public function remove_user( $options=array() ){
		
		global $gamo;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d')."]";
		
		if( empty( $options['user_id'] ) or empty( $options['event_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
			
		//ERRORS: action type id not found
		//ERRORS: action id not found
		//ERRORS: failed removing
		
		
		$action_types_id = $this->get_action_id_for_slug( array('slug' => 'attend_virtual_event') );
		if( Core::has_error($action_types_id) or empty($action_types_id) ){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		
		$action_id = $this->get_action_id_for_user( array( 
			'action_type_id' => $action_types_id,
			'user_id' => $options['user_id'],
			'event_id' => $options['event_id']
		) );
		if( Core::has_error($action_id) or empty($action_id) ){
			$error = Core::error($this->errors, 6);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		
		$result = Core::r('actions')->modify_action( array( 'action_id' => $options['action_id'], 'values' => 'delete') );
		if( Core::has_error($result) or empty($result) ){
			$result['error_msg'] .= $error_append;
			return $result;
		}
			
		return $result;
		
	}
	
	
	public function get_action_id_for_user(){
		//TODO: Must get action_type_id, user_id, event_id
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d')."]";
		
		if( empty( $options['action_type_id'] ) or empty( $options['user_id'] ) or empty( $options['event_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}

		$sql = "SELECT action_id FROM `".GAMO_DB."`.`actions_log` WHERE action_types_id = :action_types_id AND user_id = :user_id ".
				"AND int_other = :event_id AND active = 1";
		
		try{
				
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= $error_append;
				return $error;
			}
				
			$sres = $stm->execute( array( 
				':action_types_id' => $options['action_type_id'],
				':user_id' => $options['user_id'],
				':event_id' => $options['event_id']
			 ) );
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= $error_append;
				return $error;
			}
				
			$id = $stm->fetchColumn(PDO::FETCH_ASSOC);
				
		}catch(PDOException $e){
				
			return false;
				
		}
		
		//TODO: check the value of id or exception try catch
		if( !empty( $id['action_id'] ) ){
				
			return $id['action_id'];
				
		}else{
				
			return false;
				
		}
		
	}
	
	private function get_action_id_for_slug( $options=array() ){
		
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d')."]";
		
		if( empty( $options['slug'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$sql = "SELECT action_types_id FROM `".GAMO_DB."`.`action_types_info` WHERE info_type = :infotype";
		
		try{
			
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= $error_append;
				return $error;
			}
			
			$sres = $stm->execute( array( ':infotype' => $options['slug'] ) );
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= $error_append;
				return $error;
			}
			
			$id = $stm->fetchColumn(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			$error = Core::error($this->errors, 3);
			$error['error_msg'] = " PDO MESSAGE[".$e->getMessage()."]";
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		//TODO: check the value of id or exception try catch
		if( !empty( $id['action_types_id'] ) ){
			
			return $id['action_types_id'];
			
		}else{
			
			return false;
			
		}
		
	}
	
}