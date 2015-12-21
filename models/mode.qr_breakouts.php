<?
class Model_Qr_Breakouts {

	function run($options = array()) {
		
		global $gamo, $data;

		$result = array();

		$result['qr_list'] = array(
			array(
				'name' => 'Breakout 1',
				'quiz_id' => 47
			),
			array(
				'name' => 'Breakout 2',
				'quiz_id' => 48
			),
			array(
				'name' => 'Breakout 3',
				'quiz_id' => 49
			),
			array(
				'name' => 'Breakout 4',
				'quiz_id' => 50
			),
			array(
				'name' => 'Breakout 5',
				'quiz_id' => 51
			)
		);

		require_once(DIR_MODELS . "/model.quiz.php");
		$quiz = new Model_Quiz();

		$action_types_id = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));

		foreach($result['qr_list'] as $k => $code) {

			$c = Core::db_count(array(
					'table' => GAMO_DB . '.actions_log',
					'values' => array(
						'action_types_id' => $action_types_id,
						'int_other' => Core::fetch_column(
							"SELECT qr_id FROM " . GAMO_DB . ".qr_codes WHERE qr_code = :qr_code",
							array(
								':qr_code' => $code['qr_code']
							)
						),
						'user_id' => $data['user_id']
					)
				)
			);

			$result['qr_list'][$k]['scanned'] = $c;

			$quiz = $quiz->run(array(
					'user_id' => $data['user_id'],
					'quiz_id' => $code['quiz_id']
				)
			);

		}
		
		return $result;

	}

}

?>
