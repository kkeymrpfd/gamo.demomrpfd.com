<?
class Model_Trivia_Broadcast {

	function run($options = array()) {

		global $data, $gamo;
		
		Core::ensure_defaults(array(
				'quiz_id' => -1
			)
		, $options);

		$result['question_set'] = Core::r('quiz')->get_question_set(array(
				'quiz_id' => $options['quiz_id']
			)
		);

		return $result;

	}

}

?>