<?
$data['mdf']['order_form'] = [
	[
		'name' => "Partner Information",
		'fields' => [
			[
				'id' => "parter_contact_name",
				'label' => "Partner Contact Name",
				'type' => "text",
				'required' => 1,
				'prefill' => "user_full_name"
			],
			[
				'id' => "partner_contact_number",
				'label' => "Partner Contact Phone",
				'type' => "text",
				'required' => 1,
				'prefill' => "user_phone",
				'validate' => [
					'min_length' => 10
				]
			],
			[
				'id' => "partner_contact_email",
				'label' => "Partner Contact Email",
				'type' => "text",
				'required' => 1,
				'prefill' => "user_email",
				'validate' => [
					'is_email' => 1
				]
			]
		]
	],
	[
		'name' => "Target Details",
		'fields' => [
			[
				'id' => "message_topic",
				'label' => "Message Topic",
				'type' => "select",
				'required' => 0,
				'options' => [
					[
						'value' => "software",
						'label' => "Software",
						'bucket_require' => "software"
					],
					[
						'value' => "enterprise",
						'label' => "Enterprise",
						'bucket_require' => "enterprise"
					],
					[
						'value' => "client",
						'label' => "Client",
						'bucket_require' => "client"
					]
				]
			],
			[
				'id' => "message_topic_client",
				'label' => "",
				'type' => "radio_group",
				'required' => 0,
				'show_if' => [
					'id' => "message_topic",
					'value' => "client"
				],
				'groups' => [
					[
						'group_name' => "Productivity",
						'options' => [
							"Notebooks", "Desktops"
						]
					],
					[
						'group_name' => "Mobility",
						'options' => [
							"Tablets", "Tablets 2-in-1s"
						]
					],
					[
						'group_name' => "Performance",
						'options' => [
							"Workstations", "Ruggedized Systems"
						]
					]
				]
			],
			[
				'id' => "message_topic_software",
				'label' => "",
				'type' => "radio_group",
				'required' => 0,
				'show_if' => [
					'id' => "message_topic",
					'value' => "software"
				],
				'groups' => [
					[
						'group_name' => "Software",
						'options' => [
							"KACE", "Data Protection", "SonicWALL"
						]
					]
				]
			],
			[
				'id' => "message_topic_enterprise",
				'label' => "",
				'type' => "radio_group",
				'required' => 0,
				'show_if' => [
					'id' => "message_topic",
					'value' => "enterprise"
				],
				'groups' => [
					[
						'group_name' => "Converged Solutions",
						'options' => [
							"PowerEdge FX Architecture", "PowerEdge VRTX", "Nutanix with Citrix", "EVO:Rail with VMware"
						]
					],
					[
						'group_name' => "Modernize and transform the network",
						'options' => [
							"Software-defined networking", "Data center networking", "Campus / office networking"
						]
					],
					[
						'group_name' => "Your scale to hyperscale",
						'options' => [
							"13G PowerEdge servers", "X86 Server transition"
						]
					],
					[
						'group_name' => "Cloud client-computing",
						'options' => [
							"End-to-end desktop virtualization solutions for Citrix, Microsoft, VMware and Wyse vWorkspace"
						]
					],
					[
						'group_name' => "Redefining the economics of storage",
						'options' => [
							"Flash at the price of disk", "Mid-range SAN", "SC4000", "SC4020", "Flash Leadership", "SCv2000", "Software-defined storage", "Storage Solutions"
						]
					]				
				]
			],
			[
				'id' => "start_date",
				'label' => "Campaign Start Date",
				'type' => "date"
			],
			[
				'id' => "sfdc_campaign_code",
				'label' => "SFDC Campaign Code",
				'type' => "text"
			],
			[
				'id' => "geography",
				'label' => "Geography",
				'type' => "select",
				'required' => 0,
				'options' => [
					[
						'value' => "none",
						'label' => "Please select an option"
					],
					[
						'value' => "city_radius",
						'label' => "City Radius"
					],
					[
						'value' => "area_codes",
						'label' => "Area Codes"
					]
				]
			],
			[
				'id' => "state",
				'label' => "State",
				'type' => "text",
				'show_if' => [
					'id' => "geography",
					'value' => "city_radius"
				]
			],
			[
				'id' => "city",
				'label' => "City Name",
				'type' => "text",
				'show_if' => [
					'id' => "geography",
					'value' => "city_radius"
				]
			],
			[
				'id' => "radius",
				'label' => "Radius",
				'type' => "text",
				'show_if' => [
					'id' => "geography",
					'value' => "city_radius"
				]
			],
			[
				'id' => "area_codes",
				'label' => "Area Codes",
				'type' => "text",
				'show_if' => [
					'id' => "geography",
					'value' => "area_codes"
				]
			],
			[
				'id' => "employee_size",
				'type' => "checkbox_list",
				'label' => 'Employee Size',
				'options' => [
					[
						'id' => "employee_size_0_to_99",
						'label' => "1 - 99",
					],
					[
						'id' => "employee_size_100_to_249",
						'label' => "100 - 249",
					],
					[
						'id' => "employee_size_250_to_499",
						'label' => "250 - 499",
					],
					[
						'id' => "employee_size_500_to_999",
						'label' => "500 - 999",
					],
					[
						'id' => "employee_size_1000_to_5000",
						'label' => "1000 to 5000",
					]
				]
			]
		]
	]
];

