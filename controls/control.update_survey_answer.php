<?

class Control_Update_Survey_Answer{

    function run(){

      Core::authorize(array(
              'user_id' => 'get'
          )
      );

       global $data, $page_settings, $session, $gamo;

       $page_settings['allow_json'] = 0;
    
       $inputs = array(
            'survey_answers_id' => 2,
            'values' => array(
                'survey_questions_id' => 2
            )  
       );

       $result = Core::r('survey_answer')->update_survey_answer($inputs);

       Core::print_r($result);

       return $data;

    }

}


?>
