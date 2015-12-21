<?
class Model_Partners {

	function run($options = array()) {
		
		global $gamo, $dbh;

		Core::ensure_defaults(array(
				'user_id' => -1
			)
		, $options);

		if(!is_numeric($options['user_id'])) {

			$options['user_id'] = -1;

		}

		require_once(DIR_MODELS . '/model.partner_cert_level.php');
		$partner_cert_level = new Model_Partner_Cert_Level();

		// Retrieve partners that this bss user owns
		$sql = "SELECT
		user_id,
		(SELECT company FROM " . GAMO_DB . ".users WHERE " . GAMO_DB . ".users.user_id = " . GAMO_DB . ".users_info.user_id) AS company
		FROM " . GAMO_DB . ".users_info WHERE info_type = 'bss_owner' AND int_info = :int_info";
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
		          ':int_info' => $options['user_id']
		    )
		);
		
		$data['owned_partners'] = array();

		$sql_level = "SELECT
		badge_id,
		(SELECT badge_name FROM " . GAMO_DB . ".badges WHERE " . GAMO_DB . ".badges.badge_id = " . GAMO_DB . ".users_info.badge_id) AS badge_name
		FROM " . GAMO_DB . ".users_info
		WHERE
		user_id = :user_id
		AND badge_id IN (15, 16, 17, 18)
		ORDER BY info DESC LIMIT 0, 1
		";

		$level_sth = $dbh->prepare($sql_level);

		while($row = $sth->fetch()) {

		    $row['partner_level'] = $partner_cert_level->run(array(
		                'user_id' => $row['user_id']
		          )
		    );

		    $row['partner_level'] = $row['partner_level']['level'];

		    $level_sth->execute(array(
		    		':user_id' => $row['user_id']
		    	)
		    );

		    $level_row = $level_sth->fetch();

		    if(!is_array($level_row)) {

		    	$row['level_name'] = 'No Certification';
		    	$row['level_id'] = 0;

		    } else {

		    		$row['level_name'] = $level_row['badge_name'];
		    		$row['level_id'] = $level_row['badge_id'];

		    }

		    array_push($data['owned_partners'], Core::remove_numeric_keys($row));

		}

		return $data;

	}

}

?>
