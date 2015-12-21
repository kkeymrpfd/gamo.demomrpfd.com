var gamo_meeting = new function() {

	this.meetings = [];

	/*
	Retrieve a list of people that this user scheduled meetings for
	*/
	this.get_meetings = function(options) {

		$.get('/?a=get_meetings&v=json&page='+options['page'], function(data) {

			var result = $.parseJSON(data);
			var status = 0;
			var points = 0;

			gamo_meeting.meetings = result['meetings']['records'];
			var html = '';

			if(result['meetings']['records'].length > 0) {

				var status = '';
				Core.log(result['meetings']['records']);
				for(var k in result['meetings']['records']) {

					switch(result['meetings']['records'][k]['status']) {

						case 'submit_meeting':
							status = 'Deal Submitted';
							break;
						case 'submit_deal_feedback':
							status = 'Feedback Logged';
							break;
						case 'submit_deal_close':
							status = 'Deal Closed';
							break;

					}

					if(status != '') {

						html += '<div class="row" style="margin-bottom:10px">'
		                            +'<div class="col-xs-4 col-md-4">'+Core.safe_echo( result['meetings']['records'][k]['company'] )+'</div>'
		                            +'<div class="col-xs-4 col-md-4">'+status+'</div>'
		                            +'<div class="col-xs-1 col-md-1">'+result['meetings']['records'][k]['total_points']+'</div>'
		                            +'<div class="col-xs-3 col-md-2" data-meeting-update="'+result['meetings']['records'][k]['action_id']+'"><a class="btn orangebackground">Update</a></div>'
		                        +'</div>';

		            }

	            }
				
				pager.set({
					holder: options['pager'],
					current: result['meetings']['current_page'],
					last: result['meetings']['last_page'],
					getter_id: options['getter_id']
				});
				
				$('.meetingfeedbackheader').show();

			} else {

				var html = '<div class="no-meetings">You have not scheduled any meetings yet.</div>';
				$('.meetingfeedbackheader').hide();

			}

			//$('#meeting-list-holder').html(html);
			$(".container-fluid").find('.row').each(function() {

				if(!$(this).hasClass('meetingfeedbackheader')) {

					$(this).remove();

				}

			});

			$('.meetingfeedbackheader').after(html);

			$("[data-meeting-update]").on('click', function() {

				gamo_meeting.update($(this).attr('data-meeting-update'));

			});

		});

	};

	this.result_to = '';

	this.save_meeting = function() {

		var params = Core.get_inputs({
			holder: $('#create-meeting-form')
		});

		Core.log(params);

		clearTimeout(gamo_meeting.result_to);
		$("#meeting_result_h").hide();

		Core.log(params);

		$.post('/?a=save_meeting&v=json', params, function(data) {

			data = $.parseJSON(data);

			if(data['saved'] != 1) {
				
				$("#meeting_result_h").html('<div class="alert alert-danger">'+data['error_msg']+'</div>').fadeIn(300);

			} else {
				
				$("#meeting_result_h").html('<div class="alert alert-success">Your entry has been saved!</div>').fadeIn(300);

				gamo_meeting.result_to = setTimeout(function() {

					$("#meeting_result_h").hide();

				}, 5000);

				gamo_meeting.clear_form();

			}

			$('html,body').animate({
			   scrollTop: $("#meeting_result_h").offset().top - 10
			});

			Core.functions[Core.reference["meeting_actions_new"]](1, Core.reference["meeting_actions_new"]);

		});

	};

	this.update = function(action_id) {

		$("#meeting_result_h").hide();

		var meeting = false;

		for(var k in gamo_meeting.meetings) {
			
			if(gamo_meeting.meetings[k]['action_id'] == action_id) {

				meeting = gamo_meeting.meetings[k];

			}

		}

		if(meeting == false) {

			return false;

		}

		var items = {
			meeting_name: 'contact_name',
			meeting_title: 'title',
			meeting_company: 'company',
			meeting_phone: 'phone',
			meeting_email: 'email',
			meeting_date: 'date',
			meeting_id: 'meeting_id',
			meeting_status: 'status',
			meeting_amount: 'amount',
			meeting_notes: 'notes'
		};

		for(var field in items) {

			$("#"+field).val( meeting.actions_info[ items[field] ]['info'] );

		}

		$("#action_id").val(action_id);

	}

	this.clear_form = function() {

		$("#create-meeting-form").find('input').val('');
    	$("#meeting_status").val('submit_meeting');

	};

	this.invoice_error = function(msg) {

		if(msg == false) {

			$("#invoice-error").hide();

		} else {

			$("#invoice-error").html('<div class="alert alert-danger">'+msg+'</div>').fadeIn(500);

		}

	};

	this.invoice_file = '';

	this.use_invoice = function(name) {

		gamo_meeting.invoice_file = name;
		Core.log(name);
		
	}

};

$(document).ready(function() {
	
	
	Core.reference["meeting_actions_new"] = Core.unique_id();

	Core.functions[Core.reference["meeting_actions_new"]] = function(page, getter_id) {

		gamo_meeting.get_meetings({
			pager: "#meeting-list-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};
	
	

	Core.functions[Core.reference["meeting_actions_new"]](1, Core.reference["meeting_actions_new"]);
	
    $("#create-meeting-submit").click(function() {

        gamo_meeting.save_meeting();

    });

    //$("#meeting_date, #meeting_date2").datepicker({ minDate: "+14", beforeShowDay: $.datepicker.noWeekends });
    
    $(".numeric").numeric(false, function() { 
        
        this.value = "";
        this.focus();

        return false;
    });
    
    $("#meeting-reset").on('click', function(e) {

    	e.preventDefault();

    	gamo_meeting.clear_form();

    });

    $("#invoice").on('change', function(e) {

    	gamo_meeting.invoice_error(false);
		$("#invoice-form").trigger('submit');

	});

});
