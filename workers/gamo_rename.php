<?
// Ensure that all users have a pin
require(dirname(dirname(__FILE__)) . '/inc/config.php');
require(dirname(dirname(__FILE__)) . '/inc/loader.php');
require(DIR_INC . '/gamo/class.Gamo.php');

$dir = '/var/www/gamo.demomrpfd.com/inc/core/libs/';
$files = scandir($dir);

print_r($files);

foreach($files as $k => $file) {

	if(strpos($file, '.php') !== FALSE) {

		$new_file = strtolower($file);
		$mv = 'mv ' . $dir . $file . ' ' . $dir . $new_file;
		exec($mv);

	}

}

?>