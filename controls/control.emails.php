<?
/*
Looks up a user based on e-mail address to see if they are already registered, needs a password, or can log in
*/
class Control_Emails {

	function run() {
		
		global $gamo, $session, $dbh, $data, $page_settings;

		$hosted_email_id = (int)Core::get_input('id', 'get');
		
		$email = Core::fetch_column(
			"SELECT html FROM " . GAMO_DB . ".hosted_emails WHERE hosted_email_id = :hosted_email_id",
			array(
				':hosted_email_id' => $hosted_email_id
			)
		);

		if($email !== FALSE) {
			echo $email;
			die();

		}

	}

}
?>