<?
/*
The Gamo class. This class really just imports all the other classes that do the heavy lifting and provide
a single point interface to them. Please note that a lot of the functions in this class itself were copied from
old projects or written up super quick. They are not as well commented, but should intuitively make sense to virtually anyone.
However, the other classes are far more extensively documented and kept pretty neat. I use a commenting convention that
I think most will prefer to the standard @param stuff that does pratically nothing to explain what's really going on.
I'm sure we can clean up the code more. Please, please, please let me know what bugs/potential issues you see. I am sure they are there.
Let me know if you have any questions.

Also, there is some odd usage of self and $this going on in some of the classes. This needs to be resolved to avoid scope issues
*/

Class Gamo {
	
	private $libs;

	private $statements = Array();

	function __construct() {
		
		$this->libs = array();

	}

	function r($library = '', $location = '', $arr_argument=null) { // Load a library

		global $gamo;
		
		if(!isset($gamo->libs[$library])) {

			if(substr($location, -1) != '/') {

				$location .= '/';

			}

			$method = str_replace(' ', '_', ucwords(str_replace('_' , ' ', $library)));
			$location = DIR_INC . '/gamo/libs' . $location . 'class.Gamo_' . $method . '.php';
			
			if(file_exists($location)) {

				require_once($location);

				$load = 'Gamo_' . $method;
				
				if( isset($arr_argument) and is_array($arr_argument) ){

					$gamo->libs[$library] = new $load($arr_argument);
					
				}else{
					
					$gamo->libs[$library] = new $load;
					
				}

			} else {

				return false;

			}

		}

		return $gamo->libs[$library];

	}

}

$gamo = new Gamo();
?>
