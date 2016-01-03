<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Delete_Mdf_Activity {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		$page_settings['allow_json'] = 1;

		Core::authorize(array(
				'user_id' => 'get'
			)
		);

		$delete = Core::r('mdf')->delete_activity(array(
				'mdf_activity_id' => Core::get_input('mdf_activity_id', 'get'),
				'user_id' => $data['user_id']
			)
		);

		Core::shift_data($delete);

		return $data;

	}

}
?>
