<?
class Control_Resource_Video {

    function run() {
        
        Core::authorize(array(
                'user_id' => 'get'
            )
        );

        global $data, $page_settings, $session, $gamo;

        $page_settings['allow_json'] = 1;

        $resource_id = Core::get_input('resource_id', 'get');

        $resource = Core::r('resources')->get_resource(array(
        		'resource_id' => $resource_id
        	)
        );

        if(Core::has_error($resource)) {

            die();

        }
        
        $c = Core::db_count(array(
                'table' => GAMO_DB . '.actions_log',
                'values' => array(
                    'user_id' => $data['user_id'],
                    'action_types_id' => Core::r('actions')->action_types_id(array('action_key' => 'download_resource')),
                    'active' => 1,
                    'int_other' => $resource_id
                )
            )
        );
        
        if($c == 0) {
        	
        	$values = array(
                    'user_id' => $data['user_id'],
                    'action_types_id' => 'download_resource',
                    'int_other' => $resource_id
                );
        	

            $result = Core::r('actions')->create_action($values );

        }

        if($resource_id == 62) { // Award points for seeing replay of virtual event

            date_default_timezone_set('UTC');
            $current_time = time();
            if($current_time > 1375289070 && $current_time < 1375292730) { // Between 12:45 pm and 1:45 pm

                $action_type = Core::r('actions')->action_types_id(array(
                        'action_key' => 'attend_vevent'
                    )
                );

                $c = Core::db_count(array(
                        'table' => GAMO_DB . '.actions_log',
                        'values' => array(
                            'user_id' => $data['user_id'],
                            'action_types_id' => $action_type,
                            'int_other' => 7,
                            'active' => 1
                        )
                    )
                );

                if($c == 0) {

                    $result = Core::r('actions')->create_action(array(
                            'user_id' => $data['user_id'],
                            'action_types_id' => $action_type,
                            'int_other' => 7
                        )
                    );

                }

            }

        }

        $data['location'] = $resource['location'];

        $user = Core::r('users')->get_user(array(
                'user_id' => $data['user_id']
            )
        );

        $data['user_points'] = $user['points'];

        return $data;

    }

}
?>
