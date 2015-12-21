<?
class Model_Admin_General {

	function run() {
		
		global $gamo;

		$data['user_stats'] = Core::r('stats')->user_stats();
		$data['action_stats'] = Core::r('stats')->action_stats();
		$data['badge_stats'] = Core::r('stats')->badge_stats();
		
		return $data;

	}

}

?>
