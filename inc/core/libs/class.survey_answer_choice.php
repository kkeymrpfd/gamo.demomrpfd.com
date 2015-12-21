<?
/*
This class handles creating and updating survey
*/
class Core_Survey_Answer_Choice {

    public $errors; // store error codes

    function __construct() {

        // creates error codes
        $this->errors = array(
            array(
                'error_code' => 1,
                'error_msg' => 'Could not save answer'
            ),
            array(
                'error_code' => 2,
                'error_msg' => 'Could not update answer'
            ),
            array(
                'error_code' => 3,
                'error_msg' => 'Invalid answer type'
            ),
            array(
                'error_code' => 4,
                'error_msg' => 'Answer must be more than 1 character'
            ),
            array(
                'error_code' => 5, 
                'error_msg' => 'Answer must be less than 500 characters'
            ),
            array(
                'error_code' => 6,
                'error_msg' => 'Invalid survey question ID'
            ),
            array(
                'error_code' => 7,
                'error_msg' => 'Invalid survey answer ID' 
            ),
            array(
                'error_code' => 8,
                'error_msg' => 'Failed to prepare DB statement'
            ),
            array(
                'error_code' => 9,
                'error_msg' => 'Failed to execute DB statement'
            ),
            array(
                'error_code' => 10,
                'error_msg' => 'Failed. Received a PDOException'
            ),
            array(
                'error_code' => 11,
                'error_msg' => 'Value for answer type must be empty'
            ),
            array(
                'error_code' => 12,
                'error_msg' => 'Answer is empty'
            )
        );
    }

    /*
    Gets answer choices belonging to a given question
    */
    function get_answer_choices($options = array()){

        /*
        args:
        {
            question_id: the ID of a question this answer is associated with
        }

        returns:

            if there are answers:
            {
                id: the ID of the answer 
                text: the answer text
            }
    
            if there are no surveys: {}

            if error: standard error
           
        */


        global $dbh;
        $error_append = " CLASS[".__CLASS__."] METHOD [".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";

        if( empty( $options['question_id'] ) ){
            $error = Core::error($this->errors, 7);
            $error['error_msg'] .= $error_append;
            return $error;
        }

        $sql = "SELECT survey_answers_choices_id as id, answer as text FROM " . CORE_DB . ".`survey_answer_choices` WHERE survey_questions_id = :questionid and active = 1";

        try{
            $stm = $dbh->prepare($sql);

            if( empty($stm) ){
                $error = Core::error($this->errors, 8);
                $error['error_msg'] .= $error_append;
                return $error;
            }

            $sres = $stm->execute(array(':questionid' => $options['question_id']));

            if( empty($sres) ){
                $error = Core::error($this->errors, 9);
                $error['error_msg'] .= $error_append;
                return $error;
            }

            $answers = $stm->fetchAll(PDO::FETCH_ASSOC);

        }
        catch(PDOException $e){
            $error = Core::error($this->errors, 10);
            $error['error_msg'] .= $error_append;
            return $error;
        }

        if( !empty( $answers) ){
            return $answers;
        }
        else {
            return array();
        }

    }
    /*
    Creates a new answer choice
    */
    function create_survey_answer_choice($options = array()){

        /*
        args:
        {
            answer: answer text
        }
        
        returns:

            if successful:
            {
                survey_answer_choices_id: ID of new answer choice
            }

            if error: standard error

        */
        global $dbh, $session, $gamo;

        Core::ensure_defaults(array(
            'survey_questions_id' => -1,
            'choice' => '',
            'active' => 1,
            'created_time' => Core::date_string()
        )
        , $options);

        $valid = $this->validate_survey_answer_choice($options);

        if(Core::has_error($valid)){
            return $valid;
        }

        $answer_choice_id = Core::db_insert(array(
                'table' => '' . CORE_DB . '.survey_answer_choices',
                'values' => array(
                    'survey_questions_id' => $options['survey_questions_id'],
                    'choice' => $options['choice'],
                    'active' => $options['active'],
                    'created_time' => $options['created_time']
                )      
            )
        );


        Core::print_r($answer_choice_id);

        if(!is_numeric($answer_choice_id)){
            return Core::error($this->errors, 1);
        }

        return array(
            'survey_answer_choices_id' => $answer_choice_id
        );


    }

    /*
    args:
        
        survey_answer_choices_id: the ID of the answer choice

    returns:

        if error: standard error

    */

