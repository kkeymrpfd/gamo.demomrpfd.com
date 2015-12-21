<?
class Control_Linkedin_Logoff {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session;

		$page_settings['allow_json'] = 1;
		$page_settings['view'] = 'json';
			
		$data['valid'] = false;
		$data['service'] = 'linkedin';
		require_once(DIR_INC . "/apis/social/class.Social.php");
		
		$service = Social::SV_LINKEDIN;
		$social = new Social(array('services' => array($service)));
		$user_id = $session->get('user_id');
		
		
		if($user_id != -1) { 
			
			$options = array(
					'user_id' => $user_id,
					'service' => $service
			);
			
			$data['valid'] = $social->logoff_user($options);
			
			if( $data['valid'] and !Core::has_error($data['valid'])){
				$session->set('social_connect_msg', $data['service']."_disconnect");
			}
		}
		
		return $data;

	}

}
?>