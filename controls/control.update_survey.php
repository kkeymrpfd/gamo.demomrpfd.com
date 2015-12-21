<?

class Control_Update_Survey{

    function run(){

        Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
        global $data, $page_settings, $session, $gamo;

        $page_settings["allow_json"] = 0;

        $jsonStr = '{"page_type":"","valid":true,"survey_history":{"current_page":1,"last_page":1,"surveys":[{"survey_id":"1","survey_title":"title for survey","survey_description":"new descriptions","questions":[{"question_id":"95","question_label":"3","text":"this is a radio question","answer_type":"radio","answer_group":[{"id":"61","text":"blah"}]},{"question_id":"78","question_label":"-1","text":"who is your daddy?","answer_type":"dropdown","answer_group":[{"id":"3","text":"this is an answer"},{"id":"4","text":"some answer"}]},{"question_id":"79","question_label":"1","text":"what does he do?","answer_type":"dropdown","answer_group":[]},{"question_id":"80","question_label":"1","text":"what is your pets name?","answer_type":"dropdown","answer_group":[]},{"question_id":"81","question_label":"1","text":"What is your favorite color?","answer_type":"dropdown","answer_group":[]},{"question_id":"82","question_label":"1","text":"what is your first name?","answer_type":"dropdown","answer_group":[]},{"question_id":"83","question_label":"1","text":"what is you date of birth?","answer_type":"dropdown","answer_group":[]},{"question_id":"84","question_label":"1","text":"are you married?","answer_type":"dropdown","answer_group":[]},{"question_id":"85","question_label":"1","text":"where is your home?","answer_type":"dropdown","answer_group":[]},{"question_id":"86","question_label":"1","text":"when is your party?","answer_type":"dropdown","answer_group":[]}]}]}}';

        $jsonObj = json_decode($jsonStr, true);

        $surveys = $jsonObj['survey_history']['surveys'];

        foreach($surveys as $s){

            $survey_id = $s['survey_id'];

            $thisSurvey = array(
                'survey_id' => $survey_id,
                'values' => array(
                    'title' => $s['survey_title'],
                    'descrip' => $s['survey_description']
                )
            );

            $valid = Core::r('survey')->update_survey($thisSurvey);
            
            //Core::print_r($valid); 
            
            if(Core::has_error($valid)){

                return $valid;

            }

            foreach($s['questions'] as $q ){
    
                $survey_questions_id = $q['question_id'];
                
                $thisQuestion = array(
                    'survey_questions_id' => $q['question_id'],
                    'values' => array(
                        'survey_id' => $survey_id,
                        'question_type' => $q['answer_type'],
                        'question' => $q['text'],
                        'question_order' => $q['question_label']
                    )
                );

                $result = Core::r('survey_question')->update_survey_question($thisQuestion);

                Core::print_r($result);

                foreach($q['answer_group'] as $c){

                    $thisChoice = array(
                        'survey_answer_choices_id' => $c['id'],
                        'values' => array(
                            'survey_questions_id' => $survey_questions_id,
                            'choice' => $c['text']
                        )
                    );
                    
                    $result = Core::r('survey_answer_choice')->update_survey_answer_choice($thisChoice);

                    Core::print_r($result);

                }

            }

        }
        
    }

}


?>
