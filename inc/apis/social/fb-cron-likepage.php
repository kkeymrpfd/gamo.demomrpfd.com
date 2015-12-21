<?php
require_once('cronjob-loader.php');
require_once('class.Facebook_Service.php');
require_once('class.Social_Cron.php');
require_once('class.Options.php');

$slug = 'facebookLikePage';

$fb = new Facebook_Service(array('current_slug'));
$action_slugs = $fb->get_action_slugs();
$action_types = array();

foreach($action_slugs as $action_slug){
	
	$action_types = array_merge($action_types,Social_Cron::get_action_types( array('action_slug' => $action_slug) ));
	
}

//error_log(print_r($action_types,true));exit;

if(!empty($action_types)){
	
	$fb = new Facebook_Service();
	
	$options = array_merge(
			$fb->get_connection(),
			$fb->get_game()
	);
	
	//$options_obj = new Options();
	//$options_obj->unlock_scraper(array('scraper_slug' => 'scraperFacebookLikePage'));
	
	$fb->get_page_likes($options);
	$new_actions = $fb->get_new_actions();
	
	error_log(print_r($new_actions,true));exit;
	
	if(!Core::has_error($new_actions) and !empty($new_actions)){
		
		///Cause we connect to the for every action, even old - we need to use the windows for actions to retrive only new actions
		foreach($new_actions as $action){

			$action_id = Social_Cron::get_logged_action(array(
					'user_id' => $action['user_id'], 
					'object_id' => $action['game_obj_id'], 
					'action_types_id' => $tw_action_types[$action['activity_slug'].$action['game_obj_id']]["action_types_id"]
			));
			if( Core::has_error($action_id) or !empty($action_id) ){
				continue;
			}else{
				error_log(print_r($action,true));
				
				/*
				$result = Core::r('actions')->create_action(array(
						'action_types_id' => $tw_action_types[$action['activity_slug'].$action['game_obj_id']]["action_types_id"], 
						'user_id' => $action['user_id'], 
						'other' => $action['object_id']
				));
				*/
			}

		}
		
	}
	
}else{
	
	error_log("We did not find any action types for given slugs. Check to have all the needed info in the action_type and action_type_info tables.");
	
}


