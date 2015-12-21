<?
class Control_Admin_Get_Users {

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
		
		require_once(DIR_MODELS . "/model.get_users.php");
		$users = new Model_Get_Users();

		$per_page = 4; // How many records there should be per page

		$page = Core::get_input('page', 'get'); // The record number to start at

		if(!is_numeric($page) || $page < 1) { $page = 1; } // The start record was not set, so set it to 0

		$start = ($page-1) * $per_page; // The start record based on page # and # of records per page setting

		// Construct the filters array
		$filters = unserialize(Core::get_input('filters', 'get'));

		if(!is_array($filters)) {

			$filters = array();

		}
		
		$result = $users->run(array(
				'start' => $start,
				'records' => $per_page,
				'filters' => $filters
			)
		);
		
		if(isset($result['users'][0]['user_id'])) {

			foreach($result['users'] as $k => $user) {

				unset($result['users']['has']);

			}

		}

		Core::shift_data($result);

		return $data;

	}

}
?>