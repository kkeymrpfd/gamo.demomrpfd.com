<?
require_once(DIR_INC . '/ct/class.CT_Campaign.php');
require_once(DIR_INC . '/ct/class.impack.php');
require_once(DIR_INC . '/ct/class.meeting_requester.php');
require_once(DIR_INC . '/ct/class.CT_Snoopy.php');

class Core_Invite {

	public $errors; // Store error codes
	public $campaigns; // Campaign IDs from CT that are being used

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid sender information provided'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid recipient e-mail'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'An invite has already been sent to this recipient from this user for this event'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Could not create invite'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'Could not find invite'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'This provided pin code is not valid'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'This invite was already used'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'This invite key is not valid or was already used'
			),
			array(
				'error_code' => '10',
				'error_msg' => 'This person has already been invited to the event'
			),
			array(
				'error_code' => '11',
				'error_msg' => 'You cannot send an invite to yourself'
			),
			array(
				'error_code' => '12',
				'error_msg' => 'The person you are trying to invite is already a part of this game, and cannot be invited again'
			)
		);

		$this->campaigns = array();

	}

	/*
	Create an invite
	This is NOT the same as sending the invite. That is handled by $this->send_invite()
	*/
	function create_invite($options) {

		/*
		args:
			{
				from_user_id: the user who the invite is from,
				first_name: first name of the recipient
				last_name: last name of the recipient
				email: the e-mail address of the recipient,
				msg: an optional msg to send along with the invite,
				event_id: the event to invite to
			}

		returns:
			if success:
			{
				invite_id: the id of the invite
			}

			if error:
			{
				error_code: The error code
				error_msg: The error msg
			}
		*/

		global $dbh, $session, $gamo;

		// Ensure defaults
		Core::ensure_defaults(array(
				'from_user_id' => -1,
				'to_name' => '',
				'to_company' => '',
				'to_title' => '',
				'email' => '',
				'msg' => '',
				'event_id' => ''
			)
		, $options);

		// Determine if the user exists
		$valid = Core::r('users')->user_valid(array(
				'user_id' => $options['from_user_id']
			)
		);

		if(Core::has_error($valid) || $valid['valid'] == 0) { // User that is sending is not a valid user

			return Core::error($this->errors, 1);

		}

		// Validate e-mail
		if(!filter_var($options['email'], FILTER_VALIDATE_EMAIL)) { // Recipient e-mail is not valid

			return Core::error($this->errors, 2);

		}
		
		// Ensure that the user is not inviting themselves
		$c = Core::db_count(array(
				'table' => CORE_DB . '.users',
				'values' => array(
					'user_id' => $options['from_user_id'],
					'email' => $options['email']
				)
			)
		);

		if($c > 0) { // Users cannot invite themselves

			return Core::error($this->errors, 11);

		}
		
		// Ensure that the user is not already in the game
		$c = Core::db_count(array(
				'table' => CORE_DB . '.users',
				'values' => array(
					'email' => $options['email']
				)
			)
		);

		if($c > 0) { // Users cannot invite themselves

			return Core::error($this->errors, 12);

		}
		
		// Determine if the recipient has already been invited to this event
		$c = Core::db_count(array(
				'table' => CORE_DB . '.invites',
				'values' => array(
					'email' => $options['email'],
					'event_id' => $options['event_id']
				)
			)
		);

		if($c > 0) { // Invite already sent

			return Core::error($this->errors, 10);

		}

		// Determine if this user is already in CT
		$check_pin = Core::r('ct')->get_pin(array(
				'email' => $options['email']
			)
		);

		if(!Core::has_error($check_pin)) { // user is already in ct

			return Core::error($this->errors, 10);

		}

		// Send invite
		$invite_key = Core::unique_string(15);

		$invite_id = Core::db_insert(array(
				'table' => CORE_DB . '.invites',
				'values' => array(
					'from_user_id' => $options['from_user_id'],
					'to_name' => $options['to_name'],
					'to_company' => $options['to_company'],
					'to_title' => $options['to_title'],
					'email' => $options['email'],
					'invite_time' => Core::date_string(),
					'invite_status' => 0,
					'invite_key' => $invite_key,
					'msg' => $options['msg'],
					'event_id' => $options['event_id']
				)
			)
		);

		if(!is_numeric($invite_id)) { // Could not create invite

			return Core::error($this->errors, 4);

		}

		$invite_action_type = Core::r('actions')->action_types_id(array(
        		'action_key' => 'send_invite'
        	)
        );

		// Record as action
		$action = Core::r('actions')->create_action(array(
				'user_id' => $options['from_user_id'],
				'action_types_id' => $invite_action_type,
				'int_other' => $invite_id,
				'other' => $options['to_name'] . '(' . $options['to_company'] . ')',
				'other_b' => $options['email']
			)
		);

		if(!Core::has_error($action) && isset($action['action_id'])) {

			Core::r('actions')->create_action_info(array(
					'action_id' => $action['action_id'],
					'info_type' => 'to_name',
					'info' => $options['to_name']
				)
			);

			Core::r('actions')->create_action_info(array(
					'action_id' => $action['action_id'],
					'info_type' => 'to_company',
					'info' => $options['to_company']
				)
			);

			Core::r('actions')->create_action_info(array(
					'action_id' => $action['action_id'],
					'info_type' => 'to_email',
					'info' => $options['email']
				)
			);

		}

		$this->send_invite(array(
				'invite_id' => $invite_id,
				'event_id' => $options['event_id']
			)
		);

		return array(
			'invite_id' => $invite_id,
			'action' => $action
		);

	}

	/*
	Send the invite to the recipient
	This is NOT the same as create the invite. That is handled by $this->create_invite()
	*/
	function send_invite($options) {

		/*
		args:
		{
			invite_id: the invite id to send
		}

		returns:
			if success:
			{
				sent: 1
			}

			if error:
			{
				error_code: The error code
				error_msg: The error msg
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'invite_id' => -1,
				'invite_info' => array(),
				'event_id' => -1,
				'subject' => '',
				'preview' => 0,
				'from_name' => '',
				'self_send' => 0
			)
		, $options);

		global $dbh, $gamo;

		if( count($options['invite_info']) == 0 ) {

			// Retrieve invite
			$sql = "SELECT
				from_user_id,
				to_name,
				to_title,
				to_company,
				email,
				invite_key,
				msg,
				event_id
				FROM " . CORE_DB . ".invites
				WHERE invite_id = :invite_id";

			$sth = $dbh->prepare($sql);
			$sth->execute(array(
					':invite_id' => $options['invite_id']
				)
			);

			$invite = $sth->fetch();
			
			if(!is_array($invite)) {

				return Core::error($this->errors, 5);

			}

			$invite = Core::remove_numeric_keys($invite);

		} else {

			$invite = $options['invite_info'];

		}

		if($options['event_id'] == -1) { $options['event_id'] = $invite['event_id']; }

		$event = Core::r('virtual_events')->get_event(array(
				'id' => $options['event_id']
			)
		);

		if(Core::has_error($event)) {

			return $event;

		}

		$from_user = Core::r('users')->get_user(array(
				'user_id' => $invite['from_user_id']
			)
		);

		$last_name = ($from_user['last_name'] != '') ? ' ' . $from_user['last_name'] : '';

		$from_user_name = ucwords($from_user['first_name'] . $last_name);

		if($options['subject'] == '') {

			$subject = $from_user_name . ' has invited you to join in a virtual event online.';

		} else {

			$subject = $options['subject'];

		}

		global $dbh, $gamo;

		$sql = "UPDATE " . CORE_DB . ".invites SET sent_qty = sent_qty+1 WHERE invite_id = :invite_id";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':invite_id' => $options['invite_id']
			)
		);

		$from_email = Core::multi_get($event['has'], 'info_type', 'from_email', 'info');

		if($options['self_send'] == 0) {

			$from_name = $from_user_name;
			$from_email = $from_user['email'];

		} else {

			$from_name = Core::multi_get($event['has'], 'info_type', 'from_name', 'info');

		}

		$invite_url;

		if( $options['self_send'] == 0 ) {

			if($options['preview'] == 1) {

				$invite_link = 'href="#" onclick="return false"';
				$invite_url = 'http://' . SITE_URL . '/#virtualevents';

			} else {

				$name_split = explode(' ', $invite['to_name']);
				$ct_first_name = $name_split[0];
				$ct_last_name = '';

				foreach($name_split as $k => $part) {

					if($k > 1) {

						$ct_last_name .= ' ';

					}

					if($k > 0) { $ct_last_name .= $part; }

				}

				$result = Core::r('ct')->create_ct_user(array(
						'first_name' => $ct_first_name,
						'last_name' => $ct_last_name,
						'title' => $invite['to_title'],
						'company' => $invite['to_company'],
						'phone' => '',
						'email' => $invite['email']
					)
				);
				
				$invite_url = 'http://' . SITE_URL . '/?invite_key=' . $invite['invite_key'] . '&pin=' . $result['pin'] . '#virtualevents';
				$invite_link = 'href="' . $invite_url . '"';

			}

			$msg_top = 'Hi ' . ucwords($invite['to_name']) . '-
<br><br>
' . $from_user_name . ' has invited you to join in a virtual event online.
<br><br>
You can view more details about the event <a ' . $invite_link . ' target="_blank">here</a>, or by clicking on the invitation below.
<br><br>
If you choose to RSVP to the event you\'ll earn points in the Game On! game which will go towards earning some great rewards.  You\'ll also have the opportunity to earn points and badges for other activities that will also earn you rewards.
<br><br>
Check out the details and play today!<br><br>';

		} else {

			$invite_url = 'http://' . SITE_URL . '/#virtualevents';

			$msg_top = 'Hi ' . ucwords($invite['to_name']) . '-
<br><br>
Here is the event you just RSVP\'d to. You can view more details about the event <a href="' . $invite_url . '" target="_blank">here</a>, or by clicking on the invitation below.
<br><br>
If you attend the event, you\'ll earn points in the Game On! game which will go towards earning some great rewards.  You\'ll also have the opportunity to earn points and badges for other activities that will also earn you rewards.
<br><br>
Check out the details and RSVP and play today!<br><br>';

		}
		
		$send_invite = Core::r('invite')->send_invite_email(array(
				'invite_key' => (isset($invite['invite_key'])) ? $invite['invite_key'] : '',
				'event_id' => $options['event_id'],
				'email_to' => $invite['email'],
				'email_from' => $from_email,
				'name_from' => $from_name,
				'subject' => $subject,
				'msg_top' => $msg_top,
				'preview' => $options['preview'],
				'invite_url' => $invite_url
			)
		);

		return array(
			'sent' => 1,
			'invite' => $invite,
			'send_invite' => $send_invite
		);

	}

	function send_invite_email($options = array()) {

		Core::ensure_defaults(array(
				'invite_key' => '',
				'event_id' => '',
				'email_to' => '',
				'email_from' => '',
				'name_from' => '',
				'subject' => '',
				'msg_top' => '',
				'preview' => 0,
				'invite_url' => ''
			)
		, $options);

		$table_size = ($options['preview'] == 1) ? ' width="600" height="1055"' : '';

		if($options['msg_top'] != '') {

			$options['msg_top'] = '<div style="text-align:left"><br>' . $options['msg_top'] . '</div>';

		}

		$msg_body = '<center>
<p style="text-align: center; font-family:Arial; font-size:12px; color: #000000">Having trouble viewing this email? Please view the <a href="http://' . SITE_URL . '/?a=vevent_email&event_id=' . $options['event_id'] . '&k=' . sha1($options['event_id'] . SIMPLE_HASH) . '" style="color: #000000;" target="_blank"><b>online version</b></a></p>
' . $options['msg_top'] . '
	<table' . $table_size . ' border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top" align="left" bgcolor="#000000" width="600" style="font-size:0;">
				<a href="' . $options['invite_url'] . '" target="_blank"><img src="http://' . SITE_URL . '/vevent_email_img.php?id=' . $options['event_id'] . '" alt="" width="600" height="1055" border="0"/></a>
			</td>
		</tr>
	</table>
</center>';

		$invite_html = '<html>
<head>
<title>Invite</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
' . $msg_body . '
</body>
</html>';
		
		$from_email = Core::multi_get($event['has'], 'info_type', 'from_email', 'info');
		$from_name = Core::multi_get($event['has'], 'info_type', 'from_name', 'info');
		
		$email_sent = 0;

		if($options['preview'] == 0) {

			Core::email(array(
					'email_to' => $options['email_to'],
					'email_from' => $options['email_from'],
					'name_from' => $options['name_from'],
					'subject' => $options['subject'],
					'message' => $invite_html
				)
			);

			$email_sent = 1;

		}

		return array(
			'msg_body' => $msg_body,
			'email_sent' => $email_sent
		);

	}

	function accept_invite($options) {

		/*
		args:
		{
			invite_id: the invite id to accept,
			invite_key: look up by the invite key (either this or the invite id can be used)
		}

		returns:
			if success:
			{
				accepted: 1
			}

			if error:
			{
				error_code: The error code
				error_msg: The error msg
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'invite_id' => -1,
				'invite_key' => ''
			)
		, $options);

		if($options['invite_key'] != '') { // Look up the invite_id based on the invite_key

			$id = Core::fetch_column(
					"SELECT invite_id FROM " . CORE_DB . ".invites WHERE invite_key = :invite_key",
					array(
						'invite_key' => $options['invite_key']
					)
			);

			if($id === FALSE) { // Invite is not valid

				return Core::error($this->errors, 5);

			}

			$options['invite_id'] = $id;

		}

		// Determine if the invite is valid
		$c = Core::db_count(array(
				'table' => CORE_DB . '.invites',
				'values' => array(
					'invite_id' => $options['invite_id']
				)
			)
		);

		if($c == 0) { // Invite is not valid

			return Core::error($this->errors, 5);

		}

		// Invite is valid. Accept it
		$update = Core::db_update(array(
				'table' => CORE_DB . '.invites',
				'values' => array(
					'response_time' => Core::date_string(),
					'invite_status' => 1
				),
				'where' => array(
					'invite_id' => $options['invite_id'],
					'invite_status' => 0
				)
			)
		);

		return array(
			'accepted' => 1
		);

	}

	/*
	Generate the msg that should be sent
	*/
	function invite_msg($options = array()) {

		/*
		args:
		{
			to_name: the name of the recipient,
			from_name: the name of the sender
		}

		return:
		{
			msg: the msg to send
		}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'to_name' => '',
				'name_from' => '',
				'event_id' => -1
			)
		, $options);

		$msg = "Dear " . Core::safe_echo($options['to_name']) . ",

		" . Core::safe_echo($options['name_from']) . " has sent you an invite!

		<img src=\"/vevent_email_img.php?id=" . (int)$options['event_id'] . "\">";

		return array(
			'msg' => $msg
		);

	}
	
	function get_invited_count($options = array()) {
	
		/*
			args:
		{
		filters => {
		[any column(s) from the invites table]
		}
		}
	
		return
		{
		records:
		{
		invite_id,
		invite_key,
		to_name,
		to_company,
		status
		}
		}
		*/
	
		Core::ensure_defaults(array(
				'filters' => array()
		)
				, $options);
	
		$params = Core::db_params(array(
				'values' => $options['filters']
		)
		);
	
		global $dbh;
	
		$sql = "SELECT
		count(*) 
		FROM " . CORE_DB . ".invites";
	
		if($params['sql'] != '') {
	
			$sql .= ' WHERE ' . $params['sql'];
	
		}
		
		$sth = $dbh->prepare($sql);
		$sth->execute($params['params']);

		return $sth->fetchColumn();

	}

	/*
	Retrieve a list of people that were invited based on certain criteria
	*/
	function get_invited($options = array()) {

		/*
		args:
		{
			filters => {
				[any column(s) from the invites table]
			}
		}

		return
		{
			records:
				{	
					invite_id,
					invite_key,
					to_name,
					to_company,
					status
				}
		}
		*/

		Core::ensure_defaults(array(
				'filters' => array(),
				'start' => 0,
				'number' => 0
			)
		, $options);

		$params = Core::db_params(array(
				'values' => $options['filters']
			)
		);	

		global $dbh, $gamo;

		$sql = "SELECT
			invite_id,
			from_user_id,
			to_name,
			to_company,
			email,
			invite_time,
			invite_status,
			invite_key,
			(
				SELECT
				point_value_use
				FROM " . CORE_DB . ".actions_log AS a
				WHERE a.action_types_id = :invite_action_type
				AND a.int_other = " . CORE_DB . ".invites.invite_id
			) AS points,
			(
				SELECT
				end_time
				FROM
				" . CORE_DB . ".virtual_events AS a
				WHERE
				a.id = " . CORE_DB . ".invites.event_id
			) AS end_time
			FROM
			" . CORE_DB . ".invites";

		if($params['sql'] != '') {

			$sql .= ' WHERE ' . $params['sql'];

		}

		if($sql != '') {

			$sql .= ' HAVING points > 0';

		} else {

			$sql = ' HAVING points > 0';

		}

		$sql .= " ORDER BY invite_id DESC LIMIT ".(int)$options['start'].",".(int)$options['number'];
		
		$params['params'][':invite_action_type'] = Core::r('actions')->action_types_id(array(
				'action_key' => 'send_invite'
			)
		);

		$sth = $dbh->prepare($sql);
		$sth->execute($params['params']);

		$records = array();

		while($row = $sth->fetch()) {

			$row = Core::remove_numeric_keys($row);
			$row['allow_resend'] = (strtotime($row['end_time']) < (time() + 60)) ? 0 : 1;

			array_push($records, $row);

		}

		return array(
			'records' => $records
		);

	}

	function get_survey_user($options) {

		/*
		args:
		{
			email: the email address that was invited
		}

		returns
		{
			taken: 1 = survey taken, 0 = survey not taken
		}
		*/

		$options = Core::ensure_defaults(array(
				'email' => ''
			)
		, $options);

		$campaigns_list = array(2791, 2792, 2793, 2794, 2795, 2796, 2797, 2798, 2799, 2800);

		$invite_key = 0;
		$invitee_pin = 0;

		foreach($campaigns_list as $campaign_id) {

			$campaign = new Campaign();
	        $campaign
	                ->setCampaignID($campaign_id)
	                ->setCampaignURL('http://ct30.entermarketing.com');

	        $pin = $campaign->getPinByEmail($options['email']);

	        $data = 0;

			if($pin !== FALSE) {

				$invitee_pin = $pin;

				$data = $campaign->getData($pin);
				
				if(is_array($data)) {
					
					return array('taken' => 1);

				}

				break;

			}

		}

		return array('taken' => 0);

	}
	
	function get_campaign_user($options) {

		/*
		args:
		{
			email: the email address that was invited
		}

		returns
		{
			invite_used: 0 = not used, [invite_key] = the invite key that this person used to register
			$invitee_pin: 0 = no pin, [invitee_pin] = CT pin of the invitee,
		}
		*/

		$invite_key = 0;
		$invitee_pin = 0;
		
		foreach($this->campaigns as $campaign_id) {

			$campaign = new Campaign();
	        $campaign
	                ->setCampaignID($campaign_id)
	                ->setCampaignURL('http://ct30.entermarketing.com');

	        $pin = $campaign->getPinByEmail($options['email']);

	        $data = 0;

			if($pin !== FALSE) {

				$invitee_pin = $pin;

				$data = $campaign->getData($pin);
				
				if(is_array($data)) {
					
					foreach($data as $k => $data1) {

						if(is_array($data1)) {

							$pin_k = Core::multi_find($data1, '1', 'Invite key');

							if($pin_k != -1) {

								$invite_key = substr($data1[$pin_k][2], 0, 15);

								if(strlen($invite_key) < 5) {

									$invite_key = 0;

								} else {

									break;

								}

							}

						}

					}

				}

				break;

			}

		}

		return array(
			'invite_key' => $invite_key,
			'invitee_pin' => $invitee_pin,
			'data' => $data
		);

	}

}

?>
