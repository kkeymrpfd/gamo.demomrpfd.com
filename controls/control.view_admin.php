<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_View_Admin {

	function run() {
		
		Core::authorize(array(
				'user_id' => 'get',
				'levels' => 'admin'
			)
		);
	
		global $data, $page_settings, $models, $session;

		$gamo = new Gamo();

		$pages = array(
			'admin_general',
			'admin_users',
			'admin_user',
			'admin_actions',
			'admin_resources',
			'admin_vevents',
            'admin_fevents',
			'admin_reports'
		);

		if(!in_array($page_settings['page'], $pages)) {

			$page_settings['page'] = 'admin_general';

		}

		$result = array();

		if($page_settings['page'] == 'admin_general') {

			require_once(DIR_MODELS . "/model.admin_general.php");
			$model = new Model_Admin_General();
			$result = $model->run();

		} else if($page_settings['page'] == 'admin_users') {

			require_once(DIR_MODELS . "/model.admin_users.php");
			$model = new Model_Admin_Users();
			$result = $model->run();

		}  else if($page_settings['page'] == 'admin_user') {

			require_once(DIR_MODELS . "/model.admin_user.php");
			$model = new Model_Admin_User();
			$result = $model->run(array(
					'user_id' => Core::get_input('user_id', 'get')
				)
			);

		} else if($page_settings['page'] == 'admin_actions') {

			require_once(DIR_MODELS . "/model.admin_users.php");
			$model = new Model_Admin_Users();
			$result = $model->run();

		}

		Core::shift_data($result);
		//Core::print_r($result);
		
		$page_settings['pages'] = array('admin_header', $page_settings['page'], 'admin_footer');

		$data['page'] = $page_settings['page'];

		return $data;

	}

}
?>
