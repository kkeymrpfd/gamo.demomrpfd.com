<?
// Generate qr codes
require(dirname(dirname(__FILE__)) . '/inc/config.php');
require(dirname(dirname(__FILE__)) . '/inc/loader.php');
require(DIR_INC . '/gamo/class.Gamo.php');

$gamo = new Gamo();

$partners = array(
	'Accenture',
	'affecto',
	'amazon',
	'amberleaf',
	'analytix',
	'appfluent',
	'attivio',
	'bytemanagers',
	'capgemini',
	'cisco',
	'cloudperspective',
	'cloudsherpas',
	'cloudera',
	'cognizant',
	'collaborative',
	'corporatetech',
	'datasift',
	'datasource',
	'dell',
	'deloutte',
	'eccella',
	'engagepoint',
	'etlfactory',
	'hcl',
	'hexaware',
	'highpoint',
	'hitachi',
	'infolink',
	'infosys',
	'infoverity',
	'intricity',
	'logan',
	'lumendata',
	'mapr',
	'momentum',
	'myersholum',
	'oracle',
	'perficient',
	'pwc',
	'oliktech',
	'rcg',
	'scalable',
	'softpath',
	'ssg',
	'systech',
	'tata',
	'teradata',
	'brainbrokers',
	'trinus',
	'wipro'
);

foreach($partners as $k => $partner) {

	$qr_code = $partner . '-' . Core::unique_string(3);

	$url = 'http://saleskickoffgame.com/?a=qr_scan&c=' . $qr_code;

	echo $url . "\n";

	$img = 'https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=' . urlencode($url) . '&choe=UTF-8';

	file_put_contents(DIR_STORE . '/qr_codes/' . $qr_code . '.png', file_get_contents($img));

}

for($i = 0;$i <= 10;$i++) {

	$qr_code = Core::unique_string(5);

	$url = 'http://saleskickoffgame.com/?a=qr_scan&c=' . $qr_code;

	echo $url . "\n";

	$img = 'https://chart.googleapis.com/chart?chs=500x500&cht=qr&chl=' . urlencode($url) . '&choe=UTF-8';

	file_put_contents(DIR_STORE . '/qr_codes/' . $qr_code . '.png', file_get_contents($img));

}

?>