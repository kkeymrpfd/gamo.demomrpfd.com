<?
// Generate the data for the home page of the site
// @depend core/class.Core.php
class Control_Excel_Test {

	function run() {
		
		global $data, $page_settings, $models, $session, $gamo, $dbh;

        $file = DIR_STORE . '/mdf_programs.csv';
 
        $arr = Core::csv_to_array($file);

        foreach($arr as $k => $v) {

            if($v['vendor'] == 'Market Resource Partners') {

                $split = explode('-MRP:', $v['option_description']);
                $v['option_description'] = isset($split[1]) ? $split[1] : $split[0];

                $split = explode('-MRP:', $v['program_description']);
                $v['program_description'] = isset($split[1]) ? $split[1] : $split[0];

            }

            $arr[$k] = $v;

        }

        Core::print_r($arr);

		return $data;

	}

}
?>
