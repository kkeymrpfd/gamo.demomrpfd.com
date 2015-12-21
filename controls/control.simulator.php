<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Simulator {

	function run() {

		Core::authorize(array(
				'user_id' => 'get',
				'levels' => 'admin'
			)
		);
		
		global $data, $page_settings, $models, $session;

		require_once(DIR_MODELS . "/model.simulator.php");
		$simulator = new Model_Simulator();
		$result = $simulator->run();

		Core::shift_data($result);

		$page_settings['pages'] = array('simulator');

		return $data;

	}

}
?>
