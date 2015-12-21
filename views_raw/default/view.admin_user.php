/start_view
/js: /js/gamo/admin_actions.js
/js: /js/pager.js
/js: /js/gamo/admin_users.js
<table {table-normal}>
<tr>
	<td valign="top" style="width:600px">

		<!-- user info //-->
		<table {table-normal}>
			<tr>
				<td valign="top"><div class="user-img-mid"><img src="/get_user_img/' . $data['user']['user_id'] . '.png" class="img-fit"></div></td>
				<td width="10"></td>
				<td valign="top">
					<div style="font-size:18px;font-weight:bold">' . htmlspecialchars($data['user']['display_name']) . '</div>
					<div>' . htmlspecialchars($data['user']['first_name']) . ' ' . htmlspecialchars($data['user']['last_name']) . '</div>
					<div>Company: ' . htmlspecialchars($data['user']['company']) . '</div>
					<div>E-mail: ' . htmlspecialchars($data['user']['email']) . '</div>
					
					<div style="margin-top:15px;font-weight:bold">' . $data['user']['badge_qty'] . ' of ' . $data['badge_qty'] . ' badges earned</div>
					<div class="progress progress-striped">
					  <div class="bar" style="width: ' . $data['badge_pct'] . '%;"></div>
					</div>

					<div style="font-weight:bold">Badges:</div>
/end_view
<?

foreach($data['user']['has'] as $k => $info) { // Display all badges. Iterate through each user_info item and display only the badges

	if(is_numeric($info['badge_id']) && $info['badge_id'] > 0 && $info['rank'] == 0) { // This is a badge

		$view_output .= '<span class="badge badge-info" style="margin:6px;display:inline-block">' . $info['badge_name'] . '</span>';

	}

}
?>
/start_view
				</td>
			</tr>
		</table>
		<!-- user info e //-->

	</td>
	<td width="50"></td>
	<td valign="top">

		<div class="board" style="width:200px">
			<div style="font-size:18px;color:#777;padding:5px">Points</div>
			<div style="height:1px;width:100%;background-color:#ddd"></div>
			<div style="height:1px;width:100%;background-color:#fff"></div>
			' . $comps->points(array(
					'points' =>  $data['user']['points'],
					'html' => 'style="font-size:46px;margin:5px 5px 10px 5px;display:block;padding-top:18px"',
					'text' => '<div class="point-label" style="margin-top:3px">points</div>',
					'front' => 0
				)
			) . '
			<div class="board-accent border-curved-bottom" style="font-size:17px;margin-top:5px">
				Rank: #<b>' . $data['user']['rank'] . '</b>
				<div>Level: <b>' . $data['user']['level'] . '</b></div>
			</div>
		</div>

	</td>
</tr>
</table>

<div style="height:1px;width:100%;background-color:#ccc;margin:30px 0px 15px 0px"></div>
<div style="text-align:left">
	<div style="font-size:18px;margin:10px 0px 20px 0px">Activity History</div>
	<form id="actions_form" onsubmit="return false">
		<input type="hidden" id="filter_name" value="' . $data['user']['email'] . '" origin_form="actions_form">
		<table {table-normal}>
		<tr>
			<td align="right" valign="top" style="padding:5px 10px 0px 0px">Activity: </td>
			<td>
			<select id="filter_action_type">
				<option value="none">Show all activities</option>
		/end_view
		<?
		foreach($data['action_types'] as $k => $type) {

			$view_output .= '<option value="' . $type['action_types_id'] . '">' . $type['action_name'] . '</option>';

		}
		?>
		/start_view
			</select>

			</td>
		</tr>
		<tr>
			<td align="right" valign="top"><input type="checkbox" id="filter_show_inactive"></td>
			<td style="padding-left:6px"><div check-bind="filter_show_inactive">Show deleted actions</div></td>
		</tr>
		<tr>
			<td></td>
			<td align="right"><div class="btn btn-primary" id="get_actions_submit" is-submit="1" style="margin-top:14px">Get Actions</div></td>
		</tr>
		</table>
	</form>

	<div id="actions-holder" style="margin:30px 5px"></div>
	<div id="actions-holder-pager" style="margin-left:650px"></div>
</div>
/end_view
