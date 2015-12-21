var confirmer = new function() {
	
	this.submit = function(options) {

		options = Core.ensure_defaults({
			email: '',
			tnc_accepted: '',
			register_pin: ''
		}, options);

		Core.log(options);

		$.post('/?a=confirm_user&v=json&email='+options['email']+'&tnc_accepted='+options['tnc_accepted']+'&register_pin='+options['register_pin'], options, function(data) {
			Core.log(data);
			var result = $.parseJSON(data);

			if(result['error'] != '') {

				Core.modal({
					msg: result['error'],
					alert: 'danger'
				});

			} else if(result['success'] == 1) {

				window.location = '/?p=dashboard';

			}

		});

	};

};

$(document).ready(function() {

	$("form[confirm-form='1']").submit(function(e) {

		e.preventDefault();

		confirmer.submit({
			email: $(this).find("input[confirm-field='email']").val(),
			tnc_accepted: ($(this).find("input[confirm-field='tnc']").prop('checked')) ? 1 : 0,
			register_pin: $(this).find("input[confirm-field='register_pin']").val()
		});

	});

});