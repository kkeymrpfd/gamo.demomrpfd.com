<?

class Control_Import_Qrs {

	function run() {

		$path    = DIR_STORE . '/qr_images';
		$files = scandir($path);

		/*
		foreach($files as $k => $file) {

			if(strpos($file, '-') !== FALSE) {

				$code = strtolower(str_replace('.png', '', preg_replace('/\s+/', '', $file)));
				
				echo $code . '<br>';

				Core::db_insert(array(
						'table' => GAMO_DB . '.qr_codes',
						'values' => array(
							'qr_code' => $code,
							'url' => '/?p=partner_scanned&set_id='
						)
					)
				);

			}

		}
		*/

		global $dbh;

		$sql = "SELECT qr_id, url, int_info FROM " . GAMO_DB . ".qr_codes WHERE int_info > 1 AND url LIKE '%='";
		$sth = $dbh->prepare($sql);
		$sth->execute();

		while($row = $sth->fetch()) {

			Core::print_r($row);

			Core::db_update(array(
					'table' => GAMO_DB . '.qr_codes',
					'values' => array(
						'url' => $row['url'] . $row['int_info']
					),
					'where' => array(
						'qr_id' => $row['qr_id']
					)
				)
			);

		}

	}

}
?>