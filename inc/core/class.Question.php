<?
// Class to manage questions
//@depend core/core.php
//@depend core/class.Validate.php
require_once(DIR_INC . '/lib/class.Validate.php');

class Question extends Validate {

	function check_title($options) {

		$title_length = strlen($options['title']);
		
		if(trim(strlen($options['title'])) == 0) {

			$this->add_error_output(Array(
					'msg' => 'Please enter a title for your question',
					'id' => 'create_question_title'
				)
			);

		} else if($title_length < 10) {

			$this->add_error_output(Array(
					'msg' => 'The title is too short',
					'id' => 'create_question_title'
				)
			);

		} else if($title_length > 140) {

			$this->add_error_output(Array(
					'msg' => 'The title is too long. It cannot be more than 140 characters',
					'id' => 'create_question_title'
				)
			);

		}

	}

	function check_description($options) {

		$length = strlen($options['description']);

		if($length < 15) {

			$this->add_error_output(Array(
					'msg' => 'The description is too short',
					'id' => 'create_question_description'
				)
			);

		} else if($length >= 1000) {

			$this->add_error_output(Array(
					'msg' => 'The description is too long. It cannot be be more than 1000 characters long',
					'id' => 'create_question_description'
				)
			);

		}

	}

	function check_category($options) {

		$qty = Core::fetch_column(
			"SELECT count(*) FROM general.categories WHERE category_id = :category_id",
			Array(
				':category_id' => $options['category']
			)
		);

		if($qty == 0) {

			$this->add_error_output(Array(
					'msg' => 'Please select a category for what you are looking for',
					'id' => 'create_question_category'
				)
			);

		}

	}

	function check_all($options) {

		$this->reset_errors_output();

		$options['title'] = $this->single_space($options['title']);

		$this->check_title(&$options);
		$this->check_description(&$options);
		$this->check_category(&$options);

		return $this->get_result_output();

	}

}

$question = new Question();

?>