<?php
class Control_Youtube_Connect {

	function run() {

		Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
		global $data, $page_settings, $models, $session;
			
		$data['valid'] = false;
		require_once(DIR_INC . "/apis/social/class.Social.php");

		$service = Social::SV_YOUTUBE;
		$social = new Social(array('services' => array($service)));
		$user_id = $session->get('user_id');

		if($user_id != -1) {
			$data['prefix'] = str_replace('#', '', $session->get('url'));
				
			$options = array_merge(array(
					'user_id' => $user_id,
					'service' => $service,
					'yt_token' => Core::get_input('code','get')),
					$social->get_connection(array('service' => $service))
			);
			$data['valid'] = $social->login_user($options);
			
			if(Core::has_error($data['valid'])){
				error_log(print_r($data['valid'],true));
				$data['valid'] = false;
			}
		}

		$data['service'] = 'youtube';

		if(!$data['valid'] or Core::has_error($data['valid'])){
			$session->set('social_connect_msg', $data['service']."_error");
			header("Location: ".PROTOCOL."://".URL.$data['prefix']);
			die();
		}else{
			$session->set('social_connect_msg', $data['service']."_linked");
			header("Location: ".PROTOCOL."://".URL.$data['prefix']);
			die();
		};

		return $data;

	}

}
?>