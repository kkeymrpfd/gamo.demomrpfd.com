<?
class Control_Facebook_Connect {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo;
			
		$data['valid'] = false;
		
		$user_id = $session->get('user_id');
		
		if($user_id != -1) {
			
			$data['prefix'] = str_replace('#', '', $session->get('url'));
			$data['prefix'] = str_replace('_=_', '', $data['prefix']);
			
			if(empty($data['prefix'])) $data['prefix'] = "/";
			
			//error_log("Connect");
			//error_log(print_r($data['prefix'],true));

			$data['valid'] = Core::r('facebook_service','/social/')->login_user(array('user_id' => $user_id ));
		}
		
		if(!$data['valid'] or Core::has_error($data['valid'])){
			$session->set('social_connect_msg', "facebook_error");
			header("Location: ".PROTOCOL."://".URL.$data['prefix']);
			die();
		}else{
			$session->set('social_connect_msg', "facebook_linked");
			header("Location: ".PROTOCOL."://".URL.$data['prefix']);
			die();
		}
		
		return $data;

	}

}
?>