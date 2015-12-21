<?
class Control_User_Img {

	function run() {

		$user_id = (int)(Core::get_input('user_id', 'get'));
		
		header('Content-type: image/png');

		if(!is_numeric($user_id)
			|| $user_id > 9999999999999 
			|| !file_exists(DIR_STORE . '/user_img/' . $user_id . '.png')) {

			readfile(DIR_STORE . '/user_img/blank.png');

		} else {

			readfile(DIR_STORE . '/user_img/' . $user_id . '.png');

		}
		
		die();

	}

}
?>