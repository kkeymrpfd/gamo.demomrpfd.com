<?
$data['mdf']['package_id'] = Core::get_input('package_id', 'get');
$data['mdf']['mdf_activity_id'] = Core::get_input('mdf_activity_id', 'get');

$save_text = 'Order';

if($data['mdf']['mdf_activity_id'] != '') {

	$data['mdf']['activity'] = Core::r('mdf')->get_activities([
		'mdf_activity_ids' => [$data['mdf']['mdf_activity_id']]
	]);

	if(count($data['mdf']['activity']['activities']) != 1) {

		header("Location: /");
		die();

	}

	$data['mdf']['activity'] = $data['mdf']['activity']['activities'][0];
	$data['mdf']['package_id'] = $data['mdf']['activity']['package_id'];
	$save_text = 'Save';

}

$data['mdf']['package'] = Core::r('mdf')->get_package(array(
		'package_id' => $data['mdf']['package_id']
	)
);

if(!isset($data['mdf']['package']['vendor_name'])) {

	header("Location: /");
	die();

}

Core::get_element('game_header');

$saved_fields = '';

if($data['mdf']['mdf_activity_id'] != '') {

	$saved_fields = 'mdf.mdf_activity_id = "' . $data['mdf']['mdf_activity_id'] . '";mdf.prefill("' . str_replace('"', '\"', json_encode($data['mdf']['activity']['fields'])) . '");';

}

?>
<? $view_output .= '
<link rel="stylesheet" type="text/css" href="/css/datepicker.css">
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/gamo/mdf.js?t=' . time() . '"></script>
<script src="/js/pager.js?t=1"></script>
<div class="row">
	<div class="col-md-4 col-sm-4 col-xs-12 submenu hidden-xs">
	'; ?>
	<? Core::get_element('game_nav'); ?>
	<? $view_output .= '
	</div>
	<div class="col-md-9 col-sm-9 col-xs-12 content2">

		<form id="mdf-order-form" style="margin:0px">
		<div class="hidden-xs">
			<div class="module-title">MDF Order Form</div>
		</div>
		<div id="mdf_order_result_h" style="margin:20px 0px"></div>
		<div style="font-weight:bold;font-size:1.3em;margin:10px 0px 20px 0px">
			' . $data['mdf']['package']['vendor_name'] . ' - ' . $data['mdf']['package']['name'] . '
		</div>
'; ?>
		<? foreach($data['mdf']['package']['order_form']['form'] as $k => $section) {
		
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

						if(!isset($option['bucket_require']) || $option['bucket_require'] == $data['mdf']['package']['bucket_category_id']) {

							if($field['id'] != 'packages_option_id'
								|| $data['mdf']['mdf_activity_id'] == ''
								|| $field['id'] == 'packages_option_id' && $data['mdf']['mdf_activity_id'] != '' && $option['value'] == $data['mdf']['activity']['fields']['packages_option_id']) {

								$view_output .= '<option value="' . $option['value'] . '">' . $option['label'] . '</option>';

							}

						}

					}

					$view_output .= '</select></div>';

				} else if($field['type'] == 'radio_group') {

					$view_output .= '<div class="row" style="margin:20px 10px 10px 40px;text-align:center" ' . $show_if . '>';

					$end = max(count($field['groups']) - 1, 0);

					foreach($field['groups'] as $k3 => $group) {

						if($k3 == 0 || $k3 == 3) {
								
							$view_output .= '<div class="row">';

						}

						$view_output .= '<div class="col-sm-4 col-lg-4" style="text-align:left;margin-bottom:15px">
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
<? $view_output .= '
		<center>
			<div style="margin:20px 0px 50px 0px">
				<button class="btn btn-default" style="color:#666">Cancel</button>
				<button type="submit" class="btn btn-primary" style="margin-left:30px">' . $save_text . '</button>
			</div>
		</center>
		</form>
	</div>			
</div>
		<!-- InstanceEndEditable -->
<script language="javascript">
$(document).ready(function() {

	gamo.page_two_cols();
	$(".datepicker").datepicker();
	mdf.use_package_id = "' . $data['mdf']['package_id'] . '";
	mdf.use_quarter_id = "1";
	' . $saved_fields . '

});

</script>
'; ?>
<?
Core::get_element('page_footer');
?>
