<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Adjust_Demandgen {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

        if(Core::get_input('allow', 'get') != 'go') {

            header("Location: /");
            die();

        }

		$sql = "SELECT action_id FROM " . GAMO_DB . ".actions_log WHERE action_types_id = 45";

        $sth = $dbh->prepare($sql);

        $sth->execute();

        while($row = $sth->fetch()) {

            Core::print_r($row);

            Core::r('actions')->modify_action(array(
                    'action_id' => $row['action_id'],
                    'values' => 'delete'
                )
            );

            Core::db_delete(array(
                    'table' => GAMO_DB . ".actions_log",
                    'where' => array(
                        'action_id' => $row['action_id']
                    )
                )
            );

        }

        $sql = "SELECT user_id, email_template_id, email_to FROM " . GAMO_DB . ".demandgen_contacts";
        $sth = $dbh->prepare($sql);
        $sth->execute();


        $demandgen_action_types_id = Core::r('actions')->action_types_id('send_demandgen');
        
        while($row = $sth->fetch()) {

            Core::r('actions')->create_action(array(
                    'user_id' => $row['user_id'],
                    'action_types_id' => $demandgen_action_types_id,
                    'int_other' => $row['email_template_id'],
                    'other' => $row['email_to']
                )
            );

        }

		return $data;

	}

}
?>
