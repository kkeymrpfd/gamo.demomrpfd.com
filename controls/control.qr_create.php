<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Qr_Create {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		require_once(DIR_MODELS . "/model.qr_list.php");
		$qr = new Model_Qr_List();

		$result = $qr->run();

		foreach($result['codes'] as $category => $codes) {

			foreach($codes as $k => $code) {

				/*
				Core::db_insert(array(
						'table' => GAMO_DB . '.qr_codes',
						'values' => array(
							'qr_name' => $code['name'],
							'qr_code' => $code['qr_code'],
							'trigger_step' => 'breakout_trivia'
						)
					)
				);
				*/

			}

		}

		Core::print_r($result);

		return $data;

	}

}
?>
