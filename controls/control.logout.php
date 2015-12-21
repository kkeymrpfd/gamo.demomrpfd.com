<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Logout {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		$session->destroy();

		header("Location: /?p=login");

		return $data;

	}

}
?>
