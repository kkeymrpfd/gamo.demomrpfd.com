<?
class Model_Levels {

	function run($options = array()) {

		global $dbh;

		$sql = "SELECT
		badge_id,
		badge_name,
		rank,
		(
			SELECT
			points
			FROM " . GAMO_DB . ".badges_info AS a
			WHERE a.badge_id = " . GAMO_DB . ".badges.badge_id
			AND info_type = 'min_points'
		) AS min_points
		FROM " . GAMO_DB . ".badges
		WHERE rank > 0
		ORDER BY rank ASC
		";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		$result['rank_levels'] = array();

		while($row = $sth->fetch()) {

			if(!is_numeric($row['min_points'])) { $row['min_points'] = 0; }
			array_push($result['rank_levels'], Core::remove_numeric_keys($row));

		}
		
		return $result;

	}

}

?>
