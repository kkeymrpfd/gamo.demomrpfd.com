var login = new function() {

	this.login = function() {

		$('#result-msg').hide()

		var settings = {
			email: $('#email').val(),
			password: $('#password').val(),
			remember_me: ( $("#remember_me").prop('checked') ) ? 1 : 0
		};

		$.post('/?a=login_auth&v=json', settings, function(data) {
			
			var result = $.parseJSON(data);
			
			if(result['valid'] != 1) {

				$('#result-msg').html('<div class="alert alert-danger" style="text-align:center">The username or password you entered is incorrect. Please try again. By default, your password is "trivia" (without the quotes).</div>').fadeIn(250);

			} else {

				window.location = result['redirect'];

			}

		});

	};

	this.request_reset = function() {

		$('#result-msg').hide();

		var settings = {
			email: $('#email').val()
		};
		
		$.post('/?a=login_reset&v=json', settings, function(data) {
			
			var result = $.parseJSON(data);
			
			if(result['valid'] == 2) {

				$('#result-msg').html('<div class="alert alert-danger">Please enter a valid e-mail address</div>').fadeIn(250);

			} else {

				$('#result-msg').html('<div class="alert alert-success">If this e-mail address belongs to a user, we have sent it an e-mail with directions to reset your password.</div>').fadeIn(250);
				$('#email').val('');
				
			}

		});

	};

	this.reset_password = function() {

		$('#result-msg').hide();

		var settings = {
			reset_key: $('#reset_key').val(),
			email: $('#email').val(),
			password: $('#password').val(),
			password2: $('#password2').val()
		};
		
		$.post('/?a=reset_password&v=json', settings, function(data) {
			
			var result = $.parseJSON(data);

			if(result['msg'] != 1) {

				$('#result-msg').html('<div class="alert alert-danger">'+result['msg']+'</div>').fadeIn(250);

			} else {

				window.location = '/?p=profile';

			}

		});

	};

}

$(document).ready(function() {

	$('#login-form').submit(function(e) {

		e.preventDefault();
		login.login();

	});

});
