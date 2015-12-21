<?
class Model_Get_Users {

	function run($options = array()) {

		/*
		arguments:
		{
			start: which record # to start from
			records: how many records to retrieve
			sort: how to order (defult = 'points desc'). Can also use multiple sorts such as "display_name asc, company desc, points asc",
			fields: an array of which fields to retrieve
			{
				user_id,
				first_name,
				last_name,
				..
				..
			},
			has: 1 = include has values, 0 = do not return has values
		}

		returns:
			Returns:
			if successful:
			{
				user,
				user,
				user,
				..
				..
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/
		global $gamo;

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
