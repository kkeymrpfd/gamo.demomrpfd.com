<?
/*
Pull data from inside view
*/
class Gamo_Insideview {

	public $errors; // Store error codes

	function __construct() {

		// Create error codes
		$this->errors = array(
			array(
				'error_code' => '1',
				'error_msg' => 'Valid parameters not specified for pulling company information'
			),
			array(
				'error_code' => '2',
				'error_msg' => 'Could not pull raw data'
			),
			array(
				'error_code' => '3',
				'error_msg' => 'Could not extract from raw data'
			)
		);

	}

	/*
	Pull raw company data
	*/
	function pull_raw_company($options = array()) {

		/*
		args:
		{
			base_url: the base url to which the company gets added (defaults to http://www.insideview.com/directory/),
			company: the name of the company,
			url: the actual url to use rather then constructing it (optional)
		}

		returns:
			if success:
			{
				raw: the raw content of the company page
			}

			if error:
				std error
		*/

		Core::ensure_defaults(array(
				'base_url' => 'http://www.insideview.com/directory/',
				'company' => '',
				'url' => ''
			)
		, $options);

		if($options['url'] != '') {

			$url = $options['url'];

		} else {

			$options['company'] = ltrim(rtrim($options['company']));
			$options['base_url'] = ltrim(rtrim($options['base_url']));

			if($options['company'] == '' || $options['base_url'] == '') { // Invalid and/or missing parameters

				return Core::error($this->errors, 1);

			}

			$url_company = str_replace(' ', '-', $options['company']);

			$url = $options['base_url'] . $url_company;

		}
			
		$stream_context = stream_context_create(array('http' =>
			    array(
			        'method'  => 'GET',
			        'timeout' => 30,
			        "User-Agent: 	Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6\r\n"
			    )
			)
		);

		$raw = file_get_contents($url, false, $stream_context, false, 500000);

		if(strpos($raw, '<div class="views-field views-field-company-name">') === FALSE) {

			return Core::error($this->errors, 2);

		}

		return array(
			'raw' => $raw
		);

	}

	/*
	Extract data into an array from the raw data
	*/
	function parse_raw($options = array()) {

		/*
		args:
		{
			raw: the raw content to pull from,
			company: the name of the company as it is in the insideview url
		}

		returns:
			if success:
			{
				company_name: the name of the company passed to the url for $this->pull_raw_company
				company_display_name: the name of the company as it is displayed on the page
				address: the address of the company
				industry: the industry of the company
				phone: contact number for the company
				url: the company's website url
				annual_revenue: annual revenue of the company
				employee_qty: the # of employees the company has
			}

			if error:
			std error
		*/

		Core::ensure_defaults(array(
				'raw' => ''
			)
		, $options);

		$start = strpos($options['raw'], '<div class="views-field views-field-company-name">');

		if($start === FALSE) {

			return Core::error($this->errors, 2);

		}


		$cont = substr($options['raw'],
				$start,
				strpos($options['raw'], '<div class="views-field views-field-creationDate">') - $start + 100
			);

		
		$raw_lines = explode("\n", $cont);

		$this->line_info(array(
				'raw_line' => $raw_lines[0]
			)
		);

		$fields = array(
			'company_display_name' => '',
			'street' => '',
			'city' => '',
			'state' => '',
			'zip' => '',
			'country' => '',
			'website' => '',
			'phone' => '',
			'revenue' => '',
			'employee_qty' => ''
		);

		$line_c = 0;

		foreach($fields as $field => $v) {

			if($field == 'employee_qty') {

				$line_c = 11;

			}

			$info = $this->line_info(array(
					'raw_line' => $raw_lines[$line_c]
				)
			);

			if(Core::has_error($info)) {

				return $info;

			}

			$fields[$field] = $info['info'];

			++$line_c;

		}

		$fields['phone'] = str_replace(array('<span id="phone">Phone: ', '-'), '', $fields['phone']);
		$fields['website'] = substr($fields['website'], strpos($fields['website'], '">')+2 );
		$fields['website'] = substr($fields['website'], 0, strpos($fields['website'], '</a>'));
		
		return $fields;

	}

	/*
	Extracts the actual information from a raw section line of html
	*/
	function line_info($options = array()) {

		/*
		args:
		{
			raw_line: the raw line content
		}

		returns:
			if success:
			{
				info: the information contained on the line
			}

			if error:
			std error
		*/

		Core::ensure_defaults(array(
				'raw_line' => ''
			)
		, $options);
		
		$start = strpos($options['raw_line'], '<span class="field-content">');

		if($start === FALSE) {

			return Core::error($this->errors, 3);

		}

		$cont = substr($options['raw_line'], $start+28);

		$end = strpos($cont, '</span>');

		if($end !== FALSE) {

			$cont = substr($cont, 0, $end);

		}
		
		return array(
			'info' => $cont
		);

	}

	/*
	Get data about a company in array format
	*/
	function get_company($options = array()) {

		/*
		/*
		args:
		{
			base_url: the base url to which the company gets added (http://www.insideview.com/directory/),
			company: the name of the company
		}

		returns:
			if success:
			{
				company_name: the name of the company passed to the url for $this->pull_raw_company
				company_display_name: the name of the company as it is displayed on the page
				address: the address of the company
				industry: the industry of the company
				phone: contact number for the company
				url: the company's website url
				revenue: annual revenue of the company
				employees: the # of employees the company has
			}

			if error:
				std error
		*/

	}

}
?>
