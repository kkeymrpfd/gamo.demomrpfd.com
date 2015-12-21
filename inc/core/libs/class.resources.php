<?
/*
Module to allow for the sharing of resources such as pdfs, docs, youtube videos, etc
Any type of resource can be uploaded and shared. Permissions can also be set for sharing and downloading.
Surveys can also be linked to a resource

The goal is to use a controller called control.create_resource.php which handles the file upload.
After uploading the resource type, it is passed to $this->create_resource which actually creates the resource
as well as passes the parameters through validation
*/
class Core_Resources {
	
	public $errors;
	public $resource_types; // valid resource types
	public $title_max_length; // max length of the title

	function __construct() {

		$this->title_max_length = 200;

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Could not locate resource'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Could not determine resource type'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Unsupported resource type'
			),
			array(
				'error_code' => '4',
				'error_msg' => 'No title was specified'
			),
			array(
				'error_code' => '5',
				'error_msg' => 'The title is cannot exceed ' . $this->title_max_length . ' characters in length long'
			),
			array(
				'error_code' => '6',
				'error_msg' => 'There is already a resource with the same title'
			),
			array(
				'error_code' => '7',
				'error_msg' => 'Could not create resource'
			),
			array(
				'error_code' => '8',
				'error_msg' => 'Invalid resource specified'
			),
			array(
				'error_code' => '9',
				'error_msg' => 'This resource appears to have already been uploaded'
			),
			array(
				'error_code' => '10',
				'error_msg' => 'Please provide a description for this resource'
			)
		);

		// Valid resource types
		$this->resource_types = array(
			array(
				'type' => 'pdf',
				'display_type' => 'PDF'
			),
			array(
				'type' => 'doc',
				'display_type' => 'Word Document'
			),
			array(
				'type' => 'powerpoint',
				'display_type' => 'Powerpoint'
			),
			array(
				'type' => 'spreadsheet',
				'display_type' => 'Excel Spreadsheet'
			),
			array(
				'type' => 'video',
				'display_type' => 'Video File'
			),
			array(
				'type' => 'image',
				'display_type' => 'Image File'
			),
			array(
				'type' => 'youtube',
				'display_type' => 'Youtube Video'
			),
			array(
				'type' => 'url',
				'display_type' => 'Website'
			)
		);

	}

	/*
	Detect resource type
	*/
	function validate_resource($options = array()) {

		/*
		args:
		{
			location: resource location (url or filesystem)
			type: get = auto-determine resource type, or pass type
		}

		returns:
			success:
			{
				valid: 1 = valid
				type: the resource type
			}

			error:
			std error
		*/

		/*
		Specify acceptable file types

		if type is not "get", then check if the file type is acceptable.
		else, determine filetype using php fileinfo and determine if filetype is acceptable
		make sure to check that the file actually exists or the url is valid (set timeout to 10 seconds)
		*/

		Core::ensure_defaults(array(
				'location' => '',
				'type' => 'get'
			)
		, $options);
		
		// Determine if this is a url
		if($options['type'] == 'get'
		&& file_exists($options['location'])) { // Determine if this is a file

			// This is file. Try to determine file type
			$ext = pathinfo($options['location'], PATHINFO_EXTENSION);

			if($ext === FALSE || $ext == '') { // Could not determine resource extension

				return Core::error($this->errors, 2);

			} else { // Extension determined

				$type = Core::multi_find($this->resource_types, 'type', $ext); // Determine if this extension is supported

				if($type == -1) { // unsupported resource type 

					return Core::error($this->errors, 2);

				} else { // resource type is supported

					$options['type'] = $type;

				}

			}

		} else if($options['type'] != 'video'
		&& !file_exists($options['location'])) { // Invalid resource or could not validate resource

			return Core::error($this->errors, 1);

		} else if($options['type'] == 'video'
		&& $options['location'] == '') { // Missing video

			return Core::error($this->errors, 1);

		}

		return array(
			'valid' => 1,
			'type' => $options['type']
		);

	}

	/*
	Validate title
	*/
	function validate_title($options = array()) {

		/*
		args:
		{
			title: resource title
			resource_id: -1 = check against all resources for uniqueness of title
							other # = check against all resources except the given resource_id for uniqueness
		}

		returns:
			success:
			{
				valid: 1
			}

			error:
			std error
		*/

		Core::ensure_defaults(array(
				'title' => '',
				'resource_id' => -1
			)
		, $options);

		if(trim($options['title']) == '') { // No title was specified

			return Core::error($this->errors, 4);

		}

		// Determine if length of title is acceptable
		if(strlen($options['title']) > $this->title_max_length) {

			return Core::error($this->errors, 5);

		}

		$options['title'] = ltrim(rtrim($options['title']));

		if($options['resource_id'] == -1) { // Determine if this title is unique without taking into consideration a resource_id

			$c = Core::db_count(array(
					'table' => CORE_DB . '.resources',
					'values' => array(
						'title' => $options['title']
					)
				)
			, $options);

		} else { // Determine if this title is unique factoring with the exception of a certain resource id

			$c = Core::fetch_column(
				"SELECT count(*)
					FROM " . CORE_DB . ".resources
					WHERE
					title = :title
					AND resource_id != :resource_id",
					array(
						':title' => $options['title'],
						':resource_id' => $options['resource_id']
					)
				);

		}

		if($c > 0) { // There is already a resource with this title

			return Core::error($this->errors, 6);

		}

		return array(
			'valid' => 1
		);

	}

	/*
	Create a new resource
	*/
	function create_resource($options) {

		/*
		args:
		{
			user_id: user that is adding this resource
			title: the title of the resource
			descrip: the description of the resource
			type: the type of resource (get = auto detect)
			location: the location of the resource
			time_added: the time the resource was added
		}

		returns:
			success:
			{
				resource_id: the id of the uploaded resource
			}

			error:
			std error
		*/

		/*
		Validate that user has permission to upload a resource
		Validate title
		Validate location
		Validate type

		Create resource
		*/

		Core::ensure_defaults(array(
				'user_id' => -1,
				'title' => '',
				'descrip' => '',
				'type' => 'get',
				'location' => '',
				'time_added' => Core::date_string(),
				'file_name' => Core::date_string() . ' ' . rand(11111, 99999)
			)
		, $options);

		global $gamo;

		$title = Core::r('resources')->validate_title(array(
				'title' => $options['title']
			)
		);

		if(Core::has_error($title)) {

			return $title;

		}

		if(trim($options['descrip']) == '') {

			return Core::error($this->errors, 10);

		}
		
		$location = Core::r('resources')->validate_resource(array(
				'location' => $options['location'],
				'type' => $options['type']
			)
		);

		if(Core::has_error($location)) {

			return $location;

		}

		$c = Core::db_count(array(
				'table' => CORE_DB . '.resources',
				'values' => array(
					'title' => $options['title'],
					'descrip' => $options['descrip'],
					'type' => $location['type'],
					'location' => $options['file_name'],
					'user_id' => $options['user_id']
				)
			)
		);

		if($c > 0) {
			
			return Core::error($this->errors, 9);

		}

		if($options['type'] != 'video') {

			$dest = DIR_STORE . '/resources/' . $options['file_name'];

			copy($options['location'], $dest);
			unlink($options['location']);

		} else {

			$options['file_name'] = $options['location'];

			$options['file_name'] = str_replace("http:", "", $options['file_name']);
			$options['file_name'] = str_replace("watch?v=", "embed/", $options['file_name']);

		}

		// Try creating resource
		$resource_id = Core::db_insert(array(
				'table' => CORE_DB . '.resources',
				'values' => array(
					'title' => $options['title'],
					'descrip' => $options['descrip'],
					'type' => $location['type'],
					'location' => $options['file_name'],
					'time_added' => $options['time_added'],
					'user_id' => $options['user_id'],
					'active' => 1
				)
			)
		);

		if(!is_numeric($resource_id)) { // Could not create resource

			return Core::error($this->errors, 7);

		}

		return array(
			'resource_id' => $resource_id
		);

	}

	/*
	Edit an existing resource
	*/
	function edit_resource($options) {

		/*
		args:
		{
			resource_id: the resource to edit
			user_id: the user editing this resource
			values: { // array of values to update (if set to "delete", will delete resource)
				title: the title of the resource
				descrip: the description of the resource
				type: the type of resource (get = auto detect)
				location: the location of the resource
			}
		}

		returns:
			success:
			{
				valid: 1 = valid
			}

			error:
			std error
		*/

		Core::ensure_defaults(array(
				'resource_id' => -1,
				'user_id' => 'allow',
				'values' => array()
			)
		, $options);

		// Determine if resource_id is valid
		$c = Core::db_count(array(
				'table' => CORE_DB . '.resources',
				'values' => array(
					'resource_id' => $options['resource_id']
				)
			)
		);

		if($c == 0) { // Invalid resource specified

			return Core::error($this->errors, 8);

		}

		global $gamo;

		// Validate title if one is specified
		if( isset($options['values']['title']) ) {

			$title = Core::r('resources')->validate_title(array(
					'title' => $options['title'],
					'resource_id' => $options['resouce_id']
				)
			);

			if(Core::has_error($title)) {

				return $title;

			}

		}

		// Validate location if one is specified
		if( isset($options['values']['location']) ) {

			// Set type to "get" if type is not set
			if(!isset($options['values']['type']) ) {

				$options['values']['type'] = 'get';

			}

			$resource = Core::r('resources')->validate_resource(array(
					'location' => $options['loation'],
					'resource_id' => $options['values']['type']
				)
			);

			if(Core::has_error($resource)) {

				return $resource;

			}

		}

	}

	/*
	Delete a resource
	*/
	function delete_resource($options = array()) {

		/*
		args:
		{
			resource_id: the resource to delete
			delete_awards:  0 = DO NOT delete points/badges awarded as a result of downloadind/sharing this resource (default)
							1 = Delete points/badges awarded as a result of downloadind/sharing this resource
		}

		returns:
		if success:
		{
			deleted: 1
		}

		if error: std error
		*/

		Core::ensure_defaults(array(
				'resource_id' => -1,
				'delete_awards' => 0
			)
		, $options);

		Core::db_update(array(
				'table' => CORE_DB . ".resources",
				'values' => array(
					'active' => 0
				),
				'where' => array(
					'resource_id' => $options['resource_id']
				)
			)
		);

		if($options['delete_awards'] == 1) {

			global $dbh, $gamo;

			$download_action_type = Core::r('actions')->action_types_id(array(
	        		'action_key' => 'download_resource'
	        	)
	        );

	        $share_action_type = Core::r('actions')->action_types_id(array(
	        		'action_key' => 'share_resource'
	        	)
	        );

	        $sql = "SELECT action_id
	        FROM " . CORE_DB . ".actions_log
	        WHERE action_types_id IN (:download_action_type, :share_action_type)
	        AND int_other = :int_other
	        AND active = 1";

	        $sth = $dbh->prepare($sql);

	        $sth->execute(array(
	        		':download_action_type' => $download_action_type,
	        		':share_action_type' => $share_action_type,
	        		':int_other' => $options['resource_id']
	        	)
	        );

	        while($row = $sth->fetch()) {

	        	Core::r('actions')->modify_action(array(
	        			'action_id' => $row['action_id']
	        		)
	        	);

	        }

		}

		return array(
			'deleted' => 1
		);

	}

	/*
	Determines if user has permission to upload or edit a resource
	*/
	function user_permission($options) {

		/*
		args:
		{
			user_id: the user in question
			resource_id: -1 = uploading a resource, other # = resource_id being updated
		}

		returns:
			success:
			{
				valid: 1 = allowed to upload/edit
			}

			error:
			std error
		*/

	}

	/*
	Retrieve a resource
	*/
	function get_resource($options = array()) {

		/*
		args:
		{
			resource_id: the resource id
		}

		returns
			if success:
			{
				resource_id
				title
				descrip
				type
				display_type
				location
			}

			if error:
			std error
		*/

		Core::ensure_defaults(array(
				'resource_id' => -1
			)
		, $options);

		// Retrieve resouce info
		global $dbh;

		$sql = "
		SELECT
		resource_id,
		title,
		descrip,
		type,
		location,
		active,
		user_id,
		time_added
		FROM " . CORE_DB . ".resources
		WHERE resource_id = :resource_id
		";

		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':resource_id' => $options['resource_id']
			)
		);

		$resource = $sth->fetch();

		if(!is_array($resource)) { // Could not retrieve resource

			return Core::error($this->errors, 8);

		}

		// Retrieve resource display information
		$display = Core::multi_find($this->resource_types, 'type', $resource['type']);

		if($display == -1) { // Unsupported resource type

			return Core::error($this->errors, 3);

		}

		if($resource['type'] != 'video') {

			$file = DIR_STORE . '/resources/' . $resource['location'];

			$resource['resource_type'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file);

		} else {

			$resource['resource_type'] = 'video';

		}

		return Core::remove_numeric_keys($resource);

	}
	
	function get_resources_count($options = array()) {
	
		global $dbh;
	
		/*
			args:
		{
		stats: 0 = do not pull stats, 1 = pull stats data,
		active: 0 = pull deleted records, 1 = pull active records, both = pull all records
		}
		*/
	
		Core::ensure_defaults(array(
				'active' => 'both'
		)
				, $options);
	
		$params = array();
	
		if($options['active'] != 'both') {
	
			$params['active'] = $options['active'];
	
		}
	
		$filters = Core::db_params(array(
				'values' => $params
		)
		);

	
		$sql_filter = (count($params) > 0) ? " WHERE " . $filters['sql'] : "";
	
		$sql = "SELECT count(*)".
		" FROM " . CORE_DB . ".resources" . $sql_filter;
	
		$sth = $dbh->prepare($sql);
		$sth->execute($filters['params']);
	
		return $sth->fetchColumn();

	
	}

	/*
	Return all resources
	*/
	function get_resources($options = array()) {

		global $dbh;

		/*
		args:
		{
			stats: 0 = do not pull stats, 1 = pull stats data,
			active: 0 = pull deleted records, 1 = pull active records, both = pull all records
		}
		*/

		Core::ensure_defaults(array(
				'stats' => 0,
				'active' => 'both',
				'start' => 0,
				'number' => 0,
				'category' => ''
			)
		, $options);

		$resources = array();

		$params = array();

		if($options['active'] != 'both') {

			$params['active'] = $options['active'];

		}

		$filters = Core::db_params(array(
			'values' => $params
			)
		);

		if($options['stats'] == 1) {

			global $gamo;

			$download_action_type = Core::r('actions')->action_types_id(array(
	        		'action_key' => 'download_resource'
	        	)
	        );

	        $share_action_type = Core::r('actions')->action_types_id(array(
	        		'action_key' => 'share_resource'
	        	)
	        );

	        $stats_sql = "
	        ,
	        (
	        	SELECT
	        	count(*)
	        	FROM " . CORE_DB . ".actions_log AS a
	        	WHERE
	        	a.action_types_id = :download_action_type
	        	AND a.int_other = " . CORE_DB . ".resources.resource_id
	        ) AS download_qty
			,
	        (
	        	SELECT
	        	count(*)
	        	FROM " . CORE_DB . ".actions_log AS a
	        	WHERE
	        	a.action_types_id = :share_action_type
	        	AND a.int_other = " . CORE_DB . ".resources.resource_id
	        ) AS share_qty
	        ";

	        $filters['params'][':download_action_type'] = $download_action_type;
			$filters['params'][':share_action_type'] = $share_action_type;

		} else {

			$stats_sql = "";

		}

		$category_sql = '';

		if($options['category'] != '' && $options['category'] != 'all') {

			$category_sql = "(SELECT count(*) FROM " . CORE_DB . ".resources_info AS a
				WHERE a.resource_id = " . CORE_DB . ".resources.resource_id AND a.info_type = 'resource_category' AND a.info_a = :resource_category) > 0";
			
			if($filters['sql'] != '') {

				$filters['sql'] .= ' AND ';

			}

			$filters['sql'] .= $category_sql;
			$filters['params'][':resource_category'] = $options['category'];

		}

		$sql_filter = (count($params) > 0) ? " WHERE " . $filters['sql'] : "";

		$sql = "SELECT
		" . CORE_DB . ".resources.resource_id as resource_id,
		title,
		descrip,
		type,
		location,
		user_id,
		active,
		ri.info_type as resource_info_type,
		ri.int_info as resource_int_info,
		ri.info_a as resource_info_a,
		ri.info_b as resource_info_b,
		ri.time as resource_info_time,
		time_added" . $stats_sql . "
		FROM " . CORE_DB . ".resources" . 
		" LEFT JOIN " . CORE_DB . ".resources_info as ri on ri.resource_id=" . CORE_DB . ".resources.resource_id" . 
		$sql_filter . "
		ORDER BY resource_id DESC LIMIT ".$options['start'].",".$options['number'];

		error_log($sql);

		$sth = $dbh->prepare($sql);
		$sth->execute($filters['params']);

		while($row = $sth->fetch()) {

			array_push($resources, Core::remove_numeric_keys($row));

		}
		
		return $resources;

	}
	
	function get_resources_user_count( $options=array() ){
		
		global $gamo, $dbh;
		
		Core::ensure_defaults(array(
				'user_id' => -1
			)
		,$options);
		
		$download_action_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'download_resource'
		)
		);
		
		$share_action_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'share_resource'
		)
		);
		
		if( empty($download_action_type) or empty($share_action_type) )
			return 0;
		
		
		
		$sql = "SELECT
		count(*)
		FROM
		" . CORE_DB . ".actions_log
		WHERE user_id = :user_id
		AND action_types_id IN (" . $download_action_type . ", " . $share_action_type . " )
		AND
		(
            SELECT
            count(*)
            FROM " . CORE_DB . ".resources AS a
            WHERE a.resource_id = " . CORE_DB . ".actions_log.int_other
        ) > 0";
		
		error_log($sql);
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id']
			)
		);
		
		return $sth->fetchColumn();
	}
	
	function get_resources_user( $options=array() ){
		
		global $gamo, $dbh;
		
		Core::ensure_defaults(array(
				'user_id' => -1,
				'start' => 0,
				'number' => 0
			)
		,$options);
		
		$actions = array();
		
		$download_action_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'download_resource'
		)
		);
		
		$share_action_type = Core::r('actions')->action_types_id(array(
				'action_key' => 'share_resource'
		)
		);
		
		if( empty($download_action_type) or empty($share_action_type) )
			return $actions;
		
		$sql = "SELECT
        action_types_id,
        point_value_use,
        int_other,
        (
            SELECT
            title
            FROM " . CORE_DB . ".resources AS a
            WHERE a.resource_id = " . CORE_DB . ".actions_log.int_other
        ) AS resource_title,
		(
            SELECT
            type
            FROM " . CORE_DB . ".resources AS a
            WHERE a.resource_id = " . CORE_DB . ".actions_log.int_other
        ) AS resource_type,
        other,
        other_b,
        time
        FROM
        " . CORE_DB . ".actions_log
        WHERE user_id = :user_id
        AND action_types_id IN (" . $download_action_type . ", " . $share_action_type . " )
        HAVING resource_title IS NOT NULL
        ORDER BY action_id DESC
        LIMIT ".$options['start'].",".$options['number'];
		
		error_log($sql);
		
		$sth = $dbh->prepare($sql);
		$sth->execute(array(
				':user_id' => $options['user_id']
		)
		);
		
		while($row = $sth->fetch()) {
		
			$row = Core::remove_numeric_keys($row);
			$row['resource_user_status'] = ($row['action_types_id'] == 2) ? 'Downloaded' : 'Shared';

			if($row['resource_type'] == 'video' && $row['action_types_id'] == 2) {

				$row['resource_user_status'] = 'Watched';

			}
		
			array_push($actions, $row);
		
		}
		
		return $actions;
		
	}

}

?>