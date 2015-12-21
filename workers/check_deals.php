<?php
// Ensure that all users have a pin
require(dirname(dirname(__FILE__)) . '/inc/config.php');
require(dirname(dirname(__FILE__)) . '/inc/loader.php');
require(DIR_INC . '/gamo/class.Gamo.php');

function format_csv($filename) {

	$raw = file_get_contents($filename);

	if(strpos($raw, ',,') === FALSE) {

		return false;

	}

	$raw = str_replace(',,', ',"",', $raw);
	$lines = explode("\n", $raw);

	foreach($lines as $k => $line) {

		if(substr($line, -1) == ',') {

			$line .= '""';

		}

	}

	$raw = implode("\n", $lines);

	file_put_contents($filename . '-parsed', $raw);

}

function csv_to_array($filename='', $delimiter=',')
{
    if(!file_exists($filename) || !is_readable($filename))
        return FALSE;

    $header = NULL;
    $data = array();
    $c = 0;

    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE)
        {

            if(!$header) {
                $header = $row;
            }
            else {

            	++$c;
            	
            	$hcount = count($header);
            	$rcount = count($row);

            	if($hcount > $rcount) {

            		$diff = $hcount - $rcount;

            		for($i = 0;$i < $diff;$i++) {

            			$row[] = '';

            		}

	            }

                $use_line = array();

		    	foreach($header as $k => $key) {

		    		if(!isset($use_line[$key]) || $use_line[$key] == '') {

		    			$use_line[$key] = $row[$k];

		    		}

		    	}

		    	$data[] = $use_line;

            }


        }
        fclose($handle);
    }
    return $data;
}

$list = csv_to_array(DIR_STORE . '/pos_sheets/1.csv');

$raw_pos_data = '';

for($i = 1; $i <= 7;$i++) {

	$raw_pos_data .= file_get_contents(DIR_STORE . '/pos_sheets/' . $i . '.csv');

}

$deals = csv_to_array(DIR_STORE . '/deals.csv');

foreach($deals as $k => $deal) {

	if(isset($deal['Deal ID'])) {

		$deal['Deal ID'] = ltrim(rtrim(trim($deal['Deal ID'])));

		if(strlen($deal['Deal ID']) > 5
			&& strpos($raw_pos_data, $deal['Deal ID']) !== FALSE) {

			echo 'found: ' . $deal['Deal ID'] . "\n";

		}

	}

}


?>