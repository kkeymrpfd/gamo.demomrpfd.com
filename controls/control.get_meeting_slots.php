<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Get_Meeting_Slots {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;

		$data['slots'] = Core::r('slots')->get_slots();

		return $data;

	}

}
?>
