<?
// Validate input for a form
//@depend core/class.Core.php
class Gamo_Validate {

	protected $sets; // Sets of characters
	protected $errors = Array(); // A list of errors to be displayed
	protected $output_data = Array(); // Data to add to the output array

	function __construct() {

		$this->sets = Array(
			'alphabet' => 'abcdefghijklmnopqrstuvwxyz',
			'numeric' => '0123456789',
			'special' => ',./;\'[]\\`<>?:"{}|~!@#$%^&*()_+-=',
			'space' => ' '
		);

	}

	function reset_output() { // Reset the errors list

		$this->errors = Array();
		$this->output_data = Array();

	}

	function add_error($error) { // Add a error to the errors list

		if( Core::multi_find($this->errors, Array('msg' => $error['msg'], 'id' => $error['id']) ) == -1 ) { // This error is not already in the list

			array_push($this->errors, $error);
			return true; // error was added to the errors list

		}

		return false; // error was not added to the errors list since it is already in the list

	}

	function get_result($settings = array()) {

		Core::ensure_defaults(array(
				'form_id' => 0
			)
		, $settings);

		if($settings['form_id'] == 0) {
			
			if(isset($_POST['form_id'])) {

				$settings['form_id'] = $_POST['form_id'];

			} else if(isset($_GET['form_id'])) {

				$settings['form_id'] = $_GET['form_id'];

			}

		}

		return Array(
			'valid' => (count($this->errors) == 0) ? 1 : 0,
			'errors' => $this->errors,
			'data' => $this->output_data,
			'form_id' => $settings['form_id']
		);

	}

	function add_output_data($data) {

		foreach($data as $k => $v) {

			$this->output_data[$k] = $v;

		}

	}

	function validate_characters($options) {

		/*
		This function ensures that only allowed characters are in a given string
		$this->sets stores the values for different sets of characters. For example, $this->sets['alphabet'] stores all alphabetic characters
		This function can defined which sets are allowed along with additional characters to allow. If any characters are found in the test string
		that are not found in the allowed string, then return an error
		*/

		Core::ensure_defaults($defaults = array(
			'string' => '', // The test string
			'allowed' => 'alphabet numeric space', // What sets are allowed (the actual sets are defined in $this->sets [the class constructor sets the values])
			'allowed_string' => '' // Additional allowed characters
		), $options);

		// Convert the list of allowed sets into an array of allowed sets
		$options['allowed'] = explode(' ', $options['allowed']);

		foreach($options['allowed'] as $set) { // Iterate through each allowed set

			if(isset($this->sets[$set])) { // The set is defined. Add it to the allowed_string set

				$options['allowed_string'] .= $this->sets[$set];

			}

		}

		$this->reset_output(); // Reset the errors list

		// Convert the test string into an array of each of its individual characters
		$string_array = str_split($options['string']);

		foreach($string_array as $string) { // Test each individual character in the test string

			if( stripos($options['allowed_string'], $string) === FALSE ) { // This character was not found in the allowed list.

				$this->add_error('Invalid character');
				break;

			}

		}

		// Test string only contained valid characters
		return $this->get_result();

	}

	function validate_email($options) { // Determine wether or not this is a valid e-mail

		Core::ensure_defaults(array(
				'check_only' => 1
			)
		, $options);

		$this->reset_output(); // Reset the errors list

		if(!filter_var($options['email'], FILTER_VALIDATE_EMAIL)) {

			if($options['check_only']) { return 0; }

			$this->add_error("Invalid e-mail address");

		}

		if($options['check_only']) { return 1; }

		return $this->get_result();

	}

	function validate_password($options) {

		Core::ensure_defaults(Array(
			'password' => '',
			'min_length' => 5, // The minimum length of the password
			'max_length' => 60, // The maximum length of the password
			'unallowed' => Array() // A list of strings that are not allowed in the password
		), $options);

		$errors = Array();

		if(trim($options['password']) == '') {

			$this->add_error('Please enter a password');

		} else if( strlen($options['password']) < $options['min_length'] ) { // The password is too short

			$this->add_error('The password must be at least ' . $options['min_length'] . ' characters long');

		} else if( strlen($options['password']) > $options['max_length'] ) { // The password is too long

			$this->add_error('The password cannot be more than ' . $options['max_length'] . ' characters long');

		}

		foreach($options['unallowed'] as $item) {

			if(stripos($options['password'], $item['value']) !== FALSE) {

				$this->add_error('The password cannot contain your ' . $item['name'] . '');
				break;

			}

		}

		return $this->get_result();

	}

	function modal_error($error) {

		return Array(
			'valid' => 0,
			'modal' => $error
		);

	}

	function single_space($string) { // Ensure a single space is the maximum space (replaces double spaces, line breaks, etc)

		return preg_replace('!\s+!', ' ', $string);

	}

}
?>