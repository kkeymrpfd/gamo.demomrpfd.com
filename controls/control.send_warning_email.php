<?

class Control_Send_Warning_Email {

	function run() {

		global $gamo, $session, $dbh;	

		$msg = "Hi Scott -
<br><br>
Thanks for your interest in the Game On! game.
<br><br>
Points are awarded in the resources module for sharing content with sales and marketing professionals at their business email address.
<br>Sharing content on social networks also have a limit of up to 5 Tweets per day and 1 Facebook share per day.
<br><br>
Your account points activity has been updated to reflect this.
<br><br>
We certainly appreciate your interest in the Game On! game, but ask that you please play in accordance with the rules of the game.";
		die();
		Core::email(array(
				'email_to' => 'scott@ahavaus.com',
				'name_to' => "Scott M",
				'email_from' => ADMIN_EMAIL,
				'name_from' => SITE_NAME,
				'subject' => 'Update regarding your points',
				'message' => $msg
			)
		);

	}

}
?>