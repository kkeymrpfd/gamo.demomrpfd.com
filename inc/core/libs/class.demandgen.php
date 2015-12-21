<?
/*
This class handles creating meetings
Note: if you need to run any queries, try using Core::db_count, Core::db_update, or Core::db_insert.
If those functions aren't ideal, then use global $dbh inside of the function, then run a query using PDO
*/

class Core_Demandgen {

    public $errors; // Store error codes

    function __construct() {

        // Create error codes
        $this->errors = array(
            array(
                'error_code' => '1',
                'error_msg' => 'Please select a date for this meeting'
            )
        );

    }

    function get_email_templates($options = array()) {

        global $dbh;

        Core::ensure_defaults(array(
                'user_id' => ''
            )
        , $options);

        $records = array();

        $sql = "SELECT
        email_template_id,
        title,
        description,
        html,
        plaintext,
        subject,
        settings
        FROM " . CORE_DB . ".email_templates
        WHERE
        active = 1
        ORDER BY email_template_id DESC";

        $sth = $dbh->prepare($sql);
        $sth->execute();
        
        while($row = $sth->fetch()) {

            $record = Core::remove_numeric_keys($row);
            $record['settings'] = json_decode($row['settings'], true);
            $record['sent_qty'] = Core::db_count(array(
                    'table' => CORE_DB . ".demandgen_contacts",
                    'values' => array(
                        'email_template_id' => $record['email_template_id'],
                        'user_id' => $options['user_id'],
                        'test' => 0
                    )
                )
            );

            $records[] = $record;

        }

        return array(
            'records' => $records
        );

    }

