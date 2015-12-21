<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Upload_Demandgen_List {

	function run($options = array()) {

		Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
		global $data, $page_settings, $models, $session, $dbh, $gamo;

		$data['error'] = '';
		
		if(!isset($_FILES["recipients_file"])) {

			$data['error'] = 'There was an error while processing your request. Please refresh the page and try again.';

		} else if($_FILES['recipients_file']['size'] > 5800000) {

			$data['error'] = 'The file cannot be larger than 5 MB. Please try a smaller file.';

		} else {

			$split = explode('.', strtolower($_FILES['recipients_file']['name']));

			if( $split[count($split)-1] != 'csv' ) {

				$data['error'] = 'Please make sure to upload a valid CSV file';

			}

		}

		$lines = '';

		if($data['error'] == '') {

			echo 'here';
			$raw = file_get_contents($_FILES["recipients_file"]["tmp_name"]);
			$raw = str_replace(array('"', "'", ",", "	"), '', $raw);
			$lines = explode("\n", $raw);

			$c = 0;

			$use_lines = array();

			foreach($lines as $k => $line) {

				if($c <= 201) {

					$line = trim(ltrim(rtrim($line)));

					if($line != '') {

						$use_lines[] = $line;
						++$c;

					}

				}

			}

			$lines = $use_lines;
			$lines = json_encode($lines);

		}

		if( $data['error'] != '' ){
			
			echo  
			
			'
			<script type="text/javascript">

			window.parent.demandgen.list_error("' . $data['error'] . '");
			 
			</script>
			';

			die();
			
		}else{
			
			echo 
			
			'
			<script type="text/javascript">

			window.parent.demandgen.set_list_recipients("' . str_replace('"', '\"', $lines) . '");
			 
			</script>
			';

			die();
			
		}


		

	}

}
?>
