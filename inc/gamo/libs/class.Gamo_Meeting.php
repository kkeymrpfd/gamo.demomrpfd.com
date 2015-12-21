<?
/*
This class handles creating meetings
Note: if you need to run any queries, try using Core::db_count, Core::db_update, or Core::db_insert.
If those functions aren't ideal, then use global $dbh inside of the function, then run a query using PDO
*/

class Gamo_Meeting {

    public $errors; // Store error codes
    public $action_types_ids;
    public $field_defaults;
    public $save_fields;

    function __construct() {

        // Create error codes
        $this->errors = array(
            array(
                'error_code' => '1',
                'error_msg' => 'Please select a date for this meeting'
            )
        );

        $this->action_types_ids = array(
            'submit_meeting' => Core::r('actions')->action_types_id(array(
                'action_key' => 'submit_meeting'
            )),
            'submit_deal_close' => Core::r('actions')->action_types_id(array(
                'action_key' => 'submit_deal_close'
            )),
            'submit_deal_feedback' => Core::r('actions')->action_types_id(array(
                'action_key' => 'submit_deal_feedback'
            ))
        );

        $this->field_defaults = array(
            'user_id' => '',
            'action_id' => '',
            'required' => array(
                'contact_name', 'title', 'company', 'phone', 'email', 'date', 'meeting_id', 'status', 'amount'
            )
        );

        $this->save_fields = array(
            'contact_name' => '',
            'title' => '',
            'company' => '',
            'phone' => '',
            'email' => '',
            'date' => '',
            'meeting_id' => '',
            'status' => '',
            'amount' => '',
            'notes' => ''
        );

        foreach($this->save_fields as $k => $v) {

            $this->field_defaults[$k] = $v;

        }

    }

    function validate_meeting($options = array()) {

        Core::ensure_defaults($this->field_defaults, $options);

        if(!is_array($options['required'])) {

            $options['required'] = array();

        }

        if($options['action_id'] != '') {

            $c = Core::db_count(array(
                    'table' => GAMO_DB . ".actions_log",
                    'values' => array(
                        'action_id' => $options['action_id'],
                        'action_types_id' => $this->action_types_ids['submit_meeting'],
                        'user_id' => $options['user_id'],
                        'active' => 1
                    )
                )
            );

            if($c == 0) {

                return Core::error("Invalid meeting specified. Please refresh the page and try again.");

            }

        }

        if(in_array('contact_name', $options['required'])) {

            if($options['contact_name'] == '') {

                return Core::error("Please enter a contact name");

            }

        }

        if(in_array('title', $options['required'])) {

            if($options['title'] == '') {

                return Core::error("Please enter a title");

            }

        }

        if(in_array('company', $options['required'])) {

            if($options['company'] == '') {

                return Core::error("Please enter a company");

            }

        }

        if(in_array('phone', $options['required'])) {

            if($options['phone'] == '') {

                return Core::error("Please enter a phone");

            }

        }

        if(in_array('date', $options['required'])) {

            if($options['date'] == '') {

                return Core::error("Please enter a date");

            }

        }

        if(in_array('email', $options['required'])) {

            if($options['email'] == '') {

                return Core::error("Please enter an email address");

            }

            $valid = Core::r('users')->validate_email(array(
                    'email' => $options['email'],
                    'unique_check' => 0
                )
            );

            if(Core::has_error($valid)) {

                return Core::error("Please enter a valid email address");

            }

        }

        if(in_array('status', $options['required'])) {

            if( !isset($this->action_types_ids[ $options['status'] ]) ) {

                return Core::error("Invalid status value");

            }

        }

        if(in_array('meeting_id', $options['required'])) {

            if($options['status'] != 'submit_meeting' && $options['meeting_id'] == '') {

                return Core::error("Please enter a deal registration ID");

            }

        }

        if(in_array('amount', $options['required'])) {

            if($options['status'] == 'submit_deal_close' && $options['amount'] == '') {

                return Core::error("Please enter an amount for the value of this deal / opportunity");

            }

        }

        if($options['status'] == 'submit_deal_feedback' && $options['notes'] == '') {

            return Core::error("Please use the meeting notes section to note why the deal did not close");

        }

        /*
        if(in_array('invoice_file', $options['required'])) {

            if($options['status'] == 'submit_deal_close' && ($options['invoice_file'] == '' || !file_exists(DIR_STORE . '/meeting_assets/' . $options['invoice_file']) ) ) {

                return Core::error("Please upload the distributor invoice for this deal closing.");

            }

        }
        */

        $options['status_exists'] = array();

        foreach($this->action_types_ids as $k => $v) {

            $id = Core::fetch_column(
                "SELECT action_id FROM " . GAMO_DB . ".actions_log WHERE action_types_id = :action_types_id AND user_id = :user_id AND other = :other AND active = 1",
                array(
                    ':action_types_id' => $v,
                    ':user_id' => $options['user_id'],
                    ':other' => $options['email']
                )
            );

            $options['status_exists'][$k] = $id;

        }

        if($options['action_id'] != '') {

            $options['status_exists']['submit_meeting'] = $options['action_id'];

        }

        if($options['action_id'] != '') {

            $c = Core::db_count(array(
                    'table' => GAMO_DB . ".actions_log",
                    'values' => array(
                        'action_id!' => $options['action_id'],
                        'action_types_id' => $this->action_types_ids['submit_meeting'],
                        'user_id' => $options['user_id'],
                        'other' => $options['email'],
                        'active' => 1,
                    )
                )
            );

            if($c > 0) {

                return Core::error("There is already a deal submitted for this contact");

            }

        }

        return $options;

    }

