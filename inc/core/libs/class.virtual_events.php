<?php
//this is not an instance from the ORM perspective, rather interface to table
//interface handles the validation? - 
class Core_Virtual_Events {
	
	static $table_name = 'virtual_events';
	static $action_slug = 'attend_virtual_event';
	
	
	public $now;
	
	
	//Core::error($this->errors, 10);
	
	function __construct(){
		
		$this->now = date('Y-m-d H:i:s');
		//$this->now = '2013-07-30 13:00:00';
		error_log($this->now);
		
		$this->errors = array(
			array(
				'error_code' => 1,
				'error_msg' => 'Missing required paramaters.'
			),
			array(
				'error_code' => 2,
				'error_msg' => 'Failed to prepare DB statement.'
			),
			array(
				'error_code' => 3,
				'error_msg' => 'Failed to execute DB statement.'
			),
			array(
				'error_code' => 4,
				'error_msg' => 'Failed. Received a PDOException.'
			),
			array(
				'error_code' => 5,
				'error_msg' => 'Failed to find the action_types_id.'
			),
			array(
				'error_code' => 6,
				'error_msg' => 'Failed to find the action_types_id.'
			),
			array(
				'error_code' => 7,
				'error_msg' => 'Failed validating input values.'
			),
			array(
				'error_code' => 8,
				'error_msg' => 'Invalid event id specified'
			),
			array(
				'error_code' => 9,
				'error_msg' => 'Please select the location you would like to attend'
			)
		);
	}
	
