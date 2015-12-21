<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Load_Mdf_Programs {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

        $file = DIR_STORE . '/mdf_programs.csv';
 
        $packages = Core::csv_to_array($file);

        foreach($packages as $k => $v) {

            if($v['vendor'] == 'Market Resource Partners') {

                $split = explode('-MRP:', $v['option_description']);
                $v['option_description'] = isset($split[1]) ? $split[1] : $split[0];

                $split = explode('-MRP:', $v['program_description']);
                $v['program_description'] = isset($split[1]) ? $split[1] : $split[0];

            }
            $v['price'] = preg_replace('/\D/', '', $v['price']);

            $packages[$k] = $v;

        }

        foreach($packages as $k => $package) {

            $vendor_entity_id = Core::r('mdf')->create_vendor(array(
                    'name' => $package['vendor']
                )
            );

            $bucket_category_id = Core::r('categories')->create_category(array(
                    'category_name' => $package['bucket'],
                    'category_type' => 'mdf_bucket_type'
                )
            );

            $category_category_id = Core::r('categories')->create_category(array(
                    'category_name' => $package['category'],
                    'category_type' => 'mdf_package_type'
                )
            );

            $package_id = Core::r('mdf')->create_package(array(
                    'vendor_entity_id' => $vendor_entity_id['vendor_entity_id'],
                    'bucket_category_id' => $bucket_category_id['category_id'],
                    'name' => $package['package_name'],
                    'description' => $package['package_description'],
                )
            );

            $result = Core::r('mdf')->create_packages_option(array(
                    'package_id' => $package_id['package_id'],
                    'description' => $package['option_description'],
                    'price' => $package['price']
                )
            );

            $result = Core::r('mdf')->assign_package_to_quarter(array(
                    'package_id' => $package_id['package_id'],
                    'quarter_id' => 'Q1FY16'
                )
            );

            $result = Core::r('mdf')->assign_package_to_category(array(
                    'package_id' => $package_id['package_id'],
                    'category_id' => $category_category_id['category_id']
                )
            );

        }

		return $data;

	}

}
?>