$data['mdf']['package_id'] = Core::get_input('package_id', 'get');

$data['mdf']['package'] = Core::r('mdf')->get_package(array(
		'package_id' => $data['mdf']['package_id']
	)
);

$investment_levels = [];
$investment_levels_fields = [];

foreach($data['mdf']['package']['packages_options'] as $k => $option) {

	$investment_levels[] = [
		'value' => $option['packages_option_id'],
		'label' => '$' . $option['price']*1
	];

	$investment_levels_fields[] = [
		'id' => 'investment_level_' . $option['packages_option_id'],
		'type' => 'content_block',
		'show_if' => [
			'id' => 'investment_level',
			'value' => $option['packages_option_id']
		],
		'content' => $option['description']
	];

}

array_unshift($investment_levels_fields, [
	'id' => "investment_level",
	'label' => "Investment Level",
	'type' => "select",
	'required' => 0,
	'options' => $investment_levels
]);

array_unshift($data['mdf']['order_form'], [
	'name' => 'Package Selection',
	'fields' => $investment_levels_fields
]);

Core::get_element('game_header');
?>
/start_view
<link rel="stylesheet" type="text/css" href="/css/datepicker.css">
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/gamo/mdf.js?t=' . time() . '"></script>
<script src="/js/pager.js?t=1"></script>
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
	/end_view
	<? Core::get_element('game_nav'); ?>
	/start_view
	</div>
	<div class="col-md-9 col-sm-9 col-xs-12 content2">

		<div class="hidden-xs">
			<div class="module-title">MDF Order Form</div>
		</div>
		<div style="font-weight:bold;font-size:1.3em;margin:10px 0px 20px 0px">
			' . $data['mdf']['package']['vendor_name'] . ' - ' . $data['mdf']['package']['name'] . '
		</div>
