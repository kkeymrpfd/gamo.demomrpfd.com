<?
class Gamo_Commenter{

    public $errors;

    function __construct(){

        $this->errors = array(

            array(
                'error_code' => '1',
                'error_msg' => 'Invalid comment id',
            ),
            array(
                'error_code' => '2',
                'error_msg' => 'Invalid user id',
            ),
            array(
                'error_code' => '3',
                'error_msg' => 'Invalid comment',
            ),
            array(
                'error_code' => '4',
                'error_msg' => 'Could not update comment',
            ),
            array(
                'error_code' => '5',
                'error_msg' => 'Could not save comment',
            ),
            array(
                'error_code' => '6',
                'error_msg' => 'Cannot reply to a comment that does not exist',
            )
        );

    }

    // todo count records where user_id, approved = 1, and reply_to < 0
    /*function get_comment_history_count($options = array()){
    
        $options = Core::ensure_defaults(array(
            'user_id' => -1
        )
        , $options);

        return Core::db_count(array(
                'table' => GAMO_DB . '.comments',
                'values' => array(
                    'user_id' => $options['user_id'],
                    'approved' => 1
                )
            )
        );    

    }*/


    // todo count records where user_id, approved = 1, and reply_to > 0
    /*function get_reply_history_count($options = array()){
    
        $options = Core::ensure_defaults(array(
            'user_id' => -1
        )
        , $options);

        return Core::db_count(array(
                'table' => GAMO_DB . '.comments',
                'values' => array(
                    'user_id' => $options['user_id'],
                    'approved' => 1
                )
            )
        );    

    }*/

