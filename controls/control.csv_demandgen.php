<?
class Control_Csv_Demandgen {

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
		(
			SELECT
			email
			FROM " . GAMO_DB . ".users AS a
			WHERE a.user_id = demandgen_contacts.user_id
		) AS partner_email,
		(
			SELECT
			company
			FROM " . GAMO_DB . ".users AS a
			WHERE a.user_id = demandgen_contacts.user_id
		) AS partner_company,
		email_to,
		(
			SELECT
			title
			FROM " . GAMO_DB . ".email_templates AS a
			WHERE a.email_template_id = demandgen_contacts.email_template_id
		) AS email_template,
		clicked
		FROM " . GAMO_DB . ".demandgen_contacts AS demandgen_contacts
		WHERE
		user_id NOT IN (" . implode(',', $exclude_user_ids) . ")
		ORDER BY clicked DESC";

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
			$csv[] = '"' . implode('","', $row) . '"';

		}

		$csv = implode("\n", $csv);

		header('Content-type: text/calendar; charset=utf-8');
		header('Content-Disposition: inline; filename=' . str_replace(" ", "_", SITE_NAME) . '_demandgen.csv');
		echo $csv;

		return $data;

	}

}
?>
