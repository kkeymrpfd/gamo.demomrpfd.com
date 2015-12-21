/start_view
/js: /js/gamo/admin_actions.js
/js: /js/pager.js
<div style="width:100%;text-align:left">
	<form id="actions_form" onsubmit="return false">
		<table {table-normal}>
		<tr>
			<td align="right" valign="top" style="width:100px;padding:5px 10px 0px 0px">User: </td>
			<td><input type="text" id="filter_name" placeholder="Name, company, or e-mail" origin_form="actions_form"></td>
		</tr>
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
</div>

<div id="actions-holder" style="margin:30px 5px"></div>
<div id="actions-holder-pager" style="margin-left:650px"></div>
/end_view