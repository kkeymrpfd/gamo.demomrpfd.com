<?
class Control_Csv_Meetings {

	function run() {

		global $data, $page_settings, $models, $dbh, $gamo;

		if(Core::get_input('c', 'get') != 'jaksj38ak27a' && Core::get_input('c', 'get') != '8aks8s87la0172') {

			header("Location: /");
			die();

		}

		$sql = "SELECT user_id FROM " . GAMO_DB . ".users WHERE email LIKE '%dell%' OR email LIKE '%mrpfd%'";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$exclude_user_ids = array();

		while($row = $sth->fetch()) {

			$exclude_user_ids[] = $row['user_id'];

		}

		$sql = "SELECT
		(SELECT company FROM " . GAMO_DB . ".users AS u WHERE u.user_id = actions_log.user_id) AS partner_company,
		(SELECT email FROM " . GAMO_DB . ".users AS u WHERE u.user_id = actions_log.user_id) AS partner_email,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'status') AS status,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'company') AS prospect_company,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'contact_name') AS prospect_contact_name,
		other AS prospect_email,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'amount') AS amount,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'date') AS date,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'email') AS email,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'meeting_id') AS meeting_id,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'notes') AS notes,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'phone') AS phone,
		(SELECT info FROM " . GAMO_DB . ".actions_info AS ai WHERE ai.action_id = actions_log.action_id AND ai.info_type = 'title') AS title
		FROM " . GAMO_DB . ".actions_log AS actions_log
		WHERE
		action_types_id = 42
		AND user_id NOT IN (" . implode(',', $exclude_user_ids) . ")
		AND active = 1
		AND point_value_used > 0";

		$sth = $dbh->prepare($sql);
		$sth->execute();
		$header = false;
		$csv = array();

		while($row = $sth->fetch()) {

			Core::remove_numeric_keys($row);

			if($header === false) {

				foreach($row as $k => $v) {

					$header[] = $k;

				}

				$csv[] = '"' . implode('","', $header) . '"';

			}

			//$row['amount'] = preg_replace("/[^0-9,.]/", "",$row['amount']);
			$row['status'] = str_replace("submit_meeting", 'Registered', $row['status']);
			$row['status'] = str_replace("submit_deal_close", 'Deal Closed', $row['status']);
			$csv[] = '"' . implode('","', $row) . '"';

		}

		$csv = implode("\n", $csv);

		header('Content-type: text/calendar; charset=utf-8');
		header('Content-Disposition: inline; filename=' . str_replace(" ", "_", SITE_NAME) . '_meetings.csv');
		echo $csv;

		return $data;

	}

}
?>
