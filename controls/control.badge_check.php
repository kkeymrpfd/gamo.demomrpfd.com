<?
class Control_Badge_Check {

	function run($options = array()) {

		global $page_settings, $dbh, $data;

		Core::authorize();

		$page_settings['allow_json'] = 1;

		require_once(DIR_MODELS . "/model.badge_check.php");
		$model = new Model_Badge_Check();
		$result = $model->run(array(
				'badge_ids' => Core::get_input('badge_ids', 'get'),
				'user_id' => $data['user_id']
			)
		);

		Core::shift_data($result);
		
		return $data;

	}

}
?>