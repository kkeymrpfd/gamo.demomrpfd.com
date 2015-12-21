/start_view
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=8" />
</head>
<body>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
/js: /js/bootstrap.min.js
/js: /js/moment.js
/js: /js/core.js
/css: /css/bootstrap.css
/css: /css/gamo.css
<center>
<div style="margin:8px;width:894px">
/end_view
<?
if($session->get('access_admin') == 1) {

	$view_output .= '<div style="margin:10px 10px 10px 780px">
	<a href="/">Home</a> | <a href="/?a=view_admin">Admin</a>
	</div>';
}
?>
/start_view
	<div style="margin-bottom:20px;width:100%">
		<table {table-normal} style="margin-left:-250px">
		<tr>
			<td valign="top">
				<ul class="nav nav-tabs nav-stacked" style="margin:0px 10px;min-width:250px">
				  <li id="top-menu-admin_general"><a href="/?a=view_admin">General</a></li>
				  <li id="top-menu-admin_users"><a href="/?a=view_admin&p=admin_users">Users</a></li>
				  <li id="top-menu-admin_actions"><a href="/?a=view_admin&p=admin_actions">Activities</a></li>
				  <li id="top-menu-admin_vevents"><a href="/?a=view_admin&p=admin_vevents">Virtual Events</a></li>
				  <li id="top-menu-admin_resources"><a href="/?a=view_admin&p=admin_resources">Resources</a></li>
				  <li id="top-menu-admin_resources"><a href="/?a=view_admin&p=admin_reports">Reports</a></li>
				</ul>
			</td>
			<td valign="top">

			<div id="cont-main">
/end_view