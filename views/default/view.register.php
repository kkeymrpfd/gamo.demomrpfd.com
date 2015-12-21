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
		<script src="/js/gamo/register.js"></script>
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
					<div class="mtop15 pull-right col-md-12 col-sm-12 col-xs-12">
						<img src="img/pageheader.png" class="img-responsive">
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="content widget">
						<h1>Register</h1>
						<p>&nbsp;</p>
						<p id="reg-result-h"></p>
						<form class="form-horizontal" role="form" id="register-form">
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name">
								</div>
							</div>
							<div class="form-group" style="display:none">
								<label for="title" class="col-sm-2 control-label">Title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title">
								</div>
							</div>
							<div class="form-group">
								<label for="company" class="col-sm-2 control-label">Company</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="company">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="email">
								</div>
							</div>
							<div class="form-group" style="display:none">
								<label for="phone" class="col-sm-2 control-label">Phone</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="phone">
								</div>
							</div>
							<div class="form-group">
								<label for="zip" class="col-sm-2 control-label">Zip Code</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="zip" placeholder="Company Zip Code">
								</div>
							</div>
							<div class="form-group">
								<label for="password" class="col-sm-2 control-label">Choose Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="password">
								</div>
							</div><div class="form-group">
								<label for="passwordConfirm" class="col-sm-2 control-label">Re-Enter Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" id="password2">
								</div>
							</div>
							<div class="form-group">
								
								<div class="col-sm-offset-2">
									<input type="checkbox" name="terms" id="terms" class="inputCheckbox sm" />
									<label for="terms" class="control-label">I accept the <a target="_blank" href="/hosted/tnc.pdf" style="color: blue;">Terms and Conditions</a></label>
								</div>
								
							</div>
							<div class="form-group">
							
								<div class="col-sm-offset-2 col-sm-10">
									Already registered? <a href="/?p=login" style="color: blue;" >Login</a>
								</div>

								
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
				<img src="img/reg-banner.png" class="img-responsive" style="margin-bottom:20px">
				<div style="margin:3em;text-align:center">Questions or comments? E-mail <a class="forgotpass" href="mailto:contact@delloverdrive.com">contact@delloverdrive.com</a></div>
			</div>
		</div>
		
<script type="text/javascript">
		</script>
		<script>
  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

  ga(\'create\', \'UA-64309770-2\', \'auto\');
  ga(\'send\', \'pageview\');

</script>
	</body>
</html>
'; ?>
