<?

class Control_Update_Survey_Validate {

    function run(){

        Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
        global $data, $page_settings, $session, $gamo;

        $page_settings['allow_json'] = 1;

        $inputs = array(
            'survey_validate_id' => 1,
            'values' => array(
                //'survey_answers_id' => 75,
                'validate_type' => 'min_length',
                'validate_value' => '5'
            )
        );

        $result = Core::r('survey_validate')->update_survey_validate($inputs);

        Core::print_r($result);

        return $data;

    }
}


?>
