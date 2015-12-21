<?
class Model_Simulator {

	function run($options = array()) {
		
		global $gamo, $dbh;

		$data['action_types'] = Core::r('actions')->get_action_types();
		
		// Retrieve all categories
		$categories = array();
		$sql = 'SELECT category_id, category_name FROM ' . GAMO_DB . '.categories ORDER BY category_name ASC';
		$sth = $dbh->prepare($sql);
		$sth->execute();

		while($row = $sth->fetch()) {

			array_push($categories, Core::remove_numeric_keys($row));

		}

		$data['categories'] = $categories;

		$data['users'] = Core::r('users')->get_users(array(
				'records' => 5000
			)
		);

		$data['users']['users'] = Core::multi_sort($data['users']['users'], 'display_name');

		return $data;

	}

}

?>
