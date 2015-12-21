<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_View {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;
		
		$page_settings['allow_json'] = 0;

		$pages = array(
			'login',
			'validate',
			'welcome',
			'profile',
            'scoreboard',
			'qrcode',
			'prizes',
		);

		$data['page'] = $page_settings['page'];
		if (!in_array($page_settings['page'], $pages)) {
			$page_settings['page'] = 'login';
		}

		return $data;

	}

}
