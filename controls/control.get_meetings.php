<?
class Control_Get_Meetings {

    function run($options = array()) {
        
    	
        Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
        
        global $data, $page_settings, $session, $gamo;

        Core::ensure_defaults(array(
                'user_id' => $session->get('user_id')
            )
        , $options);

        $page_settings['allow_json'] = 1;

        $page = Core::get_input('page', 'get');
		if(empty($page)){
			$page = 1;
		}else{
			$page = intval($page);
		}
		
		$per_page = 5;
        
        $meetings = Core::r('meeting')->get_meetings(array(
                'user_id' => $options['user_id'],
        		'page' => $page, 
        		'records' => $per_page,
        		'action_key' => array('schedule_meeting_manager','schedule_meeting_clevel')
            )
        );

        $data['meetings'] = $meetings;

        return $data;

    }

}
?>
