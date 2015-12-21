<?
/*
This class handles the sending of notifications to users
*/
class Core_Notify {
	
	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Invalid user id specified'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Invalid message specified'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Could not create notification'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'Invalid values specified'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'Could not update notification'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'Could not find notification'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'There is already an equivelant active unseen notification'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'Invalid filters specified'
			)
		);

	}

	function create_notify($options = array()) {

		/*
		arguments:
			{
				user_id: who to send the notification to
				subject: the subject of the message to send
				int_other
				other
				other_b
				msg: the name of the message to send
				seen: wether this message was seen by the user
				active: wether this message is active (setting this to 0 basically means that the notification was deleted)
			}

		returns:
			if successful:
			{
				notify_id: the notification id
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'user_id' => -1,
				'subject' => '',
				'msg' => '',
				'int_other' => -1,
				'other' => '',
				'other_b' => '',
				'seen' => 0,
				'active' => 1,
				'time' => Core::date_string(),
				'badge_id' => -1
			)
		, $options);

		if($options['user_id'] == -1) { // Invalid user id

			return Core::error($this->errors, 1);

		}

		if($options['msg'] == '') { // Invalid message specified

			return Core::error($this->errors, 2);

		}

		// Ensure that the record is unique if this is an active, unseen record. Active unseen records must be unique
		if($options['active'] == 1 && $options['seen'] == 0) {

			$c = Core::db_count(array(
					'table' => CORE_DB . '.notify',
					'values' => array(
						'user_id' => $options['user_id'],
						'subject' => $options['subject'],
						'msg' => $options['msg'],
						'int_other' => $options['int_other'],
						'other' => $options['other'],
						'other_b' => $options['other_b'],
						'seen' => $options['seen'],
						'active' => $options['active']
					)
				)
			);

			if($c > 0) {

				return Core::error($this->errors, 7);

			}

		}

		$notify_id = Core::db_insert(array(
				'table' => CORE_DB . '.notify',
				'values' => array(
					'user_id' => $options['user_id'],
					'subject' => $options['subject'],
					'msg' => $options['msg'],
					'int_other' => $options['int_other'],
					'other' => $options['other'],
					'other_b' => $options['other_b'],
					'seen' => $options['seen'],
					'active' => $options['active'],
					'time' => $options['time']
				)
			)
		);
		
		if(!is_numeric($notify_id)) { // Error while creating record

			return Core::error($this->errors, 3);

		}
		
		if($options['badge_id'] != -1) { // Send notification e-mail for new rank/badge

			global $gamo;

			$badge = Core::r('reward_manager')->get_badge(array(
					'badge_id' => $options['badge_id']
				)
			);

			if(!Core::has_error($badge)) {
				
				$user = Core::r('users')->get_user(array(
						'user_id' => $options['user_id'],
						'get_has' => 0
					)
				);

				if($badge['rank'] <= 0) { // This is a badge

					$subject = 'You earned a new badge!';

					$email_msg = 'Hi ' . ucwords($user['first_name'] . ' ' . $user['last_name']) . '-
<br><br>
Congratulations!  You earned the ' . $badge['badge_name'] . ' badge in the ' . SITE_NAME . ' game.
<br><br>
<img src="http://' . SITE_URL . '/img/badges/' . $options['badge_id'] . '-active.png">
<br><br>
Check out what you have earned on the rewards page in your game interface <a href="http://' . SITE_URL . '/?p=prizes" target="_blank">here</a>';
				

				} else { // This is a rank

					$subject = 'You reached a new achievement!';

					$email_msg = 'Hi ' . ucwords($user['first_name'] . ' ' . $user['last_name']) . '-
<br><br>
Congratulations!  You reached the ' . $badge['badge_name'] . ' level in the ' . SITE_NAME . ' game.
<br><br>
<a href="https://www.facebook.com/dialog/feed?
  app_id=145634995501895
  &display=popup&caption=' . urlencode('I earned the ' . $badge['badge_name'] . ' level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com') . ' 
  &link=http://trivialegacy.com
  &redirect_uri=https://facebook.com" target="_blank">Share on Facebook</a>
<br>
<a href="http://twitter.com/intent/tweet?url=www.trivialegacy.com&text=I earned the ' . $badge['badge_name'] . ' level in the Momentum Trivia Legacy game at EMC Conference www.trivialegacy.com&related=yarrcat" target="_blank">Share on Twitter</a>
<br><br>
Check out what you have earned on the rewards page in your game interface <a href="http://' . SITE_URL . '/?p=prizes" target="_blank">here</a>';
				
				}

				Core::email(array(
						'email_to' => $user['email'],
						'email_from' => ADMIN_EMAIL,
						'name_from' => SITE_NAME,
						'subject' => $subject,
						'message' => $email_msg
					)
				);

			}

		}

		return array(
			'notify_id' => $notify_id
		);

	}

	/*
	Update a notification
	*/
	function update_notify($options = array()) {

		/*
		arguments:
		{
			notify_id: the notification to edit,
			values: array( the values to update (each is optional) Setting this to delete will set the record to inactive (active = 0)
				user_id,
				subject,
				msg,
				int_other,
				other,
				other_b,
				seen,
				active,
				time
			)
		}

		returns:
			if successful:
			{
				valid: 1
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'notify_id' => -1,
				'values' => array()
			)
		);

		if($options['values'] == 'delete') { // Delete the record

			$options['values'] = array(
				'active' => 0
			);

		}

		if(!is_array($options['values']) || count($options['values']) == 0) { // No values were specified for updating

			return Core::error($this->errors, 4);

		}
		
		$update = Core::db_update(array(
				'table' => CORE_DB . '.notify',
				'values' => $options['values'],
				'where' => array(
					'notify_id' => $options['notify_id']
				)
			)
		);

		if($update != 1) { // Could not return update

			return Core::error($this->errors, 5);

		} else {

			return array(
				'valid' => 1
			);

		}

	}

	/*
	Retrieve values for a notification
	*/
	function get_notify($options = array()) {

		/*
		arguments:
		{
			notify_id: the notification to retrieve
		}

		returns:
			if successful:
			{
				notify_id,
				user_id,
				subject,
				msg,
				int_other,
				other,
				other_b,
				seen,
				active
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'notify_id' => -1
			)
		, $options);

		global $dbh;

		$sql = 'SELECT
			notify_id,
			user_id,
			subject,
			msg,
			int_other,
			other,
			other_b,
			seen,
			active,
			time
			FROM ' . CORE_DB . '.notify
			WHERE notify_id = :notify_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':notify_id' => $options['notify_id']
			)
		);

		$row = $sth->fetch();

		if(!is_array($row)) { // Could not retrieve notification

			return Core::error($this->errors, 6);

		}

		// Record found. Return it
		return Core::remove_numeric_keys($row);

	}

	/*
	Get notifications matching a set of filters
	*/
	function get_notifications($options = array()) {

		/*
		{
			start: which record to start at
			records: how many records to retrieve
			values: { Which values to filter by. Each is optional
				notify_id,
				user_id,
				subject,
				msg,
				int_other,
				other,
				other_b,
				seen,
				active,
				time
			}
		}

		returns:
			if successful:
			{
				{
					notify_id,
					user_id,
					subject,
					msg,
					int_other,
					other,
					other_b,
					seen,
					active,
					time
				},
				{
					notify_id,
					user_id,
					subject,
					msg,
					int_other,
					other,
					other_b,
					seen,
					active,
					time
				},
				..
				..
			}

		if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'start' => 0,
				'records' => 100,
				'values' => array()
			)
		, $options);

		if(!is_array($options['values'])) { // Invalid filters specified

			return Core::error($this->errors, 8);

		}

		// Create filters
		$params = Core::db_params(array(
				'values' => $options['values']
			)
		);

		if($params['sql'] != '') { // There are filters

			$filter = ' WHERE ' . $params['sql'];

		} else { // There are no filters. Retrieve all records

			$filter = '';

		}

		// Retrieve records
		global $dbh;

		$sql = 'SELECT
			notify_id,
			user_id,
			subject,
			msg,
			int_other,
			other,
			other_b,
			seen,
			active,
			time
			FROM ' . CORE_DB . '.notify' . $filter . ' LIMIT ' . (int)$options['start'] . ', ' . (int)$options['records'];
			
		$sth = $dbh->prepare($sql);
		$sth->execute($params['params']);

		$records = array();

		while($row = $sth->fetch()) {

			array_push($records, Core::remove_numeric_keys($row));

		}

		// Determine count of records
		$c = Core::db_count(array(
				'table' => CORE_DB . '.notify',
				'values' => $options['values']
			)
		);

		return array(
			'records' => $records,
			'qty' => $c
		);

	}

	// Marks all active notifications for a user as seen
	function notify_seen($options = array()) {

		/*
		arguments:
			user_id

		returns:
			if successful:
			{
				valid: 1
			}

			if error:
			{
				error_code: The error code
				error_msg: The error message
			}
		*/

		// Ensure defaults
		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		global $dbh;

		$sql = 'UPDATE ' . CORE_DB . '.notify SET seen = 1 WHERE active = 1 AND user_id = :user_id';

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id']
			)
		);

		return array(
			'valid' => 1
		);

	}

}
?>
