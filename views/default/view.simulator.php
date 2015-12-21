<? $view_output .= '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
</head>
<body>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/core.js"></script>
<script type="text/javascript" src="/js/gamo/simulator.js"></script>
<link rel="stylesheet" type="text/css" href="/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="/css/gamo.css">
<div style="margin:30px 300px;width:880px">
	<div id="cont-main">
		<select id="user">
			<option value="none">Please select a user</option>
'; ?>
<?
foreach($data['users']['users'] as $k => $user) {

	$view_output .= '<option value="' . $user['user_id'] . '">' . $user['display_name'] . '</option>';

}

?>
<? $view_output .= '
		</select>
		<div class="btn" id="login" style="margin:-12px 0px 0px 10px">Login as user</div>
'; ?>
<?
array_push($data['categories'], array('category_name' => 'all actions', 'category_id' => -1));

// Generate how to get points for each section
foreach($data['categories'] as $k => $cat) {

	$view_output .= '<div id="section-' . str_replace(" ", "-", $cat['category_name']) . '">'
		. ucfirst($cat['category_name'])
		. '<div style="margin:10px">';

	foreach($data['action_types'] as $k2 => $action_type) {

		if($cat['category_name'] != 'all actions') {

			// Determine if this action type belongs to this category (will return 1 if it does)
			$c = Core::multi_count($action_type['has'], array(
					'info_type' => 'category',
					'int_info' => $cat['category_id']
				)
			);

		} else {

			$c = 1;

		}

		if($c == 1) {

			$view_output .= '<div style="margin:7px">
				<div class="points-up" style="position:relative;top:3px">+ ' . $action_type['points']
				. '</div>&nbsp;<div class="btn" action-types-id="' . $action_type['action_types_id'] . '">' . $action_type['action_name'] . '</div>
			</div>';

		}

	}

	$view_output .= '</div>';

}

?>
<? $view_output .= '
	</div>
</div>

<div id="result-holder" class="float" style="bottom:0px;right:20px;text-align:center">
	<a href="#" onclick="simulator.set_points(0);return false">Reset</a>
	<div class="board" id="total-points" style="background-color:#eee;color:#222;width:100px;padding:10px">0 pts total</div>
</div>

<script language="javascript">
$(document).ready(function() {

	$("[action-types-id]").click(function() {

		simulator.simulate({
			user_id: $("#user").val(),
			action_types_id: $(this).attr("action-types-id")
		});

	});

	$("#user").change(function() {

		simulator.set_points(0);

	});

	$("#login").click(function() {

		var user_id = $("#user").val();

		if(user_id != "none") {

			url = "/?a=auth_user&user_id="+user_id;

			var win=window.open(url, "gamo");
  			win.focus();

		}

	});

});
</script>

</body>
</html>
'; ?>