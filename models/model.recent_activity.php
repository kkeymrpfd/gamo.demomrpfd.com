<?
/*
Retrieve recent activity
*/
class Model_Recent_Activity {

	function run($options = array()) {
		
		global $session, $dbh, $data, $gamo;

		$filters = array();
		$params = array();

		foreach(Core::r('users')->exclude_emails as $k => $email) {

			array_push($filters, "email NOT LIKE :email_exclude" . $k);
			$params[":email_exclude" . $k] = '%' . $email . '%';

		}

		$sql_filter = '';

		if(count($filters) > 0) { // There are filters

			$sql_filter = " AND " . implode(' AND ', $filters);

		}

		$eligible_actions = array(
			'download_resource',
			'share_resource',
			'send_invite',
			'schedule_meeting',
			'claim_referral',
			'take_survey',
			'post_comment_board',
			'reply_comment_board',
			'attend_vevent',
			'rsvp_vevent',
            'attend_fevent',
            'rsvp_fevent',
			'post_vevent_question',
			'share_survey',
			'submit_referral',
			'like_facebook_page',
			'facebook_post',
			'facebook_post_shared',
			'facebook_post_commented',
			'facebook_post_liked',
			'twitter_follow',
			'twitter_share_link',
			'twitter_tweet_hashtag',
			'linkedin_follow',
			'schedule_meeting_clevel',
			'transacted_meeting_manager',
			'schedule_meeting_manager',
			'transacted_meeting_clevel',
			'won_meeting',
			'poc_meeting',
			'register_portal'
		);

		$use = "'" . implode("', '", $eligible_actions) . "'";

		$sql = "
		SELECT
		action_id,
		user_id,
		(
			SELECT
			display_name
			FROM " . GAMO_DB . ".users AS a
			WHERE a.user_id = " . GAMO_DB . ".actions_log.user_id" . $sql_filter . "
		) AS display_name,
		time,
		point_value_use,
		(
			SELECT
			info
			FROM " . GAMO_DB . ".action_types_info AS a
			WHERE a.action_types_id = " . GAMO_DB . ".actions_log.action_types_id
			AND a.info_type = 'activity_display'
			LIMIT 0, 1
		) AS activity_display
		FROM " . GAMO_DB . ".actions_log
		WHERE
		point_value_use > 0
		AND active = 1
		AND action_types_id IN (
			SELECT
			action_types_id
			FROM " . GAMO_DB . ".action_types AS a
			WHERE action_key IN (" . $use . ")
			AND " . GAMO_DB . ".actions_log.point_value_use > 0
		)
		HAVING display_name IS NOT NULL AND activity_display IS NOT NULL
		ORDER BY action_id DESC LIMIT 0, 5
		";

		$sth = $dbh->prepare($sql);
		$sth->execute($params);

		$actions = array();

		while($row = $sth->fetch()) {

			array_push($actions, Core::remove_numeric_keys($row));

		}

		$actions = array(
			'recent_activity' => $actions
		);

		return $actions;

	}

}

?>
