<?
class Model_Pm_User_Edit {

	function run($options = array()) {
		
		global $gamo, $dbh;

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		if(!is_numeric($options['user_id'])) {

			$options['user_id'] = -1;

		}

		$data['user_admin'] = Core::r('users')->get_user(array(
		          'user_id' => $options['user_id']
		    )
		);

		return $data;

	}

}

?>
