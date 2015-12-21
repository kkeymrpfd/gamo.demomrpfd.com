/start_view
<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/main.dwt" codeOutsideHTMLIsLocked="false" -->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- InstanceBeginEditable name="doctitle" -->
		<title>Dell Overdrive</title>
		<!-- InstanceEndEditable -->
		<!-- Bootstrap -->
		<link href="/css/bootstrap.css?t=123" rel="stylesheet">
		<link href="/css/add2home.css" rel="stylesheet">
		<!--
		<link href="fonts/stylesheet.css" rel="stylesheet">
		-->
		<link href="/css/custom.css?t=1241233" rel="stylesheet">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
		<script src="js/jquery-1.11.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="/js/bootstrap.min.js"></script>	
		<script src="/js/holder.js"></script>			
		<script src="/js/jquery.knob.js"></script>
		<script src="/js/core.js"></script>
		<script src="/js/gamo/gamo.js"></script>
		<script src="/js/add2home.js"></script>
		<script type="text/javascript">
        var addToHomeConfig = {
            animationIn: "bubble",
            expire: 0,
            touchIcon: true
        };
    </script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
	</head>
	<body>
		<div class="top-nav-bg"></div>
		<div class="container">
			<div class="navbar-header hidden-sm hidden-md hidden-lg">
			
				<a class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <img width="77" src="img/Assets-39.png?t=123"> </a> 
				<a href="/?p=profile"> <img width="49" src="img/Assets-40.png" class="buttonmenu"> </a> 
				<a href="/?p=points"> <img width="49" src="img/Assets-41.png" class="buttonmenu"> </a> 
				<a href="/?p=leaderboard"> <img width="49" src="img/Assets-42.png" class="buttonmenu"> </a> 
				<a href="/?p=badges"> <img width="49" src="img/Assets-43.png" class="buttonmenu"> </a> 
				
			</div>
			
			<div class="collapse navbar-collapse top-menu-mobile" style="padding-top:15px">
				<div class="visible-xs">
					/end_view
						<? Core::get_element('game_nav'); ?>
					/start_view	
				</div>
			</div>
			
			<a class="navbar-brand" href="/" style="display:inline-block">
				<img src="img/logo.png?t=1" class="navbar-logo">
			</a>
			
			<!-- about and logout menu for mobile -->
			<ul class="mobilemenu pull-right hidden-sm hidden-md hidden-lg">
				<li><a style="font-size: 13px; color: white;" href="/?p=whatsnew">Home</a></li>
				<li><a style="font-size: 13px; color: white;" href="/?p=about">Program Overview</a></li>
				<li><a style="font-size: 13px; color: white;" href="/?p=badges">Rewards</a></li>
				<li><a style="font-size: 13px; color: white;" href="/?a=logout">Logout</a></li>
			</ul>
			<div class="mobile-nav-spacer"></div>
			
			
			<!-- about and logout menu for desktop -->
			<div  class="pull-right hidden-xs">
				<ul class="nav navbar-nav">
					<li><a href="/?p=whatsnew" style="color:#fff">Home</a></li>
					<li><a href="/?p=about" style="color:#fff">Program Overview</a></li>
					<li><a href="/?p=badges" style="color:#fff">Rewards</a></li>
					<li><a href="/?a=logout" style="color:#fff">Logout</a></li>
				</ul>
			</div>
			
			<div class="row">
			
				
				
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
/end_view
						<? Core::get_element('profile_dashlet'); ?>
						<? Core::get_element('points_dashlet'); ?>
						<? Core::get_element('leaders_dashlet'); ?>
/start_view			
					</div>
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-12" id="page-cols">			
/end_view
