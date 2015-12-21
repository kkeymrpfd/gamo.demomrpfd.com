var register = new function() {

	this.register = function() {

		$('#result-msg').hide();

		var settings = {
			password: $('#register-password').val(),
			password2: $('#register-password2').val(),
			pin: $('#register-pin').val(),
			tos: ($('#register-tos').prop('checked')) ? 1 : 0
		};

		$.post('/?a=pin_register&v=json', settings, function(data) {
			
			var result = $.parseJSON(data);
			
			if(result['msg'] != 1) {

				$('#result-msg').html('<div class="alert alert-error">'+result['msg']+'</div>').fadeIn(250);

			} else {

				window.location = '/?p=whats_new';
 
			}

		});

	};

	this.show_section = function(section) {

		$("div[login-block], #result-msg").hide();

		if(section == 'lookup') {

			$('#result-msg').html('<div class="alert alert-info">Please enter your e-mail below to begin.</div>').fadeIn(250);
			$('#lookup-email').val( $("#email").val() );
			
		}

		$('#password').val('');

		$('#'+section+'-form-holder').fadeIn(250);

	};

	this.email_check = function() {

		$('#result-msg').hide();

		var settings = {
			email: $('#lookup-email').val()
		};

		$.post('/?a=email_pin&v=json', settings, function(data) {
			
			var result = $.parseJSON(data);
			var error = '';

			if(result['msg'] == 'invalid_email') {

				error = 'Please enter a valid e-mail address';

			} else if(result['msg'] == 'not_found') {

				error = '<center>We did not find anyone in our system with that e-mail address.'
					+ '<br><br>If you have already registered, please use the link contained in the e-mail invite to access the game</center>';

			}

			/*if(result['pin'] == 1) { // User is already in game

				$('#email').val($('#email2').val());
				$("#password").val("");
				
				$("#pull-email-holder").hide();
        		$("#login-holder").fadeIn(500);
        		$('#result-msg').html('<div class="alert alert-success">You are already in the game.<br>Please login to continue.</div>').fadeIn(250);

        		setTimeout(function() {

		            $(window).scrollTop(500);
		            
		        }, 100)$('#result-msg');

			} else { // User is registered but not in game

				window.location = '/?a=splash&pin='+result['pin']+'#go';

			}*/

			if(error != '') {

				$('#result-msg').html('<div class="alert alert-error">'+error+'</div>').fadeIn(250);

			}

			if(result['msg'] == 'register_pending') {

				register.show_section('register');
				$('#register-email').val(result['email']);
				$('#register-pin').val(result['pin']);
				
				$('#result-msg').html('<div class="alert alert-info" style="text-align:center">Please set your password to enter the game.</div>').fadeIn(250);

			} else if(result['msg'] == 'is_user') {

				register.show_section('login');
				$('#email').val(result['email']);
				$('#result-msg').html('<div class="alert alert-info" style="text-align:center">You are registered for the game. Please login below.<br><br>If you do not remember your password, please <a href="/?p=forgot_password">click here</a>.</div>').fadeIn(250);

			}

		});

	}

}
