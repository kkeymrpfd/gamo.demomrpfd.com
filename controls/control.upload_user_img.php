<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Upload_User_Img {

	function run($options = array()) {

		Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
		global $data, $page_settings, $models, $session, $dbh, $gamo;

		$data['error'] = 0;

		if(!isset($_FILES["file"]['error']) || $_FILES["file"]['error'] != 0) {

			$data['error'] = 'There was an error while processing your request. Please refresh the page and try again.';

		} else if($_FILES['file']['size'] > 10800000) {

			$data['error'] = 'The file cannot be larger than 10 MB. Please try a smaller image.';

		} else {

			$result = Core::r('image')->save_user_image(array(
					'location' => $_FILES["file"]["tmp_name"],
					'user_id' => $session->get('user_id')
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

			 window.parent.$("#text-message").html( ' + $data["error"] + ' );
			 window.parent.$("#myModal").modal("show"); 
			 
			</script>
			';

			die();
			
		}else{
			
			echo 
			
			'
			<script type="text/javascript">

			window.parent.$("#text-message").html( "Image uploaded successfully" );
			window.parent.$("#myModal").modal("show");
			window.parent.$("#myModal .modal-dialog .modal-content .modal-header .close").on("click", function(){
			 	window.parent.location.reload();
			 });
			 
			</script>
			';

			die();
			
		}


		

	}

}
?>
