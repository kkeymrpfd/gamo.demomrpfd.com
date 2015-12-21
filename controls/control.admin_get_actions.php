<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Admin_Get_Actions {

	function run() {

		/*
		Core::authorize(array(
				'user_id' => 'get',
				'levels' => 'admin'
			)
		);
		*/

		global $data, $page_settings, $models, $session;

		$page_settings['allow_json'] = 1;
		
		require_once(DIR_MODELS . "/model.get_action_history.php");
		$history = new Model_Action_History();

		$per_page = 10; // How many records there should be per page

		$page = Core::get_input('page', 'get'); // The record number to start at

		if(!is_numeric($page) || $page < 1) { $page = 1; } // The start record was not set, so set it to 0

		$start = ($page-1) * $per_page;

		$filters = unserialize(Core::get_input('filters', 'get'));

		if(!is_array($filters)) {

			$filters = array();

		}

		Core::ensure_defaults(array(
				'action_types' => array(),
				'user_name' => '',
				'active' => 1
			)
		, $filters);

		$result = $history->run(array(
				'start' => $start,
				'category_id' => Core::get_input('category_id', 'get'),
				'user_name' => $filters['user_name'],
				'records' => $per_page,
				'action_types' => $filters['action_types'],
				'active' => $filters['active']
			)
		);
		
		Core::shift_data($result);

		return $data;

	}

}
?>
