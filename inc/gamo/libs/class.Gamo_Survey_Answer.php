<?
/*
This class handles creating and updating survey
*/
class Gamo_Survey_Answer {

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
            )
        );
    }

    /*
    Gets number of answers belonging to a given question
    */
    function get_answers($options = array()){

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

        $sql = "SELECT survey_answers_id as id, answer as text FROM " . GAMO_DB . ".`survey_answers` WHERE survey_questions_id = :questionid and active = 1";

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
    Creates a new answer
    */
    function create_survey_answer($options = array()){

        /*
        args:
        {
            answer: answer text
        }
        
        returns:

            if successful:
            {
                survey_answers_id: ID of new answer
            }

            if error: standard error

        */
        global $dbh, $session, $gamo;

        Core::ensure_defaults(array(
            'survey_questions_id' => -1,
            'answer' => '',
            'active' => 1,
            'created_time' => Core::date_string()
        )
        , $options);

        $valid = $this->validate_survey_answer($options);

        if(Core::has_error($valid)){
            return $valid;
        }

        $answer_id = Core::db_insert(array(
                'table' => '' . GAMO_DB . '.survey_answers',
                'values' => array(
                    'survey_questions_id' => $options['survey_questions_id'],
                    'answer' => $options['answer'],
                    'active' => $options['active'],
                    'created_time' => $options['created_time']
                )      
            )
        );

        if(!is_numeric($answer_id)){
            return Core::error($this->errors, 1);
        }

        return array(
            'survey_answers_id' => $answer_id
        );


    }

    /*
    args:
        
        survey_answers_id: the ID of the survey answer

    returns:

        if error: standard error

    */

    function is_valid_survey_answer($survey_answer_id){
        
        $c = Core::db_count( array(
                'table' => GAMO_DB . '.survey_answers',
                'values' => array(
                    'survey_answers_id' => $survey_answer_id
                )
            )
        );

        if($c < 1){
            return Core::error($this->errors, 7);
        }

    }

    /*
    Updates survey answer
    */
    function update_survey_answer($options = array()){

        /*
        args:
        {
            survey_answers_id: the ID of the answer
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
                'survey_answers_id' => -1,
                'values' => array(
                    'answer' => '',
                    'active' => 1,
                    'created_time' => Core::date_string()
                )
            )
        , $options);

        if(!is_array($options['values']) && $options['values'] === 'delete'){
        
            $options['values'] = array('active' => 0);
            
        }
        elseif(is_array($options['values'])){
            $valid = $this->validate_survey_answer($options);

            if(Core::has_error($valid)){
                return $valid;
            }
        }

        $result = Core::db_update(array(
               'table' => GAMO_DB . '.survey_answers',
               'values' => $options['values'],
               'where' => array(
                    'survey_answers_id' => $options['survey_answers_id']
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
    validation for creating and updating survey answers
    */
    function validate_survey_answer($options = array()){

        if( isset($options['survey_answers_id']) ) {

            Core::ensure_defaults(array(
                    'survey_answers_id' => -1,
                    'values' => array(
                    )
                )
            , $options);

            global $gamo;

            $valid = $this->is_valid_survey_answer($options['survey_answers_id']);

            if(Core::has_error($valid)){
                return $valid;
            }

            if( isset($options['values']['survey_questions_id']) ){
    
                if( !is_numeric($options['values']['survey_questions_id']) ){
                    return Core::error($this->errors, 6);
                }
                
                global $gamo;
                $valid = Core::r('survey_question')->is_valid_survey_question($options['values']['survey_questions_id']);

                if(Core::has_error($valid)){
                    return $valid;
                }
        
            }
            if( isset($options['values']['answer']) ){

                if( strlen($options['values']['answer']) < 1 ){
                  
                    return Core::error($this->errors, 4);
                    
                }
                elseif( strlen($options['values']['answer']) > 500 ){
                    
                    return Core::error($this->errors, 5);

                }
            }

            return array(
                'valid' => 1
            );           

        }
        elseif( !isset($options['survey_answers_id']) ){

            $allowed_answer_types = array();

            if( isset($options['answer_type']) ) {
                if ( trim($options['answer_type']) === '' || 
                     !in_array($options['answer_type'], $allowed_answer_types) ){

                    return Core::error($this->errors, 3);
                
                }
            }

            if( isset($options['answer']) ) {

                if( strlen($options['answer']) < 1 ){

                    return Core::error($this->errors, 4);

                }
                elseif( strlen($options['answer']) > 500 ) {

                    return Core::error($this->errors, 5);

                }

            }

            return array(
                'valid' => 1
            );
        }
    }
}

?>
