<?

class Control_Get_Recent_Activity {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $gamo, $data, $page_settings;	
		
		$page_settings['allow_json'] = 1;

		require_once(DIR_MODELS . "/model.recent_activity.php");
		$model = new Model_Recent_Activity();
		$result = $model->run();

		Core::shift_data($result);
		
		return $data;

	}

}
?>
