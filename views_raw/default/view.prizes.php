<?
Core::get_element('game_header');
?>
/start_view
<div class="container" style="margin-top:20px">
/end_view
<? foreach($data['user_badges'] as $k => $badge) {
	if($badge['title'] != 'Begginer Level') {

		$badge_active = ($badge['user_has'] != 1) ? '-inactive' : '';

		if($badge['rank'] <= 0) {

			$badge_image = '<img src="img/badges/' . $badge['badge_id'] . $badge_active . '.png" style="margin:1em 0em">';

		} else {

			$badge_image = '<div class="btn btn-lg btn-yellow" style="font-size:0.9em;margin:1em 0.2em">' . $badge['title'] . '</div>';

		}

?>
/start_view
<div class="panel panel-primary">
  <div class="panel-heading" style="text-align:center">
    <h3 class="panel-title" style="font-weight:bold">
    	<div style="font-weight:bold;font-size:1.1em">' . $badge['title'] . '</div>
	</h3>
  </div>
  <div class="panel-body" style="align:center">

  	<table {table-normal} style="width:100%">
  	<tr>
  		<td align="center" style="width:35%"><div style="font-size:0.7em;color:#000">' . $badge['description'] . '</div></td>
  		<td style="width:30%"></td>
  		<td align="center" style="width:35%"><div style="font-size:0.7em;color:#000">' . $badge['prize'] . '</div></td>
  	</tr>
  	<tr>
  		<td align="center"><div style="font-size:0.7em;color:#000">' . $badge_image . '</div></td>
  		<td valign="middle" align="center"><div style="color:#000">Earns you:</div></td>
  		<td align="center"><img src="img/badge-prizes/' . $badge['badge_id'] . '.png" style="margin:1em 0em"></td>
  	</tr>
	</table>

  </div>
</div>
/end_view
<? } 

}?>
/start_view
</div>
/end_view
<?
Core::get_element('game_footer');