<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Qr_List {

	function run() {

		global $dbh;

		echo time();
		
		if(Core::get_input('access', 'get') != 'asdsad834aads') {

			echo 'invalid access';
			die();

		}

		$sql = "SELECT
		qr_code,
		url,
		(
			SELECT
			category_name
			FROM " . GAMO_DB . ".categories AS a
			WHERE a.category_id = " . GAMO_DB . ".qr_codes.int_info
		) AS partner_name
		FROM " . GAMO_DB . ".qr_codes
		WHERE int_info > 0";

		$sth = $dbh->prepare($sql);
		$sth->execute();

		echo '<table border="1">';
		echo '<tr>';
		echo '<td style="padding:10px">Partner</td>';
		echo '<td style="padding:10px">QR Code</td>';
		echo '</tr>';

		while($row = $sth->fetch()) {

			echo '<tr>';
			echo '<td style="padding:10px">' . $row['partner_name'] . '</td>';
			echo '<td style="padding:10px"><a href="/?a=qr_scan&c=' . $row['qr_code'] . '" target="_blank">' . $row['qr_code'] . '</a></td>';
			echo '</tr>';

		}

		echo '</table>';

	}

}
?>