<?

class Control_Get_Dashlets {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $gamo, $data, $page_settings;	
		
		$page_settings['allow_json'] = 1;

		require_once(DIR_MODELS . "/model.home.php");
		$model = new Model_Home();
		$result = $model->run(array('user_id' => $data['user_id']));

		Core::shift_data($result);
		
		return $data;

	}

}
?>
