<?

class Control_Update_Survey_Question{

    function run(){

      Core::authorize(array(
                'user_id' => 'get'
            )
        );
      
       global $data, $page_settings, $session, $gamo;

       $page_settings['allow_json'] = 0;

       $inputs = array(
            'survey_questions_id' => 1,
            'values' => array(
                'question' => 'what is your last name?'
            )
       );

       $result = Core::r('survey_question')->update_survey_question($inputs);

       Core::print_r($result);

    }

}


?>
