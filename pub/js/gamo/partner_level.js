var partner_level = new function() {
	
	this.running = 0;

	this.save = function(partner_id, level) {

		if(partner_level.running == 0) {

			partner_level.running = 1;

			var input = {
				partner_id: partner_id,
				level: level
			};
			
			$.post('/?a=admin_partner_level&v=json', input, function(data) {

				partner_level.running = 0;

				var result = $.parseJSON(data);

				if(result['msg'] != 1) {

					Core.modal({
						msg: "There was an error while processing your request. Please refresh the page and try again.",
						alert: 'error'
					});

				} else {

					Core.modal({
						msg: "Partner certification level has been saved!",
						alert: 'success',
						close: 2500
					});

				}

			});

		}

	};

};

$(document).ready(function() {

	$("[partner-save]").click(function() {

		var partner_id = $(this).attr('partner-save');

		partner_level.save(partner_id, $('#partner-level-'+partner_id).val());

	});

});