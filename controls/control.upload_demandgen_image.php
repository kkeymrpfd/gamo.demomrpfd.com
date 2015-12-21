<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Upload_Demandgen_Image {

	function run($options = array()) {

		Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
		global $data, $page_settings, $models, $session, $dbh, $gamo;

		$data['error'] = 0;

		if(!isset($_FILES["demandgen_logo"]['error']) || $_FILES["demandgen_logo"]['error'] != 0) {

			$data['error'] = 'There was an error while processing your request. Please refresh the page and try again.';

		} else if($_FILES['demandgen_logo']['size'] > 11800000) {

			$data['error'] = 'The file cannot be larger than 10 MB. Please try a smaller image.';

		} else {

			$filename = Core::unique_string(15);

			$result = Core::r('image')->save_image(array(
					'location' => $_FILES["demandgen_logo"]["tmp_name"],
					'target_dir' => DIR_STORE . '/demandgen_images',
					'target_file' => $filename,
					'max_size' => 180
				)
			);

			if(Core::has_error($result)) {

				if($result['error_code'] == 1) {

					$data['error'] = 'The uploaded file does not appear to be an image';

				} else {

					$data['error'] = 'There was an error while processing your request. Please refresh the page and try again.';

				}

			}			

		}

		
		if( !empty($data['error']) ){
			
			echo  
			
			'
			<script type="text/javascript">

			 window.parent.demandgen.image_error("' . $data['error'] . '");
			 
			</script>
			';

			die();
			
		}else{
			
			echo 
			
			'
			<script type="text/javascript">

			window.parent.demandgen.use_image("' . $filename . '");
			 
			</script>
			';

			die();
			
		}


		

	}

}
?>
