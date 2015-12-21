 var meetings = new function() {

 	this.check_badges = 0;
 	this.trivia_copy = ((window.location.href+'').indexOf('trivia')) ? '<br><br>Thank you for playing this round of trivia! Check back to play more rounds throughout the conference!' : '';
 	
 	this.create_meeting = function() {

		var inputs = Core.get_inputs({
			holder: $('#create-meeting-form')
		});

		$("#phone-result-h").hide();

		$.post('/?a=create_meeting&v=json', inputs, function(data) {
			
			var result = $.parseJSON(data);
			
			if(result['error_msg'] != null && result['error_msg'] != '') {

				$("#phone-result-h").html('<div class="alert alert-danger">'+result['error_msg']+'</div>').fadeIn(300);
			    return false;

			} else {

				$("[meeting-section]").hide();
				$("#skip-meeting").hide();
				$("#meeting-phone-h").hide().css('margin', '1.5em 0em').html('<div class="alert alert-success" style="text-align:center">Your meeting has been scheduled!'+meetings.trivia_copy+'</div>').fadeIn(500);

				if(meetings.check_badges == 1) {

					badge_check.check('30_31_32_29_33_35');

				}

			}

		});

	};

	this.create_inperson = function() {

		var inputs = {
			slot_id: $('#inperson_slot').val(),
			topic: $('#inperson_topic').val()
		};

		$("#inperson-result-h").hide();

		$.post('/?a=schedule_inperson_meeting&v=json', inputs, function(data) {
			Core.log(data);
			var result = $.parseJSON(data);
			Core.log(result);
			if(result['error'] != null && result['error'] != '') {

				$("#inperson-result-h").html('<div class="alert alert-danger">'+result['error']+'</div>').fadeIn(300);
			    return false;

			} else {

				$("[meeting-section]").hide();
				$("#skip-meeting").hide();
				$("#meeting-inperson-h").hide().css('margin', '1.5em 0em').html('<div class="alert alert-success" style="text-align:center">Your meeting has been scheduled!'+meetings.trivia_copy+'</div>').fadeIn(500);
				if(meetings.check_badges == 1) {

					badge_check.check('30_31_32');

				}
				
			}

		});

	};

 };

 $(document).ready(function() {
 	
 	if($("#meeting_date").length > 0) {

	    var picker = new Pikaday({
	    	field: document.getElementById('meeting_date'),
	    	minDate: new Date('2014-06-18'),
	    	weekends: false,
	    	format: "MM-DD-YYYY"
	    });

	    $("#create-meeting-form").submit(function(e) {

	    	e.preventDefault();
	    	meetings.create_meeting();

	    });

	    $("#create-meeting-b").click(function(e) {

	    	e.preventDefault();
	    	meetings.create_meeting();

	    });

	    $("#create-inperson-b").click(function(e) {

	    	e.preventDefault();
	    	meetings.create_inperson();

	    });

	    $("a[meeting-section]").click(function(e) {

	    	e.preventDefault();

	    	var section = $(this).attr('meeting-section');
	    	var hide = (section == 'phone') ? 'inperson' : 'phone';

	    	$('#meeting-'+hide+'-h').hide();

	    	if($('#meeting-'+section+'-h').is(':visible')) {

	    		$('#meeting-'+section+'-h').hide();

	    	} else {

	    		$('#meeting-'+section+'-h').fadeIn(400);

	    	}

	    });

	}

});