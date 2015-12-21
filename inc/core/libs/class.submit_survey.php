<?
/*
This class handles submitting surveys
*/
class Core_Submit_Survey{

    public $errors; // store error codes

    function __construct() {

        // creates error codes
        $this->errors = array(
            array(
                'error_code' => 1,
                'error_msg' => 'Invalid survey ID'
            ),
            array(
                'error_code' => 2,
                'error_msg' => 'Could not submit survey'
            ),
            array(

            )
        );

    }
    /*
    Validation for a survey when submitted
    */
    function validate_submit_survey($options = array()){
        
        $validation_rules = array(
        );
         
    }
    /*
    Submits survey
    */
    function submit_survey($options = array()){

        /*
        args:
        {

        }

        returns:
            if successful: 
            {
                survey_response_id: ID of survey submitted
            }

            if error: standard error
        */
       
        global $dbh, $session, $gamo;

        /*Core::ensure_defaults(array(

            )
        , $options);
       

        $valid = $this->validate_survey_submit($options);
        
        if(Core::has_error($valid)){
            return $valid;   
        }

        $survey_submit_id = Core::db_insert(array(
                'table' => CORE_DB . '.surveys',
                'values' => array(
                )
            )
        );

        if(!is_numeric($survey_submit_id)){
            return Core::error($this->errors, 2);
        }

        return array(
            'survey_submit_id' => $survey_submit_id
        );*/



    }


}

?>
