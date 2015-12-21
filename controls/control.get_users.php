<?
class Control_Get_Users {

	function run() {
		
		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session;

		$page_settings['allow_json'] = 1;
		
		require_once(DIR_MODELS . "/model.get_users.php");
		$users = new Model_Get_Users();

		$per_page = 4; // How many records there should be per page
		
		$filters = unserialize(Core::get_input('filters', 'get'));

		$page = Core::get_input('page', 'get'); // The record number to start at

		if(!is_numeric($page) || $page < 1) { $page = 1; } // The start record was not set, so set it to 0

		$start = ($page-1) * $per_page; // The start record based on page # and # of records per page setting

		// Construct the filters array
		$caller = Core::get_input('caller', 'get');
		
		if( !empty($caller) and $caller == 'leaderboard' ){
			
			$per_page = 7;
			$start = $page * $per_page;
			
		}
		

		if(!is_array($filters)) {

			$filters = array();

		}

		$result = $users->run(array(
				'start' => $start,
				'records' => $per_page,
				'filters' => $filters
			)
		);
		
		$is_admin = ($session->get('access_admin') == 1) ? 1 : 0;
		
		if(!$is_admin) {

			if(isset($result['users'][0]['user_id'])) {

				foreach($result['users'] as $k => $user) {

					unset($result['users'][$k]['email']);
					unset($result['users'][$k]['city']);
					unset($result['users'][$k]['state']);
					unset($result['users'][$k]['zip']);
					unset($result['users'][$k]['company']);
					unset($result['users'][$k]['first_name']);
					unset($result['users'][$k]['last_name']);
					unset($result['users'][$k]['has']);

				}

			}

		}

		Core::shift_data($result);

		return $data;

	}

}
?>