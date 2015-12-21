<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Home {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		$page_settings['allow_json'] = 0;

		global $data, $page_settings, $models;
		
		$page_settings['pages'] = array('header', 'home', 'footer');

		return array(
			'page' => 'something'
		);

	}

}
?>