<?
/*
This class handles creating and updating survey questions
*/
class Gamo_Survey_Question {

    public $errors; // store error codes

    function __construct() {

        // creates error codes
        $this->errors = array(
            array(
                'error_code' => 1,
                'error_msg' => 'Could not save question'
            ),
            array(
                'error_code' => 2,
                'error_msg' => 'Could not update question'
            ),
            array(
                'error_code' => 3,
                'error_msg' => 'Invalid question type'
            ),
            array(
                'error_code' => 4,
                'error_msg' => 'Question must be more than 5 characters'
            ),
            array(
                'error_code' => 5,
                'error_msg' => 'Question must be less than 500 characters'
            ),
            array(
                'error_code' => 6,
                'error_msg' => 'Order must be a number'
            ),
            array(
                'error_code' => 7,
                'error_msg' => 'Invalid survey ID'
            ),
            array(
                'error_code' => 8,
                'error_msg' => 'Invalid active code'
            ),
            array(
                'error_code' => 9,
                'error_msg' => 'Duplicate order value for this survey'
            ),
            array(
                'error_code' => 10,
                'error_msg' => 'Must specify a survey'
            ),
            array(
                'error_code' => 11,
                'error_msg' => 'Invalid survey question ID'
            ),
            array(
                'error_code' => 12,
                'error_msg' => 'Failed to prepare DB statement'
            ),
            array(
                'error_code' => 13,
                'error_msg' => 'Failed to execute DB statement'
            ),
            array(
                'error_code' => 14,
                'error_msg' => 'Failed. Received a PDOException'
            )
        );
    }

    function get_question_type($question_id){
        global $dbh;
        $error_append = " CLASS[".__CLASS__."] METHOD [".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";

        if( empty( $question_id ) ){
            $error = Core::error($this->errors, 11);
            $error['error_msg'] .= $error_append;
            return $error;
        }

        $sql = "SELECT question_type FROM " . GAMO_DB . ".`survey_questions` WHERE survey_questions_id = :surveyquestionid and active = 1";

        try{
            $stm = $dbh->prepare($sql);

            if( empty($stm) ){
                $error = Core::error($this->errors,12);
                $error['error_msg'] .= $error_append;
                return $error;
            }

            $sres = $stm->execute(array(':surveyquestionid' => $question_id));

            if( empty($sres) ){
                $error = Core::error($this->errors, 13);
                $error['error_msg'] .= $error_append;
                return $error;
            }

            $result = $stm->fetch(PDO::FETCH_ASSOC);

        }
        catch(PDOException $e){
            $error = Core::error($this->errors, 14);
            $error['error_msg'] .= $error_append;
            return $error;
        }

        if( !isset($result['question_type']) ){
            return array();
        }
       
        return $result; 
    }
    /*
    Gets questions belonging to survey ID
    */
    function get_questions($options = array()){

       /*

        args:
        {
            survey_id: the ID associated with questions
        }

        returns:

           if successful:
           {
              question_id: the survey_questions_id for this question
              question_label: the question_order for this question
              text: the question text for this question
              answer_type: the question_type for this question
           }

           if error: standard error

        */

        global $dbh;
        $error_append = " CLASS[".__CLASS__."] METHOD [".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";

        if( empty( $options['survey_id'] ) ){
            $error = Core::error($this->errors, 7);
            $error['error_msg'] .= $error_append;
            return $error;
        }

        $sql = "SELECT survey_questions_id as question_id, question_order as question_label, question as text, question_type as answer_type FROM " . GAMO_DB . ".`survey_questions` WHERE survey_id = :surveyid and active = 1";

        try{
            $stm = $dbh->prepare($sql);

            if( empty($stm) ){
                $error = Core::error($this->errors,12);
                $error['error_msg'] .= $error_append;
                return $error;
            }

            $sres = $stm->execute(array(':surveyid' => $options['survey_id']));

            if( empty($sres) ){
                $error = Core::error($this->errors, 13);
                $error['error_msg'] .= $error_append;
                return $error;
            }

            $questions = $stm->fetchAll(PDO::FETCH_ASSOC);


            foreach($questions as $k => &$v){
                $v['answer_group'] = $this->get_answers($v);
            }

        }
        catch(PDOException $e){
            $error = Core::error($this->errors, 14);
            $error['error_msg'] .= $error_append;
            return $error;
        }

        if( !empty( $questions) ){
            return $questions;
        }
        else {
            return array();
        }
       
    }

    /*
    Creates a new survey question
    */
    function create_survey_question($options = array()){

        /*

        args:
        {
            survey_id: ID of survey question belong to
            question: question text
            question_type: type of answer question takes such as a radio, dropdown, etc.
            question_order: order of question in this survey
        }

        returns:
            if successful:
            {
                survey_questions_id: ID of new survey question
            }

            if error: standard error

        */

        global $dbh, $session, $gamo;

        Core::ensure_defaults(array(
            'survey_id' => -1, 
            'question' => '',
            'question_type' => '',
            'question_order' => 0,
            'active' => 1,
            'created_time' => Core::date_string()
        )
        , $options);

        $valid = $this->validate_survey_question($options);
        
        if(Core::has_error($valid)){
            return $valid;
        }

        $question_id = Core::db_insert(array(
                'table' => '' . GAMO_DB . '.survey_questions',
                'values' => array(
                    'survey_id' => $options['survey_id'],
                    'question_type' => $options['question_type'],
                    'question' => $options['question'],
                    'question_order' => $options['question_order'],
                    'active' => $options['active'],
                    'created_time' => $options['created_time']
                )
            )
        );
        
        if(!is_numeric($question_id)){
            return Core::error($this->errors, 1);
        }

        return array(
            'survey_questions_id' => $question_id
        );

    }

