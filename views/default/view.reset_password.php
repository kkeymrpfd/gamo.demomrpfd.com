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
		<link href="css/custom.css" rel="stylesheet">

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
		<script src="js/custom.js"></script>
		<script src="js/core.js"></script>
		<script src="/js/gamo/gamo.js"></script>
		<script src="/js/gamo/register.js"></script>
    </head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="mtop15 pull-right">
						<img src="img/pageheader.jpg" class="img-responsive">
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
				
<script src="js/login.js?t=' . time() . '"></script>


					<div style="margin:20px">
					    <div class="panel panel-default" style="color:#000">
						      <div class="panel-heading" style="text-align:center">
						        <h3 class="panel-title" style="font-weight:bold">
						          <div style="font-weight:bold;font-size:1.1em">Dell Overdrive</div>
						        </h3>
						      </div>
						        <div class="panel-body">
						            <div id="result-msg">
						                <div class="alert alert-info">Please enter your e-mail address and select your new password below</div>
						            </div>
						'; ?>
						<? if($data['key_valid'] == 1) { ?>
						<? $view_output .= '
						<form id="password-form" class="form-horizontal" role="form">
						              <div id="result-msg"></div>
						              <div class="form-group">
						                <label for="email" class="col-sm-2 control-label">Email</label>
						                <div class="col-sm-10">
						                  <input type="text" class="form-control" id="email" placeholder="Email">
						                </div>
						              </div>
						              <div class="form-group">
						                <label for="password" class="col-sm-2 control-label">Password</label>
						                <div class="col-sm-10">
						                  <input type="password" class="form-control" id="password" placeholder="Password">
						                </div>
						              </div>
						              <div class="form-group">
						                <label for="password2" class="col-sm-2 control-label">Confirm Password</label>
						                <div class="col-sm-10">
						                  <input type="password" class="form-control" id="password2" placeholder="Password">
						                </div>
						              </div>
						              <div class="form-group">
						                <div class="col-sm-offset-2 col-sm-10">
						                  <a href="/?p=login" style="font-size:0.8em;margin:1em 0em">Return to login?</a>
						                </div>
						              </div>
						              <div class="form-group" style="text-align:center">
						                <div class="col-sm-offset-2 col-sm-10">
						                  <button type="submit" class="btn btn-primary" style="font-size:1em">Update Password</button>
						                </div>
						              </div>
						              <input type="hidden" value="' . Core::safe_echo($data['reset_key']) . '" id="reset_key">
						            </form>
						'; ?>
						<? } else { ?>
						<? $view_output .= '
						This password reset link is no longer valid.
						<br><br>To request a new password, please <a href="/?p=forgot_password">click here</a>
						'; ?>
						<? } ?>     
        <? $view_output .= '
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>
<script language="javascript">
$(document).ready(function() {

    $(".navbar").hide();
    $("#password-form").submit(function(e) {

        e.preventDefault();
    	  login.reset_password();

    });

});
</script>
		
<script type="text/javascript">
		</script>
	</body>
</html>
'; ?>