    function create_meeting($options = array()) {

        Core::ensure_defaults($this->field_defaults, $options);

        $valid = $this->validate_meeting($options);

        if(Core::has_error($valid)) {

            return $valid;

        }

        $options = $valid;

        $save = array();

        foreach($this->save_fields as $field => $r) {

            $save[$field] = $options[$field];

        }

        $options['hash'] = md5(json_encode($save));
        
        $result = array();

        $save_info = 0;

        if($options['status_exists']['submit_meeting'] === FALSE) {        

            $save_info = 1;

            $result['create']['submit_meeting'] = Core::r('actions')->create_action(array(
                    'user_id' => $options['user_id'],
                    'action_types_id' => $this->action_types_ids['submit_meeting'],
                    'other' => $options['email'],
                    'other_b' => $options['hash']
                )
            );

            if(Core::has_error($create)) {

                return $create;

            }

            $options['status_exists']['submit_meeting'] = $result['create']['submit_meeting']['action_id'];

        } else {

            $hash = Core::fetch_column(
                "SELECT other_b FROM " . GAMO_DB . ".actions_log WHERE action_id = :action_id",
                array(
                    ':action_id' => $options['status_exists']['submit_meeting']
                )
            );

            if($hash != $options['hash']) {

                Core::db_update(array(
                        'table' => GAMO_DB . ".actions_log",
                        'values' => array(
                            'other' => $options['email'],
                            'other_b' => $options['hash']
                        ),
                        'where' => array(
                            'action_id' => $options['status_exists']['submit_meeting']
                        )
                    )
                );

                Core::db_delete(array(
                        'table' => GAMO_DB . ".actions_info",
                        'where' => array(
                            'action_id' => $options['status_exists']['submit_meeting']
                        )
                    )
                );
                
                $save_info = 1;   
            }

        }

        $result['save_info'] = array();

        if($save_info == 1) {

            foreach($this->save_fields as $field => $r) {

                $result['save_info'][$field] = Core::r('actions')->create_action_info(array(
                        'action_id' => $options['status_exists']['submit_meeting'],
                        'info_type' => $field,
                        'info' => $options[$field]
                    )
                );

            }

        }

        if( in_array($options['status'], array('submit_deal_close', 'submit_deal_feedback')) &&  $options['status_exists']['submit_deal_feedback'] === FALSE ) {

            $result['create']['submit_deal_feedback'] = Core::r('actions')->create_action(array(
                    'user_id' => $options['user_id'],
                    'action_types_id' => $this->action_types_ids['submit_deal_feedback'],
                    'other' => $options['email']
                )
            );

            if(Core::has_error($create)) {

                return $create;

            }

        }

        if( in_array($options['status'], array('submit_deal_close')) &&  $options['status_exists']['submit_deal_close'] === FALSE ) {

            $result['create']['submit_deal_close'] = Core::r('actions')->create_action(array(
                    'user_id' => $options['user_id'],
                    'action_types_id' => $this->action_types_ids['submit_deal_close'],
                    'other' => $options['email']
                )
            );

            if(Core::has_error($create)) {

                return $create;

            }

        }

        if( in_array($options['status'], array('submit_meeting')) ) {

            if($options['status_exists']['submit_deal_feedback'] !== FALSE) {

                Gamo::r('actions')->modify_action(array(
                        'action_id' => $options['status_exists']['submit_deal_feedback'],
                        'values' => 'delete'
                    )
                );

            }

        }

        if( in_array($options['status'], array('submit_meeting', 'submit_deal_feedback')) ) {

            if($options['status_exists']['submit_deal_close'] !== FALSE) {

                Gamo::r('actions')->modify_action(array(
                        'action_id' => $options['status_exists']['submit_deal_close'],
                        'values' => 'delete'
                    )
                );

            }

        }

        return $result;

    }

