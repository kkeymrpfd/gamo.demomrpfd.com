<?
class Control_Youtube_Login {

	function run() {

		global $data, $page_settings, $models, $session;

		$page_settings['allow_json'] = 1;
		$page_settings['view'] = 'json';
			
		$data['login_url'] = '';
		
		require_once(DIR_INC . "/apis/social/class.Social.php");
		
		$service = Social::SV_YOUTUBE;
		$social = new Social(array('services' => array($service)));
		$user_id = $session->get('user_id');
		
		if($user_id != -1) {
			$url = preg_replace('/&msg=(.)+_linked/', '', Core::get_input('url','get') );
			$url = preg_replace('/&msg=(.)+_disconnect/', '', $url );
			$url = preg_replace('/&msg=(.)+_error/', '', $url );
			
			$session->set('url', $url);
			
			$options = array_merge(array(
					'redirect_url' => YT_REDIRECT_URL,
					'service' => $service),
					$social->get_connection(array('service' => $service))
			);
			
			$result = $social->get_login_url($options);
			
			if(!Core::has_error($result)){
				$data['login_url'] = $result;
			}
		}
		
		return $data;

	}

}
?>