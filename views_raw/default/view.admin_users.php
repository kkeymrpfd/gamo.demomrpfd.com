
/start_view
/js: /js/gamo/admin_users.js
/js: /js/pager.js
<div style="width:100%;text-align:left">
	<form id="users_form">
		<table {table-normal}>
		<tr>
			<td align="right" valign="top" style="width:100px;padding:5px 10px 0px 0px">User: </td>
			<td><input type="text" id="filter_name" placeholder="Name, company, or e-mail" origin_form="users_form"></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td align="right" valign="top" style="padding:5px 10px 0px 0px">Activity: </td>
			<td>
			<select id="filter_action_type">
				<option value="none">Do not filter by activity</option>
		/end_view
		<?
		foreach($data['action_types'] as $k => $type) {

			$view_output .= '<option value="' . $type['action_types_id'] . '">' . $type['action_name'] . '</option>';

		}
		?>
		/start_view
			</select>

			</td>
			<td align="right" valign="top" style="padding:5px 10px 0px 30px">Quantity: </td>
			<td><input type="text" id="filter_action_type_qty" class="input-small" style="width:36px" value="1" placeholder="#" origin_form="users_form"></td>
		</tr>
		<tr>
			<td align="right" valign="top" style="padding:5px 10px 0px 0px">Badge: </td>
			<td>
			<select id="filter_badge">
			<option value="none">Do not filter by badge</option>
		/end_view
		<?
		foreach($data['badges'] as $k => $badge) {

			$view_output .= '<option value="' . $badge['badge_id'] . '">' . $badge['badge_name'] . '</option>';

		}
		?>
		/start_view
			</select>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td align="right"><div class="btn btn-primary" id="get_users_submit" is-submit="1">Get users</div></td>
			<td></td>
			<td></td>
		</tr>
		</table>
	</form>
</div>
<div id="users-holder" style="margin:30px 5px"></div>
<div id="users-holder-pager" style="margin-left:650px"></div>
/end_view