var pin_login = new function() {

	this.running = false;

	this.send_pin = function() {

		window.location.hash
		$(".login-return").hide();
		
		if(!pin_login.running) {
			
			pin_login.running = true;

			var inputs = {
				email: Core.trim($("#email").val()),
				first_name: Core.trim($("#first_name").val()),
				last_name: Core.trim($("#last_name").val())
			};

			$.post('/?a=send_pin&v=json', inputs, function(data) {
				
				var msg = '';

				pin_login.running = false;

				try {
					
					var result = $.parseJSON(data);

					if(result['sent'] != 1) {

						msg = '<div class="alert alert-danger">'+result['error_msg']+'</div>';

					} else {

						msg = '<div class="alert alert-success" style="text-align:center">We emailed you your PIN. Please use that to log in.</div>';

						if(result['logged_in'] == 1) {
						
							window.location = '/?p=profile';

							return true;

						}

					}

				} catch(e) {

					msg = '<div class="alert alert-danger" style="text-align:center">There was an error while processing your request. Please try again.</div>';

				}

				setTimeout(function() {

					window.location.hash = '';
					window.location.hash = 'pin-result-msg';
					window.scroll(0, 0);

				}, 50);

				$("#login-msg").html(msg).fadeIn(250);

			});

		}

	};

	this.login = function() {

		$(".login-return").hide();

		if(!pin_login.running) {

			pin_login.running = true;

			var inputs = {
				password: Core.trim($("#pin").val())
			};
			
			$.post('/?a=login_auth&v=json', inputs, function(data) {
				
				pin_login.running = false;

				var msg = '';

				try {

					var result = $.parseJSON(data);
					
					if(result['valid'] != 1) {

						if(result['error_msg'] != null && result['error_msg'] != '') {

							msg = '<div class="alert alert-danger">'+result['error_msg']+'</div>';

						} else {

							msg = '<div class="alert alert-danger">That PIN does not appear valid. Please try again, or use the form above to have your PIN e-mailed to you again.</div>';

						}

					} else {

						window.location = '';

						return true;

					}

				} catch(e) {

					msg = '<div class="alert alert-danger" style="text-align:center">There was an error while processing your request. Please try again.</div>';

				}

				setTimeout(function() {

					window.location.hash = '';
					window.location.hash = 'login-result-msg';

				}, 50);

				$("#login-msg").html(msg).fadeIn(250);

			});

		}

	};
	
};

$(document).ready(function() {

	$("#send-pin-form").bind('submit', function(e) {
		e.preventDefault();
		pin_login.send_pin();

	});

	$("#login-form").bind('submit', function(e) {
		e.preventDefault();
		pin_login.login();

	});

});
