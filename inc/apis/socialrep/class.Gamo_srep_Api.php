<?
require("../config.gamo.php");
/*
This class interfaces with averetek to pull information for JMC
*/
class Gamo_srep_Api {

	public $errors; // Store error codes
	public $map_types;

	function __construct() {

		/*
		When we pull actions from socialrep, the action types are set to things suchas "facebook" or "googleplus".
		We need to map this to the correct action_types_id. This is done here
		*/
		$this->map_types = array(
			'linkedin' => 75,
			'twitter' => 73,
			'facebook' => 71,
			'googleplus' => 74
		);

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Could not pull data succesfully from Social Rep'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid data type selected for retrieving info from Averetek'
			)
		);

	}

	/*
	Make a request to averetek for some information
	*/
	function make_request($options = array()) {

		/*
		arguments:
		{
			min_time: timestamp of the oldest time
			max_time: timestamp of the newest time
			key: the api key (defaults to the default api key),
			type: the type of data to request from social rep. This is just the short name that maps to the real info
			{
			
			}
		}

		Return:
			if successful:
			{
				valid: 1 = request succesful, 0 = request failed
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'min_time' => time() - 86400*30,
				'max_time' => time(),
				'key' => 'Y79WAJZzhLLGz1SY',
				'type' => 'facebook_shares'
			)
		, $options);

		$url = 'http://syndapp.socialrep.net/api-v1/analytics/users/number-of-shares-per-social-network/' . $options['min_time'] . '-' . $options['max_time'] . '?key=' . $options['key'];

		$raw = file_get_contents($url);

		$response = json_decode($raw, true);

		if(!is_array($response)) {

			return Core::error($this->errors, 1);

		}

		return $response;

	}

}

$srep = new Gamo_srep_Api();
$response = $srep->make_request();
Core::print_r($response);
?>