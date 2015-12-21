<?php
class Gamo_Social_Account{
	
	private $errors = array(
			array(
					'error_code' => '1',
					'error_msg' => 'Missing required arguments.'
			)
	); 
	
	public function create_account($options=array()){
		global $gamo;
		$result = Core::r('users')->create_user_info($options);
	
		if(Core::has_error($result)) {
			//TODO: Modify the code to save the value of the error to be reported
			return false;
		}
	
		return true;
	}
	
	public function delete_account($options=array()){
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) or empty( $options['account_type'])){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			$error['error_msg'] .= ' ARGUMENTS[' . error_log(print_r($options,true)) . ']';
			return $error;
		}
	
		$sql = "DELETE FROM " . GAMO_DB . '.users_info WHERE user_id = :user_id and info_type = :account_type';
	
		$sth = $dbh->prepare($sql);
		$result = $sth->execute(array(':user_id' => $options['user_id'], ':account_type' => $options['account_type']));
		
		if($result){
			$result = $sth->rowCount();
		}
		return $result;
	}
	
	public function find_accounts($options=array()){
		global $dbh;
		
		$result = Core::check_required_arguments(array('options' => $options, 'req_args' => array('account_type')));
		if(Core::has_error($result))
			return $result['error_msg'] .= " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		$sql = 'SELECT user_id, int_info as s_user_id, info as username, info_b as access_token FROM ' . GAMO_DB .
		'.users_info WHERE info_type = :account_type';
	
		$sth = $dbh->prepare($sql);
		$sth->execute(array(':account_type' => $options['account_type']));
	
		$fb_accounts = array();
	
		while($row = $sth->fetch()) {
			array_push($fb_accounts, Core::remove_numeric_keys($row));
		}
	
		if(!empty($fb_accounts)){
			return $fb_accounts;
		}else{
			return false;
		}
	}
	
	public function has_account($options=array()){
	
		$c = Core::db_count(array(
				'table' => '' . GAMO_DB . '.users_info',
				'values' => array(
						'user_id' => $options['user_id'],
						'info_type' => $options['account_type']
				)
			)
		);
	
		if($c > 0){
			return true;
		}
	
		return false;
	}
	
}