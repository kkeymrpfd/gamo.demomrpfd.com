<?
// Retrieve notifications
class Control_Get_Notify {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;
		
		Core::authorize(array(
				'user_id' => $session->get('user_id')
			)
		);

		$data['notify'] = Core::r('notify')->get_notifications(array(
				'values' => array(
					'user_id' => $session->get('user_id'),
					'seen' => 0
				)
			)
		);

		$session->extend_session();

		return $data;

	}

}
?>
