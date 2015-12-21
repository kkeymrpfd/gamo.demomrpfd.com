<?

class Router {

	public $routes;
	private $views;

	function run() {

		global $page_settings, $data, $view_output;

		$this->views = array(
			'default',
			'json'
		);
		
		//error_log(print_r($_GET,true));

		Core::ensure_defaults(array(
				'action' => (isset($_GET['a'])) ? $_GET['a'] : 'view_site',
				'view' => (isset($_GET['v']) && in_array($_GET['v'], $this->views)) ? $_GET['v'] : 'default',
				'page' => (isset($_GET['p'])) ? $_GET['p'] : 'landing',
			)
		, $page_settings);
		
		$page_settings['control'] = DIR_CONTROLS . '/control.' . $page_settings['action'] . '.php';
		$page_settings['pages'] = array($page_settings['action']);
		
		if(file_exists($page_settings['control'])) {

			if(strpos($page_settings['action'], 'process_') === 0) {

				require_once(DIR_INC . '/lib/class.Validate.php');
				$page_settings['view'] = 'json';
				
				global $validate;
				$validate = new Validate();

			}
			//error_log('Controller file found');
			//error_log(print_r($page_settings['action'],true));
			//error_log(print_r($page_settings['control'],true));

			require($page_settings['control']);
            
			$control = 'Control_' . $page_settings['action'];
			$control = new $control;
			$control->run();

		}

		Core::get_view($page_settings, $data);

	}

}

?>