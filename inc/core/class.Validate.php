<?
// Validate input for a form
//@depend core/class.Core.php
class Validate {

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
	
	function validate_notempty( $options=array() ){
	
		if( empty( $options['to_validate'] ) ){
			return false;
		}else{
			return true;
		}
	
	}
	
	function validate_length( $options=array() ){
	
		if( empty( $options['to_validate'] ) or empty( $options['length'] ) ){
			return false;
		}
	
		if( strlen( $options['to_validate'] ) > intval($options['length']) ){
			return false;
		}else{
			return true;
		}
	
	}
	
	function get_timezone_offset($remote_tz, $origin_tz = null) { // Return difference between two timezones
	    if($origin_tz === null) {
	        if(!is_string($origin_tz = date_default_timezone_get())) {
	            return false; // A UTC timestamp was returned -- bail out!
	        }
	    }
	    $origin_dtz = new DateTimeZone($origin_tz);
	    $remote_dtz = new DateTimeZone($remote_tz);
	    $origin_dt = new DateTime("now", $origin_dtz);
	    $remote_dt = new DateTime("now", $remote_dtz);
	    $offset = $origin_dtz->getOffset($origin_dt) - $remote_dtz->getOffset($remote_dt);
	    return $offset;
	}

	function utc_time($datetime, $origin_tz = 'America/New_York') {

		$offset = Validate::get_timezone_offset('UTC', $origin_tz);

		$timestamp = strtotime($datetime) + $offset*-1;

		return date("Y-m-d H:i:s", $timestamp);

	}

	function east_time($datetime, $origin_tz = 'UTC') {

		$offset = Validate::get_timezone_offset('America/New_York', $origin_tz);

		$timestamp = strtotime($datetime) + $offset*-1;

		return date("Y-m-d H:i:s", $timestamp);

	}

	function datetime( $options=array()){

		Core::ensure_defaults(array(
				'datetime' => '',
				'date' => '',
				'time' => ''
			)
		, $options);

		$split = explode('-', $options['date']);

		if(strlen($split[0]) == 2) {

			$options['date'] = $split[2] . '-' . $split[0] . '-' . $split[1];

		}

		if($options['datetime'] == '' && $options['date'] != '') {

			$options['datetime'] = $options['date'];

			if($options['time'] != '') {
				
				if(strpos($options['time'], ':') === FALSE) {

					$time_len = strlen($options['time']);

					if($time_len == 3) {

						$options['time'] = substr($options['time'], 0, 1) . ':' . substr($options['time'], 1);

					} else if($time_len == 4) {

						$options['time'] = substr($options['time'], 0, 2) . ':' . substr($options['time'], 2);

					}

				}

				$options['datetime'] .= ' ' . $options['time'];

			}

		}

		$timestamp = strtotime( $options['datetime'] );
		
		if(!$timestamp || !checkdate(date("m",$timestamp), date("d",$timestamp), date("Y",$timestamp)) ){
			//Error related to incorrect format
			return false;
		}
	
		return array(
			'datetime' => $options['datetime'],
			'utc' => Validate::utc_time($options['datetime'])
		);
	
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

		$this->reset_errors(); // Reset the errors list

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

		$this->reset_errors(); // Reset the errors list

		if(!filter_var($options['email'], FILTER_VALIDATE_EMAIL)) {

			$this->add_error("Invalid e-mail address");

		}

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

	function pro_email($email) { // Check that an e-mail is not a free e-mail service

		$unallowed = array(
			'yahoo.',
			'msn.',
			'gmail.',
			'live.',
			'rocketmail.',
			'hotmail.',
			'aim.',
			'outlook.',
			'mail.',
			'aol.',
			'facebook.com'
		);

		foreach($unallowed as $k => $string) {

			if(stripos($email, $string) !== FALSE) {

				return false; // This is not a pro email

			}

		}

		return true;

	}

}
?>