	function validate_notempty( $options=array() ){
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['to_validate'] ) ){
			return false;
		}else{
			return true;
		}
		
	}
	
	function validate_length( $options=array() ){
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['to_validate'] ) or empty( $options['length'] ) ){
			return false;
		}
		
		if( strlen( $options['to_validate'] ) > intval($options['length']) ){
			return false;
		}else{
			return true;
		}
		
	}
	
	function validate_datetime( $options=array()){
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['date'] ) ){
			return false;
		}

		$date = strtotime( $options['date'] );

		if(!$date ){
			//Error related to incorrect format
			return false;
		}
		
		//Take care of the leap year 
		return checkdate(date("m",$date), date("d",$date), date("Y",$date) );

		
	}
	
	function validate_title( $options=array() ){
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['title'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if( !$this->validate_notempty( array( 'to_validate' => $options['title'] ) ) ){
			$error = Core::error($this->errors, 7);
			$error['error_msg'] .= 'Event title cant be empty. Title['.$options['title'].']';
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if( !$this->validate_length( array( 'to_validate' => $options['title'], 'length' => 255 ) ) ){
			$error = Core::error($this->errors, 7);
			$error['error_msg'] .= 'Event title cant be longer than 255 chars. Title['.$options['title'].']';
			$error['error_msg'] .= $error_append;
			return $error;
		}
			
		return $options['title'];

	}
	
	function validate_description( $options=array() ){
	
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		if( empty( $options['description'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
	
		if( !$this->validate_notempty( array( 'to_validate' => $options['description'] ) ) ){
			$error = Core::error($this->errors, 7);
			$error['error_msg'] .= 'Event description cant be empty. ';
			$error['error_msg'] .= $error_append;
			return $error;
		}
	
		if( !$this->validate_length( array( 'to_validate' => $options['description'], 'length' => 255 ) ) ){
			$error = Core::error($this->errors, 7);
			$error['error_msg'] .= 'Event description cant be longer than 255 chars. ';
			$error['error_msg'] .= $error_append;
			return $error;
		}
			
		return $options['description'];
	
	}
	
	function validate_event_date( $options=array() ){
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['date'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if( !$this->validate_datetime( array( 'date' => $options['date'] ) ) ){
			$error = Core::error($this->errors, 7);
			$error['error_msg'] .= 'Event date not valid format. ';
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$date_now = strtotime( date('Y-m-d') );
		$test_date = strtotime( date('Y-m-d', strtotime( $options['date'] ) ) );
		
		if( $test_date < $date_now ){
			$error = Core::error($this->errors, 7);
			$error['error_msg'] .= 'Event date cant be in the past. ';
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		return $options['date'];
		
	}
	
	function create_event( $options=array() ){
		//TODO: Validate for title, date/time, description:
			//length = 255, present
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		Core::ensure_defaults(array(
				'title_unique' => 1
			), $options
		);
		
		if( empty( $options['title'] ) or empty( $options['description'] ) or empty( $options['date'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$values['title'] = $this->validate_title( array('title' => $options['title']) );
		if(Core::has_error( $values['title'] )){
			return $values['title'] ;
		}
		
		$values['description'] = $this->validate_description( array('description' => $options['description']) );
		if(Core::has_error( $values['description'] )){
			return $values['description'];
		}
		
		$values['date_time'] = $this->validate_event_date( array('date' => $options['date']) );
		if(Core::has_error( $values['date_time'] )){
			return $values['date_time'];
		}
		
		if($options['title_unique']){
			//TODO:Check if the title unique
			if( Core::db_count( array(
				'table' => CORE_DB.".".self::$table_name,
				'values' => array(
					'title' => $values['title']
				)
			))){
				$error = Core::error($this->errors, 7);
				$error['error_msg'] .= 'Event title must be unique. ';
				$error['error_msg'] .= $error_append;
				return $error;
			}
		}
		
		
		$result = Core::db_insert( array(
				'table' => CORE_DB.".".self::$table_name,
				'values' => $values
		));
		
		if( Core::has_error($result) or empty($result) ){
			$result['error_msg'] .= $error_append;
			return $result;
		}
		
		return $result;
		
	}
	
	public function edit_event( $options=array() ){
		//TODO: Validate for title, date/time, description:
			//length = 255
			//must have id
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		$values = array();
		
		if( empty( $options['id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		http://gamo-framework.local/?a=create_event&title=Test&description=random&date=2013-07-12%2011:00
		Core::ensure_defaults(array(
				'title_unique' => 1
			), $options
		);
		
		
		if( isset($options['title']) ){ 
			$values['title'] = $this->validate_title( array('title' => $options['title']) );
			if(Core::has_error( $values['title'] )){
				return $values['title'] ;
			}
			
			if($options['title_unique']){
				//TODO:Check if the title unique
				if( !Core::db_count( array(
						'table' => CORE_DB.".".self::$table_name,
						'values' => array(
								'title' => $values['title']
						)
				))){
					$error = Core::error($this->errors, 7);
					$error['error_msg'] .= 'Event title must be unique. ';
					$error['error_msg'] .= $error_append;
					return $error;
				}
			}
		}
		
		if( isset($options['description']) ){
			$values['description'] = $this->validate_description( array('description' => $options['description']) );
			if(Core::has_error( $values['description'] )){
				return $values['description'];
			}
		}
		
		if( isset($options['date']) ){
			$values['date_time'] = $this->validate_event_date( array('date' => $options['date']) );
			if(Core::has_error( $values['date_time'] )){
				return $values['date_time'];
			}
		}
		
		$result = Core::db_update( array(
			'table' => CORE_DB.".".self::$table_name,
			'values' => $values,
			'where' => array(
				'id' => $options['id']
			)
		));
		
		if( Core::has_error($result) or empty($result) ){
			$result['error_msg'] .= $error_append;
			return $result;
		}
		
		return $result;
		
	}
	
	public function add_user( $options=array() ){
		
		global $gamo;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) or empty( $options['event_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		Core::ensure_defaults(array(
				'action_key' => 'rsvp_vevent',
				'event_id' => -1,
				'location' => 'none'
		),$options);
		
		// Retrieve event type
		$event_type = Core::fetch_column(
			"SELECT event_type FROM " . CORE_DB . ".virtual_events WHERE id = :id",
			array(
				':id' => $options['event_id']
			)
		);

		$c = Core::db_count(array(
				'table' => CORE_DB . '.virtual_events_info',
				'values' => array(
					'event_id' => $options['event_id'],
					'info_type' => 'event_location'
				)
			)
		);

		$use_location = false;

		// Location is required. Determine if user has selected a valid location
		if($c > 0) {

			$c = Core::db_count(array(
					'table' => CORE_DB . '.virtual_events_info',
					'values' => array(
						'event_id' => $options['event_id'],
						'info_type' => 'event_location',
						'info_b' => $options['location']
					)
				)
			);

			if($c == 0) { // User did not select a valid location

				$error = Core::error($this->errors, 9);
				$error['error_msg'] .= $error_append;
				return $error;

			} else {

				$use_location = true;

			}

		}

		$options['action_key'] = ($event_type == 1) ? 'rsvp_vevent' : 'rsvp_ftf';

		$action_types_id = Core::r('actions')->action_types_id(array(
				'action_key' => $options['action_key']
			)
		);

		if( Core::has_error($action_types_id) or empty($action_types_id) ){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		//error_log(print_r($action_types_id,true));
		//error_log($options['user_id']);
		//error_log($options['event_id']);
		
		//TODO: Make sure the user is not there
		//get_action_id_for_user
		if( $test = $this->get_action_id_for_user( array(
			'action_type_id' => $action_types_id,
			'user_id' => $options['user_id'],
			'event_id' => $options['event_id']
		) ) ){
			$error = Core::error($this->errors, 7);
			$error['error_msg'] .= 'User already part of this event. ';
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		//error_log(print_r($test,true));
		
		
		$result = Core::r('actions')->create_action( array( 
			'action_types_id' => $action_types_id, 
			'user_id' => $options['user_id'],
			'int_other' =>  $options['event_id']
		) );

		if( Core::has_error($result) or empty($result) ){
			$result['error_msg'] .= $error_append;
			return $result;
		}

		if($use_location) { // Save attendance location

			Core::r('actions')->create_action_info(array( 
					'action_id' => $result['action_id'], 
					'info_type' => 'event_location',
					'info' => $options['location']
				) 
			);

		}
		
		$user = Core::r('users')->get_user(array(
				'user_id' => $options['user_id'],
				'get_has' => 1
			)
		);

		/*
		// Email the invite to the user
		Core::r('invite')->send_invite(array(
				'event_id' => $options['event_id'],
				'invite_info' => array(
					'from_user_id' => $options['user_id'],
					'to_name' => $user['first_name'] . ' ' . $user['last_name'],
					'to_company' => $user['company'],
					'email' => $user['email'],
					'invite_key' => '',
					'msg' => '',
					'event_id' => $options['event_id']
				),
				'subject' => 'Your virtual event invite',
				'self_send' => 1
			)
		);
		*/

		//error_log('Here');
			
		return $result;
		
	}
	
	function get_new_events_count(){
		
		global $gamo, $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		$sql = 	"SELECT count(*) as count FROM ".CORE_DB.".".self::$table_name.
		" WHERE end_time > '".$this->now."'";
		
		//error_log($sql);
		
		try{
		
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$sres = $stm->execute();
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$id = $stm->fetch(PDO::FETCH_ASSOC);
		
		}catch(PDOException $e){
			$error = Core::error($this->errors, 4);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		//error_log( print_r( $id, true ) );
		
		if( !empty( $id['count'] ) ){
		
			return $id['count'] ;
		
		}else{
		
			return false;
		
		}
		
	}
	
	function get_new_events( $options=array() ){
		
		//TODO: Must remove any events that the user is part of already
		
		global $gamo, $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		Core::ensure_defaults(array(
				'start' => 0,
				'number' => 1
			),
		$options);
		
		$sql = "SELECT id FROM " . CORE_DB . "." . self::$table_name.
		" WHERE active = 1 and hide = 0 ORDER BY date_time ASC LIMIT ".$options['start'].",".$options['number'];

		$sth = $dbh->prepare($sql);

		$vevents = array();
		$sth->execute();

		while($row = $sth->fetch()) {

			$row = Core::r('virtual_events')->get_event(array(
					'id' => $row['id'],
					'public_has' => 1,
					'show_private_has' => 0
				)
			);

			array_push($vevents, $row);

		}

		return $vevents;
		
	}
	
	function get_new_events_no_page(){
	
		//TODO: Must remove any events that the user is part of already
	
		global $gamo, $dbh;
	
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";

	
		$sql = "SELECT id FROM " . CORE_DB . "." . self::$table_name.
		" WHERE active = 1 and hide = 0 ORDER BY date_time ASC";
	
		$sth = $dbh->prepare($sql);
	
		$vevents = array();
		$sth->execute();


		while($row = $sth->fetch()) {
	
			$row = Core::r('virtual_events')->get_event(array(
					'id' => $row['id'],
					'public_has' => 1,
					'show_private_has' => 0
				)
			);


			array_push($vevents, $row);
	
		}
	
		return $vevents;
	
	}

	/*
	Retrieve the details for an event
	*/
	function get_event($options = array()) {

		/*
		args:
		{
			id: the event id
			get_has: 1 = retrieve info table values, 0 = do not retrieve info table values
			show_private_has: 1 = show has values that should only be privately accessible (to devs), 0 = do not show
		}
		*/

		Core::ensure_defaults(array(
				'id' => -1,
				'get_has' => 1,
				'show_private_has' => 1
			)
		, $options);

		global $dbh;

		$sql = "SELECT
		id,
		title,
		description,
		date_time,
		date_time as date,
		end_time,
		event_type,
		event_type,
		active,
		summary
		FROM " . CORE_DB . ".virtual_events
		WHERE id = :id
		";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':id' => $options['id']
			)
		);

		$event = $sth->fetch();

		if(!is_array($event)) { // Could not find event

			return Core::error($this->errors, 8);

		}

		$event = Core::remove_numeric_keys($event);
		$event['has'] = array();

		if($options['show_private_has'] == 1) {

			$params = array(
				'event_id' => $options['id']
			);

			$filters = Core::db_params(array(
					'values' => $params
				)
			);

		} else {

			$filters['sql'] = "event_id = :event_id AND (info_type = 'livestream_id' OR info_type = 'coveritlive_id' OR info_type = 'launched' OR info_type = 'event_location')";
			$filters['params'] = array(
				':event_id' => $options['id']
			);

		}

		// Retrieve has values
		$sql = "SELECT
		virtual_events_info_id,
		event_id,
		info_type,
		int_info,
		info,
		info_b,
		time
		FROM
		" . CORE_DB . ".virtual_events_info
		WHERE " . $filters['sql'];

		$sth = $dbh->prepare($sql);

		$sth->execute($filters['params']);

		while($row = $sth->fetch()) {

			array_push($event['has'], Core::remove_numeric_keys($row));

		}
		
		return $event;

	}
	
	function get_events_user_count( $options=array() ){
		//array( 'user_id' => $user_id)
		global $gamo, $dbh;
	
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
	
		if( empty( $options['user_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
	
		$action_types_vevent = Core::r('actions')->action_types_id(array(
				'action_key' => 'rsvp_vevent'
			)
		);

		$action_types_ftf = Core::r('actions')->action_types_id(array(
				'action_key' => 'rsvp_ftf'
			)
		);

		if( Core::has_error($action_types_vevent) or empty($action_types_vevent) ){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		

		$sql = 	"SELECT
		count(ve.id) as count
		FROM ".CORE_DB.".".self::$table_name." as ve ".
		"INNER JOIN ".CORE_DB.".actions_log as al on ve.id=al.int_other ".
		"WHERE al.action_types_id IN (" . $action_types_vevent . ", " . $action_types_ftf . ") AND ".
		"user_id = :user_id AND al.active = 1 AND al.point_value_use IS NOT NULL AND al.point_value_use > 0 ";
	
		//error_log($sql);
		
		try{
	
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= $error_append;
				return $error;
			}
	
			$sres = $stm->execute( array(
					':user_id' => $options['user_id']
			) );
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= $error_append;
				return $error;
			}
	
			$id = $stm->fetch(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){

			$error = Core::error($this->errors, 4);
			$error['error_msg'] .= $error_append;
			return $error;
		}
	
		if( !empty( $id['count'] ) ){
	
			return $id['count'];
	
		}else{
	
			return false;
	
		}
	
	}
	
	function get_events_user_ids( $options=array() ){
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$ids_ar = $this->get_events_user($options);
		$ids = array();

		if(!is_array($ids_ar)) { $ids_ar = array(); }

		foreach($ids_ar as $id){
			$ids[] = $id['id'];
		}
		
		return $ids;
	}

	function get_events_user_future_ids( $options=array() ){
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$ids_ar = $this->get_events_user_future($options);
		$ids = array();

		if(!is_array($ids_ar)) { $ids_ar = array(); }

		foreach($ids_ar as $id){
			$ids[] = $id['id'];
		}
		
		return $ids;
	}
	
	function get_events_user_future( $options=array() ){
		
		global $gamo, $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$action_types_vevent = Core::r('actions')->action_types_id(array(
				'action_key' => 'rsvp_vevent'
			)
		);

		$action_types_ftf = Core::r('actions')->action_types_id(array(
				'action_key' => 'rsvp_ftf'
			)
		);

		if( Core::has_error($action_types) or empty($action_types) ){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		
		$sql = 	"SELECT id FROM ".CORE_DB.".".self::$table_name.
		" WHERE id IN (SELECT int_other FROM `".CORE_DB."`.`actions_log` WHERE action_types_id IN (" . $action_types_vevent . ", " . $action_types_ftf . ") AND ".
		"user_id = :user_id AND active = 1) AND date_time > '".$this->now."'";
		
		//error_log($sql);
		//error_log(print_r($action_types,true));
		//error_log(print_r($options['user_id'],true));
		
		try{
		
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$sres = $stm->execute( array(
					':user_id' => $options['user_id']
			) );
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= $error_append;
				return $error;
			}
		
			$id = $stm->fetchAll(PDO::FETCH_ASSOC);
			//error_log(print_r($id,true));
		
		}catch(PDOException $e){
			$error = Core::error($this->errors, 4);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if( !empty( $id ) ){
		
			return $id;
		
		}else{
		
			return false;
		
		}
		
	}

	
	function get_events_user( $options=array() ){
		//array( 'user_id' => $user_id)
		global $gamo, $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		Core::ensure_defaults(array(
				'start' => 0,
				'number' => 100
			),
		$options);
		
		$action_types_vevent_rsvp = Core::r('actions')->action_types_id(array(
				'action_key' => 'rsvp_vevent'
			)
		);
		
		$action_types_vevent_attend = Core::r('actions')->action_types_id(array(
				'action_key' => 'attend_vevent'
			)
		);

		$action_types_ftf_rsvp = Core::r('actions')->action_types_id(array(
				'action_key' => 'rsvp_ftf'
			)
		);
		
		$action_types_ftf_attend = Core::r('actions')->action_types_id(array(
				'action_key' => 'attend_ftf'
			)
		);

		if( Core::has_error($action_types_vevent_rsvp) or empty($action_types_vevent_rsvp) ){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		if( Core::has_error($action_types_vevent_attend) or empty($action_types_vevent_attend) ){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		
		//error_log(print_r($action_type,true));
		//error_log(print_r($action_types,true));
		//error_log(print_r($options['user_id'],true));
		
		$sql = 	"SELECT
			ve.id as id,
			date_time as date,
			title as name,
			(
				SELECT
				int_info
				FROM " . CORE_DB . ".virtual_events_info AS a
				WHERE a.event_id = ve.id
				AND a.info_type = 'launched'
			) AS launched,
			al.point_value_use+COALESCE( (
				SELECT
					al2.point_value_use
				FROM ".CORE_DB.".actions_log as al2
				WHERE 
					al2.user_id = ".$options['user_id']."
					AND al2.action_types_id IN (".$action_types_vevent_attend.",".$action_types_ftf_attend.")
					AND al2.int_other = ve.id
					AND al2.active = 1
			),0 ) as points,
			ve.event_type AS event_type
			FROM ".CORE_DB.".".self::$table_name." as ve ".
			"INNER JOIN ".CORE_DB.".actions_log as al on ve.id=al.int_other ".
			"WHERE al.action_types_id IN (".$action_types_vevent_rsvp.",".$action_types_ftf_rsvp.") AND ".
			"user_id = :user_id AND al.active = 1 AND al.point_value_use IS NOT NULL AND al.point_value_use > 0 ORDER BY date_time ASC LIMIT ".$options['start'].",".$options['number'];
		
		//error_log($sql);
		//,".$action_types_attend.")
		
		$stm = $dbh->prepare($sql);
		if( empty($stm) ){
			$error = Core::error($this->errors, 2);
			$error['error_msg'] .= $error_append;
			return $error;
		}
	
		$sres = $stm->execute( array(
				':user_id' => $options['user_id']
		) );
		if( empty($sres) ){
			$error = Core::error($this->errors, 3);
			$error['error_msg'] .= $error_append;
			return $error;
		}
	
		$id = $stm->fetchAll(PDO::FETCH_ASSOC);
		
		if( !empty( $id ) ){
		
			return $id;
		
		}else{
		
			return false;
		
		}
		
	}
	
	public function remove_user( $options=array() ){
		
		global $gamo;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['user_id'] ) or empty( $options['event_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		
		$action_types_id = Core::r('actions')->action_types_id(array(
				'action_key' => 'rsvp_vevent'
			)
		);

		if( Core::has_error($action_types_id) or empty($action_types_id) ){
			$error = Core::error($this->errors, 5);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		
		$action_id = $this->get_action_id_for_user( array( 
			'action_type_id' => $action_types_id,
			'user_id' => $options['user_id'],
			'event_id' => $options['event_id']
		) );
		if( Core::has_error($action_id) or empty($action_id) ){
			$error = Core::error($this->errors, 6);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		
		$result = Core::r('actions')->modify_action( array( 'action_id' => $options['action_id'], 'values' => 'delete') );
		if( Core::has_error($result) or empty($result) ){
			$result['error_msg'] .= $error_append;
			return $result;
		}
			
		return $result;
		
	}
	
	
	public function get_action_id_for_user( $options=array() ){
		//TODO: Must get action_type_id, user_id, event_id
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		//error_log(print_r($options['action_type_id'],true));
		//error_log(print_r($options['user_id'],true));
		//error_log(print_r($options['event_id'],true));
		
		if( empty( $options['action_type_id'] ) or empty( $options['user_id'] ) or empty( $options['event_id'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}

		$sql = "SELECT action_id FROM `".CORE_DB."`.`actions_log` WHERE action_types_id = :action_types_id AND user_id = :user_id ".
				"AND int_other = :event_id AND active = 1";
		
		//error_log($sql);
		
		try{
				
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= $error_append;
				return $error;
			}
				
			$sres = $stm->execute( array( 
				':action_types_id' => $options['action_type_id'],
				':user_id' => $options['user_id'],
				':event_id' => $options['event_id']
			 ) );
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= $error_append;
				return $error;
			}
				
			$id = $stm->fetch(PDO::FETCH_ASSOC);
				
		}catch(PDOException $e){
			$error = Core::error($this->errors, 4);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		//error_log(print_r($id,true));
		
		if( !empty( $id['action_id'] ) ){
				
			return $id['action_id'];
				
		}else{
				
			return false;
				
		}
		
	}
	
	function get_action_type_for_slug( $options=array() ){
		
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['slug'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$sql = "SELECT * FROM `".CORE_DB."`.`action_types_info` WHERE info_type = :infotype";
		
		//error_log($sql);
		//error_log($options['slug']);
		
		try{
				
			$stm = $dbh->prepare($sql);
			if( empty($stm) ){
				$error = Core::error($this->errors, 2);
				$error['error_msg'] .= $error_append;
				return $error;
			}
				
			$sres = $stm->execute( array( ':infotype' => $options['slug'] ) );
			if( empty($sres) ){
				$error = Core::error($this->errors, 3);
				$error['error_msg'] .= $error_append;
				return $error;
			}
				
			$id = $stm->fetch(PDO::FETCH_ASSOC);
				
		}catch(PDOException $e){
			$error = Core::error($this->errors, 3);
			$error['error_msg'] = " PDO MESSAGE[".$e->getMessage()."]";
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		//TODO: check the value of id or exception try catch
		if( !empty( $id ) ){
				
			return $id;
				
		}else{
				
			return false;
				
		}
		
	}
	
	function get_action_id_for_slug( $options=array() ){
		
		global $dbh;
		
		$error_append = " CLASS[".__CLASS__."] METHOD[".__METHOD__."] DATE[".date('Y-m-d H:i:s')."]";
		
		if( empty( $options['slug'] ) ){
			$error = Core::error($this->errors, 1);
			$error['error_msg'] .= $error_append;
			return $error;
		}
		
		$id = $this->get_action_type_for_slug( $options );
		
		//error_log(print_r($id,true));
		
		//TODO: check the value of id or exception try catch
		if( !empty( $id['action_types_id'] ) ){
			
			return $id['action_types_id'];
			
		}else{
			
			return false;
			
		}
		
	}
	
}
