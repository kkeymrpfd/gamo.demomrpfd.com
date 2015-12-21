<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Admin_User_Page {

	function run($options = array()) {

		global $data, $page_settings, $models, $session, $dbh, $gamo;

		$page_settings['allow_json'] = 1;

		$options = Core::ensure_defaults(array(
				'user_id' => Core::get_input('user_id', 'get')
			)
		, $options);

		$group = Core::fetch_column(
			"SELECT user_group FROM " . GAMO_DB . ".users WHERE user_id = :user_id",
			array(
				':user_id' => $options['user_id']
			)
		);

		if($group === FALSE) {

			header("Location: /");
			die();

		}

		header("Location: /?p=admin_edit_" . $group . "_user&user_id=" . $options['user_id']);
		die();

		return $data;

	}

}
?>
