<?
// Retrieve notifications
class Control_Notify_Seen {

	function run() {

		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;

		$data['notify'] = Core::r('notify')->notify_seen(array(
				'user_id' => $session->get('user_id')
			)
		);

		return $data;

	}

}
?>
