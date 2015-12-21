
	<? 
	foreach($data['gamo_nav'] as $name => $nav_data) : 
		$css_class = "";
		if( $nav_data['current'] === true ) $css_class = ' class="current"'
	?> 
		/start_view
		<ul class="nav nav-pills nav-stacked sidebar' . $nav_data['addClass'] . '" id="sidenav">
			<li' . $css_class . ' style="border:none"> <a href="' . $nav_data['href'] . '"> <img src="' . $nav_data['img'] . $nav_data['img_suf'] . '"> ' . $nav_data['name'] . ' </a> </li>
		</ul>
		/end_view
	<? endforeach; ?>
