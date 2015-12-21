<?
class Control_Get_Surveys{

    function run() {
        
        Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
        global $data, $page_settings, $session, $gamo;

		$page_settings['allow_json'] = 1;
		$page_settings['view'] = 'json';
		$data['valid'] = false;

        $user_id = $session->get('user_id');
		$page = Core::get_input('page', 'get');
		
        if(empty($page)){
			$page = 1;
		}
        else{
			$page = intval($page);
		}
		
		$per_page = 5;
        
        $surveys = Core::r('survey')->get_surveys(array(
                'user_id' => 75,//$user_id,
                'start' => $per_page*($page-1),
                'num' => $per_page
            )
        );

        $totals = Core::r('survey')->get_surveys_count(array('user_id' => $user_id));

        if( Core::has_error($surveys) or empty($surveys) or Core::has_error($totals) or empty($totals) ){
              $page = 1;
              $last_page = $page;
              $surveys = array();
        }
        else{
			$data['valid'] = true;
            $last_page = ceil($totals/$per_page);
		}
		
        $data['survey_history'] = array(
            'current_page' => $page,
            'last_page' => $last_page,
            'surveys' => $surveys
            
        );
      
        return $data;
		

    }
}
?>
