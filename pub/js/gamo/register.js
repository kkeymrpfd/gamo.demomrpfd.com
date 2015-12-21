var gamo_register = new function() {

	this.register_form = '#register-form';
	this.redirect = '';

	this.create_user = function(options) {

		options = Core.ensure_defaults({
			holder: gamo_register.register_form
		}, options);

		var inputs = Core.get_inputs({
			holder: options['holder']
		});

		$('#reg-result-h').show();

		$.post('/?a=register_user&v=json', inputs, function(data) {
			Core.log(data);

			try {

				var results = $.parseJSON(data);
				
				if(results['error'] != '') {

					$('#reg-result-h').html('<div class="alert alert-danger">'+results['error']+'</div>').show();
					window.scrollTo(0, 0);

				} 

					
				if(results['user_id'] != '' &&  results['error'] == '') {

					window.location = results['redirect'];
					
				}

			} catch(err) {

				$('#reg-result-h').html('<div class="alert alert-danger">There was an error while processing your request. Please refresh the page and try again.</div>').fadeIn(400);

			}

		});

	};

};

$(document).ready(function() {

	$(gamo_register.register_form).submit(function(e) {

		e.preventDefault();

		gamo_register.create_user();

	});

});
