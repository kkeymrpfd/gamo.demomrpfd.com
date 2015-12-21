<?
class Control_Linkedin_Login {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session;

		$page_settings['allow_json'] = 1;
		$page_settings['view'] = 'json';
			
		$data['login_url'] = '';
		require_once(DIR_INC . "/apis/social/class.Social.php");
		
		$service = Social::SV_LINKEDIN;
		$social = new Social(array('services' => array($service)));
		$user_id = $session->get('user_id');
		
		error_log('Inlogin');
		
		if($user_id != -1) {
			error_log('Usergot');
			$url = preg_replace('/&msg=(.)+_linked/', '', Core::get_input('url','get') );
			$url = preg_replace('/&msg=(.)+_disconnect/', '', $url );
			$url = preg_replace('/&msg=(.)+_error/', '', $url );
			
			$session->set('url', $url);
			
			$options = array_merge(array(
					'redirect_url' => LI_REDIRECT_URL,
					'service' => $service),
					$social->get_connection(array('service' => $service))
			);
			
			$result = $social->get_login_url($options);
			
			if(!Core::has_error($result)){
				$data['login_url'] = $result;
			}
		}
		
		//error_log(print_r($data,true));
		
		return $data;

	}

}
?>