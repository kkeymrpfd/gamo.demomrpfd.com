<?
class Control_Facebook_Logoff {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;
		$page_settings['view'] = 'json';
			
		$data['valid'] = false;
		
		$user_id = $session->get('user_id');
		if($user_id != -1) {
			$data['valid'] = Core::r('facebook_service','/social/')->logoff_user( array('user_id' => $user_id, 'account_type' => 'facebook_account' ));
			
			if( $data['valid'] and !Core::has_error($data['valid'])){
				$session->set('social_connect_msg', "facebook_disconnect");
			}
		}
		
		return $data;

	}

}
?>