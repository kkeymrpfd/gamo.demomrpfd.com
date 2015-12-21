<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Modify_Actions {

	function run() {
		
		Core::authorize(array(
				'user_id' => 'get',
				'levels' => 'admin'
			)
		);

		global $data, $page_settings, $models, $session, $gamo;
		
		$page_settings['allow_json'] = 1;

		$values = array(
			'point_value_use' => Core::get_input('point_value_use', 'get'),
			'active' => Core::get_input('active', 'get')
		);

		$action_id = Core::get_input('action_id', 'get');

		if(!is_numeric($values['point_value_use'])) {

			unset($values['point_value_use']);

		}

		if(!is_numeric($values['active']) && $values['active'] != 1 && $values['active'] != 0) {

			unset($values['point_value_use']);

		}

		if(count($values) == 0 || !is_numeric($action_id)) { // Invalid input

			$data = array(
				'error' => 'Request could not be processed succesfully'
			);

			return $data;

		}

		$result = Core::r('actions')->modify_action(array(
				'action_id' => Core::get_input('action_id', 'get'),
				'values' => $values
			)
		);
		
		Core::shift_data($result);

		return $data;

	}

}
?>
