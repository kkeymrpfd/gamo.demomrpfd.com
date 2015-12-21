<?
class Model_Admin_Users {

	function run() {
		
		global $gamo;

		$data['action_types'] = Core::r('actions')->get_action_types();
		$data['action_types'] = Core::multi_sort($data['action_types'], 'action_name');
		$data['badges'] = Core::r('reward_manager')->get_badges();

		return $data;

	}

}

?>
