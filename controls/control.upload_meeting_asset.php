<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Upload_Meeting_Asset {

	function run($options = array()) {

		Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
		global $data, $page_settings, $models, $session, $dbh, $gamo;

		$data['error'] = 0;

		if(!isset($_FILES["invoice"]['error']) || $_FILES["invoice"]['error'] != 0) {

			$data['error'] = 'There was an error while processing your request. Please refresh the page and try again.';

		} else if($_FILES['demandgen_logo']['size'] > 11800000) {

			$data['error'] = 'The file cannot be larger than 10 MB. Please try a smaller image.';

		} else {

			$filename = Core::unique_string(15);

			$split = explode(".", $_FILES['invoice']['name']);

			if(count($split) < 2) {

				$data['error'] = "The file you specified is not a valid spreadsheet";

			} else {

				$extension = strtolower($split[count($split) - 1]);

				if($extension != 'csv' && $extension != 'xls' && $extension != 'xlsx' && $extension != 'xlsm' && $extension != 'xlm') {

					$data['error'] = "The file you specified is not a valid spreadsheet";

				} else {

					$filename = $filename . '.' . $extension;
					copy($_FILES["invoice"]["tmp_name"], DIR_STORE . '/meeting_assets/' . $filename);

				}

			}	

		}

		
		if( !empty($data['error']) ){
			
			echo  
			
			'
			<script type="text/javascript">

			 window.parent.gamo_meeting.invoice_error("' . $data['error'] . '");
			 
			</script>
			';

			die();
			
		}else{
			
			echo 
			
			'
			<script type="text/javascript">

			window.parent.gamo_meeting.use_invoice("' . $filename . '");
			 
			</script>
			';

			die();
			
		}


		

	}

}
?>
