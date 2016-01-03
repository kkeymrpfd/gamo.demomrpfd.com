<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Get_Mdf_Activities {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

		$page_settings['allow_json'] = 1;

		Core::authorize(array(
				'user_id' => 'get'
			)
		);

		$data['mdf']['activities'] = Core::r('mdf')->get_activities(array(
				'quarter_ids' => Core::get_input('quarter_ids', 'get'),
				'bucket_category_ids' => Core::get_input('bucket_category_ids', 'get'),
				'vendor_entity_ids' => Core::get_input('vendor_entity_ids', 'get'),
				'category_ids' => Core::get_input('category_ids', 'get'),
				'partner_entity_ids' => Core::get_input('partner_entity_ids', 'get'),
			)
		);

		return $data;

	}

}
?>
