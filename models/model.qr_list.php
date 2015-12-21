<?
class Model_Qr_List {

	function run($options = array()) {
		
		global $gamo, $data;

		$result = array();

		$result['qr_list'] = array(
			'conference' => array(
				array(
					'name' => 'Customer Reference Booth',
					'qr_code' => '0k72le'
				),
				array(
					'name' => 'Keynote - Rick Devenuti',
					'qr_code' => '0najfz'
				),
				array(
					'name' => 'Momentum Party at Tao',
					'qr_code' => '1hcyti'
				),
				array(
					'name' => 'Momentum User Group',
					'qr_code' => '2jlf9n'
				),
				array(
					'name' => 'EMC Certified Selfie Station',
					'qr_code' => '3t99nh'
				),
				array(
					'name' => 'Syncplicity Booth',
					'qr_code' => '7kyj0o'
				),
				array(
					'name' => 'Genius Lab',
					'qr_code' => '40rm00'
				),
				array(
					'name' => 'Rogue Program',
					'qr_code' => 'qwko06'
				)
			),
			'Momentum Zone' => array(
				array(
					'name' => 'Content Management',
					'qr_code' => '80f068'
				),
				array(
					'name' => 'Managed Service OnDemand',
					'qr_code' => '95dcxx'
				),
				array(
					'name' => 'Cloud & SaaS',
					'qr_code' => 'a1wqtp'
				),
				array(
					'name' => 'Energy & Engineering',
					'qr_code' => 'a10m5j'
				),
				array(
					'name' => 'Financial Services & Insurance',
					'qr_code' => 'bp8dy3'
				),
				array(
					'name' => 'Healthcare',
					'qr_code' => 'ce6rlr'
				),
				array(
					'name' => 'Life Sciences',
					'qr_code' => 'cq7fs8'
				),
				array(
					'name' => 'Capture and Process',
					'qr_code' => 'd57yzc'
				),
				array(
					'name' => 'Governance',
					'qr_code' => 'dwwnzd'
				),
				array(
					'name' => 'Public sector',
					'qr_code' => 'e2vhkv'
				),
				array(
					'name' => 'Archiving',
					'qr_code' => 'ecctpz'
				)
			),
			'EMC Certified Solution Booths' => array(
					array(
							'name' => 'NNIT - Booth 830',
							'qr_code' => 'n97ak5'
					),
					array(
							'name' => 'Perficient - Booth 908',
							'qr_code' => 'lwrucf'
					),
					array(
							'name' => 'Presidio - Booth 914',
							'qr_code' => 'qcmezn'
					),
					array(
							'name' => 'enChoice - Booth 916',
							'qr_code' => 'ileoha'
					),
					array(
							'name' => 'CVISION – Booth 920',
							'qr_code' => 'ffwlug'
					),
					array(
							'name' => 'Bass - Booth 1001',
							'qr_code' => 'mxmplt'
					),
					array(
							'name' => 'Crawford Technologies - 1003',
							'qr_code' => 'nvshhp'
					),
					array(
							'name' => 'fme - Booth 1007',
							'qr_code' => 'k8y4p3'
					),
					array(
							'name' => 'Informative Graphics Corporation (IGC) - Booth 1009',
							'qr_code' => 'jn976n'
					),
					array(
							'name' => 'Reveille Software - Booth 1013',
							'qr_code' => 'gil24v'
					),
					array(
						'name' => 'Forefront Technologies - Booth 1019',
						'qr_code' => 'esewes'
					),
					array(
							'name' => 'IBM (formerly Daeja Image Systems) - Booth 1021',
							'qr_code' => 'mzlo4n'
					),
					array(
							'name' => 'Adlib Software - Booth 1023',
							'qr_code' => 'eijjmi'
					)
			)
		);
		
		require_once(DIR_MODELS . "/model.quiz.php");

		$action_types_id = Core::r('actions')->action_types_id(array('action_key' => 'qr_scan'));

		foreach($result['qr_list'] as $list_name => $list) {

			foreach($list as $k => $code) {

				$qr_id = Core::fetch_column(
					"SELECT qr_id FROM " . GAMO_DB . ".qr_codes WHERE qr_code = :qr_code",
					array(
						':qr_code' => $code['qr_code']
					)
				);

				$quiz_id = Core::fetch_column(
					"SELECT quiz_id FROM " . GAMO_DB . ".quizzes_info WHERE info_type = 'qr_required' AND int_info = :qr_id",
					array(
						':qr_id' => $qr_id
					)
				);

				$quiz = new Model_Quiz();
				$quiz = $quiz->run(array(
						'user_id' => $data['user_id'],
						'quiz_id' => $quiz_id
					)
				);

				$result['qr_list'][$list_name][$k]['qr_id'] = $qr_id;
				$result['qr_list'][$list_name][$k]['quiz_id'] = $quiz_id;

				$result['qr_list'][$list_name][$k]['scanned'] = 0;

				if($quiz['allow_quiz'] == 1) {

					$result['qr_list'][$list_name][$k]['scanned'] = 1;

					if($quiz['next_question_key'] == -1) {
					
						$result['qr_list'][$list_name][$k]['quiz_taken'] = 1;

					} else if($quiz['next_question_key'] != -1) {

						$result['qr_list'][$list_name][$k]['quiz_taken'] = 0;

					}

				}

			}

		}

		return $result;

	}

}

?>
