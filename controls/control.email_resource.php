<?
class Control_Email_Resource {

    function run() {
        
        Core::authorize(array(
                'user_id' => 'get'
            )
        );
        
        global $data, $page_settings, $session, $gamo, $dbh;

        $page_settings['allow_json'] = 1;

        $resource_id = Core::get_input('resource_id', 'get');

        // Determine if resource id is valid
        $sql = "SELECT resource_id, title, descrip FROM " . GAMO_DB . ".resources WHERE resource_id = :resource_id LIMIT 0, 1";
        $sth = $dbh->prepare($sql);
        $sth->execute(array(
                ':resource_id' => $resource_id
            )
        );

        $resource = $sth->fetch();

        $data['error'] = '';

        if(!isset($resource['resource_id'])) {

            $data['error'] = 'Invalid resource';
            return $data;

        }

        $user = Core::r('users')->get_user(array(
                'user_id' => $data['user_id']
            )
        );

        $msg_html = "Hi " . $user['first_name'] . ",
<br><br>
Here is the resource you requested from the " . SITE_NAME . ".
<br><br>
You can download it by <a href=\"http://" . SITE_URL . "/resources/" . $resource_id . ".pdf\" target=\"_bank\">clicking here</a>.";

        Core::email(array(
                'email_to' => $user['email'],
                'name_to' => ucwords($user['first_name'] . ' ' . $user['last_name']),
                'email_from' => ADMIN_EMAIL,
                'name_from' => SITE_NAME,
                'subject' => "Resource you requested from " . SITE_NAME,
                'message' => $msg_html
            )
        );

        $data['sent'] = 1;

        $c = Core::db_count(array(
                'table' => GAMO_DB . '.actions_log',
                'values' => array(
                    'user_id' => $data['user_id'],
                    'action_types_id' => Core::r('actions')->action_types_id(array('action_key' => 'download_resource')),
                    'active' => 1,
                    'int_other' => $resource_id
                )
            )
        );
        
        if($c == 0) {

            $result = Core::r('actions')->create_action(array(
                    'user_id' => $data['user_id'],
                    'action_types_id' => 'download_resource',
                    'int_other' => $resource_id
                )
            );

        }

        $user = Core::r('users')->get_user(array(
                'user_id' => $data['user_id']
            )
        );

        $data['user_points'] = $user['points'];

        return $data;

    }

}
?>
