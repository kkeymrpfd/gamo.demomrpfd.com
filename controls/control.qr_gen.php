<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Qr_Gen {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo;

		for($i = 0;$i <= 41;$i++) {

			$code = Core::unique_string(6);

			$cont = file_get_contents('https://api.qrserver.com/v1/create-qr-code/?size=1000x1000&data=' . urlencode('http://trivialegacy.com/?a=qr&c=' . $code) );
			file_put_contents(DIR_STORE . '/qr_codes/' . $code . '.png', $cont);

			echo 'http://trivialegacy.com/?a=qr&c=' . Core::unique_string(6) . "\n";

		}

		return $data;

	}

}
?>
