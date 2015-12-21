<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Quiz_Question_Unlock {

	function run() {

		global $data, $page_settings, $models, $session, $dbh;

		/*
		Core::authorize(array(
				'user_id' => 'get',
			)
		);
		*/
		
		$page_settings['allow_json'] = 1;

		$question_id = Core::get_input('question_id', 'get');

		// Retrieve question
		$sql = "SELECT quiz_id, question_id, question, polling, user_group FROM " . GAMO_DB . ".quiz_questions WHERE question_id = :question_id AND locked IN (1, 2)";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
			':question_id' => $question_id
			)
		);

		$question = $sth->fetch();

		$data['success'] = 0;
		$data['error'] = '';

		if($question === FALSE) {

			$data['error'] = "This is either an invalid question or it is not set to be a locked question";
			return $data;

		}

		if($question['user_group'] != '') { // Unlock all other user group questions for this quiz

			Core::db_update(array(
					'table' => GAMO_DB . '.quiz_questions',
					'values' => array(
						'locked' => 2
					),
					'where' => array(
						'quiz_id' => $question['quiz_id'],
						'polling' => 1
					)
				)
			);

			Core::db_update(array(
					'table' => GAMO_DB . '.quiz_questions',
					'values' => array(
						'locked' => 2
					),
					'where' => array(
						'quiz_id' => $question['quiz_id'],
						'polling' => 2
					)
				)
			);

		}

		// Set to unlocked
		Core::db_update(array(
				'table' => GAMO_DB . '.quiz_questions',
				'values' => array(
					'locked' => 2
				),
				'where' => array(
					'question_id' => $question_id
				)
			)
		);

		require(DIR_INC . "/vendor/realtimeco/ortc.php");

		// Broadcast unlocked status
		$URL = 'http://ortc-developers.realtime.co/server/2.1';
		$AK = 'JqrwmM';
		$PK = 'o9Hdy4qoFUwS';
		$TK = 'dummyToken'; // token can be randomly generated
		$CH = 'triviafever';
		      
		// Authenticating a token with write (w) permissions on myChannel
		  
	    $rt = new Realtime( $URL, $AK, $PK, $TK );
	    $ttl = 180000;
	    $result = $rt->auth(
	        array(
	            $CH => 'w'
	        ),
	        $ttl
	    );
		 
		// Send RT message
		$result = $rt->send($CH, json_encode($question), $response);

		// Broadcase
		$data['success'] = 1;
		
		return $data;

	}

}
?>
