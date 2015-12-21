<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Ct_Fix {

	function run() {

		global $data, $page_settings, $models, $session, $dbh;

		$page_settings['allow_json'] = 1;
		
		DEFINE("CT_DB", "ct30_main");
		
		/*
		$sql = "SELECT * FROM " . CT_DB . ".QUESTIONS AS QUESTIONS WHERE CampaignID = 4143 AND (SELECT count(*) FROM " . CT_DB . ".PROFILES AS PROFILES WHERE QuestionID = QUESTIONS.ID) = 0;";
		echo $sql;
		$sth = $dbh->prepare($sql);
		$sth->execute();
		
		$questions = array();
		
		while($row = $sth->fetch()) {
			
			Core::remove_numeric_keys($row);
			//Core::print_r($row);
			
			//$questions[] = '"' . implode('","', $row) . '"';
			
		}
		
		echo implode("\n", $questions);
		*/
		
		$sql = "SELECT
		ID,
		QuestionText,
		(
			SELECT
			b.ID
			FROM " . CT_DB . ".QUESTIONS AS b
			WHERE
			b.CampaignID = QUESTIONS.CampaignId
			AND b.ID != QUESTIONS.ID
			AND 
			(
				b.QuestionText = QUESTIONS.QuestionText
				OR b.QuestionText = REPLACE(REPLACE(QUESTIONS.QuestionText, ']]', ']'), '[[', '[')
			)
			LIMIT 0, 1
		) AS target_question_id
		FROM " . CT_DB . ".QUESTIONS AS QUESTIONS WHERE CampaignID = 4143
		AND
		 (
			SELECT count(*)
			FROM " . CT_DB . ".QUESTIONS AS b
			WHERE
			b.CampaignID = QUESTIONS.CampaignId
			AND b.ID != QUESTIONS.ID
			AND 
			(
				b.QuestionText = QUESTIONS.QuestionText
				OR b.QuestionText = REPLACE(REPLACE(QUESTIONS.QuestionText, ']]', ']'), '[[', '[')
			)
		) > 0;
		";
		
		$questions_map = array();
		
		$sth = $dbh->prepare($sql);
		$sth->execute();
		
		while($row = $sth->fetch()) {
				
			//Core::print_r($row);
			
			$questions_map[] = array(
				'old_id' => $row['ID'],
				'new_id' => $row['target_question_id'],
				'answers' => array()
			);
			
		}
		
		foreach($questions_map as $k => $map) {
			
			$sql = "SELECT
			ID,
			(
				SELECT
				b.ID
				FROM
				" . CT_DB . ".ANSWERS AS b
				WHERE
				b.CampaignID = ANSWERS.CampaignID
				AND b.AnswerText = ANSWERS.AnswerText
				LIMIT 0, 1
			) AS target_answer_id
			FROM " . CT_DB . ".ANSWERS AS ANSWERS WHERE QuestionID = " . $map['old_id'];
			
			$sth = $dbh->prepare($sql);
			$sth->execute();
			
			while($row = $sth->fetch()) {
				
				$questions_map[$k]['answers'][] = array(
					'old_id' => $row['ID'],
					'new_id' => $row['target_answer_id']
				);
				
			}
			
		}
		
		$sql = "SELECT * FROM " . CT_DB . ".PROFILES WHERE QuestionID = :QuestionID AND AnswerID = :AnswerID";
		$sth = $dbh->prepare($sql);
		
		foreach($questions_map as $k => $question) {
				
			foreach($question['answers'] as $k2 => $answer) {
				echo 1;
				$sth->execute(array(
						':QuestionID' => $question['old_id'],
						':AnswerID' => $answer['old_od']
					)
				);
				
				while($row = $sth->fetch()) {
						
					Core::print_r($row);
					
				}
				
			}
			
		}
		
		Core::print_r($questions_map);

	}

}
?>
