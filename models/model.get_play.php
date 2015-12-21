<?
class Model_Get_Users {

	function run($options = array()) {
		
		Core::ensure_defaults(array(
				'start' => 0,
				'records' => 10,
				'filters' => array()
			)
		, $options);

		global $gamo;

		$result = Core::r('users')->get_users(array(
				'start' => $options['start'],
				'records' => $options['records'],
				'filters' => $options['filters']
			)
		);

		$result['current_page'] = max($options['start'] / $options['records'], 0) + 1;
		$result['last_page'] = ceil($result['records'] / $options['records']);

		if($result['current_page'] > $result['last_page'] && $result['last_page'] != 0) { // The current page is too high. Set it to the last page

			$options['start'] = $result['last_page'] * $options['records'] - $options['records'];

			return $this->run($options);

		} else if($result['current_page'] < 1) { // The current page is too low. Set it to the first page

			$options['start'] = 0;

			return $this->run($options);

		}
		
		return $result;

	}

}

?>
