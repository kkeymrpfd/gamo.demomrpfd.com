<?
class Control_Facebook_Login {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;
		$page_settings['view'] = 'json';
			
		$data['login_url'] = '';

		$url = preg_replace('/&msg=(.)+_linked/', '', Core::get_input('url','get') );
		$url = preg_replace('/&msg=(.)+_disconnect/', '', $url );
		$url = preg_replace('/&msg=(.)+_error/', '', $url );
		
		//error_log("Login");
		//error_log(print_r($url,true));
		$session->set('url', $url);

		
		$result = Core::r('facebook_service', '/social/')->get_login_url();
		
		if(!Core::has_error($result)){
			$data['login_url'] = $result;
			$data['login_url'] = str_replace('arrowriseabove.com', 'www.arrowriseabove.com', $data['login_url']);
		}

		
		return $data;

	}

}
?>