<?
class Control_Share_Resource {

    function run() {
        
    	
        Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
        
        global $data, $page_settings, $session, $gamo;

        $page_settings['allow_json'] = 1;

        $resource_id = Core::get_input('resource_id');
        $name = ltrim(rtrim(Core::get_input('name')));
        $title = ltrim(rtrim(Core::get_input('title')));
        $email = ltrim(rtrim(Core::get_input('email')));
        $msg = ltrim(rtrim(Core::get_input('message')));

        $resource = Core::r('resources')->get_resource(array(
        		'resource_id' => $resource_id
        	)
        );

        $result['error'] = '';

        if(trim($name) == '') {

        	$result['error'] = "Please enter the name of the person to send this resource to.";

        } else if(trim($title) == '') {

        	$result['error'] = "Please enter the title of the person to send this resource to.";

        } else if(trim($email) == '') {

        	$result['error'] = "Please enter the e-mail address of the person to send this resource to.";

        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $result['error'] = "The e-mail you entered does not appear to be valid. Please try again.";

        } else if(!Validate::pro_email($email)) {

            $result['error'] = "Resources can only be shared with professional e-mail accounts.";

        } else {
            
        	$share_qty = Core::db_count(array(
        			'table' => GAMO_DB . '.actions_log',
        			'values' => array(
        				'user_id' => $data['user_id'],
        				'action_types_id' => 3,
        				'int_other' => $resource_id,
        				'other' => $email
        			)
        		)
        	);

        	if($share_qty > 0) {

        		$result['error'] = "You have already sent this resource to this person";

        	} else {

                $user = Core::r('users')->get_user(array(
                        'user_id' => $data['user_id'],
                        'get_has' => 0
                    )
                );

                if(trim($user['email']) == trim($email)) {

                    $result['error'] = "You cannot send a resource to yourself.";

                } else {

                $download_word = ($resource['type'] != 'video') ? 'download' : 'watch';

$msg_html = "Hi " . $name . ",
<br><br>
" . $user['first_name'] . " " . $user['last_name'] . " has shared a resource from Sparkmotive Sales Enablement with you.
<br><br>
You can " . $download_word . " and review the resource <a href=\"http://" . SITE_URL . "/?a=download_resource&resource_id=" . $resource_id . "\" target=\"_bank\">here</a>.";

if(trim($msg) != '') {

    $msg_html .= "<br><br>
" . $user['first_name'] . " also wanted us to give you this message:
<br><br>
" . $msg;

}


                    Core::email(array(
                            'email_to' => $email,
                            'name_to' => $name,
                            'email_from' => $user['email'],
                            'name_from' => $user['first_name'] . " " . $user['last_name'],
                            'subject' => $user['first_name'] . " " . $user['last_name'] . " has shared a resource with you.",
                            'message' => $msg_html
                        )
                    );

                    if($share_qty == 0) {

                		$share_action = Core::r('actions')->create_action(array(
                				'user_id' => $data['user_id'],
                				'action_types_id' => 'share_resource',
                				'int_other' => $resource_id,
                				'other' => $email,
                				'other_b' => $title
                			)
                		);
                		
                		if(!Core::has_error($share_action) && isset($share_action['action_id'])) {
                		
                			Core::r('actions')->create_action_info(array(
                					'action_id' => $share_action['action_id'],
                					'info_type' => 'resource_title',
                					'info' => $resource['title']
                			)
                			);
                			
                			Core::r('actions')->create_action_info(array(
                					'action_id' => $share_action['action_id'],
                					'info_type' => 'to_name',
                					'info' => $name
                			)
                			);
                			
                			Core::r('actions')->create_action_info(array(
                					'action_id' => $share_action['action_id'],
                					'info_type' => 'to_title',
                					'info' => $title
                			)
                			);
                			
                			Core::r('actions')->create_action_info(array(
                					'action_id' => $share_action['action_id'],
                					'info_type' => 'to_email',
                					'info' => $email
                			)
                			);
                			
                			Core::r('actions')->create_action_info(array(
                					'action_id' => $share_action['action_id'],
                					'info_type' => 'email_body',
                					'info' => $msg
                			)
                			);

                		}
                		
                    }

                }

        	}

        }

        Core::shift_data($result);

        return $data;

    }

}
?>