    function is_valid_survey_answer_choice($survey_answer_choices_id){
        
        $c = Core::db_count( array(
                'table' => CORE_DB . '.survey_answer_choices',
                'values' => array(
                    'survey_answer_choices_id' => $survey_answer_choices_id
                )
            )
        );

        if($c < 1){
            return Core::error($this->errors, 7);
        }

    }

    /*
    Updates survey answer choice
    */
    function update_survey_answer_choice($options = array()){

        /*
        args:
        {
            survey_answer_choices_id: the ID of the answer choice
            values: {
                answer: the answer text
            }

        }

        or

        args:
        {
            answer: the answer text
        }

        returns:

            if successful:
            {
                valid: 1
            }

            if error: standard error

        */

        Core::ensure_defaults(array(
                'survey_answer_choices_id' => -1,
                'values' => array(
                    'choice' => '',
                    'active' => 1,
                    'created_time' => Core::date_string()
                )
            )
        , $options);

        if(!is_array($options['values']) && $options['values'] === 'delete'){
        
            $options['values'] = array('active' => 0);
            
        }
        elseif(is_array($options['values'])){
            $valid = $this->validate_survey_answer_choice($options);

            if(Core::has_error($valid)){
                return $valid;
            }
        }

        $result = Core::db_update(array(
               'table' => CORE_DB . '.survey_answer_choices',
               'values' => $options['values'],
               'where' => array(
                    'survey_answer_choices_id' => $options['survey_answer_choices_id']
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
    validation for creating and updating survey answer choice
    */
    function validate_survey_answer_choice(&$options = array()){
        global $gamo;

        if( isset($options['survey_answer_choices_id']) ) {

            Core::ensure_defaults(array(
                    'survey_answer_choices_id' => -1,
                    'values' => array(
                    )
                )
            , $options);

            $result = $this->is_valid_survey_answer_choice($options['survey_answer_choices_id']);

            if(Core::has_error($result)){
                return $result;
            }


            if( isset($options['values']['survey_questions_id']) ){
    
                if( !is_numeric($options['values']['survey_questions_id']) ){
                    return Core::error($this->errors, 6);
                }
                
                $result = Core::r('survey_question')->is_valid_survey_question($options['values']['survey_questions_id']);

                if(Core::has_error($result)){
                    return $result;
                }

                $result = Core::r('survey_question')->get_question_type($options['values']['survey_questions_id']);
                
                if(Core::has_error($result)){
                    return $result;
                }

                Core::print_r($options);

                if( isset($result['question_type']) ){

                    if(($result['question_type'] === 'text' or 
                        $result['question_type'] === 'textarea') ){


                        if($options['values']['choice'] !== ''){
                            return Core::error($this->errors, 10);
                        }
                        else {
                            $options['values']['choice'] = '-1';
                        }
                    }
                    else{

                        if($options['values']['choice'] === ''){
                            return Core::error($this->errors, 12);
                        }
                    }
                }
                else {

                   if(!in_array($result['question_type'], $allowed_answer_types) ){
                        return Core::error($this->errors, 3);
                    }
                    else {
                        if( trim($options['values']['choice']) === '' ){
                            return Core::error($this->errors, 4);
                        }
                        elseif( strlen($options['values']['choice']) > 500 ) {
                            return Core::error($this->errors, 5);
                        }
                    }
                }
            }

            return array(
                'valid' => 1
            );

        }
        elseif( !isset($options['survey_answer_choices_id']) ){

            $result  = Core::r('survey_question')->is_valid_survey_question($options['survey_questions_id']);

            if(Core::has_error($result)){
                return $result;
            }

            $result = Core::r('survey_question')->get_question_type($options['survey_questions_id']);
            if(Core::has_error($result)){
                return $result;
            }

            Core::print_r($result);

            $allowed_answer_types = array('radio','checkbox','dropdown');

            if( isset($result['question_type']) ) {

                if( $result['question_type'] === 'text' or
                    $result['question_type'] === 'textarea' ){
                   
                    if($options['choice'] !== '' ){
                        return Core::error($this->errors, 10);
                    }
                    else {
                        $options['choice'] = '-1';
                    }

                }
                else {

                    if( $options['choice'] === ''){
                        return Core::error($this->errors, 12);
                    }

                }
            }
            else {

                if(!in_array($result['question_type'], $allowed_answer_types) ){
                    return Core::error($this->errors, 3);
                }
                else {
                    if( trim($options['choice']) === '' ){

                        return Core::error($this->errors, 4);

                    }
                    elseif( strlen($options['choice']) > 500 ) {

                        return Core::error($this->errors, 5);

                    }
                }
            }

            return array(
                'valid' => 1
            );
        }
    }
}

?>
