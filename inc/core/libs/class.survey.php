<?
/*
This class handles creating and updating surveys
*/
class Core_Survey {

    public $errors; // store error codes

    function __construct() {

        // creates error codes
        $this->errors = array(
            array(
                'error_code' => 1,
                'error_msg' => 'Invalid survey title'
            ),
            array(
                'error_code' => 2,
                'error_msg' => 'Could not update survey'
            ),
            array(
                'error_code' => 3,
                'error_msg' => 'Could not save survey'
            ),
            array(
                'error_code' => 4,
                'error_msg' => 'Invalid survey description'
            ),
            array(
                'error_code' => 6,
                'error_msg' => 'Invalid survey ID'
            ),
            array(
                'error_code' => 7,
                'error_msg' => 'Invalid user ID'
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
    Gets number of surveys belonging to user
    */
	function get_surveys_count( $options = array() ){
	
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) ){
			$error = Core::error($this->errors, 7);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		return Core::db_count(array(
				'table' => CORE_DB.'.users',
				'values' => array(
					'user_id' => $options['user_id']
				)
		    )
        );
		
	}

    /*
    Gets surveys for given user_id
    */
    function get_surveys($options = array()){

        /*
        args:
        {
            user_id: the ID associated with surveys
            start: start range for LIMIT
            num: end range for LIMIT
        }

        returns:

            if there are surveys:
            {
                survey_id: the ID of the survey 
                survey_title: the title for this survey
                survey_description: the description for this survey
            }
    
            if there are no surveys: {}

            if error: standard error
           
        */


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

        $sql = "SELECT survey_id, title as survey_title, descrip as survey_description FROM " . CORE_DB . ".`surveys` WHERE user_id = :userid and active = 1 ORDER BY created_time DESC LIMIT " .$options['start'] . "," . $options['num'];

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
            return array();
        }

    }

    /*
    Creates a new survey
    */
    function create_survey($options = array()){
    
        /*
        args:
        {
            user_id: ID of user is survey belongs to
            title: title of new survey
            descrip: description of new survey
        }

        returns:
            if successful:
            {
                survey_id: ID of new survey
            }

            if error: standard error

        */
        global $dbh, $session, $gamo;

        Core::ensure_defaults(array(
            'user_id' => -1,
            'title' => '',
            'descrip' => '',
            'active' => 1,
            'created_time' => Core::date_string()
        )
        , $options);

        $valid = $this->validate_survey_info($options);

        if(Core::has_error($valid)){

            return $valid;


        }

        $survey_id = Core::db_insert(array(
                'table' => '' . CORE_DB . '.surveys',
                'values' => array(
                    'user_id' => $options['user_id'],
                    'title' => $options['title'],
                    'active' => $options['active'],
                    'created_time' => $options['created_time']
                )
            )
        );

        if(!is_numeric($survey_id)){
    
            return Core::error($this->errors, 3);

        }

        return array(
            'survey_id' => $survey_id
        );

    }
    /*
    Updates survey
    */
    function update_survey($options = array()){
        /*
        args: 
        {
            survey_id: the ID of the survey
            values: {
                title: the title of the survey
                descrip : the description of the survey
            }
        }

        or

        args:
        {
            title: the title of the survey
            descrip : the description of the survey
        
        }


        returns:
            if successful:
            {
                valid : 1
            }

            if error: standard error
        
        */

        Core::ensure_defaults(array(
                'survey_id' => -1,
                'values' => array(
                    'user_id' => -1,
                    'title' => '',
                    'descrip' => '',
                    'active' => 0,
                    'created_time' => Core::date_string()
                )
            )
        , $options);

        if(!is_array($options['values']) && $options['values'] === 'delete'){
        
            $options['values'] = array('active' => 0);
            
        }
        elseif(is_array($options['values'])){
            $valid = $this->validate_survey_info($options);

            if(Core::has_error($valid)){
                return $valid;
            }
        }
       
        $result = Core::db_update(array(
                'table' => CORE_DB . '.surveys',
                'values' => $options['values'],
                'where' => array(
                    'survey_id' => $options['survey_id']
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

        survey_id: the ID of the survey

    returns:
                
        if error: standard error

    */
    function is_valid_survey($survey_id){

        $c = Core::db_count( array(
                'table' => CORE_DB . '.surveys',
                'values' => array(
                    'survey_id' => $survey_id
                )
            )
        );
    
        if($c < 1){

            return Core::error($this->errors, 5);

        }

    }

    /*
    Validation for creating/updating a survey
    */
    function validate_survey_info($options = array()){

        // validation for existing survey
        if(isset($options['survey_id'])){

            //$this->is_valid_survey($options['survey_id']);

            Core::ensure_defaults(array(
                    'survey_id' => -1,
                    'values' => array()
                )
            , $options);

            if(isset($options['values']['title'])){

                if( trim($options['values']['title']) == '' ){

                    return Core::error($this->errors, 1);

                }

            }
            if(isset($options['values']['descrip'])){

                if( trim($options['values']['descrip']) == ''){

                    return Core::error($this->errors, 4);

                }
              
            }

        }
        // validation for new survey
        elseif(!isset($options['survey_id'])){

            if( trim($options['title']) === '' ) {

                return Core::error($this->errors, 1);

            }

            // this is commented out because a description is not required
            /*if( trim($options['descrip']) === ''){

                return Core::error($this->errors, 4);

            }*/

        }

		// Return if valid, or if not, what is invalid
        return array(
            'valid' => 1
        );

    }
}

?>
