<?
// Pull users and actions from Averetek
require(dirname(dirname(__FILE__)) . '/inc/config.php');
require(dirname(dirname(__FILE__)) . '/inc/loader.php');

if(file_exists('/www/local') || file_exists('/www/staging')) {

	echo "Exiting since this is local";

}

if(Core::get('send_emails_running') == 1) {

	echo 'Worker is already running';
	die();

}

Core::set('send_emails_running', 1, 0, 7200);

// Ensure that there are actually emails to send before establishing an smtp connection
$sql_filter = "sent = 0
AND time < :time
AND message LIKE '%DOCTYPE HTML PUBLIC%'
AND message NOT LIKE '%trivialegacy.com%'
AND email_from != 'contact@delloverdrive.com'";

$c = Core::fetch_column(
	"SELECT count(*) FROM " . GAMO_DB . ".emails WHERE " . $sql_filter,
	array(
		':time' => Core::date_string()
	)
);

if($c == 0) {

	Core::set('send_emails_running', 0);
	echo "No E-mails to send";
	die();

}

require(DIR_INC . '/vendor/phpmailer/class.phpmailer.php');

require(DIR_INC . '/gamo/class.Gamo.php');

$gamo = new Gamo();

$sql = "SELECT
email_id,
email_to,
name_to,
email_from,
name_from,
subject,
message,
message_text,
time,
sent,
item_id
FROM " . GAMO_DB . ".emails
WHERE " . $sql_filter;

$sth = $dbh->prepare($sql);
$sth->execute(array(
		':time' => Core::date_string()
	)
);

$max_qty = 5000;
$sent_qty = 0;

while($row = $sth->fetch()) {

	$mail = new PHPMailer;

	$mail->IsSMTP();                                      // Set mailer to use SMTP
	$mail->Host = SMTP_HOST;  // Specify main and backup server
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = SMTP_USER;                            // SMTP username
	$mail->Password = SMTP_PASS;                           // SMTP password
	$mail->Port = SMTP_PORT;

	$mail->WordWrap = 600;                                 // Set word wrap to 600 characters
	$mail->IsHTML(true);                                  // Set email format to HTML

	$mail->From = $row['email_from'];
	$mail->FromName = $row['name_from'];

	$mail->AddAddress($row['email_to'], "");  // Add a recipient
	$mail->AddReplyTo($row['email_from'], $row['name_from']);

	$mail->Subject = $row['subject'];
	$mail->Body    = $row['message'];
	$mail->AltBody = $row['message_text'];

	if(!$mail->Send()) {

	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   
	} else {

		echo ++$sent_qty . ": Mail sent";
		Core::db_update(array(
				'table' => GAMO_DB . '.emails',
				'values' => array(
					'sent' => 1
				),
				'where' => array(
					'email_id' => $row['email_id']
				)
			)
		);

	}

	echo "\n\n";

	if($sent_qty >= $max_qty) {

		echo "Max qty sent\n";
		Core::set('send_emails_running', 0);
		die();

	}

}
/*
// Delete old e-mails
$sql = "DELETE FROM " . GAMO_DB . ".emails WHERE sent = 1 AND time <= :time";
$sth = $dbh->prepare($sql);
$sth->execute(array(
		':time' => Core::date_string(time() - 86400 * 30)
	)
);
*/

Core::set('send_emails_running', 0);

?>