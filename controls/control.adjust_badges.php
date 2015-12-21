<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Adjust_Badges {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		if(Core::get_input('access', 'get') != 'uaosjdlasd') {

			echo 'Invalid';
			die();

		}

		$sql = "SELECT user_id FROM " . GAMO_DB . ".users";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		while($row = $sth->fetch()) {

			$result = Core::r('rewards')->determine_badges(array(
					'user_id' => $row['user_id']
				)
			);

			Core::print_r($result);

		}

		return $data;

	}

}
?>
