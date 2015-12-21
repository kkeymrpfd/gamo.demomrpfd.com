<?
require_once(DIR_INC . '/vendor/imagelib/php_image_magician.php');
/*
Save and retrieve images from mysql
*/
class Core_Image {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'The location specified is not an image'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Could not save image'
			)
		);

	}
	
	function generate_image_thumbnail($source_image_path, $thumbnail_image_path, $max_width, $max_height)
	{
		
		list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
		
		switch ($source_image_type) {
			case IMAGETYPE_GIF:
				$source_gd_image = imagecreatefromgif($source_image_path);
				break;
			case IMAGETYPE_JPEG:
				$source_gd_image = imagecreatefromjpeg($source_image_path);
				break;
			case IMAGETYPE_PNG:
				$source_gd_image = imagecreatefrompng($source_image_path);
				break;
		}
		
		if ($source_gd_image === false) {
			return false;
		}
		
		imagealphablending( $source_gd_image, false );
		imagesavealpha( $source_gd_image, true );

		$source_aspect_ratio = $source_image_width / $source_image_height;
		$thumbnail_aspect_ratio = $max_width / $max_height;
		if ($source_image_width <= $max_width && $source_image_height <= $max_height) {
			error_log('c1');
			$thumbnail_image_width = $source_image_width;
			$thumbnail_image_height = $source_image_height;
		} elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
			error_log('c2');
			$thumbnail_image_width = (int) ($max_height * $source_aspect_ratio);
			$thumbnail_image_height = $max_height;
		} else {
			error_log('c3');
			$thumbnail_image_width = $max_width;
			$thumbnail_image_height = (int) ($max_width / $source_aspect_ratio);
		}
		
		$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
		
		imagealphablending( $thumbnail_gd_image, false );
		imagesavealpha( $thumbnail_gd_image, true );
		
		if ($thumbnail_gd_image === false) {
			return false;
		}
		
		$did_succeed = imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
		
		if ($did_succeed === false) {
			return false;
		}
		
		imagepng($thumbnail_gd_image, $thumbnail_image_path);
		imagedestroy($source_gd_image);
		imagedestroy($thumbnail_gd_image);
		return true;
	}

	/*
	Save an image
	*/
	function save_image($options = array()) {

		/*
		args:
		{
			location: the location of the image (filepath or url will work),
			target_dir: the destination directory/file
			target_file: the target filename
		}

		returns
		if success:
		{
			file: the location of the file
		}

		if error: std error
		*/

		Core::ensure_defaults(array(
				'location' => '',
				'target_dir' => DIR_STORE,
				'target_file' => DIR_STORE,
				'max_size' => ''
			)
		, $options);

		$img_file = $options['target_dir'] . '/' . $options['target_file'] . '.png'; // What to save the image as
		echo '<img src="' . $options['location'] . '">';
		//copy($options['location'], $options['target_dir'] . '/' . $options['target_file'] . '-raw.png');
        //Core::print_r($img_file);exit;
		// Determine if a url was specified

		if($options['location'] == '') {
           
			return Core::error($this->errors, 1);

		}

        //Core::print_r($options['location']);exit;
        
		$value_img = file_get_contents($options['location']);

		// Save the image		
		file_put_contents($img_file . '.tmp', $value_img);
			
		$base_image = imagecreatefromstring(file_get_contents($img_file . '.tmp'));
		imagealphablending( $base_image, false );
		imagesavealpha( $base_image, true );
		
		imagepng($base_image, $img_file . '.tmp');

		if(!@getimagesize($img_file . '.tmp')) { // The file specified is not an image

			if(file_exists($img_file . '.tmp')) {

				unlink($img_file . '.tmp');

			}

			return Core::error($this->errors, 1);

		}

		$base_image = imagecreatefromstring(file_get_contents($img_file . '.tmp'));
		imagealphablending( $base_image, false );
		imagesavealpha( $base_image, true );

		imagepng($base_image, $img_file);

		unlink($img_file . '.tmp');

		if(!file_exists($img_file)) { // Could not save image

			return Core::error($this->errors, 2);

		}

		if($options['max_size'] != '') {

			$this->generate_image_thumbnail($img_file,$img_file,$options['max_size'],$options['max_size']);

		}

		return array(
			'file' => $img_file
		);

	}
	/*
	Save a user image to the database
	*/
	function save_user_image($options = array()) {

		/*
		args:
		{
			location: location of the image (filepath or url will work)
			user_id: the user id
			dir: the default storage directory
		}

		returns:
		if successful:
		{
			file:
			name:
		}

		if error:
		{
			error_code:
			error_msg:
		}
		*/

		// Ensure defaults:
		Core::ensure_defaults(array(
				'location' => '',
				'user_id' => -1,
				'dir' => DIR . '/store'
			)
		, $options);

		$img_file = $options['dir'] . '/user_img/' . $options['user_id']; // What to save the image as
		
        // Determine if a url was specified
        if($options['location'] === '') {

            // todo 
			//copy(DIR_STORE . '/user_img/blank.png', $img_file);

			return Core::error($this->errors, 1);

		}

        //Core::print_r($options['location']);
        $value_file = file_get_contents($options['location']);

		// Save the image		
		file_put_contents($img_file . '-tmp.png', $value_file);
		
		
		$this->generate_image_thumbnail($img_file . '-tmp.png',$img_file.'.png','120','120');
		$this->generate_image_thumbnail($img_file . '-tmp.png',$img_file.'-small.png','50','50');


		global $gamo, $dbh;

		$sql = "SELECT users_info_id FROM " . CORE_DB . ".users_info WHERE user_id = :user_id AND info_type = 'has_img'";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id']
			)
		);

		while($row = $sth->fetch()) {

			Core::r('users')->update_user_info(array(
					'users_info_id' => $row['users_info_id'],
					'values' => "delete"
				)
			);

		}

		Core::r('users')->create_user_info(array(
				'user_id' => $options['user_id'],
				'info_type' => 'has_img',
				'int_info' => 1
			)
		);

		return array(
			'file' => $img_file,
			'name' => $options['user_id'] . '.png'
		);
	}

	function get_user_image($options = array()) {

		/*
		options:
		{
			user_id:

		}
		*/

		

	}

}
?>
