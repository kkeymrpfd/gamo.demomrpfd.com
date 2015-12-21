<? $view_output .= '

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dell Overdrive</title>
	<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--
		<link href="fonts/stylesheet.css" rel="stylesheet">
		-->
		<link href="css/custom.css?t=123" rel="stylesheet">
		<link href="/css/add2home.css" rel="stylesheet">
        
     <!-- Select Box -->
		<link href="css/select2-3.5.1/select2.css" rel="stylesheet"/>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
		<script src="js/jquery-1.11.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>	
		<script src="js/holder.js"></script>			
		<script src="js/jquery.knob.js"></script>
		<script src="js/custom.js?t=123"></script>
		<script src="js/core.js"></script>
		<script src="/js/gamo/gamo.js"></script>
		<script src="/js/add2home.js"></script>
        <script src="css/select2-3.5.1/select2.js"></script>
		<script>
        $(document).ready(function() { $("#country").select2(); });
    	</script>
		<script type="text/javascript">
        var addToHomeConfig = {
            animationIn: "bubble",
            expire: 0,
            touchIcon: true
        };
    </script>
        
    </head>
	<body class="home">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="content widget">
						<h1>Profile</h1>
						<p>&nbsp;</p>
						<p id="result-h"></p>
						<form class="form-horizontal" role="form" id="register-form">
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="email">
								</div>
							</div>
							<div class="form-group">
								<label for="company" class="col-sm-2 control-label">Company</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="company">
								</div>
							</div>
							<div class="form-group">
								<label for="title" class="col-sm-2 control-label">Title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title">
								</div>
							</div>
							<div class="form-group">
								<label for="phone" class="col-sm-2 control-label">Phone</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="phone">
								</div>
							</div>
							<div class="form-group">
								
								<div class="col-sm-offset-2 col-sm-10">
									
									<button class="btn bluebackground btn-signin pull-right">Submit</button>
									
									<!--
									<a class="btn bluebackground pull-right" href="whatsnew.htm">Submit</a>
									-->
									
								</div>
							</div>
						</form>	
											
					</div>
				</div>
			</div>
		</div>
<script type="text/javascript" src="/js/gamo/demandgen.js"></script>
<script language="javascript">
$(document).ready(function() {

	demandgen.register_hash = "' . $data['hash'] . '";

});
</script>
	</body>
</html>
'; ?>
