<?
/*
This is a custom session management system used to manage sessions. It is particularly useful in distributed environments.
(Default PHP sessions ARE NOT consistent in distributed environments)
It essentially acts like an abstraction layer to memcached (or any other storage mechanism) to store session-type data
Sesssion accessors have no mutex-like properties, so they are not atomic (which is also the case for the default PHP session handler).
As such, for transaction safe storage (essentially anything require an atomic process), use the db
@depen core/class.Core.php
*/
class Session {

	private $session_id; // The unique ID for this session
	private $user_id;
	private $session_duration; // How many seconds the session is valid for

	function __construct() {

		$generate = true;
		$this->session_duration = 86400; // Set session expiry to 1 day by default

		if(isset($_COOKIE['sid'])) { // Try to retrieve the session id from the sid cookie.

			$cookie_sid = strtolower($_COOKIE['sid']);

			if(strlen($cookie_sid) != 40 // Session ID length is not valid. This is not a valid session ID
				|| !ctype_alnum($cookie_sid) // Session ID is not alphanumeric, so it cannot be valid
				) {
				
				$generate = true;

			} else {

				// Determine if sid is validly stored in memcache
				$stored = Core::get($cookie_sid);

				if($stored === FALSE) { // Session ID is not valid in memcached. This is not a valid session id.
					
					$generate = true;

				} else { // Session ID appears valid

					$this->session_id = $cookie_sid;

					$generate = false;

				}

			}

		}

		if($generate) { // There is no valid session id set in the cookie sid. Generate one now

			$this->new_session_id();

		}
		
		return $this->session_id;
		
	}

	function get_session_duration() {

		$cached = $this->get('session_duration');

		if($cached === FALSE) {

			$use = $this->session_duration;

		} else {

			$use = $this->session_duration;

		}

		if(!is_numeric($use)) {

			$use = 86400;

		}

		return $use;

	}

	function new_session_id($random = 'get', $session_duration = -1) { // Generate a new session id

		if($random == 'get') {
			
			$random = Core::unique_string(40); // A random alphanumeric string guaranteed to be unique

		}

		$this->session_id = $random; // Set the class sid to the random string

		Core::set($random, json_encode(Array()));

		if($session_duration == -1) { $session_duration = $this->session_duration; }

		$this->set('session_duration', $session_duration);

		setcookie("sid", $random, time()+$this->get_session_duration(), '/'); // Set an expiry time for the session

		return $random;

	}

	function extend_session() {

		setcookie("sid", $this->session_id, time()+$this->get_session_duration(), '/'); // Set an expiry time for the session

	}

	function destroy() { // Destroy the current session id
		
		return Core::set($this->session_id, json_encode(array()) );

	}

	function session_id() { // A getter for the session id

		return $this->session_id;

	}

	function get_all() { // Retrieve all session variables as an array

		$get = Core::get($this->session_id);

		return json_decode($get, true);

	}

	function get($key) { // Retrieve session value by key

		$get = $this->get_all();

		if($key == 'user_id' && $this->user_id != '') {
			
			return $this->user_id;

		}

		return ( isset($get[$key]) ) ? $get[$key] : null;

	}

	function set($key, $value) { // Save a session value

		// Session values are saved in an array object in memcached that is stored in JSON format

		// Retrieve all values
		$get = $this->get_all();

		$type = gettype($value);

		if($type == 'array' || $type == 'object') { // Convert object to json_encoded string for proper saving

			$value = json_encode($value);

		}

		// Save desired value
		$get[$key] = $value;

		// Encode and save values back to session storage object
		Core::set($this->session_id, json_encode($get) );

		if($key == 'user_id') {

			$this->user_id = $value;

		}

		return $get;

	}

	function remove($key) { // Removes a variable from the session array

		// Retrieve all values
		$get = $this->get_all();

		// Unset the desired value
		unset($get[$key]);

		// Store updated session values
		Core::set($this->session_id, json_encode($get) );

		return $get;

	}

}

/*
Example use:
$session = new Session(); // start a new session
$session->set('name', 'john doe'); // Save john doe to the session as the name property
$session->set('age', 32); // Save 32 to the session as the age property
$session->get('age'); // Retrieves the value of the age property
$session->get_all(); // Retrieves all properties saved for this session
*/

$session = new Session(); // start a new session
?>