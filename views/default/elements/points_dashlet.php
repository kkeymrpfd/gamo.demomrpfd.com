<? $view_output .= '
<div class="col-md-4 col-sm-4 hidden-xs">
	<div class="points widget eqh1">
		<div class="orange widget-title">Current Position</div>
		<img src="img/points_icon.png" class="points-icon">
		<div class="score" id="points_dash" style="display:inline-block">' . $data['user']['points'] . '</div>
		<div class="points-divider"></div>
		<img src="img/trophy_icon.png" class="points-icon">
		<div class="score" style="display:inline-block">' . $data['user_has_qty'] . '</div>
		<div class="media" style="position:relative;top:-5px">
			<div class="media-body" style="text-align:center">
				<p><button class="dashlet-link orange" href="/?p=points">View Activity</button></p>
			</div>
		</div>
	</div>
	
</div>
'; ?>