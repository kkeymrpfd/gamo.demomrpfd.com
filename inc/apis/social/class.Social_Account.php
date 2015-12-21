<?php
class Social_Account{
	
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
	
		$sql = "DELETE FROM " . GAMO_DB . '.users_info WHERE user_id = :user_id and info_type = :account_type';
	
		$sth = $dbh->prepare($sql);
		$result = $sth->execute(array(':user_id' => $options['user_id'], ':account_type' => $options['account_type']));
		return $result;
	}
	
	public function find_accounts($options=array()){
		global $dbh;
	
		$sql = 'SELECT user_id, int_info as s_user_id, info as username, info_b as access_token FROM ' . GAMO_DB .
		'.users_info WHERE info_type = "'.$options['account_type'].'"';
	
		$sth = $dbh->prepare($sql);
		$sth->execute();
	
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