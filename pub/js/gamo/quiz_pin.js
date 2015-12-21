var quiz_pin = new function() {
	
	this.unlock = function() {

		var params = Core.get_inputs({
			holder: '#pin-form'
		});

		$("#result-msg").hide();

		$.post('/?a=quiz_pin_unlock&v=json', params, function(data) {

			Core.log(data);
			data = $.parseJSON(data);

			if(data['error'] != '') {

				$("#result-msg").html('<div class="alert alert-danger">'+data['error']+'</div>').fadeIn(300);

			} else {

				window.location = '/?p=live_trivia&quiz_id='+params['quiz_id'];

			}

		});

	};

};

$(document).ready(function() {

	$("#pin-form").submit(function(e) {

		e.preventDefault();
		quiz_pin.unlock();

	});
	
});