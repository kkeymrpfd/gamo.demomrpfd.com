<?
class Control_Linkedin_Connect {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session;
			
		$data['valid'] = false;
		require_once(DIR_INC . "/apis/social/class.Social.php");
		
		$service = Social::SV_LINKEDIN;
		$social = new Social(array('services' => array($service)));
		$user_id = $session->get('user_id');
		
		if($user_id != -1) {
			
			$data['prefix'] = str_replace('#', '', $session->get('url'));
			$data['prefix'] = str_replace('_=_', '', $data['prefix']);
			
			if(empty($data['prefix'])) $data['prefix'] = "/";
			
			
			$options = array_merge(array(
					'redirect_url' => LI_REDIRECT_URL,
					'user_id' => $user_id,
					'service' => $service),
					$social->get_connection(array('service' => $service))
			);

			$data['valid'] = $social->login_user($options);
		}

		$data['service'] = 'linkedin';
		
		if(!$data['valid'] or Core::has_error($data['valid'])){
			$session->set('social_connect_msg', $data['service']."_error");
			header("Location: ".PROTOCOL."://".URL.$data['prefix']);
			die();
		}else{
			$session->set('social_connect_msg', $data['service']."_linked");
			header("Location: ".PROTOCOL."://".URL.$data['prefix']);
			die();
		}
		
		return $data;

	}

}
?>