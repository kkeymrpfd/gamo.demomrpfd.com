/start_view
<center>
<b>General Stats:</b><br>
/end_view
<?
$comps->board_summary(array(
		'title' => 'Users',
		'info' => $data['user_stats']['user_qty_active'] . ' <span style="color:#aaa"> / ' . $data['user_stats']['user_qty'] . '</span>',
		'subinfo' => 'active / inactive'
	)
);

$comps->board_summary(array(
		'title' => 'Average Points',
		'info' => $data['user_stats']['avg_points_active'] . ' <span style="color:#aaa"> / ' . $data['user_stats']['avg_points'] . '</span>',
		'subinfo' => 'active / inactive'
	)
);
?>

/start_view
<br><br><div class="divider-v"></div>
<br><b>Actions:</b><br>
/end_view
<?
foreach($data['action_stats'] as $k => $action) {

	$comps->board_summary(array(
			'title' => $action['action_name'],
			'info' => '<div class="points-up" style="padding:5px 15px">' . $action['action_qty'] . '</div>',
			'html' => ' onclick="window.location=\'/?a=view_admin&p=admin_actions#filter_action_type=' . $action['action_types_id'] . '\'"'
		)
	);	

}
?>

/start_view
<br><br><div class="divider-v"></div>
<br><b>Badges:</b><br>
/end_view
<?

foreach($data['badge_stats'] as $k => $badge) {

	$comps->board_summary(array(
			'title' => $badge['badge_name'],
			'info' => '<div class="points-up" style="padding:5px 15px">' . $badge['badge_qty'] . '</div>',
			'html' => ' onclick="window.location=\'/?a=view_admin&p=admin_users#filter_badge=' . $badge['badge_id'] . '\'"'
		)
	);	

}
?>
/start_view
</center>
/end_view