<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Test {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

        /*
        $sql = "SELECT package_id FROM " . GAMO_DB . ".packages";
        $sth = $dbh->prepare($sql);
        $sth->execute();

        while($row = $sth->fetch()) {

            $result = Core::r('mdf')->assign_order_form_to_package(array(
                    'package_id' => $row['package_id'],
                    'mdf_form_id' => 1
                )
            );

            Core::print_r($result);

        }

        die();
        */

        $result = Core::r('mdf')->create_wallet_history(array(
                'wallet_id' => 2,
                'amount' => 15000,
                'type' => 'fund_adjustment',
                'user_id' => 759,
                'bucket_category_id' => 'Client'
            )
        );

        Core::print_r($result);

        die();

        $result = Core::r('categories')->create_category(array(
                'category_name' => 'Software',
                'category_type' => 'mdf_bucket_type'
            )
        );

        Core::print_r($result);

		$result = Core::r('mdf')->create_partner(array(
                'name' => 'Acme Corp',
                'level' => 'Gold'
            )
        );

        Core::print_r($result);

        $result = Core::r('mdf')->assign_user_to_partner(array(
                'user_id' => 'nahmed@mrpfd.com',
                'partner_id' => 'Acme Corp'
            )
        );

        Core::print_r($result);

        $result = Core::r('mdf')->create_wallet(array(
                'entity_id' => 'Acme Corp',
                'quarter_id' => 1 
            )
        );

        Core::print_r($result);

        $category = Core::r('categories')->create_category(array(
                'category_name' => 'BANT Leads',
                'category_type' => 'mdf_package_type'
            )
        );

        Core::print_r($category);

        $package = Core::r('mdf')->create_package(array(
                'vendor_entity_id' => 'MRP',
                'bucket_category_id' => 'Enterprise',
                'name' => 'Delta Prelytix',
                'description' => 'IP Listening Program-Engage with the right prospects at the right time by pursuing opportunities with the highest propensity to buy. 200-350 Leads, access to MRP Marketing Cloud Real time reporting dashboard, Topic / Keyword recommendation and selection, Target IP Listening on Monitored Websites, Taxonomy Details and topic Unique to Partner. Net New Prospects.'
            )
        );

        Core::print_r($package);

        $result = Core::r('mdf')->create_packages_option(array(
                'package_id' => $package['package_id'],
                'description' => 'This is an entry option',
                'price' => 5000 
            )
        );

        Core::print_r($result);

        $result = Core::r('mdf')->assign_package_to_quarter(array(
                'package_id' => $package['package_id'],
                'quarter_id' => 'Q1FY16'
            )
        );

        Core::print_r($result);

        $result = Core::r('mdf')->assign_package_to_category(array(
                'package_id' => $package['package_id'],
                'category_id' => $category['category_id']
            )
        );

        Core::print_r($result);

        /*
        $result = Core::r('mdf')->unassign_package_from_category(array(
                'package_id' => $package['package_id'],
                'category_id' => $category['category_id']
            )
        );

        Core::print_r($result);
        */

        $result = Core::r('mdf')->get_wallet(array(
                'wallet_id' => 2
            )
        );

        Core::print_r($result);

        /*
        $result = Core::r('mdf')->create_wallet_history(array(
                'wallet_id' => 2,
                'amount' => 1500,
                'type' => 'fund_adjustment',
                'user_id' => 759,
                'bucket_category_id' => 77
            )
        );

        Core::print_r($result);
        */

        $result = Core::r('mdf')->get_packages(array(
                'package_id' => 5
            )
        );

        Core::print_r($result);

		return $data;

	}

}
?>
