<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Get_Quiz {

	function run() {

		global $data, $page_settings, $models, $session, $dbh;

		$page_settings['allow_json'] = 1;
		
		require_once(DIR_MODELS . "/model.trivia_broadcast.php");
		$model = new Model_Trivia_Broadcast();
		$result = $model->run(array(
				'quiz_id' => Core::get_input('quiz_id', 'get')
			)
		);

		Core::shift_data($result);
		
		return $data;

	}

}
?>
