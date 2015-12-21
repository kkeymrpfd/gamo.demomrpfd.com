<?
/*
This class handles reserving of slots
*/

class Core_Slots {

	public $errors; // Store error codes
    public $action_type_reserve;

	function __construct() {

        global $gamo;

		// Create error codes
		$this->errors = array(
			array(
                'error_code' => '1',
                'error_msg' => 'Invalid user information specified'
            ),
            array(
                'error_code' => '2',
                'error_msg' => 'Invalid slot specified'
            ),
            array(
                'error_code' => '3',
                'error_msg' => 'This slot is already fully booked. Please try a different slot'
            ),
            array(
                'error_code' => '4',
                'error_msg' => 'This user has already booked a slot for this slot group'
            )
		);

        $this->action_type_reserve = Core::r('actions')->action_types_id('reserve_slot_meeting');

	}

    /*
    Return all meeting slots, along with how many meetings have been created for each slot
    */
	function get_slots($options = array()) {

        Core::ensure_defaults(array(
                'slot_id' => -1
            )
        , $options);

        global $dbh, $gamo;

        $params =array(
            ':action_types_id' => $this->action_type_reserve
        );

        $sql_filter = '';

        if($options['slot_id'] != -1) {

            // Determnine if slot id is valid
            $c = Core::db_count(array(
                    'table' => CORE_DB . '.slots',
                    'values' => array(
                        'slot_id' => $options['slot_id']
                    )
                )
            );

            if($c == 0) {

                return Core::error($this->errors, 2);

            }

            $sql_filter = ' WHERE slot_id = :slot_id';
            $params[':slot_id'] = $options['slot_id'];

        }

        $sql = "SELECT
        slot_id,
        start_time,
        end_time,
        max_qty,
        slot_group,
        slot_name,
        (
            SELECT
            count(*)
            FROM " . CORE_DB . ".actions_log AS a
            WHERE
            a.int_other = " . CORE_DB . ".slots.slot_id
            AND a.action_types_id = :action_types_id
        ) AS reserved_qty
        FROM " . CORE_DB . ".slots" . $sql_filter;

        $sth = $dbh->prepare($sql);
        $sth->execute($params);

        $slots = array(
            'slots' => array()
        );

        while($row = $sth->fetch()) {

            $row['remaining_qty'] = $row['max_qty'] - $row['reserved_qty'];
            $row['display_time_range'] = date('l, F jS - g:i a', strtotime($row['start_time'])) . ' to ' . date('g:i a', strtotime($row['end_time']));

            array_push($slots['slots'], Core::remove_numeric_keys($row));

        }

        return $slots;

    }

    // Determine if a user has already reserved a slot
    function slot_reserved($options = array()) {

        Core::ensure_defaults(array(
                'user_id' => $options['user_id']
            )
        , $options);

        $c = Core::db_count(array(
                'table' => CORE_DB . '.actions_log',
                'values' => array(
                    'action_types_id' => $this->action_type_reserve,
                    'user_id' => $options['user_id']
                )
            )
        );

        return ($c > 0) ? 1 : 0;

    }

    /*
    Reserve a slot
    */
    function reserve_slot($options = array()) {

        global $gamo;

        Core::ensure_defaults(array(
                'user_id' => -1,
                'slot_id' => -1,
                'topic' => ''
            )
        , $options);

        // Determnine if user id is valid
        $c = Core::db_count(array(
                'table' => CORE_DB . '.users',
                'values' => array(
                    'user_id' => $options['user_id']
                )
            )
        );

        if($c == 0) {

            return Core::error($this->errors, 1);

        }

        // Determnine if slot id is valid
        $slots = $this->get_slots(array(
                'slot_id' => $options['slot_id']
            )
        );

        if(Core::has_error($slots)) { // Slot is not valid

            return $slots;

        }

        $slot = $slots['slots'][0];

        if($slot['remaining_qty'] < 1) { // Slot is fully booked.

            return Core::errors($this->errors, 3);

        }

        // Determine if this user has already booked a slot for this slot group
        $c = Core::db_count(array(
                'table' => CORE_DB . '.actions_log',
                'values' => array(
                    'user_id' => $options['user_id'],
                    'action_types_id' => $this->action_type_reserve,
                    'other' => $slot['slot_group']
                )
            )
        );

        if($c > 0) { // User has already booked a slot for this slot group

            return Core::error($this->errors, 4);

        }

        // Book slot
        $result = Core::r('actions')->create_action(array(
                'user_id' => $options['user_id'],
                'action_types_id' => $this->action_type_reserve,
                'int_other' => $slot['slot_id'],
                'other' => $slot['slot_group'],
                'other_b' => $options['topic']
            )
        );

        return $result;

    }

    /*
    Unreserve a user for a slot group
    */
    function unreserve_user_group($options = array()) {

        global $gamo, $dbh;

        Core::ensure_defaults(array(
                'user_id' => -1,
                'group' => -1
            )
        , $options);

        // Retrieve valid slot ids
        $sql = "SELECT slot_id FROM " . CORE_DB . ".slots WHERE slot_group = :slot_group";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':slot_group' => $options['group']
            )
        );

        $slot_ids = array();

        while($row = $sth->fetch()) {

            array_push($slot_ids, $row['slot_id']);

        }

        if(count($slot_ids) == 0) {

            return true;

        }

        $sql = "SELECT action_id FROM " . CORE_DB . ".actions_log WHERE user_id = :user_id AND action_types_id = :action_types_id AND int_other IN (" . implode(",", $slot_ids) . ")";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':user_id' => $options['user_id'],
                ':action_types_id' => $this->action_type_reserve
            )
        );

        $delete_sql = "DELETE FROM " . CORE_DB . ".actions_log WHERE action_id = :action_id";
        $delete_sth = $dbh->prepare($delete_sql);

        while($row = $sth->fetch()) {

            Core::r('actions')->modify_action(array(
                    'action_id' => $row['action_id'],
                    'values' => 'delete'
                )
            );

            $delete_sth->execute(array(
                    ':action_id' => $row['action_id']
                )
            );

        }

        return true;


    }

}
?>
