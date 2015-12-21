<?
Core::get_element('game_header');
?>
/start_view
<div class="visible-xs mtop15"></div>
		<!-- InstanceBeginEditable name="content" -->
                        <div class="content widget pointshistory">
							<div class="module-title" style="margin-bottom:20px">Points History</div>
							<table class="table borderless table-striped">
							
							
/end_view

							<? foreach( $data['event_activity'] as $activity):?>
/start_view

								<tr>
									<th class="point-amount" style="color:#08abf7">' . $activity['point_value_used'] . ' Pts</th>
									<td class="point-desc">' . $activity['display'] . '</td>
								</tr>						
/end_view
							<? endforeach; ?>

/start_view
							</table>
						</div>
						<!-- InstanceEndEditable -->
/end_view
<?
Core::get_element('game_footer');
?>