    /*
    Updates survey question
    */
    function update_survey_question($options = array()){

        /*
        args: 
        {
            survey_questions_id: the ID of the survey question
            values: {
                survey_id: the ID of the survey the question belongs to
                question: question text
                question_type: the type of answer this question has. for example, radio, dropdown, etc.
                question_order: the order of this question
            }
        }

        or

        args:
        {
            survey_id: the ID of the survey the question belongs to
            question: question text
            question_type: the type of answer this question has. for example, radio, dropdown, etc.
            question_order: the order of this question
        }


        returns:
            if successful:
            {
                valid: 1
            }

            if error: standard error

        */

        Core::ensure_defaults(array(
                'survey_questions_id' => -1,
                'values' => array(
                    'survey_id' => -1,
                    'question' => '',
                    'question_type' => '',
                    'question_order' => 0,
                    'active' => 1,
                    'created_time' => Core::date_string()
                    
                )
            )
        , $options);

        if(!is_array($options['values']) && $options['values'] === 'delete'){
        
            $options['values'] = array('active' => 0);
            
        }
        elseif(is_array($options['values'])){
            $valid = $this->validate_survey_question($options);

            if(Core::has_error($valid)){
                return $valid;
            }
        }

        $result = Core::db_update(array(
                'table' => GAMO_DB . '.survey_questions',
                'values' => $options['values'],
                'where' => array(
                    'survey_questions_id' => $options['survey_questions_id']
                )
            )
        );

        if($result === false){
            
            return Core::error($this->errors, 2);
    
        }

        return array(
            'updated' => 1
        );
    }

    /*
    args: 
        
        survey_questions_id: the ID of the survey question

    returns:

        if error: standard error

    */
    function is_valid_survey_question($survey_question_id){


        $c = Core::db_count( array(
                'table' => GAMO_DB . '.survey_questions',
                'values' => array(
                    'survey_questions_id' => $survey_question_id
                )
            )
        );

        if($c < 1){

            return Core::error($this->errors, 11);

        }
    }

    /*
    Validate input for creating/updating a survey
    */
    function validate_survey_question(&$options = array()){
        
        $allowed_question_types = array(
            'radio', 'checkbox', 'input', 'text', 'textarea', 'dropdown'
        );
       
        if( isset($options['survey_questions_id']) ){

            Core::ensure_defaults(array(
                    'survey_questions_id' => -1,
                    'values' => array(
                    )
                )
            , $options);

            $valid = $this->is_valid_survey_question($options['survey_questions_id']);
            
            if(Core::has_error($valid)){
                return $valid;   
            }

            if( isset($options['values']['survey_id']) ){

                global $gamo;

                $valid = Core::r('survey')->is_valid_survey($options['values']['survey_id']);

                if(Core::has_error($valid)){
                    return $valid;
                }

            }

            if( isset($options['values']['active']) ){

                if(!is_numeric($options['values']['active'])){
                    return Core::error($this->errors, 8);    
                }

            }

            if( isset($options['values']['question_type']) ){
                if( trim($options['values']['question_type']) === '' ||
                    !in_array(strtolower(trim($options['values']['question_type'])), $allowed_question_types) ){
                    
                    return Core::error($this->errors, 3);

                }
            }
            if( isset($options['values']['question']) ){
                if( strlen($options['values']['question']) < 5 ){

                    return Core::error($this->errors, 4);

                }
                if( strlen($options['values']['question']) > 500 ){
                    
                    return Core::error($this->errors, 5);

                }
            }

            if( isset($options['values']['question_order']) ) {

                $options['values']['question_order'] = trim($options['values']['question_order']);

                if( !is_numeric($options['values']['question_order']) ){

                    return Core::error($this->errors, 2);

                }

                if( isset($options['values']['survey_id']) ){

                    $c = Core::db_count( array(
                            'table' => GAMO_DB . '.survey_questions',
                            'values' => array(
                                'survey_id' => $options['values']['survey_id'],
                                'question_order' => $options['values']['question_order']
                            )
                        )
                    );

                    if($c < 1){

                        return Core::error($this->errors, 9);

                    }

                }
                else{
                    return Core::error($this->errors, 10);
                }

            }

            return array(
                'valid' => 1
            );

        }
        elseif( !isset($options['survey_questions_id']) ){


            if( !isset($options['survey_id']) ){
        
                return Core::error($this->errors, 7);

            }
            else {

                global $gamo;

                $valid = Core::r('survey')->is_valid_survey($options['survey_id']);

                if(Core::has_error($valid)){
                    return $valid;
                }

            }

            if( isset($options['question_type']) ) {

                if (trim($options['question_type']) === '' || 
                    !in_array(strtolower(trim($options['question_type'])), $allowed_question_types) ){

                    return Core::error($this->errors, 3);
                
                }

            }
    
            if( isset($options['question']) ) {

                if( strlen($options['question']) < 5 ){

                    return Core::error($this->errors, 4);

                }
                elseif( strlen($options['question']) > 500 ) {
                    return Core::error($this->errors, 5);
                }

            }

            if( isset($options['question_order']) ){
    
                if( !is_numeric(trim($options['question_order'])) ) {
                
                    return Core::error($this->errors, 6);
                    
                }  

            }

            return array(
                'valid' => 1
            );

        }

    }

}

?>