    function get_meetings($options = array()) {

        global $dbh;

        Core::ensure_defaults(array(
                'page' => 0,
                'records' => 5,
                'user_id' => '',
                'sort' => 'action_id desc'
            )
        , $options);

        $start = max($options['page'] - 1, 0) * $options['records'];

        $sql = "SELECT
        action_id
        FROM " . GAMO_DB . ".actions_log
        WHERE 
        action_types_id = :action_types_id
        AND user_id = :user_id
        AND active = 1
        ORDER BY " . $options['sort'] . "
        LIMIT " . $start . ", " . $options['records'];
        
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':action_types_id' => $this->action_types_ids['submit_meeting'],
                ':user_id' => $options['user_id']
            )
        );

        $records = array();

        while($row = $sth->fetch()) {

            $record = Core::r('actions')->get_action(array(
                    'action_id' => $row['action_id']
                )
            );

            $actions_info = array();

            foreach($record['actions_info'] as $k => $v) {

                $actions_info[ $v['info_type'] ] = $v;

            }

            $record['actions_info'] = $actions_info;

            $k = Core::multi_find($record['actions_info'], 'info_type', 'status');

            if($k != -1) {

                $record['status'] = $record['actions_info'][$k]['info'];
                $record['company'] = Core::fetch_column(
                    "SELECT info FROM " . GAMO_DB . ".actions_info WHERE action_id = :action_id AND info_type = 'company' LIMIT 0, 1",
                    array(
                        ':action_id' => $row['action_id']
                    )
                );

                $record['total_points'] = Core::fetch_column(
                    "SELECT SUM(point_value_used) FROM " . GAMO_DB . ".actions_log WHERE action_types_id IN (" . implode(',', $this->action_types_ids) . ") AND user_id = :user_id AND other = :other AND active = 1",
                    array(
                        ':other' => $record['other'],
                        ':user_id' => $options['user_id']
                    )
                );

                $records[] =  $record;

            }

        }

        $total_records = Core::db_count(array(
                'table' => GAMO_DB . ".actions_log",
                'values' => array(
                    'action_types_id' => $this->action_types_ids['submit_meeting'],
                    'user_id' => $options['user_id'],
                    'active' => 1
                )
            )
        );

        return array(
            'records' => $records,
            'current_page' => $options['page'],
            'total_records' => $total_records,
            'last_page' => ceil($total_records / $options['records'])
        );

    }

}
?>