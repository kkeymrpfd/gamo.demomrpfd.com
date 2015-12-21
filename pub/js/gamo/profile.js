var profile = new function() {
		
	this.reveal_qty = 10;

	this.reveal = function() {

		var revealed_qty = 0;
		var remaining = 0;

		$("[activity-entry]").each(function() {

			if($(this).attr('activity-shown') == 0) {

				if(revealed_qty < profile.reveal_qty) {

					++revealed_qty;

					$(this).fadeIn(200);
					$(this).attr('activity-shown', 1);

				} else {

					++remaining;

				}

			}

		});

		if(remaining == 0) {

			$("#activity-more").hide();

		}

	}

};

$(document).ready(function() {

	$("[activity-entry]").hide();

	$("#activity-more").click(function(e) {

		e.preventDefault();
		profile.reveal();

	});

	profile.reveal();

});