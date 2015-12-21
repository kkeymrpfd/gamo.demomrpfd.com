<?
class Survey {

	private $survey;
	private $track;
	private $js_conditions;

	protected $errors;

	function __construct() {

		$this->survey = array(
			'info' => array(),
			'questions' => array(),
			'answer_groups' => array(),
			'sections' => array()
		);

		$this->track = array(
			'question_count' => 0
		);

		$this->js_conditions = array();

		$this->set_errors();

	}

	private function set_errors() {

		$this->errors = array(
			0 => array(
				'error_code' => 0,
				'error_msg' => "Could not find survey"
			),
			1 => array(
				'error_code' => 1,
				'error_msg' => "Invalid question passed for rendering"
			),
			2 => array(
				'error_code' => 2,
				'error_msg' => "Answer group not found during rendering while searching by question"
			)
		);

	}

	public function get_survey( $options ) {

		global $dbh;

		Core::ensure_defaults(array(
				'survey_id' => -1,
				'survey_key' => ''
			)
		, $options);

		$survey_info = $this->survey_info($options);

		if( Core::has_error($survey_info) ) {

			return $survey_info; // could not find survey

		}

		$this->survey['info'] = $survey_info;
		$this->survey['questions'] = $this->get_questions($survey_info['survey_id']);
		$this->survey['answer_groups'] = $this->get_answer_groups($survey_info['survey_id']);
		$this->survey['sections'] = $this->get_sections($survey_info['survey_id']);

		return $this->survey;

	}

