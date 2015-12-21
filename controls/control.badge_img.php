<?
class Control_Badge_Img {

	function run() {

		$badge_id = (int)(Core::get_input('badge_id', 'get'));
		
		//header('Content-type: image/png');

		if(!is_numeric($badge_id)
			|| $badge_id > 9999999999999 
			|| !file_exists(DIR_STORE . '/badge_img/' . $badge_id . '.png')) {
			
			readfile(DIR_STORE . '/badge_img/blank.png');

		} else {

			readfile(DIR_STORE . '/badge_img/' . $badge_id . '.png');

		}
		
		die();

	}

}
?>