<?
class Control_Download_Resource {

    function run() {
    	
        
        global $data, $page_settings, $session, $gamo;

        $page_settings['allow_json'] = 1;
        

        $resource_id = Core::get_input('resource_id', 'get');

        $resource = Core::r('resources')->get_resource(array(
        		'resource_id' => $resource_id
        	)
        );
        

        if(Core::has_error($resource)) {

            header("Location: http://" . SITE_URL);
            die();

        }

        if($resource['type'] == 'video') {

            header("Location: /?a=watch_video&resource_id=" . $resource['resource_id']);
            die();

        }
        
        $file = DIR_STORE . '/resources/' . $resource['location'];
        
       
        
        if (file_exists($file) && $resource['active'] == 1) {

            if(is_numeric($data['user_id'])) { // Record points for this download ONLY IF the user is logged in

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

        die();
        return $data;

    }

}
?>
