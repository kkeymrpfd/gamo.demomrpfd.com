<?
class Control_Create_Meeting {

    function run() {
    	
        Core::authorize(array(
                'user_id' => 'get'
            )
        );

        
        global $data, $page_settings, $session, $gamo, $dbh;

        $page_settings['allow_json'] = 1;
        

        $user = Core::r('users')->get_user(array(
                'user_id' => $data['user_id']
            )
        );
     
        $meeting_id = Core::get_input('meeting_id');
        $blue_coat_rep = Core::get_input('meeting_rep');
        $name = Core::get_input('meeting_name');
        $title = Core::get_input('meeting_title');
        $company = Core::get_input('meeting_company');
        $email = Core::get_input('meeting_email');
        $phone = Core::get_input('meeting_phone');
        
        //schedule_meeting_manager
        $time_a = Validate::datetime(array(
        		'date' => Core::get_input('meeting_date'),
        		'time' => Core::get_input('meeting_time')
        )
        );
         
        if(!$time_a) {
        	 
        	$data['error_msg'] = "Please select a valid date or time for this meeting";
        	$data['error_field'] = 'meeting_date';
        	 
        }
        
        
        if(empty($name )) {
        
        	$data['error_msg'] = "Please enter the name of the meeting attendee";
        	$data['error_field'] = 'meeting_name';
        
        }
        
        if(empty($title )) {
        
        	$data['error_msg'] = "Please enter the title of the meeting attendee";
        	$data['error_field'] = 'meeting_title';
        
        }
        
        if(empty($company )) {
        
        	$data['error_msg'] = "Please enter the company of the meeting attendee";
        	$data['error_field'] = 'meeting_company';
        
        }
        
        if(empty($phone )) {
        
        	$data['error_msg'] = "Please enter the phone of the meeting attendee";
        	$data['error_field'] = 'meeting_phone';
        
        }
        
        if(empty($email )) {
        
        	$data['error_msg'] = "Please enter the email of the meeting attendee";
        	$data['error_field'] = 'meeting_email';
        
        }

        if( empty($data['error_msg']) ){
        	
	        if( empty($meeting_id) ){
	        	
	        	$meeting_rep = Core::get_input('meeting_rep');
	        	
	        	$topic_name = "Meeting ". Core::get_input('meeting_level');
	        	
	        	$level = Core::get_input('meeting_level');
	        	
	        	if( $level == 'Manager'){
	        		
	        		$action_key = 'schedule_meeting_manager';
	        		$action_id = 34;
	        		
	        	}else{
	        		
	        		$action_key = 'schedule_meeting_clevel';
	        		$action_id = 5;
	        		
	        	}
	        	
		        $inputs = array(
		        		
		        		'user_id' => $data['user_id'],
		        		'name' => Core::get_input('meeting_name'),
		        		'title' => Core::get_input('meeting_title'),
		        		'company' => Core::get_input('meeting_company'),
		        		'email' => Core::get_input('meeting_email'),
		        		'phone' => Core::get_input('meeting_phone'),
		        		'topic' => $topic_name,
		        		'action_key' => $action_key,
		        		'datetime_a' => $time_a['utc'],
		        		'datetime_b' => (isset($time_b['utc'])) ? $time_b['utc'] : '',
		        		'meeting_rep' => $blue_coat_rep,
		        		'level' => $level
		        		//meeting_rep
		        		
		        );
		        
		        $share_qty = Core::db_count(array(
		        		'table' => GAMO_DB . '.actions_log',
		        		'values' => array(
		        				'user_id' => $data['user_id'],
		        				'action_types_id' => $action_id,
		        				'other' => Core::get_input('meeting_email')
		        		)
		        	)
		        );
	
		        if($share_qty > 0) {
		        
		        	$result['error_code'] = 123;
		        	$result['error_msg'] = "You have already set a meeting with this person";
		        
		        }else{
		        
			        $result = Core::r('meeting')->create_meeting($inputs);
			        
			        $data['create_update'] = 'created';
			        
		        }
		        
	        }else{
	        	
	        	$data['create_update'] = 'updated';
	     	
	        	$inputs = array(
						'name' => Core::get_input('meeting_name'),
	        			'title' => Core::get_input('meeting_title'),
	        			'company' => Core::get_input('meeting_company'),
	        			'email' => Core::get_input('meeting_email'),
	        			'phone' => Core::get_input('meeting_phone'),
	        			'datetime_a' => $time_a['utc'],
	        			'datetime_b' => (isset($time_b['utc'])) ? $time_b['utc'] : '',      		     
	        	);
	        	
	        	$transacted_yes = Core::get_input('transacted-yes');
	        	$transacted_no = Core::get_input('transacted-no');
	        	$sched_yes = Core::get_input('sched-yes');
	        	$sched_no = Core::get_input('sched-no');
	        	$opportunity = Core::get_input('opportunity');
	        	$won_yes = Core::get_input('won-yes');
	        	$won_no = Core::get_input('won-no');
	        	$amount = Core::get_input('amount');
	        	
	        	if( $won_yes and $amount == '' ){
	        	
	        		$data['error_msg'] = "You need to provide deal amount.";
        			$data['error_field'] = 'amount';
	        		return $data;
	        	
	        	}
	        	
	        	if( $transacted_yes and $opportunity == '' ){
	        	
	        		$data['error_msg'] = "You need to provide opportunity amount.";
	        		$data['error_field'] = 'opportunity';
	        		return $data;
	        	
	        	}
	        	
	        	$meeting_update = array(
	        			'meeting_id' => $meeting_id,
	        			'values' => $inputs,
	        			'opportunity' => $opportunity,
	        			'amount' => $amount,
	        			'meeting_rep' => $blue_coat_rep
	        	);

	        	if($transacted_no) {

	        		$meeting_update['transacted-no'] = 1;

	        	}

	        	$result = Core::r('meeting')->update_meeting($meeting_update);
	        	
	        	if( Core::has_error($result) ){
	        	
	        		$data['error_msg'] = $result['error_msg'];
	        		return $data;
	        	
	        	}
	        	
	        	
	        	$result = Core::r('meeting')->get_meeting( array('meeting_id' => $meeting_id ) );
	        	 
	        	if( Core::has_error($result) ){
	        	
	        		$data['error_msg'] = $result['error_msg'];
	        		return $data;
	        	
	        	}
	        	
	        	$rep = $result['rep'];
	        	$did_transact = $result['did_transact'];
	        	unset($result['rep']);
	        	unset($result['did_transact']);
	        	
	        	
	        	if( $transacted_yes and $result['status'] < 1 ){
	        		
	        		unset($result['rep']);
	        		unset($result['did_transact']);
	        		
	        		if( strstr( $result['topic'], 'Manager' ) ){
	        			 
	        			$action_key = 'transacted_meeting_manager';
	        			 
	        		}else{
	        			 
	        			$action_key = 'transacted_meeting_clevel';
	        			 
	        		}
	        		
	        		$other='';
	        		if( !empty($rep) ){
	        			$other='yes';
	        		}
	        		
	        		$result['status'] = 1;
	        		
	        		//update status
	        		$result0 = Core::r('meeting')->update_meeting(array(
	        			'meeting_id' => $meeting_id,
	        			'values' => $result,
	        			'opportunity' => $opportunity,
	        			'transacted-yes' => 1
	        		));
	        		
	        		if( Core::has_error($result0) ){
	        		
	        			$data['error_msg'] = $result0['error_msg'];
	        			return $data;
	        		
	        		}
	        		
	        		$result1 = Core::r('actions')->create_action(array(
	        				'user_id' => $data['user_id'],
	        				'action_types_id' => Core::r('actions')->action_types_id(array(
	        						'action_key' => $action_key
	        					)
	        				),
	        				'int_other' => $meeting_id,
	        				'other' => $other
	        			)
	        		);
	        		
	        		if( Core::has_error($result1) ){
	        		
	        			$data['error_msg'] = $result1['error_msg'];
	        			return $data;
	        		
	        		}
	        		
	        		
	        	}
	        	
	        	if( $sched_yes and $result['status'] < 2 ){
	        		
	        		$action_key = 'poc_meeting';
	        		
	        		$result['status'] = 2;
	        		
	        		//update status
	        		$result3 = Core::r('meeting')->update_meeting(array(
	        			'meeting_id' => $meeting_id,
	        			'values' => $result,
	        			'opportunity' => $opportunity,
	        			'sched-yes' => 1
	        		));
	        		
	        		if( Core::has_error($result3) ){
	        		
	        			$data['error_msg'] = $result3['error_msg'];
	        			return $data;
	        		
	        		}
	        		
	        		$result4 = Core::r('actions')->create_action(array(
	        				'user_id' => $data['user_id'],
	        				'action_types_id' => Core::r('actions')->action_types_id(array(
	        						'action_key' => $action_key
	        				)
	        				),
	        				'int_other' => $meeting_id
	        			)
	        		);
	        		
	        		if( Core::has_error($result4) ){
	        		
	        			$data['error_msg'] = $result4['error_msg'];
	        			return $data;
	        		
	        		}
	        		
	        		
	        		if( $did_transact != 1){
	        			if( strstr( $result['topic'], 'Manager' ) ){
	        				 
	        				$action_key = 'transacted_meeting_manager';
	        				 
	        			}else{
	        				 
	        				$action_key = 'transacted_meeting_clevel';
	        				 
	        			}
	        			 
	        			$other='';
	        			if( !empty($rep) ){
	        				$other='yes';
	        			}
	        			 
	        			 
	        			//update status
	        			$result5 = Core::r('meeting')->update_meeting(array(
	        					'meeting_id' => $meeting_id,
	        					'values' => $result,
	        					'opportunity' => $opportunity,
	        					'transacted-yes' => 1
	        			));
	        			 
	        			if( Core::has_error($result5) ){
	        				 
	        				$data['error_msg'] = $result5['error_msg'];
	        				return $data;
	        				 
	        			}
	        			 
	        			$result6 = Core::r('actions')->create_action(array(
	        					'user_id' => $data['user_id'],
	        					'action_types_id' => Core::r('actions')->action_types_id(array(
	        							'action_key' => $action_key
	        					)
	        					),
	        					'int_other' => $meeting_id,
	        					'other' => $other
	        			)
	        			);
	        			 
	        			if( Core::has_error($result6) ){
	        				 
	        				$data['error_msg'] = $result6['error_msg'];
	        				return $data;
	        				 
	        			}
	        		}
	        	
	        	}
	        	
	        	if( $won_yes and $result['status'] < 3 ){
	        	
	        		$action_key = 'won_meeting';
	        		
	        		$result['status'] = 3;
	        		
	        		//update status
	        		$result7 = Core::r('meeting')->update_meeting(array(
	        			'meeting_id' => $meeting_id,
	        			'values' => $result,
	        			'amount' => $amount,
	        			'won-yes' => 1
	        		));
	        		
	        		if( Core::has_error($result7) ){
	        		
	        			$data['error_msg'] = $result7['error_msg'];
	        			return $data;
	        		
	        		}
	        		
	        		$result8 = Core::r('actions')->create_action(array(
	        				'user_id' => $data['user_id'],
	        				'action_types_id' => Core::r('actions')->action_types_id(array(
	        						'action_key' => $action_key
	        				)
	        				),
	        				'int_other' => $meeting_id
	        			)
	        		);
	        		
	        		if( Core::has_error($result8) ){
	        		
	        			$data['error_msg'] = $result8['error_msg'];
	        			return $data;
	        		
	        		}
	        	     
	        	}
	        	
	        }

        }
        
        if(Core::has_error($result)) {
        
        	$data['error_msg'] = $result['error_msg'];
        	$data['error_field'] = $result['error_field'];
        
        }
        
        return $data;

    }

}
?>
