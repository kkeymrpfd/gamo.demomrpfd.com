<?

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

ob_start();
require('../inc/config.php');
require('../inc/loader.php');
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

$page_settings = array();
$data = array();
$models = array();
$view_output = '';

$data['user_id'] = $session->get('user_id');

if($_SERVER['HTTP_HOST'] == 'www.delloverdrive.com') {

	header("Location: http://delloverdrive.com" . $_SERVER['REQUEST_URI']);

}

if(isset($_SERVER['REQUEST_URI'])
	&& Core::get_input('a', 'get') != 'get_recent_activity'
	&& Core::get_input('a', 'get') != 'get_dashlets') {
	
	Core::log(array(
			'info_type' => 'site',
			'info_a' => $data['user_id'],
			'info_b' => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']
		)
	);

}

require(DIR_INC . '/gamo/class.Gamo.php');
require(DIR_INC . '/core/class.Router.php');
$router = new Router();

$router->run();

if(Core::get_input('session_display', 'get') == 1) {

	Core::print_r($session->get_all());

}

if(Core::get_input('data_display', 'get') == 1) {

	Core::print_r($session->get_all());

}

echo $view_output;

ob_end_flush();
?>
