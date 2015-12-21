<?php
class Control_Load_Video {
	
	
	function run() {
	
		global $data, $page_settings, $models, $session, $gamo, $dbh;
		
		$data['src'] = Core::get_input('src', 'get');
		$data['resource_id'] = Core::get_input('resource_id', 'get');
		
	}
	
}