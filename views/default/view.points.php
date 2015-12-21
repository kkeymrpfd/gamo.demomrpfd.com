<?
Core::get_element('game_header');
?>
<? $view_output .= '
<div class="visible-xs mtop15"></div>
		<!-- InstanceBeginEditable name="content" -->
                        <div class="content widget pointshistory">
							<div class="module-title" style="margin-bottom:20px">Points History</div>
							<table class="table borderless table-striped">
							
							
'; ?>

							<? foreach( $data['event_activity'] as $activity):?>
<? $view_output .= '

								<tr>
									<th class="point-amount" style="color:#08abf7">' . $activity['point_value_used'] . ' Pts</th>
									<td class="point-desc">' . $activity['display'] . '</td>
								</tr>						
'; ?>
							<? endforeach; ?>

<? $view_output .= '
							</table>
						</div>
						<!-- InstanceEndEditable -->
'; ?>
<?
Core::get_element('game_footer');
?>