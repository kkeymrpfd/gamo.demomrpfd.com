<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Remove_Invalid_Meetings {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		if(Core::get_input('c', 'get') != 'go') {

			echo 'invalid';
			die();

		}

		$sql = "SELECT * FROM " . GAMO_DB . ".actions_log WHERE user_id IN (964,960,1000, 916) AND action_types_id IN (42, 43, 44) AND active = 1";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		$action_ids = array();

		while($row = $sth->fetch()) {

			$action_ids[] = $row['action_id'];

		}

		print_r($action_ids);

		foreach($action_ids as $k => $action_id) {

			$result = Core::r('actions')->modify_action(array(
					'action_id' => $action_id,
					'values' => 'delete'
				)
			);

			print_r($result);

		}

	}

}
?>
