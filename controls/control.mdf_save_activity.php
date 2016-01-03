<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Mdf_Save_Activity {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		$page_settings['allow_json'] = 1;

		Core::authorize(array(
				'user_id' => 'get'
			)
		);

		$result = Core::r('mdf')->save_activity([
			'user_id' => $data['user_id'],
			'package_id' => Core::get_input('package_id', 'get'),
			'mdf_activity_id' => Core::get_input('mdf_activity_id', 'get'),
			'packages_option_id' => Core::get_input('packages_option_id', 'get'),
			'quarter_id' => Core::get_input('quarter_id', 'get'),
			'form' => Core::get_input('mdf_form', 'get')
		]);

		$data['result'] = $result;

		if(!Core::has_error($result)) {

			$session->set('mdf_saved', 1);

		}

		return $data;

	}

}
?>