    function get_email_template($options = array()) {

        global $dbh;

        Core::ensure_defaults(array(
                'email_template_id' => ''
            )
        , $options);

        $records = array();

        $sql = "SELECT
        email_template_id,
        title,
        description,
        html,
        plaintext,
        subject,
        settings
        FROM " . CORE_DB . ".email_templates
        WHERE
        email_template_id = :email_template_id
        AND active = 1";

        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':email_template_id' => $options['email_template_id']
            )
        );

        $row = $sth->fetch();

        if(!isset($row['title'])) {

            return Core::error("Invalid email template specified");

        }

        $row['settings'] = json_decode($row['settings'], true);

        return Core::remove_numeric_keys($row);

    }

    function generate_html($options = array()) {

        Core::ensure_defaults(array(
                'email_template' => '',
                'params' => ''
            )
        , $options);

        if(is_numeric($options['email_template'])) {

            $options['email_template'] = $this->get_email_template(array(
                    'email_template_id' => $options['email_template']
                )
            );

            if(Core::has_error($options['email_template'])) {

                return Core::error("Invalid template specified");

            }

        }

        $html = $options['email_template']['html'];

        foreach($options['params'] as $k => $v) {

            if($k == 'redirect_url' && $v != '') {

                $v = urlencode($v);

            }

            $html = str_replace('[' . $k . ']', $v, $html);

        }

        return array(
            'html' => $html
        );

    }

    function send($options = array()) {

        global $dbh;

        Core::ensure_defaults(array(
                'email_template_id' => '',
                'list_type' => '',
                'subject' => '',
                'logo' => '',
                'redirect_url' => '',
                'manual' => '',
                'user_id' => ''
            )
        , $options);

        if(!is_array($options['manual'])) {

            $options['manual'] = array();

        }

        $valid = $this->send_validate($options);

        if(Core::has_error($valid)) {

            return $valid;

        }

        $options = $valid;

        $datetime = Core::datetime();

        /*
        $sql = "TRUNCATE " . CORE_DB . ".demandgen_contacts";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        */

        $insert_qty = 0;

        $user_email = Core::fetch_column(
            "SELECT email FROM " . CORE_DB . ".users WHERE user_id = :user_id",
            array(
                ':user_id' => $options['user_id']
            )
        );

        if($user_email == '' || $user_email === FALSE) {

            return Core::error("Could not find user email");

        }

        $demandgen_action_types_id = Core::r('actions')->action_types_id('send_demandgen');
        
        foreach($options['recipients']['recipients'] as $k => $email) {
            
            $hash = Core::unique_string(15);

            $insert = Core::db_insert(array(
                    'table' => CORE_DB . ".demandgen_contacts",
                    'values' => array(
                        'user_id' => $options['user_id'],
                        'email_to' => $email,
                        'email_template_id' => $options['email_template_id'],
                        'opened' => 0,
                        'clicked' => 0,
                        'ip' => '',
                        'datetime' => $datetime,
                        'hash' => $hash,
                        'test' => 0,
                    )
                )
            );

            if(is_numeric($insert)) {

                ++$insert_qty;

                 $generated = Core::r('demandgen')->generate_html(array(
                        'email_template' => $options['email_template'],
                        'params' => array(
                            'logo' => 'http://' . URL . '/demandgen_img.php?image=' . $options['logo'],
                            'redirect_url' => $options['redirect_url'],
                            'hash' => $hash,
                            'url' => URL
                        )
                    )
                );

                $action = Core::r('actions')->create_action(array(
                        'user_id' => $options['user_id'],
                        'action_types_id' => $demandgen_action_types_id,
                        'int_other' => $options['email_template_id'],
                        'other' => $email
                    )
                );

                Core::email(array(
                        'email_to' => $email,
                        'name_from' => SITE_NAME,
                        'email_from' => $user_email,
                        'reply_to' => $user_email,
                        'subject' => $options['subject'],
                        'message' => $generated['html']
                    )
                );

            }

        }

        return array(
            'new_valid_contacts' => $insert_qty,
            'sent' => 1
        );

    }

    function send_validate($options = array()) {

        Core::ensure_defaults(array(
                'email_template_id' => '',
                'list_type' => '',
                'subject' => '',
                'logo' => '',
                'redirect_url' => '',
                'manual' => array(),
                'list_recipients' => array(),
                'user_id' => ''
            )
        , $options);

        $options['logo'] = substr($options['logo'], 0, 20);

        if(!is_array($options['manual'])) {

            $options['manual'] = array();

        }

        if(!is_array($options['list_recipients'])) {

            $options['list_recipients'] = array();

        }

        $options['email_template'] = $this->get_email_template(array(
                'email_template_id' => $options['email_template_id']
            )
        );

        if(Core::has_error($options['email_template'])) {

            return Core::error("The email template specified is not valid. Please refresh the page and try again.");

        }

        if($options['subject'] == '') {

            return Core::error("Please provide a subject for this e-mail or use the default subject line");

        }

        if(isset($options['email_template']['settings']['redirect_url']) && !filter_var($options['redirect_url'], FILTER_VALIDATE_URL)) {

            return Core::error("Please provide a valid URL with the http or https part of the URL");

        }

        if($options['logo'] == '' || !file_exists(DIR_STORE . "/demandgen_images/" . $options['logo']. '.png')) {

            return Core::error("Please make sure to upload your partner logo for this email");

        }

        $recipients = $this->check_recipients(array(
                'email_template_id' => $options['email_template_id'],
                'recipients' => ($options['list_type'] == 'manual') ? $options['manual'] : $options['list_recipients']
            )
        );

        if(count($recipients['recipients']) == 0) {

            return Core::error("You did not specify any valid email addresses to send this email to");

        }

        $options['recipients'] = $recipients;

        return $options;

    }

    function check_recipients($options = array()) {

        Core::ensure_defaults(array(
                'email_template_id' => '',
                'recipients' => array()
            )
        , $options);

        $use = array();
        $used = array();

        foreach($options['recipients'] as $k => $email) {

            $email = ltrim(rtrim(strtolower($email)));
            if(!isset($used[$email]) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $used[$email] = 1;
                $use[] = $email;

            }

        }

        return array(
            'recipients' => $use
        );

    }

}
?>