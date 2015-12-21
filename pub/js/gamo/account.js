var account = new function() {

	this.change_password = function() {

		$('#result-msg').hide();

		var settings = {
			current_password: $('#current_password').val(),
			password: $('#password').val(),
			password2: $('#password2').val()
		};

		$.post('?a=change_password&v=json', settings, function(data) {
			
			var result = $.parseJSON(data);

			if(result['msg'] != 1) {

				$('#result-msg').html('<div class="alert alert-error">'+result['msg']+'</div>').fadeIn(250);

			} else {

				$('#result-msg').html('<div class="alert alert-success">Your password has been updated!</div>').fadeIn(250);

			}

		});

	}

};