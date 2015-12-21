<?
/*
This class handles creating referrals
Note: if you need to run any queries, try using Core::db_count, Core::db_update, or Core::db_insert.
If those functions aren't ideal, then use global $dbh inside of the function, then run a query using PDO
*/
class Gamo_Referral {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid name'
			),
            array(
                'error_code' => '2',
                'errror_msg' => 'Invalid title'
            ),
            array(
                'error_code' => '3',
                'error_msg' => 'Invalid company'
            ),
            array(
                'error_code' => '4',
                'error_msg' => 'Invalid email'
            ),
            array(
                'error_code' => '5',
                'error_msg' => 'Invalid message'
            ),
            array(
                'error_code' => '6',
                'error_msg' => 'Could not save referral'
            ),
            array(
                'error_code' => '7',
                'error_msg' => 'Could not update referral'
            ),
            array(
                'error_code' => '8',
                'error_msg' => 'Invalid user id'
            ),
            array(
                'error_code' => '9',
                'error_msg' => 'The maximum number of referrals sent today has been exceeded'
            ),
            array(
                'error_code' => '10',
                'error_msg' => 'There is already a referral for this email'
            ),
            array(
                'error_code' => '11',
                'error_msg' => 'Invalid referral id'
            ),
			array(
					'error_code' => '12',
					'error_msg' => 'Failed to prepare DB statement.'
			),
			array(
					'error_code' => '13',
					'error_msg' => 'Failed to execute DB statement.'
			),
			array(
					'error_code' => '14',
					'error_msg' => 'Failed. Received a PDOException.'
			),
			array(
					'error_code' => '15',
					'error_msg' => 'Missing required argument.'
			),
		array(
		        'error_code' => '16',
		        'error_msg' => 'You cannot send a referral to yourself'
		    ),
		);

	}

	/*
	Creates a new referral
	*/
	function create_referral($options = array()) {

        /*
		returns:
			if successful:
			{
				referral_id: the id of the referral
			}

			if error: standard error
		*/

        global $dbh, $session, $gamo;

		
        Core::ensure_defaults(array(
				'name' => '',
                'title' => '',
				'company' => '',
				'email' => '',
				'msg' => '',
                'user_created' => -1,
                'user_claimed' => -1,
                'created_datetime' => Core::date_string(),
                'claimed_datetime' => '1970-01-01 00:00:00',
                'active' => 1,
			)
		, $options);

        $valid = $this->validate_referral_info($options);

        if(Core::has_error($valid)){
            return $valid;
        }
    	
	// Determine if user is trying to refer themselves
	$c = Core::db_count(array(
        		'table' => GAMO_DB . '.users',
        		'values' => array(
				'user_id' => $options['user_claimed'],
        			'email' => $options['email']
        		)
        	)
        );

	if($c > 0) {
		
		return Core::error($this->errors, 16);	
	
	}

    	// Determine if this is a referral claim or a new referral
        $c = Core::db_count(array(
        		'table' => GAMO_DB . '.referrals',
        		'values' => array(
        			'email' => $options['email'],
        			'user_claimed' => -1
        		)
        	)
        );

        if($c == 0) { // This is a new referral

	        // Try creating referral
	        $referral_id = Core::db_insert(array(
	                'table' => '' . GAMO_DB . '.referrals',
	                'values' => array(
	                    'name' => $options['name'],
	                    'title' => $options['title'],
	                    'company' => $options['company'],
	                    'email' => $options['email'],
	                    'msg' => $options['msg'],
	                    'user_created' => $options['user_created'],
	                    'user_claimed' => $options['user_claimed'],
	                    'created_datetime' => $options['created_datetime'],
	                    'claimed_datetime' => $options['claimed_datetime'],
	                    'active' => $options['active']
	                )
	            )
	        );

	    } else {

	    	$referral_id = Core::fetch_column(
	    		"SELECT referral_id FROM " . GAMO_DB . ".referrals WHERE email = :email AND user_claimed <= 0",
	    		array(
	    			':email' => $options['email']
	    		)
	    	);

	    }

        if(!is_numeric($referral_id)){

            return Core::error($this->errors, 6); 

        }

        
        $action_type = ($c > 0) ? 'claim_referral' : 'submit_referral';

        $referal_action = Core::r('actions')->create_action(array(
        		'action_types_id' => $action_type,
        		'user_id' => $options['user_created'],
        		'int_other' => $referral_id
        	)
        );
        
        if(!Core::has_error($referal_action) && isset($referal_action['action_id'])) {
        
        	Core::r('actions')->create_action_info(array(
        			'action_id' => $referal_action['action_id'],
        			'info_type' => 'name',
        			'info' => $options['name']
        	)
        	);
        
        	Core::r('actions')->create_action_info(array(
        			'action_id' => $referal_action['action_id'],
        			'info_type' => 'title',
        			'info' => $options['title']
        	)
        	);
        	
        	Core::r('actions')->create_action_info(array(
        			'action_id' => $referal_action['action_id'],
        			'info_type' => 'company',
        			'info' => $options['company']
        	)
        	);
        	
        	Core::r('actions')->create_action_info(array(
        			'action_id' => $referal_action['action_id'],
        			'info_type' => 'email',
        			'info' => $options['email']
        	)
        	);
        	
        	Core::r('actions')->create_action_info(array(
        			'action_id' => $referal_action['action_id'],
        			'info_type' => 'message',
        			'info' => $options['msg']
        	)
        	);
        
        }

        if($c > 0) { // This was a claimed referral. Set it to claimed

        	Core::db_update(array(
        			'table' => GAMO_DB . '.referrals',
        			'values' => array(
        				'user_claimed' => $options['user_created'],
        				'claimed_datetime' => Core::date_string()
        			),
        			'where' => array(
        				'referral_id' => $referral_id
        			)
        		)
        	);

        }

        global $gamo;

        $from_user = Core::r('users')->get_user(array(
        		'user_id' => $options['user_created'],
        		'get_has' => 0
        	)
        );

       	Core::r('referral')->send_referral(array(
				'referral_id' => $referral_id
			)
		);

        return array(
            'referral_id' => $referral_id
        );

	}

	function send_referral($options = array()) {

		Core::ensure_defaults(array(
				'referral_id' => -1,
				'email_to' => '',
				'email_from' => '',
				'name_from' => '',
				'subject' => '',
				'message' => ''
			)
		, $options);

		if($options['referral_id'] != -1) {

			global $dbh, $gamo;

			$sql = "SELECT
			name,
			email,
			user_claimed,
			msg
			FROM " . GAMO_DB . ".referrals WHERE referral_id = :referral_id";

			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':referral_id' => $options['referral_id']
				)
			);

			$row = $sth->fetch();
			$user = Core::r('users')->get_user(array(
					'user_id' => $row['user_claimed'],
					'get_has' => 0
				)
			);

			$options['email_to'] = $row['email'];
			$options['name_to'] = $row['name'];
			$options['message'] = $row['msg'];
			$options['email_from'] = $user['email'];
			$options['name_from'] = ucwords($user['first_name'] . ' ' . $user['last_name']);
			$options['subject'] = $options['name_from'] . ' is referring Netech to you.';

		}

		Core::email(array(
				'email_to' => $options['email_to'],
				'email_from' => $options['email_from'],
				'name_from' => $options['name_from'],
				'name_to' => $options['name_to'],
				'subject' => $options['subject'],
				'message' => $options['message']
			)
		);

		global $dbh;

		$sql = "UPDATE " . GAMO_DB . ".referrals SET sent_qty = sent_qty+1 WHERE referral_id = :referral_id";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':referral_id' => $options['referral_id']
			)
		);
		
		return array(
			'sent' => 1
		);

	}

	/*
	Validate input for creating/editing a referral
	*/
	function validate_referral_info($options = array()) {

		/*
        if successful:
        {
            valid: 1
        }

        if error: standard error
		*/

        if(isset($options['referral_id'])){


            $validReferralId = Core::db_count(array(
                    'table' => GAMO_DB . '.referrals',
                    'values' => array(
                        'referral_id' => $options['referral_id']
                    )
                )
            );
            
            if($validReferralId == 0){
                
                return Core::error($this->errors, 11);

            }


            if(isset($options['values']['user_claimed'])){

                $validUserClaimed = Core::db_count(array(
                        'table' => GAMO_DB . '.users',
                        'values' => array(
                            'user_id' => $options['values']['user_claimed']
                        )
                    )
                );
               
                if($validUserClaimed == 0){
                    
                    return Core::error($this->errors, 8); 
                    
                }
                  
            }

            if(isset($options['values']['name'])){
                if( trim($options['values']['name']) == '' ){

                    return Core::error($this->errors, 1);

                }
            }
            if(isset($options['values']['title'])){

                if( trim($options['values']['title']) == '' ){

                    return Core::error($this->errors, 2);

                }

            }
            if(isset($options['values']['company'])){

                if( trim($options['values']['company']) == '' ){

                    return Core::error($this->errors, 3);

                }

            }
            if(isset($options['values']['email'])){

                if(!filter_var($options['values']['email'], FILTER_VALIDATE_EMAIL)){

                    return Core::error($this->errors, 4);

                }

            }
            if(isset($options['values']['msg'])){

                if( trim($options['values']['msg']) == '' ){

                    return Core::error($this->errors, 5);

                }

            }

        }
        // validation for create_referral function
        elseif(!isset($options['referral_id'])){

            if( trim($options['name']) == ''){

                return Core::error($this->errors, 1);

            }

            if( trim($options['title']) == '' ) {

                return Core::error($this->errors, 2);

            }

            if( trim($options['company']) == '' ) {

                return Core::error($this->errors, 3);

            }

            if(!filter_var($options['email'], FILTER_VALIDATE_EMAIL)){

                return Core::error($this->errors, 4);

            }


            if( trim($options['msg']) == '' ) {

                return Core::error($this->errors, 5);

            }


            // Ensure that user_id belongs to a valid user
            $validUserCreated = Core::db_count(array(
                    'table' => GAMO_DB . '.users',
                    'values' => array(
                        'user_id' => $options['user_created']
                    )
                )
            );

            if($validUserCreated == 0){

                return Core::error($this->errors, 8);

            }

            $emailExists = Core::fetch_column(
            	"SELECT count(*) FROM " . GAMO_DB . ".referrals WHERE email = :email AND user_claimed > 0",
            	array(
            		':email' => $options['email']
            	)
            );

            if($emailExists > 0){

                return Core::error($this->errors, 10);

            }

            global $dbh;

            $sql = 'SELECT count(*) FROM ' . GAMO_DB . '.referrals WHERE user_created = :user_created AND created_datetime BETWEEN :start_date AND :end_date';
            $params[':user_created'] = $options['user_created'];
            $params[':start_date'] = date('Y-m-d') . ' ' . '00:00:00';
            $params[':end_date'] = date('Y-m-d'). ' ' . '23:59:59';


            $sth = $dbh->prepare($sql);
            $sth->execute($params);

            $row = $sth->fetch();
            
            $c = $row['count(*)'];

            if($c > 99){
                return Core::error($this->errors, 9);
            }

        }

		// Return if valid, or if not, what is invalid
        return array(
            'valid' => 1
        );
	}
	
	function get_nominations_count(){
		
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		$sql = "SELECT count(*) as count FROM ".GAMO_DB.".`referrals` WHERE user_claimed = -1 AND active = 1";
		
		
		try{
		
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, '12');
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$sres = $stm->execute();
			if( empty($sres) ){
				$error = Core::error($this->errors, '13');
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$id = $stm->fetch(PDO::FETCH_ASSOC);
		
		}catch(PDOException $e){
			$error = Core::error($this->errors, '14');
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if( !empty( $id['count'] ) ){
		
			return $id['count'] ;
		
		}else{
		
			return false;
		
		}
	}
	
	function get_referrals( $options=array() ){

		global $dbh, $gamo;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) ){
			$error = Core::error($this->errors, 15);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		Core::ensure_defaults(array(
				'start' => 0,
				'num' => 0
		)
				, $options);
		
		$claim_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'claim_referral'
			)
		);

		$submit_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'submit_referral'
			)
		);

		$sql = "SELECT
		referral_id as id,
		name,
		title,
		company,
		(
			SELECT
			point_value_use
			FROM " . GAMO_DB . ".actions_log AS a
			WHERE
			a.action_types_id IN ('" . (int)$claim_type . "', '" . (int)$submit_type . "')
			AND a.int_other = ".GAMO_DB.".referrals.referral_id
			AND a.point_value_use > 0
			LIMIT 0, 1
		) AS points
		FROM ".GAMO_DB.".referrals
		WHERE user_claimed = :user_claimed and active = 1 HAVING points IS NOT NULL ORDER BY claimed_datetime DESC LIMIT ".(int)$options['start'].",".(int)$options['num'];

		try{
			
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, '12');
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$sres = $stm->execute(array(
					':user_claimed' => $options['user_id']
				)
			);

			if( empty($sres) ){
				$error = Core::error($this->errors, '13');
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$id = $stm->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOException $e){
			$error = Core::error($this->errors, '14');
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if( !empty( $id ) ){
		
			return $id ;
		
		}else{
		
			return false;
		
		}
	}
	
	function get_referrals_count( $options=array() ){
	
		global $dbh, $gamo;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) ){
			$error = Core::error($this->errors, 15);
			$error['error_msg'] .= $error_append;
			return $error;
		}

		$claim_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'claim_referral'
			)
		);

		$submit_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'submit_referral'
			)
		);
		
		$sql = "SELECT
		count(*)
		FROM ".GAMO_DB.".referrals
		WHERE
		user_claimed = :user_claimed
		and active = 1
		AND (
			SELECT
			count(*)
			FROM " . GAMO_DB . ".actions_log AS a
			WHERE
			a.action_types_id IN ('" . (int)$claim_type . "', '" . (int)$submit_type . "')
			AND a.int_other = ".GAMO_DB.".referrals.referral_id
			AND a.point_value_use > 0 LIMIT 0, 1
		) > 0";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_claimed' => $options['user_id']
			)
		);

		$c = $sth->fetchColumn();

		return $c;		
		
	}
	
	function get_nominations( $options=array() ){
		
		global $dbh, $gamo;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		Core::ensure_defaults(array(
			'start' => 0,
			'num' => 0,
			'values' => array()
		)
		, $options);
		
		$claim_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'claim_referral'
			)
		);

		$submit_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'submit_referral'
			)
		);

		$sql = "SELECT
		referral_id as id,
		'' as profile_pic,
		title,
		name,
		company,
		email,
		msg as description,
		(
			SELECT
			point_value_use
			FROM " . GAMO_DB . ".actions_log AS a
			WHERE
			a.action_types_id IN (':claim_type', ':submit_type')
			AND a.int_other = ".GAMO_DB.".referrals.referral_id
		) AS points
		FROM ".GAMO_DB.'.referrals WHERE user_claimed = -1 AND active = 1 ORDER BY referral_id ASC LIMIT '.$options['start'].','.$options['num'];
		
		//error_log($sql);
		try{
		
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, '12');
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$sres = $stm->execute(array(
					':claim_type' => $claim_type,
					':submit_type' => $submit_type
				)
			);
			if( empty($sres) ){
				$error = Core::error($this->errors, '13');
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$id = $stm->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOException $e){
			$error = Core::error($this->errors, '14');
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if( !empty( $id ) ){
		
			return $id ;
		
		}else{
		
			return false;
		
		}
		
	}

	/*
	Update a referral
	*/
	function update_referral($options = array()) {

		/*
        returns
        if successful:
        {
            updated: 1
        }

        if error: standard error
		*/
             
        Core::ensure_defaults(array(
            'referral_id' => -1,
            'values' => array()
        )
        , $options);

        if(!is_array($options['values']) && $options['values'] === 'delete') {
        
            $options['values'] = array('active' => 0);

        }
        elseif(is_array($options['values'])){

            $valid = $this->validate_referral_info($options);

            if(Core::has_error($valid)){
                return $valid;
            }

            if(isset($options['values']['user_claimed'])){
                
                $options['values']['claimed_datetime'] = Core::date_string();

               // Core::print_r($options);
            }



        }

        $updated = Core::db_update(array(
                'table' => GAMO_DB . '.referrals',
                'values' => $options['values'],
                'where' => array(
                    'referral_id' => $options['referral_id']
                )
            )
        );

        if(!$updated){
        
            return Core::error($this->errors, 7);

        }

        return array(
            'updated' => 1
        );

	}

}
?>
