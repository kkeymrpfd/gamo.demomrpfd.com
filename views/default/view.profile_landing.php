<?
$meeting_html = '';
$meeting_info = '';

if($data['meeting_data']['type'] == 'inperson') {

	$meeting_info = '<div class="row spacer">
			<table class="table points" padding="5">
				<tr>
					<td rowspan="2" class="green-bg text-center">
						<p style="font-size:1.2em;padding-top:15px;font-weight:bold">Your in-person meeting with a LexisNexis rep is scheduled for:<br>' . $data['meeting_data']['display_time_range'] . '</p>
					</td>
				</tr>
			</table>
		</div>';
	
	$meeting_html = '<tr>
							<td class="bold-font">Schedule an in-person meeting with a LexisNexis rep</td>
							<td>100</td>
						</tr>';

} else if($data['meeting_data']['type'] == 'phone') {

	$meeting_info = '<div class="row spacer">
			<table class="table points" padding="5">
				<tr>
					<td rowspan="2" class="green-bg text-center">
						<p style="font-size:1.2em;padding-top:15px;font-weight:bold">Thank you for scheduling a phone meeting with a LexisNexis rep! Check back soon to play Trivia Fever and earn great prizes once the game is live!</p>
					</td>
				</tr>
			</table>
		</div>';
	
	$meeting_html = '<tr>
							<td class="bold-font">Schedule a phone meeting with a LexisNexis rep</td>
							<td>100</td>
						</tr>';

}
?>
<? $view_output .= '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LexisNexis</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="fonts/stylesheet.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

	<div class="container" style="margin-top:20px">
		<div class="row">
			<div class="col-xs-12">
				<div class="media">
					<div class="pull-left">
						<img src="img/blank-head.png" class="media-object img-circle">
					</div>
					<div class="profile media-body">
						<p class="name">' . Core::safe_echo($data['user']['display_name']) . '</p>
						<p class="company">' . Core::safe_echo($data['user']['company']) . '</p>						
					</div>
				</div>
			</div>
		</div>
		<div class="row spacer">
			<table class="table points" padding="5">
				<tr>
					<td rowspan="2" class="green-bg text-center">
						<h2>Points</h2>
						<p class="title">' . Core::safe_echo($data['user']['points']) . '</p>
					</td>
				</tr>
			</table>
		</div>
		<div class="row spacer">
			<div class="col-xs-4">
				<img src="img/badge1-grey.png" class="img-responsive center-block">
			</div>
			<div class="col-xs-4">
				<img src="img/badge2-grey.png" class="img-responsive center-block">
			</div>
			<div class="col-xs-4">
				<img src="img/badge3-grey.png" class="img-responsive center-block">
			</div>
		</div>
		<div class="row spacer">
			<div class="col-xs-4">
				<img src="img/badge4-grey.png" class="img-responsive center-block">
			</div>
			<div class="col-xs-4">
				<img src="img/badge5-grey.png" class="img-responsive center-block">
			</div>
			<div class="col-xs-4">
				<img src="img/badge6-grey.png" class="img-responsive center-block">
			</div>
		</div>
		' . $meeting_info. '
		<div class="row spacer">
			<div class="col-xs-12">
				<table class="table table-striped">	
					<thead>
						<tr>
							<td colspan="2">Points History</td>
						</tr>
					</thead>
					<tbody>
						' . $meeting_html . '
						<tr>
							<td class="bold-font">Register for Trivia Fever</td>
							<td>25</td>
						</tr>
						<tr>
							<td class="bold-font">Pre-Registration</td>
							<td>25</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>


    <!-- jQuery (necessary for Bootstrap\'s JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
'; ?>