    function get_reply_history($options = array()){

        $options = Core::ensure_defaults(array(
                'user_id' => -1,
                'start' => 0,
                'num' => 0
            )
        , $options);

        global $dbh, $gamo;

	$reply_type = Core::r('actions')->action_types_id(array(
			'action_key' => 'reply_comment_board'
		)
	);

        $sql = "SELECT
            comment_id,
            user_id,
            msg,
            active,
            datetime,
	(
		SELECT
		point_value_use
		FROM " . GAMO_DB . ".actions_log AS a
		WHERE a.action_types_id = :action_types_id
		AND a.int_other = " . GAMO_DB . ".comments.comment_id
		AND active = 1
		AND point_value_use > 0
	) AS points
            FROM " . GAMO_DB . ".comments
            WHERE user_id = :user_id and active=1 and approved=1 and reply_to > 0
            HAVING points IS NOT NULL 
            ORDER BY datetime DESC
            LIMIT ".(int)$options['start'].",".(int)$options['num'];
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':user_id' => $options['user_id'],
		':action_types_id' => $reply_type
            )        
        );

        $comments = array();

        while($row = $sth->fetch()){

            $row = Core::remove_numeric_keys($row);
        
            array_push($comments, $row);
        }

        return $comments;

    }
    
    function get_reply_history_count($options = array()){
    
    	$options = Core::ensure_defaults(array(
    			'user_id' => -1,
    			'start' => 0,
    			'num' => 0
    	)
    			, $options);
    
    	global $dbh, $gamo;
    	
    	$reply_type = Core::r('actions')->action_types_id(array(
    			'action_key' => 'reply_comment_board'
    	)
    	);
    
    	$sql = "SELECT
    	count(*)
    	FROM " . GAMO_DB . ".comments
    	WHERE user_id = :user_id and active=1 and approved=1 and reply_to > 0 and
    	(
			SELECT
			count(*)
			FROM " . GAMO_DB . ".actions_log AS a
			WHERE a.action_types_id = :action_types_id
			AND a.int_other = " . GAMO_DB . ".comments.comment_id
			AND active = 1
			AND point_value_use > 0
		) > 0";
    	
    	$sth = $dbh->prepare($sql);
    	$sth->execute(array(
    			':user_id' => $options['user_id'],
    			':action_types_id' => $reply_type
    		)
    	);
    
    	return  $sth->fetchColumn();
    
    }
    
    function get_comment_history_count($options = array()){
    
    	$options = Core::ensure_defaults(array(
    			'user_id' => -1,
    			'start' => 0,
    			'num' => 0
    	)
    			, $options);
    
    	global $dbh, $gamo;
    	
    	$comment_type = Core::r('actions')->action_types_id(array(
    			'action_key' => 'post_comment_board'
    	)
    	);
    
    	$sql = "SELECT
    	count(*)
    	FROM " . GAMO_DB . ".comments
    	WHERE user_id = :user_id and active=1 and approved=1 and reply_to < 0 and
    	(
			SELECT
			count(*)
			FROM " . GAMO_DB . ".actions_log AS a
			WHERE a.action_types_id = :action_types_id
			AND a.int_other = " . GAMO_DB . ".comments.comment_id
			AND active = 1
			AND point_value_use > 0
		) > 0";
    
    	$sth = $dbh->prepare($sql);
    	$sth->execute(array(
    			':user_id' => $options['user_id'],
    			'action_types_id' => $comment_type
    		)
    	);
    
    	return $sth->fetchColumn();
    
    }

    function get_comment_history($options = array()){

        $options = Core::ensure_defaults(array(
                'user_id' => -1,
                'start' => 0,
                'num' => 0
            )
        , $options);

        global $dbh, $gamo;
	
	$comment_type = Core::r('actions')->action_types_id(array(
			'action_key' => 'post_comment_board'
		)
	);
	
        $sql = "SELECT
            comment_id,
            user_id,
            msg,
            active,
            datetime,
	(
		SELECT
		point_value_use
		FROM " . GAMO_DB . ".actions_log AS a
		WHERE a.action_types_id = :action_types_id
		AND a.int_other = " . GAMO_DB . ".comments.comment_id
		AND active = 1
		AND point_value_use > 0
	) AS points
            FROM " . GAMO_DB . ".comments
            WHERE user_id = :user_id and active=1 and approved=1 and reply_to < 0
            HAVING points IS NOT NULL 
            ORDER BY datetime DESC
            LIMIT ".(int)$options['start'].",".(int)$options['num'];

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':user_id' => $options['user_id'],
		':action_types_id' => $comment_type
            )        
        );

        $comments = array();

        while($row = $sth->fetch()){

            $row = Core::remove_numeric_keys($row);
        
            array_push($comments, $row);
        }

        return $comments;

    }
    
    function get_replies_to( $options=array() ){
    	
    	global $gamo;
    	
    	$options = Core::ensure_defaults(array(
    			'reply_to' => 0
    	), $options);
    	
    	$reply_type = Core::r('actions')->action_types_id(array(
    			'action_key' => 'reply_comment_board'
    		)
    	);
    	
    	
    	$sql = "
    	SELECT user_id,
		(
			SELECT 
			point_value_use 
			FROM " . GAMO_DB . ".actions_log AS a 
			WHERE a.action_types_id = :action_types_id 
			AND a.int_other = " . GAMO_DB . ".comments.comment_id 
			AND active = 1 
			AND point_value_use > 0
		) AS points 
		FROM ".GAMO_DB.".comments WHERE 
		active=1 and approved=1 and reply_to = :reply_to_id 
		HAVING points IS NOT NULL ORDER BY `datetime` DESC";
    	
    	
    	$result = Core::db_execute(array(
    			'sql' => $sql,
    			'params' => array(
	    					':action_types_id' => $reply_type,
	    					':reply_to_id' => $options['reply_to']
	    			),
    			'get_method' => 'fetchAll'
    			)
    	);
    	
    	return $result;
    	
    }


    function get_comments($options = array()){

        $options = Core::ensure_defaults(array(
                'user_id' => -1,
                'start' => 0,
                'num' => 0
            )
        , $options);

        global $dbh, $gamo;
	
	$comment_type = Core::r('actions')->action_types_id(array(
			'action_key' => 'post_comment_board'
		)
	);

	$reply_type = Core::r('actions')->action_types_id(array(
			'action_key' => 'reply_comment_board'
		)
	);

        $sql = "SELECT 
		comment_id,
		user_id,
		msg,
		active,
		datetime,
		(
			SELECT 
			point_value_use 
			FROM " . GAMO_DB . ".actions_log AS a 
			WHERE a.action_types_id = :action_types_id 
			AND a.int_other = " . GAMO_DB . ".comments.comment_id 
			AND active = 1 
			AND point_value_use > 0
		) AS points 
		FROM " . GAMO_DB . ".comments 
		WHERE active=1 and approved=1 and reply_to < 0 
		HAVING points IS NOT NULL 
		ORDER BY datetime DESC 
		LIMIT ".(int)$options['start'].",".(int)$options['num'];

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
			':action_types_id' => $comment_type
		)	
	);

        $comments = array();

        while($row = $sth->fetch()){

            $row = Core::remove_numeric_keys($row);
            $row['display_time'] = date('F j, Y g:i a', strtotime($row['datetime']));
        
       
            array_push($comments, $row);
        }
	
	$sql = "SELECT
                comment_id,
                user_id,
                msg,
                datetime,
		(
			SELECT
			point_value_use
			FROM " . GAMO_DB . ".actions_log AS a
			WHERE a.action_types_id = :action_types_id
			AND a.int_other = " . GAMO_DB . ".comments.comment_id
			AND active = 1
			AND point_value_use > 0
		) AS points,
		(
			SELECT
			display_name
			FROM " . GAMO_DB . ".users AS a
			WHERE a.user_id = " . GAMO_DB . ".comments.user_id
		) AS display_name
                FROM " . GAMO_DB . ".comments
                WHERE active=1 and approved=1 and reply_to=:reply_to_id
                ORDER BY datetime ASC";

        foreach($comments as &$comment){

            $reply_to_id = $comment['comment_id'];
            $sth = $dbh->prepare($sql);
            
            $sth->execute(array(
			':reply_to_id' => $reply_to_id ,
			':action_types_id' => $reply_type
                )
            );

        
            $replies = array();

            while($row = $sth->fetch()){

                $row = Core::remove_numeric_keys($row);

                array_push($replies, $row);
            
            }

            $comment['replies'] = $replies;


            $tmp_sql = "SELECT
                display_name
                FROM " . GAMO_DB . ".users
                WHERE user_id = :user_id";

            $tmp_sth = $dbh->prepare($tmp_sql);
            $tmp_sth->execute(array(
                    ':user_id' => $comment['user_id']
                )
            );

            $user = $tmp_sth->fetch();
            
            $comment['display_name'] = $user['display_name'];      
        
        }

        return $comments;

    }
    
    function get_comments_count( $options = array() ){
    
    	$options = Core::ensure_defaults(array(
    			'user_id' => -1,
    			'start' => 0,
    			'num' => 0
    	)
    			, $options);
    
    	global $dbh, $gamo;
    	
    	$comment_type = Core::r('actions')->action_types_id(array(
    			'action_key' => 'post_comment_board'
    		)
    	);

    
    	$sql = "SELECT
    	count(*)
    	FROM " . GAMO_DB . ".comments
    	WHERE active=1 and approved=1 and reply_to < 0 and
    	(
			SELECT 
			count(*) 
			FROM " . GAMO_DB . ".actions_log AS a 
			WHERE a.action_types_id = :action_types_id 
			AND a.int_other = " . GAMO_DB . ".comments.comment_id 
			AND active = 1 
			AND point_value_use > 0
		) > 0";
    
    	$sth = $dbh->prepare($sql);
    	$sth->execute(array(
			':action_types_id' => $comment_type
		));
    	
    	return $sth->fetchColumn();

    }
    

    /*
    Creates a new comment
    */
    function create_comment($options = array()){

        /*
        returns:
            if successful:
            {
                comment_id: the id of the comment
            }
            if error: standard error
        */

        global $dbh, $session, $gamo;

        Core::ensure_defaults(array(
                'user_id' => -1,
                'msg' => '',
                'reply_to' => -1,
                'active' => 1,
                'approved' => 1,
                'datetime' => Core::date_string()
            ),
        $options);

        $valid = $this->validate_comment_info($options);

        if(Core::has_error($valid)){
            return $valid;
        }

        if($options['reply_to'] > 0){
            $c = Core::db_count(array(
                    'table' => GAMO_DB . '.comments',
                    'values' => array(
                        'comment_id' => $options['reply_to']
                    )
                )
            );

            if($c == 0){
                return Core::error($this->errors, 6);
            }
        }

        $comment_id = Core::db_insert(array(
                'table' => GAMO_DB . '.comments',
                'values' => array(
                    'user_id' => $options['user_id'],
                    'msg' => $options['msg'],
                    'reply_to' => $options['reply_to'],
                    'active' => $options['active'],
                    'approved' => $options['approved'],
                    'datetime' => $options['datetime']
                )
            )
        );

        if(!is_numeric($comment_id)){
            return Core::error($this->errors, 5);
        }

        global $gamo;

        Core::r('actions')->create_action(array(
                'action_types_id' => ($options['reply_to'] == -1) ? 'post_comment_board' : 'reply_comment_board',
                'user_id' => $options['user_id'],
                'int_other' => $comment_id
            )
        );

        return array(
            'comment_id' => $comment_id
        );

    }

    function update_comment($options = array()){

        Core::ensure_defaults(array(
                'comment_id' => -1,
                'values' => array()
            ),
        $options);

        
        if(!is_array($options['values']) && $options['values'] === 'delete'){

            $options['values'] = array('active' => 0);

        }

        $result = Core::db_update(array(
                'table' => GAMO_DB . '.comments',
                'values' => $options['values'],
                'where' => array(
                    'comment_id' => $options['comment_id']
                )
            )
        );

        if($result === false){
            return Core::error($this->errors, 4);
        }

        return array(
            'updated' => 1
        );

    }

    /*
    Validate input for creating/editing a comment
    */

    function validate_comment_info($options){

        /*
        returns:
            if successful:
            {
                valid: 1
            }

            if error: standard error

        */

        if( trim($options['msg']) == ''){

            return Core::error($this->errors, 3);

        }

        return array(
            'valid' => 1
        );
    }

}
?>
