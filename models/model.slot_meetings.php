<?
class Model_Slot_Meetings {

	function run($options = array()) {

		global $dbh, $gamo;

		$result = array();

		$action_type = Core::r('actions')->action_types_id('reserve_slot_meeting');

		$result['slots'] = Core::r('slots')->get_slots();
		$result['slots'] = $result['slots']['slots'];
		
		// Retrieve all reserved slots
		$sql = "SELECT user_id, int_other AS slot_id FROM " . GAMO_DB . ".actions_log WHERE action_types_id = :action_types_id";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':action_types_id' => $action_type
			)
		);

		$result['reservations'] = array();

		while($row = $sth->fetch()) {

			$row = Core::remove_numeric_keys($row);
			
			$row['user'] = Core::r('users')->get_user(array(
					'user_id' => $row['user_id']
				)
			);

			if(!Core::has_error($row['user'])) {

				array_push($result['reservations'], $row);

			}

		}

		return $result;

	}

}
?>