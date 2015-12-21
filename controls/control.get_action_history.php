<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Get_Action_History {

	function run() {

		Core::authorize(array(
				'user_id' => 'get',
			)
		);

		global $data, $page_settings, $models, $session;

		$page_settings['allow_json'] = 1;
		
		require_once(DIR_MODELS . "/model.get_action_history.php");
		$history = new Model_Action_History();

		$per_page = 10; // How many records there should be per page

		$page = Core::get_input('page', 'get'); // The record number to start at

		if(!is_numeric($page) || $page < 1) { $page = 1; } // The start record was not set, so set it to 0

		$start = ($page-1) * $per_page;
		
		$result = $history->run(array(
				'start' => $start,
				'user_id' => $session->get('user_id'),
				'category_id' => Core::get_input('category_id', 'get'),
				'records' => $per_page,
				'filters' => array(
					'point_value_use>' => 0
				)
			)
		);
		
		Core::shift_data($result);

		return $data;

	}

}
?>
