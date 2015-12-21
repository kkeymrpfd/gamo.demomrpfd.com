<?php
require_once('cronjob-loader.php');

class Social_Cron{
	
	static function get_action_types($options=array()){
		global $gamo;
		$action_types = array();
		
		//error_log(print_r($options,true));
		
		$action_typ_id = Core::r('actions')->map_action_type($options['action_slug']);
		if(!Core::has_error($action_typ_id)){
			$action_type = Core::r('actions')->get_action_type(array('action_types_id' => $action_typ_id['action_types_id']));
			if(!Core::has_error($action_type)){
				unset($action_type['has']);
				unset($action_type['action_name']);
				$action_types[$action_type['action_types_id_alias']] = $action_type;
			}else{
				return $action_type;
			}
		}else{
			return $action_typ_id;
		}
		
		return $action_types;
	}
	
	static function get_logged_action( $options=array() ){
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) or empty( $options['object_id'] ) or empty( $options['action_types_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$sql = "SELECT * FROM ".GAMO_DB.".`actions_log WHERE user_id = :userid AND other = :objectid AND action_types_id = :actiontypesid AND active = 1";
		
		try{
		
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$sres = $stm->execute(array(':userid' => $options['user_id'], ':objectid' => $options['object_id'], ':actiontypesid' => $options['action_types_id']));
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$id = $stm->fetch(PDO::FETCH_ASSOC);
		
		}catch(PDOException $e){
			$error = Core::error($this->errors, 4);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if(!empty( $id )){
			return $id;
		}else{
			return false;
		}

	}
	
	static function get_logged_actions($options=array()){
		global $gamo;
		$logged_actions = array();
		
		$actions = Core::r('actions')->get_actions(array('action_types' => $options['action_types'], 'get_count' => 1));
		if(!is_array($actions))
			return false;
		
		if(count($actions['actions']) < $actions['records']){
			//TODO: If the memory problem will exist need to find a way how to deal with it
			$actions = Core::r('actions')->get_actions(array('action_types' => $options['action_types'], 'records' => $actions['records']));
		}
		
		if(!is_array($actions))
			return false;
		//actions, records
		
		foreach($actions['actions'] as $index => $action){
			$logged_actions[] = $action['action_types_id'].'='.$action['user_id'].'='.$action['other'];
			unset($actions['actions'][$index]);
		}
		
		return $logged_actions;
	}
	
	/**
	 * 
	 * @param array $options array('sv_slugs' => array(), 'sv_options' => array(), 'social_obj' => Social()
	 */
	static function run_sv_cron($options=array()){
		global $gamo;
		
		$tw_action_types = array();
		foreach($options['sv_slugs'] as $name){
			$result = Social_Cron::get_action_types(array('action_slug' => $name));
			if(!Core::has_error($result))
				$tw_action_types = array_merge($tw_action_types, $result);
		}
		
		
		//Exit since we have no action types for twitter
		if(count($tw_action_types) == 0){
			die("No actions");
		}
		
		
		//Get all old actions for twitter
		$action_type_ids = array();
		foreach($tw_action_types as $action_type){
			$action_type_ids[] = $action_type['action_types_id'];
		}
		$tw_logged_actions = Social_Cron::get_logged_actions(array('action_types' => $action_type_ids));
		//var_dump($tw_logged_actions);
		if(!$tw_logged_actions) $tw_logged_actions = array();
		
		
		//Get new actions
		$new_actions = $options['social_obj']->get_actions($options['sv_options']);
		//Save really new actions
		//var_dump($new_actions);
		if(!Core::has_error($new_actions) and is_array($new_actions)){
			foreach($new_actions as $action){
				//TODO: we will set crons to the specific slug same as in the db
				//TODO: each action has a reference to the object
				$action_id = $tw_action_types[$action['activity_slug'].$action['game_obj_id']]["action_types_id"].'='.$action['user_id'].'='.$action['object_id'];
				if(!in_array($action_id,$tw_logged_actions)){
					//TODO:New save it
					//echo 'Added';
					$result = Core::r('actions')->create_action(array('action_types_id' => $tw_action_types[$action['activity_slug'].$action['game_obj_id']]["action_types_id"], 'user_id' => $action['user_id'], 'other' => $action['object_id']));
				}
			}
		}
		
	}
	
	
	
}