<?
class Control_Download_Asset {

    function run() {
    	
        
        global $data, $page_settings, $session, $gamo;

        $page_settings['allow_json'] = 1;
    
        $resource_id = Core::get_input('resource_id', 'get');
        $redirect_url = Core::get_input('redirect_url', 'get');

        if($redirect_url != '' && !filter_var($redirect_url, FILTER_VALIDATE_URL)) {

            echo "Invalid redirect URL";
            die();

        }

        $data['hash'] = Core::get_input('hash', 'get');

        if($redirect_url == '') {

            $resource = Core::r('resources')->get_resource(array(
            		'resource_id' => $resource_id
            	)
            );        

            if(Core::has_error($resource)) {

                header("Location: http://" . SITE_URL);
                die();

            }

        }

        $file = DIR_STORE . '/resources/' . $resource['location'];

        if ( $redirect_url != '' || ( (file_exists($file) || $resource['type'] == 'video') && $resource['active'] == 1 ) ) {

            if(is_numeric($data['user_id'])) { // Record points for this download ONLY IF the user is logged in

                if($redirect_url != '') {

                	$c = Core::db_count(array(
                			'table' => GAMO_DB . '.actions_log',
                			'values' => array(
                				'user_id' => $data['user_id'],
                				'action_types_id' => 2,
                				'active' => 1,
                				'int_other' => $resource_id
                			)
                		)
                	);
                    
                	if($c == 0) {
                		
                		$values = array(
                			'user_id' => $data['user_id'],
                			'action_types_id' => 2,
                			'int_other' => $resource_id
                		);

                		$result = Core::r('actions')->create_action(
                				$values
                		);

                	}

                }

            } else {

                $data['demandgen_contact_id'] = Core::fetch_column(
                    "SELECT demandgen_contact_id FROM " . GAMO_DB . ".demandgen_contacts WHERE hash = :hash",
                    array(
                        ':hash' => $data['hash']
                    )
                );

                if(!is_numeric($data['demandgen_contact_id']) || $data['hash'] == '') {

                    echo "Invalid URL";
                    die();

                }

                Core::db_update(array(
                        'table' => GAMO_DB . ".demandgen_contacts",
                        'values'=> array(
                            'clicked' => Core::datetime(),
                            'ip' => Core::get_ip()
                        ),
                        'where' => array(
                            'demandgen_contact_id' => $data['demandgen_contact_id']
                        )
                    )
                );

            }

            if($redirect_url != '') {

                header("Location: " . $redirect_url);
                die();

            } else if($resource['type'] == 'video') {
                
                $data['src'] = $resource['location'];
                $page_settings['pages'] = array('load_video');
                $data['page'] = 'load_video';

            } else {

    		    header('Content-Description: File Transfer');
    		    header('Content-Type: application/octet-stream');
    		    header('Content-Disposition: attachment; filename='.basename($file));
    		    header('Content-Transfer-Encoding: binary');
    		    header('Expires: 0');
    		    header('Cache-Control: must-revalidate');
    		    header('Pragma: public');
    		    header('Content-Length: ' . filesize($file));
    		    ob_clean();
    		    flush();
    		    readfile($file);
    		    exit;

            }
		    
		}

        return $data;

    }

}
?>
