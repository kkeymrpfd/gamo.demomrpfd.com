<?php
class Control_Remove_User_Vevent {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;
		$page_settings['view'] = 'json';
		$data['valid'] = false;
		
		$event_id = Core::get_input('event_id', 'get');
		$user_id = Core::get_input('user_id', 'get');
			
		$result = Core::r('virtual_events')->remove_user( array( 'user_id' => $user_id, 'event_id' => $event_id ) );
		
		if( Core::has_error($result) ){
			error_log($result['error_msg']);
		}elseif( empty($result) ){
			error_log("Removing user might failed. Eventid [".$event_id."] Userid [".$user_id."]");
		}else{
			$data['valid'] = true;
		}

		return $data;

	}

}
?>