/end_view
		<? foreach($data['mdf']['order_form'] as $k => $section) {
		
			$view_output .= '<div style="font-size:1.2em;font-weight:bold;background-color:#eee;padding:0.5em;margin:10px 0px">' . $section['name'] . '</div>';

			foreach($section['fields'] as $k2 => $field) {

				$show_if = '';
				$prefill = '';

				if(isset($field['show_if'])) {

					$show_if = ' data-show-if-id="' . $field['show_if']['id'] . '" data-show-if-value="' . $field['show_if']['value'] . '"';

				}

				if(isset($field['prefill'])) {

					switch($field['prefill']) {

						case 'user_full_name';
							$prefill = ' value="' . $data['user']['first_name'] . ' ' . $data['user']['last_name'] . '" ';
							break;
						case 'user_phone';
							$prefill = ' value="' . $data['user']['phone'] . '" ';
							break;
						case 'user_email';
							$prefill = ' value="' . $data['user']['email'] . '" ';
							break;
						default:
							$prefill = '';

					}

				}

				if($field['type'] == 'text') {

					$view_output .= '
					<div class="form-group"' . $show_if . '>
						<label for="redirect_url" style="width:200px;text-align:right">' . $field['label'] . '</label>
						<input type="text" class="form-control" id="' . $field['id'] . '" style="display:inline-block;width:400px;margin-left:20px;color:#000"' . $prefill . '>
					</div>
					';
				
				} else if($field['type'] == 'date') {

					$view_output .= '
					<div class="form-group"' . $show_if . '>
						<label for="redirect_url" style="width:200px;text-align:right">' . $field['label'] . '</label>
						<input type="text" class="form-control datepicker" id="' . $field['id'] . '" style="display:inline-block;width:400px;margin-left:20px;color:#000">
					</div>
					';
				
				} else if($field['type'] == 'select') {

					$view_output .= '
					<div class="form-group"' . $show_if . '>
						<label for="redirect_url" style="width:200px;text-align:right">' . $field['label'] . '</label>
						<select class="form-control" style="width:300px;display:inline-block;margin-left:20px" id="' . $field['id'] . '">';

					foreach($field['options'] as $k3 => $option) {

						$view_output .= '<option value="' . $option['value'] . '">' . $option['label'] . '</option>';

					}

					$view_output .= '</select></div>';

				} else if($field['type'] == 'radio_group') {

					$view_output .= '<div class="row" style="margin:20px 10px" ' . $show_if . '>';

					$end = max(count($field['groups']) - 1, 0);

					foreach($field['groups'] as $k3 => $group) {

						if($k3 == 0 || $k3 == 3) {
								
							$view_output .= '<div class="row">';

						}

						$view_output .= '<div class="col-sm-4 col-lg-4">
						<div style="font-weight:bold">' . $group['group_name'] . '</div>';

						foreach($group['options'] as $k4 => $option) {

							$view_output .= '<div class="check-bind" style="margin:5px 0px">
								<input type="radio" name="' . $field['id'] . '" value="' . $option . '"> <span style="position:relative;top:-3px">' . $option . '</span>
							</div>';

						}

						$view_output .= '</div>';

						if($k3 == $end || $k3 == 2) {
							
							$view_output .= '</div>';

						}

					}

					$view_output .= '</div>';

				} else if($field['type'] == 'checkbox_list') {

					$view_output .= '
					<div class="form-group"' . $show_if . '>
						<label for="redirect_url" style="width:200px;text-align:right;vertical-align:top;margin-top:5px">' . $field['label'] . '</label>
						<div style="width:300px;display:inline-block;margin-left:20px">';

					foreach($field['options'] as $k3 => $option) {

						$view_output .= '<div class="check-bind" style="margin:5px 0px">
								<input type="checkbox" id="' . $option['id'] . '"> <span style="position:relative;top:-3px">' . $option['label'] . '</span>
							</div>';


					}

					$view_output .= '</div></div>';


				} else if($field['type'] == 'content_block') {

					$view_output .= '<div style="margin:20px"' . $show_if . '>' . $field['content'] . '</div>';

				}

			}
		
		} ?>
/start_view
		<center>
			<div style="margin:20px 0px 50px 0px">
				<div class="btn btn-default" style="color:#666">Cancel</div>
				<div class="btn btn-primary" style="margin-left:30px">Order</div>
			</div>
		</center>
	</div>			
</div>
		<!-- InstanceEndEditable -->
<script language="javascript">
$(document).ready(function() {

	gamo.page_two_cols();

});

</script>
/end_view
<?
Core::get_element('page_footer');
?>
