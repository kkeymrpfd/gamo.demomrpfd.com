<?
class Model_Test_Page {

	function run() {

		$numbers = array();

		for($i = 1;$i <= 100;$i++) {

			array_push($numbers, $i);

		}

		return $numbers;

	}

}
?>