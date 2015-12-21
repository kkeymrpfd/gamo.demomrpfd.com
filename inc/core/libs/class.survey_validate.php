<?

class Core_Survey_Validate {

    public $errors;

    function __construct() {

        $this->errors = array(
            array(
                'error_code' => 1,
                'error_msg' => 'Invalid survey validate ID'
            ),
            array(
                'error_code' => 2,
                'error_msg' => 'Could not update validation rule for answer'
            ),
            array(
                'error_code' => 3,
                'error_msg' => 'Could not save validation rule for answer'
            ),
            array(
                'error_code' => 4,
                'error_msg' => 'Failed to prepare DB statement'
            ),
            array(
                'error_code' => 5,
                'error_msg' => 'Failed to execute DB statement'
            ),
            array(
                'error_code' => 6,
                'error_msg' => 'Failed. Received a PDOException'
            ),
            array(
                'error_code' => 7,
                'error_msg' => 'The validation rule type is not allowed'
            ),
            array(
                'error_code' => 8, 
                'error_msg' => 'Validation value must be specified when requesting a new validation rule'
            ),
            array(
                'error_code' => 9,
                'error_msg' => 'Validation type must be specified when requesting a new validation rule'
            )
        );
    }

    /*
    //todo get validation for answer
    function get_surveys($options = array()){

        global $dbh, $gamo;
        $error_append = " CLASS[".__CLASS__."] METHOD [".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";

        if( empty( $options['user_id'] ) ){
            $error = Core::error($this->errors, 7);
            $error['error_msg'] .= $error_append;
            return $error;
        }

        Core::ensure_defaults(array(
                'start' => 0,
                'num' => 0
            )
        , $options);

        $sql = "SELECT survey_id, title as survey_title, descrip as survey_description FROM " . CORE_DB . ".`surveys` WHERE user_id = :userid and active = 1 ORDER BY created_time DESC LIMIT 1" .$options['start'] . "," . $options['num'];

        try{
            $stm = $dbh->prepare($sql);

            if( empty($stm) ){
                $error = Core::error($this->errors, 8);
                $error['error_msg'] .= $error_append;
                return $error;
            }

            $sres = $stm->execute(array(':userid' => $options['user_id']));

            if( empty($sres) ){
                $error = Core::error($this->errors, 9);
                $error['error_msg'] .= $error_append;
                return $error;
            }

            $surveys = $stm->fetchAll(PDO::FETCH_ASSOC);

            foreach($surveys as $k => &$v){
                $v['questions'] = Core::r('survey_question')->get_questions($v);
            }

        }
        catch(PDOException $e){
            $error = Core::error($this->errors, 10);
            $error['error_msg'] .= $error_append;
            return $error;
        }

        if( !empty( $surveys) ){
            return $surveys;
        }
        else {
            return false;
        }

    }*/

    function create_survey_validate($options = array()){
    
        global $dbh, $session, $gamo;

        Core::ensure_defaults(array(
            'survey_answers_id' => -1,
            'validate_type' => '',
            'validate_value' => '',
            'active' => 1,
            'created_time' => Core::date_string()
        )
        , $options);

        $valid = $this->validate_survey_validation($options);

        if(Core::has_error($valid)){

            return $valid;

        }

        $survey_id = Core::db_insert(array(
                'table' => '' . CORE_DB . '.survey_validate',
                'values' => array(
                    'survey_answers_id' => $options['survey_answers_id'],
                    'validate_type' => $options['validate_type'],
                    'validate_value' => $options['validate_value'],
                    'active' => $options['active'],
                    'created_time' => $options['created_time']
                )
            )
        );

        if(!is_numeric($survey_id)){
    
            return Core::error($this->errors, 3);

        }

        return array(
            'survey_validate_id' => $survey_id
        );

    }

    function update_survey_validate($options = array()){

        Core::ensure_defaults(array(
                'survey_validate_id' => -1,
                'values' => array(
                    'survey_answers_id' => -1,
                    'validate_type' => '',
                    'validate_value' => '',
                    'active' => 1,
                    'created_time' => Core::date_string()
                )
            )
        , $options);

        if(!is_array($options['values']) && $options['values'] === 'delete'){
        
            $options['values'] = array('active' => 0);
            
        }
        elseif(is_array($options['values'])){
            $valid = $this->validate_survey_validation($options);

            if(Core::has_error($valid)){
                return $valid;
            }
        }
       
        $result = Core::db_update(array(
                'table' => CORE_DB . '.survey_validate',
                'values' => $options['values'],
                'where' => array(
                    'survey_validate_id' => $options['survey_validate_id']
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

    function is_valid_survey_validate($survey_validate_id){

        $c = Core::db_count( array(
                'table' => CORE_DB . '.survey_validate',
                'values' => array(
                    'survey_validate_id' => $survey_validate_id
                )
            )
        );
    

        if($c < 1){

            return Core::error($this->errors, 1);

        }

    }

    function validate_survey_validation(&$options = array()){

        $allowed_validation_types = array(
            'min_length',
            'max_length',
            'is_numeric',
            'is_alpha'
        );

        if(isset($options['survey_validate_id'])){

            Core::ensure_defaults(array(
                    'survey_id' => -1,
                    'values' => array()
                )
            , $options);

            if(isset($options['values']['validate_value']) && !isset($options['values']['validate_type'])){

                //todo query suvery_validate for the validate_type associated with the survey_validate_id
                $sql = "SELECT survey_validate_type FRMO " . CORE_DB . ".`survey_validate` WHERE survey_validate_id = :surveyvalidateid and active = 1";

                try{
                    global $dbh;
                    $stm = $dbh->prepare($sql);

                    if( empty($stm) ){
                        $error = Core::error($this->errors, 4);
                        $error['error_msg'] .= $error_append;
                        return $error;
                    }

                    $sres = $stm->execute(array(':surveyvalidateid' => $options['survey_validate_id']));

                    if( empty($sres) ){
                        $error = Core::error($this->errors, 5);
                        $error['error_msg'] .= $error_append;
                        return $error;
                    }
                    
                    $survey_validate_type = $stm->fetchAll(PDO::FETCH_ASSOC);

                    Core::print_r($survey_validate_type);
                    exit; 
                }
                catch(PDOException $e){
                    $error = Core::error($this->errors, 6);
                    $error['error_msg'] .= $error_append;
                    return $error;
                }

                if( !empty( $questions) ){
                    return $questions;
                }
                else{
                    return array();
                }
    
            }

            if(isset($options['values']['validate_type'])){
    
                if( !in_array($options['values']['validate_type'], $allowed_validation_types) ){

                    return Core::error($this->errors, 7);

                }

                if(!isset($options['values']['validate_value'])){

                    return Core::error($this->errors, 8);

                }
                else {

                }
            }
        }
        elseif(!isset($options['survey_validate_id'])){

            if( !isset($options['validate_type']) ){

                return Core::error($this->errors, 8);    

            }
            if(!isset($options['validate_value']) ) {

                return Core::error($this->errors, 9);

            }

            if( trim($options['validate_type']) === ''){

                return Core::error($this->errors, 8);

            }

            if( trim($options['validate_value']) === ''){

                return Core::error($this->errors, 9);

            }

            if( !in_array($options['validate_type'], $allowed_validation_types) ){
                
                return Core::error($this->errors, 7);

            }

        }

		// Return if valid, or if not, what is invalid
        return array(
            'valid' => 1
        );

    }
}

?>
