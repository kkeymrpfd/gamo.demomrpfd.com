<?
/*
This class defines some useful added functionality
@db general.unique_id
*/

class Core {

	private $statements = Array();
	private $user_id = -1;
	public $libs = array();

	public $errors = array(
		array(
				'error_code' => 2,
				'error_msg' => 'Error occured while preparing the sql statement'
		),
		array(
				'error_code' => 3,
				'error_msg' => 'Error occured while executing the sql statement'
		),
		array(
				'error_code' => 4,
				'error_msg' => 'PDOException was thrown.'
		),
		array(
				'error_code' => 5,
				'error_msg' => "Missing required arguments."
		)
	);

	function csv_to_array($filename='', $delimiter=',')
	{
	    if(!file_exists($filename) || !is_readable($filename))
	        return FALSE;

	    $header = NULL;
	    $data = array();
	    $c = 0;

	    if (($handle = fopen($filename, 'r')) !== FALSE)
	    {
	        while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE)
	        {

	            if(!$header) {
	                $header = $row;
	            }
	            else {

	                ++$c;
	                
	                $hcount = count($header);
	                $rcount = count($row);

	                if($hcount > $rcount) {

	                    $diff = $hcount - $rcount;

	                    for($i = 0;$i < $diff;$i++) {

	                        $row[] = '';

	                    }

	                }

	                $use_line = array();

	                foreach($header as $k => $key) {

	                    if(!isset($use_line[$key]) || $use_line[$key] == '') {

	                        $use_line[$key] = $row[$k];

	                    }

	                }

	                $data[] = $use_line;

	            }


	        }
	        fclose($handle);
	    }
	    return $data;
	}

	public function condition_output($condition, $true, $false) {

		return ($condition) ? $true : $false;

	}
	
	public function error_log( $error_level, $error ){
		
		$errors = array(
				
				'none' => 0,
				'error' => 1,
				'warning' => 2,
				'notice' => 3,
				'dump' => 4
		);
		
 		//var_dump( $error_level, $error, $errors[$error['error_level']], $errors[$error_level] );
		
		if( !empty($error['error_level']) ){
			
			if( $errors[ $error['error_level'] ] <= $errors[$error_level]){
				
				error_log($error['error_msg']);
				
			}
			
		}
		
	}
	
	public function check_required_arguments( $options=array() ){
		
		Core::ensure_defaults(array(
				'caller' => 'CLASS METHOD DATE - unspecified'
		),$options);
	
		if(!isset($options['options'])){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= "PARAMS:[".print_r($options['params'],true)."] "." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
		if(!isset($options['req_args'])){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= "PARAMS:[".print_r($options['params'],true)."] "." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
	
		foreach($options['req_args'] as $arg_name){
			
			if(!isset($options['options'][$arg_name])){
				$error = Core::error($this->errors, 5);
				$error['error_msg'] .= "PARAMS:[".print_r($options['params'],true)."] "." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
				return $error;
			}
	
		}
		return true;
	
	}
	
	function db_execute( $options=array() ){
		
		global $dbh;
		
		Core::ensure_defaults(array(
				'sql' => '',
				'params' => array(),
				'get_method' => 'fetch',
				'query_type' => 'select'
		),$options);
		
		try{
		
			$stm = $dbh->prepare($options['sql']);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= "SQL: [".$options['sql']."] PARAMS:[".print_r($options['params'],true)."] "." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
				return $error;
			}
		
			$sres = $stm->execute($options['params']);
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= "SQL: [".$options['sql']."] PARAMS:[".print_r($options['params'],true)."] "." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
				return $error;
			}
		
			if($options['query_type'] == 'select'){
				if($options['get_method'] == 'fetchColumn'){
					return $stm->fetchColumn();
				}else{
					return $stm->$options['get_method'](PDO::FETCH_ASSOC);
				}
			}else{
				return array(
						'rows' => $stm->rowCount(),
						'insert_id' => $dbh->lastInsertId()
				);
			}
		
		}catch(PDOException $e){
			$error = Core::error($this->errors, 4);
			$error['error_msg'] .= "SQL: [".$options['sql']."] PARAMS:[".print_r($options['params'],true)."] "." CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
			return $error;
		}
		
	}
	
	function multi_sort($array, $index, $order = 'asc', $natsort=FALSE, $case_sensitive=FALSE) {
		
		if($order == true && $order != 'asc') {
			
			$order = 'desc';
			
		} else if($order == false) {
			
			$order = 'false';
			
		}
		$sorted = array();
		
	    if(is_array($array) && count($array)>0) {
	        foreach(array_keys($array) as $key) 
	        $temp[$key]=$array[$key][$index];
	        if(!$natsort) {
	            if ($order=='asc')
	                asort($temp);
	            else    
	                arsort($temp);
	        }
	        else 
	        {
	            if ($case_sensitive===true)
	                natsort($temp);
	            else
	                natcasesort($temp);
	        if($order!='asc') 
	            $temp=array_reverse($temp,TRUE);
	        }
	        foreach(array_keys($temp) as $key) 
	            if (is_numeric($key))
	                $sorted[]=$array[$key];
	            else    
	                $sorted[$key]=$array[$key];
	        return $sorted;
	    }
	    return $sorted;

	}

    /*
    Converts m/d/y Hm to Y-m-d H:i:s. For example this function converts 07/08/2013 900 to 2013-08-07 09:00:00
    */
    function convert_datetime($datetime){

        $datetimeArr = explode(" ", $datetime);

        $date = '1970-01-01';
        $time = '00:00:00';

        if(sizeof($datetimeArr) == 2){

            $date = $datetimeArr[0];
            $time = $datetimeArr[1];


            if( $date == date('m/d/Y', strtotime($date)) ){

                $date = date('Y-m-d', strtotime($date));
                $hour = substr($time, 0, -2);
                $minute = substr($time, -2);
                $seconds = date('s', '0');

                if(strlen($hour) == 1){
                    $hour = '0' . $hour;
                }

                $convertedTime = $date . ' ' . $hour . ':' . $minute . ':' . $seconds;

                return $convertedTime;

            }
            else{
                return $date . ' ' . $time;
            }

        }
        else{
            return $date . ' ' . $time;
        }
    }

	/*
	Encrypt a string using a customizable key. By default, the key is self::$encrypt_key
	*/
	function encrypt($string, $key = '') {

		if($key == '') { $key = ENCRYPT_KEY; }

		$iv_size     = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv          = mcrypt_create_iv($iv_size, MCRYPT_RAND);

		//ENCRYPT.
		$text        = "Meet me at 11 o'clock behind the monument.";
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB, $iv);

	}

	/*
	Decrypt a string using a customizable key. By default, the key is self::$encrypt_key
	*/
	function decrypt($string, $key = '') {

		if($key == '') { $key = ENCRYPT_KEY; }

		$iv_size     = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv          = mcrypt_create_iv($iv_size, MCRYPT_RAND);

		//DECRYPT.
		return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB, $iv);

	}

	/*
	Retrieve a value from the options table based on key
	*/
	function get_option($options = array()) {

		if(!is_array($options)) {

			$options = array(
				'key' => $options
			);

		}

		return Core::fetch_column(
			"SELECT value FROM " . GAMO_DB . ".options WHERE tkey = :tkey",
			array(
				':tkey' => $options['key']
			)
		);

	}

	function db_params($options = array()) {

		/*
		usage example:
		$params = array(
			'action_id' => 20,
			'int_other' => 3
		);

		$filters = Core::db_params(array(
				'values' => $params
			)
		);

		outputs:
			Array
			(
			    [sql] => action_id = :action_id and int_other = :int_other
			    [params] => Array
			        (
			            [:action_id] => 20
			            [:int_other] => 3
			        )

			    [keys] => Array
			        (
			            [0] => action_id = :action_id
			            [1] => int_other = :int_other
			        )

			)
		*/

		Core::ensure_defaults(array(
				'values' => array(),
				'type' => 'and'
			)
		, $options);

		$keys = array();
		$params = array();

		foreach($options['values'] as $k => $v) {

			$key_use = str_replace('.', '', $k);

			array_push($keys, $k . ' = :' . $key_use);
			$params[':' . $key_use] = $v;

		}

		return array(
			'sql' => implode(' ' . $options['type'] . ' ', $keys),
			'params' => $params,
			'keys' => $keys
		);

	}

	function db_insert($options = Array()) { // Insert a row into a database
		
		/*
		 * This function makes it possible to create an sql insert statement using an array, with the index being the column,
		 * and the value of the index being the value of the column for the new row. The values to be set are:
		 * 		db => this is the mysql connection resource
		 * 		type => ' DELAYED' or null for non delayed
		 * 		table => which table to insert the row into
		 * 		values => the actual array of values
		 */
		
		global $dbh;

		Core::ensure_defaults(array(
			'dbh' => &$dbh,
			'delayed' => 0,
			'cache' => 0,
			'unique' => []
		), $options);

		if($options['delayed'] == 1) {

			$options['delayed'] = ' DELAYED';

		}

		$values = Array();

		foreach($options['values'] as $k => $v) {

			$values[':' . $k] = $v;

		}

        $sql = 'INSERT INTO ' . $options['table'] . ' (' . implode(',', array_keys($options['values'])) . ') VALUES (' . implode(',', array_keys($values)) . ')';
        $sth = $options['dbh']->prepare($sql);
        
        if(count($options['unique'])) {

        	$c = Core::db_count([
        		'table' => $options['table'],
        		'values' => $options['unique']
        	]);

        	if($c > 0) {

        		return Core::error("Record already exists");

        	}

        };

        try {

        	$sth->execute($values);

       	} catch(Exception $e) {

       		return $e;

       	}

        return $options['dbh']->lastInsertId();

	}

	/*
	Fetch a single column. This is essentially a quick way to run a prepared statement
	*/
	function fetch_column($sql, $parameters = array()) {

		global $dbh;
		
		$sth = $dbh->prepare($sql);
		$sth->execute($parameters);

		return $sth->fetchColumn();

	}

	function r($library = '', $location = '', $arr_argument=null) { // Load a library
		
		global $core;

		if(!isset($core->libs[$library])) {

			if(substr($location, -1) != '/') {

				$location .= '/';

			}

			$location = DIR_INC . '/core/libs' . $location . 'class.' . $library . '.php';
			
			if(file_exists($location)) {

				require_once($location);

				$load = 'Core_' . ucfirst($library);
				
				if( isset($arr_argument) and is_array($arr_argument) ){

					$core->libs[$library] = new $load($arr_argument);
					
				} else{
					
					$core->libs[$library] = new $load;
					
				}

			} else {

				return false;

			}

		}

		return $core->libs[$library];

	}

	/*
	Generates a random alphanumeric string of length $length using the characters from $selection.
	$selection is customizable in case we want to generate a random string using a certain set of characters
	*/
	function random_string($length, $selection = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9")) {

		$string = "";
		$selection_size = count($selection) - 1; // How many items there are in selection

		for($i = 0; $i < $length; $i++) { // Keep adding a random item from $selection to $string until $string has a length of $length

			$string .= $selection[ mt_rand(0, $selection_size) ];

		}

		return $string;

	}

	/*
	Remove all indices from an array that have a numeric index. This is useful for removing the numeric indices
	from mysql->fetch() results, leaving only an associative array with column names as the indices
	*/
	function remove_numeric_keys(&$row) {

		if(!is_array($row)) {

			return $row;

		}

		foreach($row as $k => $v) {

			if(is_numeric($k)) {

				unset($row[$k]);

			}

		}

		return $row;

	}
	
	/*
	Determine if an array has an index called 'error_code'
	*/
	function has_error(&$msg) {

		return ( is_array($msg) and isset( $msg['error_code'] ) );

	}

	/*
	Generate a random, unique string. This is essentially a way to call self::random_string, but uses a database
	to ensure that the same string is never returned twice.
	*/
	function unique_string($length = 5, $selection = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9")) {


		/*
		Generate a random unique alphanumeric string of length $length
		*/

		global $core;

		$unique = -1;

		while( $unique == -1 ) {

			/*
			Keep trying to insert a randomly generated alphanumeric string into the unique table until a mysql_insert_id is found.
			Since the unique table has a unique key on the row being inserted into, only a unique key would work
			*/

			$random_string = self::random_string($length);

			$unique = $core->db_insert(Array(
					'table' => CORE_DB . '.unique_string',
					'values' => Array(
						'unique_string' => (string) $random_string
					)
				)
			);

		}

		return $random_string;

	}

	/*
	Set an email to be sent in the queue
	*/
	function email($options = array()) {

		/*
		args:
		{
			email_to: who to send the email to,
			from_name: the name to send this e-mail from
			email_from: the email to send from,
			subject: the subject of the mail,
			message: email message
			message_text: plan text message
			time: when to send the email
		}
		*/

		Core::ensure_defaults(array(
				'email_to' => '',
				'name_to' => '',
				'name_from' => SITE_NAME,
				'email_from' => ADMIN_EMAIL,
				'subject' => '',
				'message' => '',
				'message_text' => '',
				'time' => Core::date_string()
			)
		, $options);

		if($options['message_text'] == '') {

			$options['message_text'] = $options['message'];

		}

		Core::db_insert(array(
				'table' => GAMO_DB . '.emails',
				'values' => array(
					'email_to' => $options['email_to'],
					'name_to' => $options['name_to'],
					'name_from' => $options['name_from'],
					'email_from' => $options['email_from'],
					'subject' => $options['subject'],
					'message' => $options['message'],
					'message_text' => $options['message_text'],
					'time' => $options['time'],
					'sent' => 0,
					'item_id' => 1
				)
			)
		);

	}

	function multi_get(&$arr, $key, $val = 0, $val_key) { // Retrieve a value from a multi dimensional array

		$found_k = Core::multi_find($arr, $key, $val);
		
		if($found_k == -1) {
			
			return '';

		}

		return (isset($arr[$found_k][$val_key])) ? $arr[$found_k][$val_key] : '';

	}

	function multi_find(&$arr, $key, $val = 0) { // Find a value in a multi-dimensional array

		if(is_array($arr)) {

			if(!is_array($key)) {

				foreach($arr as $k => $v) {

					if(isset($v[$key]) && $v[$key] == $val) {

						return $k; // Match found. Return key for the index with the matching key/value pair

					}

				}

			} else {

				$min_match = count($key);
				$match_qty = 0;

				foreach($arr as $k => $v) {

					$match_qty = 0;

					foreach($key as $k2 => $v2) {

						if(isset($v[$k2]) && $v[$k2] == $v2) {

							++$match_qty;

						}

						if($match_qty == $min_match) {

							return $k;

						}

					}

				}

			}

		}

		return -1;

	}

	function print_r($v) {

		echo '<pre>';
		print_r($v);
		echo '</pre>';

	}

	function multi_count(&$arr, $key, $val = 0) { // Count how many times a key/value pair match is found in a multi-dimensional array

		$c = 0;

		if(!is_array($key)) {

			foreach($arr as $k => $v) {

				if($v[$key] == $val) {

					++$c;

				}

			}

		} else {

			$req = count($key);

			foreach($arr as $k => $v) {

				$j = 0;

				foreach($key as $k2 => $v2) {

					if($v[$k2] == $v2) {

						++$j;

					}

				}

				if($j == $req) {
					
					++$c;

				}

			}

		}

		return $c;

	}

	function get_view($page_settings, &$data = Array()) {

		/*
		Generate a view for a page
		If $page is page_home_page and $view = desktop, this file will include DIR . 'pub/views/desktop/view.page_home_page.php'
		*/
		global $view_output, $comps, $session, $gamo;

		if($page_settings['view'] == 'json' && isset($page_settings['allow_json']) && $page_settings['allow_json'] == 1) {
			
			$view_output = json_encode($data);
			
			return $view_output;

		}

		foreach($page_settings['pages'] as $k => $page) {
			
			$file = DIR_VIEWS . '/' . $page_settings['view'] . '/view.' . $page . '.php';
			
			if(file_exists($file)) {

				require($file);

			}

		}

	}

    // Get element for view
	function get_element($element = null, $input = array()) {
		global $view_output, $page_settings, $data;
        $file = DIR_VIEWS . '/' . $page_settings['view'] . '/elements/' . $element . '.php';
        if(file_exists($file)) {
            require($file);
            return true;
        } else {
            return false;
        }

	}

	function file_require($file) {

		global $core;
		
		if(file_exists($file)) {

			require_once($file);

		}

	}

	function import($file) {

		global $core;
		
		if(file_exists($file)) {

			require_once($file);

		}

	}

	/*
	Ensure that all indices in $defaults are set in $options
	*/
	/*
	Ensure that all indices in $defaults are set in $options
	*/
	function ensure_defaults($defaults, &$options) {

		foreach($defaults as $key => $value) {

			if(!isset($options[$key])) {

				$options[$key] = $value;

			}

		}

		return $options;

	}

	function ensure_numeric($var) {

		if(!is_array($var)) {

			return (int)$var;

		}

		foreach($var as $k => $v) {

			$var[$k] = (int)$v;

		}

		return $var;

	}

	function get_input($name, $type = 'post', $end = 'none') { // Return user passed variable in a way that wont cause issues with strict error reporting

		if(strtolower($type) == 'post') {

			$val = (isset($_POST[$name])) ? $_POST[$name] : "";

		} else {
		
			$val = (isset($_GET[$name])) ? $_GET[$name] : "";

		}

		if($end != 'none' && is_numeric($end)) {

			return substr($val, 0, $end);

		} else {

			return $val;

		}

	}

	function get_ip() {

		return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

	}

	public function user_id($cache = true) {

		global $session;

		if($cache && is_numeric(self::$user_id)) { // Retrieving the cached value is allowed and the user ID is set. Return the cached user id

			return self::$user_id;

		}

		$user_id = $session->get('user_id'); // Try to remove the user_id from the sessions
		
		if($user_id !== FALSE && $user_id != null && is_numeric($user_id)) { // User ID appears valid

			self::$user_id = $user_id;

			return $user_id;

		}

		self::$user_id = -1;

		return -1;

	}

	function error($codes, $id) {

		if(!is_array($codes)) {

			return array(
				'error_code' => 0,
				'error_msg' => $codes
			);

		}

		$k = self::multi_find($codes, 'error_code', $id);

		if($k != -1) {

			return $codes[$k];

		}

		return array(
			'error_code' => 0,
			'error_msg' => 'There was a message level error while processing your request. Error ' . $id
		);

	}

	function pro_email($email) { // Check that an e-mail is not a free e-mail service
		
		$unallowed = array(
		'yahoo.',
		'msn.',
		'gmail.',
		'live.',
		'rocketmail.',
		'hotmail.',
		'aim.',
		'outlook.',
		'mail.',
		'aol.',
		'facebook.com'
		);
		
		foreach($unallowed as $k => $string) {
		  if(stripos($email, $string) !== FALSE) {
		     return false;
		  }
		}

		return true;

 	}
 	
 	function datetime($time = 0) {

 		return Core::date_string($time);

 	}
 	
	function date_string($time = 0) {

		if($time == 0) { $time = time(); }

		return date("Y-m-d H:i:s", $time);

	}

	function shift_data($from = array()) {

		global $data;

		foreach($from as $k => $v) {

			$data[$k] = $v;

		}

	}
	
	function db_count($options = array()) { // Determine row count

		global $dbh;

		Core::ensure_defaults(array(
				'table' => '',
				'type' => 'and',
				'values' => array()
			)
		, $options);
		
		$keys = array();
		$params = array();

		foreach($options['values'] as $k => $v) {

			if(strpos($k, '!') !== FALSE) {

				$k = str_replace('!', '', $k);
				array_push($keys, $k . ' != :' . $k);
				$params[':' . $k] = $v;

			} else {

				array_push($keys, $k . ' = :' . $k);
				$params[':' . $k] = $v;

			}

		}

		$sql = 'SELECT count(*) FROM ' . $options['table'];

		if(count($keys) > 0) {

			 $sql .= ' WHERE ' . implode(' ' . $options['type'] . ' ', $keys);

		}
		
		$sth = $dbh->prepare($sql);

		$sth->execute($params);
		
		return $sth->fetchColumn();

	}

	function db_update($options = Array()) {

		global $dbh;

		Core::ensure_defaults(array(
			'dbh' => &$dbh,
			'table' => '',
			'values' => array(),
			'where' => array(),
			'where_not' => array()
		), $options);

		if(trim($options['table']) == ''
			|| !is_array($options['values']) 
			|| count($options['values']) == 0 
			|| !is_array($options['where']) 
			|| count($options['where']) == 0) {

			return 0;

		}

		$values = Array();
		$update_keys = array();
		$where_keys = array();

		foreach($options['values'] as $k => $v) {
			
			$self_update = '';

			if(strpos($k, '-') !== FALSE) {

				$self_update = '-';

			} else if(strpos($k, '+') !== FALSE) {

				$self_update = '+';

			}

			if(is_array($v)) { $v = Core::json_encode($v); }

			if($self_update == '') {

				$values[':' . $k] = $v;
				array_push($update_keys, $k . ' = :' . $k);

			} else {

				$split = explode($self_update, $k);
				$values[':' . $split[0]] = $v;
				array_push($update_keys, $split[0] . ' = ' . $split[0] . ' ' . $self_update . ' :' . $split[0]);

			}

		}

		foreach($options['where'] as $k => $v) {

			$cmp = '=';

			if(strpos($k, '=<') !== FALSE) {

				$cmp = '=<';
				$k = str_replace('=<', '', $k);

			} if(strpos($k, '<') !== FALSE) {

				$cmp = '<';
				$k = str_replace('<', '', $k);

			} else if(strpos($k, '>=') !== FALSE) {

				$cmp = '>=';
				$k = str_replace('>=', '', $k);

			} else if(strpos($k, '>') !== FALSE) {

				$cmp = '>';
				$k = str_replace('>', '', $k);

			} else if(strpos($k, '!') !== FALSE) {

				$cmp = '<';
				$k = str_replace('!=', '', $k);

			}

			array_push($where_keys, $k . ' ' . $cmp . ' :wh' . $k);
			$values[':wh' . $k] = $v;

		}

		foreach($options['where_not'] as $k => $v) {

			array_push($where_keys, $k . ' != :nw' . $k);
			$values[':nw' . $k] = $v;

		}

		$sql = "UPDATE " . addslashes($options['table']) . " SET " . implode(', ', $update_keys) . " WHERE " . implode(' AND ', $where_keys);

		$sth = $options['dbh']->prepare($sql);

		$result = $sth->execute($values);

		if($result === FALSE) {

			return false;

		}
		
		return $sth->rowCount();

	}
	
	function db_delete($options = Array()) {

		global $dbh;

		Core::ensure_defaults(array(
			'dbh' => &$dbh,
			'table' => '',
			'where' => array()
		), $options);

		if(trim($options['table']) == ''
			|| !is_array($options['where']) 
			|| count($options['where']) == 0) {

			return 0;

		}

		$where_keys = array();
		$params = array();
		
		foreach($options['where'] as $k => $v) {

			if(strpos($k, '!') !== FALSE) {

				$k = str_replace('!', '', $k);
				array_push($where_keys, $k . ' != :' . $k);
				$params[':' . $k] = $v;

			} else {

				array_push($where_keys, $k . ' = :' . $k);
				$params[':' . $k] = $v;

			}

		}

		$sql = "DELETE FROM " . addslashes($options['table']) . " WHERE " . implode(' AND ', $where_keys);
		
		$sth = $options['dbh']->prepare($sql);
		return $sth->execute($params);

	}
	
	function db_info_delete($options = Array()) {
	
		global $dbh;
	
		Core::ensure_defaults(array(
				'dbh' => &$dbh,
				'table' => '',
				'where' => array()
		), $options);
	
		if(trim($options['table']) == ''
				|| !is_array($options['where'])
				|| count($options['where']) == 0) {
	
			return 0;
	
		}

		$update_keys = array();
		$where_keys = array();

	
		foreach($options['where'] as $k => $v) {
	
			array_push($where_keys, $k . ' = :uu' . $k);
			$values[':uu' . $k] = $v;
	
		}
	
		$sql = "DELETE FROM " . addslashes($options['table']) .  " WHERE " . implode(' AND ', $where_keys);

		$sth = $options['dbh']->prepare($sql);
		return $sth->execute($values);
	
	}

	function authorize($options = array()) {

		/*
		arguments:
		{
			user_id: the id of the user
			levels: an array of authorization level(s) required. If empty, no level is test for but will still test if the user id is valid. Defaults to empty
				{
					'admin',
					'moderator',
					..
					..
				}
			redirect: if empty, will not redirect. Or, can be set to redirect to a page
		}

		returns:
		if succesful:
			{
				valid: 0
			}

		or this function can also redirect
		*/

		Core::ensure_defaults(array(
				'user_id' => 'get',
				'levels' => array(),
				'redirect' => '/?p=register'
			)
		, $options);

		// Determine if the user id is valid
		global $gamo, $session, $data;

		if($options['user_id'] == 'get') {

			if(isset($data['user_id']) && is_numeric($data['user_id'])) {

				$options['user_id'] = $data['user_id'];

			} else {

				$options['user_id'] = $session->get('user_id');

			}			

		}


		$c = Core::db_count(array(
				'table' => GAMO_DB . '.users',
				'values' => array(
					'user_id' => $options['user_id']
				)
			)
		);

		if($c == 0) { // The user id is not valid

			if($options['redirect'] == '') {

				return array(
					'valid' => 0,
				);

			} else {

				header("Location: " . $options['redirect']);
				die();

			}

		}

		// Ensure that the levels entry is an array
		if(!is_array($options['levels'])) {

			$options['levels'] = array($options['levels']);

		}
		
		// Ensure that a has user all access level
		foreach($options['levels'] as $k => $level) {

			if($session->get('access_' . $level) != 1) {

				if($options['redirect'] == '') {

					return array(
						'valid' => 0,
					);

				} else {

					header("Location: " . $options['redirect']);
					die();

				}

			}

		}

		Core::set('last_activity', time(), 0, $session->get_session_duration());

		return array(
			'valid' => 1
		);

	}

	function log($options = array()) {

		/*
		args:
		{
			info_type:
			info_a
			info_b
			ip
			request
		}
		*/

		Core::ensure_defaults(array(
				'info_type' => '',
				'info_a' => '',
				'info_b' => '',
				'info_c' => '',
				'ip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '',
				'request' => (isset($_SERVER) && is_array($_SERVER)) ? json_encode($_SERVER) : '',
				'datetime' => Core::date_string()
			)
		, $options);

		try {

			Core::db_insert(array(
				'table' => GAMO_DB . '.log',
				'values' => array(
						'info_type' => $options['info_type'],
						'info_a' => $options['info_a'],
						'info_b' => $options['info_b'],
						'info_c' => $options['info_c'],
						'ip' => $options['ip'],
						'request' => $options['request'],
						'datetime' => $options['datetime']
					)
				)
			);

		} catch (Exception $e) {

			

		}

	}
	
	function set($key, $var, $flag = 0, $expire = 0) {

		global $mc;

		return $mc->set(SITE . '_' . $key, $var, $flag, $expire);

	}

	function delete($key) {

		global $mc;

		return $mc->delete(SITE . '_' . $key);

	}

	function set_cookie($options = array()) {

		Core::ensure_defaults(array(
			'key' => '',
			'value' => '',
			'delete' => 0
		), $options);

		if($options['delete'] == 1) {

			setcookie($options['key'], $options['value'], time()-86400*30, '/'); // Set an expiry time for the session

		} else {

			setcookie($options['key'], $options['value'], time()+86400*30, '/'); // Set an expiry time for the session

		}

		return true;

	}

	function get_cookie($key) {

		return (isset($_COOKIE[$key])) ? $_COOKIE[$key] : false;

	}

	function get($key) {

		global $mc;

		return $mc->get(SITE . '_' . $key);

	}

	function safe_echo($string) {

		return htmlspecialchars($string);

	}

}

$core = new Core();
?>
