<?
class Control_Json_Create_action {

	function run() {
		
		Core::authorize(array(
				'user_id' => 'get'
			)
		);
		
		global $data, $page_settings, $models, $session, $gamo;

		$page_settings['allow_json'] = 1;
		
		$data['resource_id'] = Core::get_input('resource_id', 'get');
		$data['action_key'] = Core::get_input('action_key', 'get');
		


        Core::r('actions')->create_action(array(
                'user_id' => $data['user_id'],
                'action_types_id' => Core::r('actions')->action_types_id(array(
                        'action_key' => $data['action_key']."_".$data['resource_id']
                    )
                ),
                'int_other' => $data['resource_id'],
        		'point_value' => 0
            )
        );

		
	}
	
}