	public function get_questions($survey_id) {

		global $dbh;

		// Retrieve all questions
		$sql = "SELECT
		question_id,
		section_id,
		display_type,
		(SELECT section_title FROM em.survey_sections WHERE survey_sections.section_id = survey_questions.section_id) AS section_title,
		question_text,
		help,
		help_type,
		question_order,
		sub_to,
		sub_type,
		label,
		active
		FROM em.survey_questions
		WHERE survey_id = :survey_id
		ORDER BY question_order ASC";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':survey_id' => $survey_id
			)
		);

		$questions = array();

		while($row = Core::remove_numeric_keys( $sth->fetch() )) {

			$row['contingents'] = $this->get_question_contingents($row['question_id']);

			array_push($questions, $row);

		}

		return $questions;

	}

	public function get_sections($survey_id) {

		// Retrieve all sections for a particular survey
		global $dbh;

		$sql = "SELECT
		section_id,
		survey_id,
		section_title,
		section_order
		FROM em.survey_sections
		WHERE survey_id = :survey_id
		ORDER BY section_order ASC";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':survey_id' => $survey_id
			)
		);

		$sections = array();

		while($row = Core::remove_numeric_keys( $sth->fetch() )) {

			array_push($sections, $row);

		}

		return $sections;

	}

	public function get_answer_groups($survey_id) {

		global $dbh;

		// Retrieve all answer groups
		$sql = "SELECT
		answer_group_id,
		question_id,
		type,
		display_type,
		required,
		error_msg,
		allow_note,
		active
		FROM em.survey_answer_groups
		WHERE survey_id = :survey_id";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':survey_id' => $survey_id
			)
		);

		$answer_groups = array();

		while($row = Core::remove_numeric_keys( $sth->fetch() )) {

			$row['answers'] = $this->get_answers($row['answer_group_id']);

			array_push($answer_groups, $row);

		}

		return $answer_groups;

	}

	public function get_question_contingents($question_id) {

		global $dbh;

		$sql = "SELECT
		contingent_id,
		question_id,
		contingent_on,
		contingent_value,
		contingent_type,
		holder_a,
		holder_b,
		holder_c
		FROM em.survey_question_contingents
		WHERE 
		question_id = :question_id";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':question_id' => $question_id
			)
		);

		$contingents = array();

		while($r = Core::remove_numeric_keys( $sth->fetch() )) {

			array_push($contingents, $r);

		}

		return $contingents;

	}

	public function get_answers($answer_group_id) {

		global $dbh;

		$sql = "SELECT
		answer_id,
		answer_group_id,
		answer_label,
		answer_order,
		answer_text,
		max_length,
		placeholder,
		help,
		help_type,
		active
		FROM em.survey_answers
		WHERE answer_group_id = :answer_group_id
		ORDER BY answer_order ASC";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':answer_group_id' => $answer_group_id
			)
		);

		$answers = array();

		while($row = Core::remove_numeric_keys( $sth->fetch() )) {

			array_push($answers, $row);

		}

		return $answers;

	}

	public function survey_info($options) {

		Core::ensure_defaults(array(
				'survey_id' => -1,
				'survey_key' => '',
				'user_id' => -1
			)
		, $options);

		$options['survey_key'] = trim($options['survey_key']);

		if($options['survey_id'] == -1 && $options['survey_key'] == ''
			|| !is_numeric($options['survey_id'])
			) {

			return $this->errors[0]; // Could not find survey

		}

		global $dbh;

		if($options['survey_id'] != -1) {

			$sql_filter = "survey_id = :survey_id";

			$parameters = array(
				':survey_id' => $options['survey_id']
			);

		} else if($options['survey_key'] != '') {

			$sql_filter = "survey_key = :survey_key";

			$parameters = array(
				':survey_key' => $options['survey_key']
			);

		}

		$sql = "SELECT survey_id, survey_key, survey_name, active FROM em.surveys WHERE " . $sql_filter;
		$sth = $dbh->prepare($sql);
		$sth->execute($parameters);

		$info = $sth->fetch();

		if(!isset($info['survey_id'])) {

			return $this->errors[0]; // Could not find survey

		}

		return Core::remove_numeric_keys($info);

	}

	public function render_questions($section_id) {

		$html = '';

		foreach($this->survey['questions'] as $k => $question) {

			if($question['section_id'] == $section_id && $question['sub_to'] == -1 ) {

				$html .= $this->render_question($question);

			}

		}

		return $html;

	}

	public function render_question($question) {

		if(is_numeric($question)) {

			$question = $this->survey['questions'][ Core::multi_find($this->survey['questions'], 'question_id', $question) ];

		}

		if(!is_array($question)) {

			return $this->errors[1]; // Invalid question

		}

		$html = '';

		$survey_question_class = ($question['display_type'] == 0) ? 'survey-question' : 'survey-question-inline';

		$html .= '<div class="' . $survey_question_class . '">';

			if($question['label']  == 1) {

				$html .= '<div class="survey-label">';
					$html .= ++$this->track['question_count'];
				$html .= ')</div>';
			
			}

			if($question['question_text'] != '') {

				$html .= '<div class="survey-question-text">' . $question['question_text'] . '</div>';

			}

			$answer_group = $this->render_answer_group( 'question_id', $question['question_id'] );

			if(!is_array($answer_group)) {

				$html .= $answer_group;

			}

		$html .= '</div>';

		return $html;

	}

	public function render_answer_group($answer_group, $id = -1) {

		if($answer_group == 'question_id') {

			$k = Core::multi_find($this->survey['answer_groups'], 'question_id', $id);

			if($k == -1) {

				return $this->errors[2]; // Answer group not found

			}

			$answer_group = $this->survey['answer_groups'][$k];
		}

		$css = ($answer_group['display_type'] == 0) ? 'block' : 'inline';

		$html = '<div style="display:' . $css . '" answer-group="' . $answer_group['answer_group_id'] . '">';

		if($answer_group['type'] == 0) { // Radio select

			foreach($answer_group['answers'] as $k => $answer) {

				$html .= '<div style="display:inline">';
				$html .= '<input type="radio" question-id="' . $answer_group['question_id'] . '" answer-id="' . $answer['answer_id'] . '" answer-group="' . $answer_group['answer_group_id'] . '" name="answer-group-' . $answer_group['answer_group_id'] . '" id="answer-group-' . $answer_group['answer_group_id'] . '" value="' . $answer['answer_id'] . '">';
				$html .= $answer['answer_text'];
				$html .= '</div>';

				$html .= $this->render_answer_sub($answer['answer_id']);

				$html .= '<br>';

			}

		} else if($answer_group['type'] == 1) { // Checkbox select

			foreach($answer_group['answers'] as $k => $answer) {

				$html .= '<div style="display:inline">';
				$html .= '<input type="checkbox" question-id="' . $answer_group['question_id'] . '" answer-id="' . $answer['answer_id'] . '" answer-group="' . $answer_group['answer_group_id'] . '" name="answer-group-' . $answer_group['answer_group_id'] . '-' . $answer['answer_id'] . '" id="answer-group-' . $answer_group['answer_group_id'] . '-' . $answer['answer_id'] . '">';
				$html .= $answer['answer_text'];
				$html .= '</div>';

				$html .= $this->render_answer_sub($answer['answer_id']);

				$html .= '<br>';

			}

		} else if($answer_group['type'] == 2) { // Text field

			foreach($answer_group['answers'] as $k => $answer) {

				$html .= '<div style="display:inline">';
				
				if($answer['answer_text'] != '') {

					$html .= $answer['answer_text'];
					$html .= ': ';

				}

				$html .= '<input type="text" question-id="' . $answer_group['question_id'] . '" answer-id="' . $answer['answer_id'] . '" answer-group="' . $answer_group['answer_group_id'] . '" name="answer-group-' . $answer_group['answer_group_id'] . '-' . $answer['answer_id'] . '" id="answer-group-' . $answer_group['answer_group_id'] . '-' . $answer['answer_id'] . '" maxlength="' . $answer['max_length'] . '" placeholder="' . $answer['placeholder'] . '">';
				$html .= '</div>';

				$html .= $this->render_answer_sub($answer['answer_id']);

				$html .= '<br>';

			}

		}

		$html .= '</div>';

		return $html;

	}

	public function render_answer_sub($answer_id) {

		$html = '';

		foreach($this->survey['questions'] as $k => $v) {

			if($v['sub_type'] == 2 && $v['sub_to'] == $answer_id) {

				$html .= $this->render_question($v);

			}

		}

		return $html;

	}

}

?>