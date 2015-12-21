var demandgen = new function() {
	
	this.email_template_id = -1;
	this.logo = '';
	this.default_subject = '';
	this.list_recipients = [];

	this.show_entry_section = function() {

		var val = $("#list_type").val();

		if(val == 'manual') {

			$("#upload_entry").hide();
			$("#manual_entry").show();

		} else {

			$("#manual_entry").hide();
			$("#upload_entry").show();

		}

	};

	this.use_image = function(filename) {

		demandgen.logo = filename;
		var url = '/?p=demandgen_preview&email_template_id='+demandgen.email_template_id+'&logo='+demandgen.logo;

		$("#demandgen_preview").attr('src', url);
		$("#logo_file").val(demandgen.logo);
		$("#preview-open").attr('href', url);

	};

	this.image_error = function(msg) {

		if(msg == false) {

			$("#image-error").hide();

		} else {

			$("#image-error").html('<div class="alert alert-danger">'+msg+'</div>').fadeIn(500);

		}

	};

	this.list_error = function(msg) {

		if(msg == false) {

			$("#list-error").hide();

		} else {

			$("#list-error").html('<div class="alert alert-danger">'+msg+'</div>').fadeIn(500);

		}

	};

	this.set_list_recipients = function(raw) {

		try {

			var recipients = $.parseJSON(raw);
			demandgen.list_recipients = recipients;

		} catch(e) {

			demandgen.list_recipients = [];

		}

		Core.log(demandgen.list_recipients);

	}

	this.send = function() {

		var params = {
			email_template_id: $("#email_template_id").val(),
			list_type: $("#list_type").val(),
			subject: $("#subject").val(),
			redirect_url: $("#redirect_url").val(),
			logo: $("#logo_file").val(),
			manual: $("#recipients").val(),
			list_recipients: demandgen.list_recipients
		};

		Core.log(params);

		$("#demandgen-result-h").hide();

		$.post('/?a=demandgen_send_process&v=json', params, function(data) {

			Core.log(data);

			data = $.parseJSON(data);

			if(data['sent'] != 1) {

				$("#demandgen-result-h").html('<div class="alert alert-danger">'+data['error_msg']+'</div>').fadeIn(400);

				$('html,body').animate({
				   scrollTop: $("#demandgen-result-h").offset().top - 10
				});

			} else {

				window.location = '/?p=demandgen#sent=1';

			}

		});

	};

	this.register_hash = '';

	this.register = function() {

		Core.log('hash: '+demandgen.register_hash);
		var params = Core.get_inputs({
			holder: "#register-form"
		});

		params['hash'] = demandgen.register_hash;

		$("#result-h").hide();

		$.post('/?a=demandgen_register&v=json', params, function(data) {

			data = $.parseJSON(data);
			
			if(data['msg'] != 'success') {

				$("#result-h").html('<div class="alert alert-danger">'+data['msg']+'</div>').fadeIn(500);

			} else {

				$("#result-h").html('<div class="alert alert-success">Thank you! A representative will be reaching out to you shortly.</div>').fadeIn(500);

			}

		});

	};

}

$(document).ready(function() {

	$("#badges-widget").remove();
	$("#recent-activity-holder").parent().remove();
	$("#page-cols").removeClass('col-md-8').removeClass('col-sm-8').addClass('col-md-12 cold-sm-12');
	$(".submenu").removeClass('col-md-4').removeClass('col-sm-4').addClass('col-md-3 cold-sm-3');

	demandgen.email_template_id = $("#email_template_id").val();

	$("#recipients").tagsinput({
		tagClass: 'big',
		maxTags: 2
	});

	$('#recipients').on('beforeItemAdd', function(event) {
	  var email = event.item+'';

	  if(event.item.indexOf('@') == -1) {

	  	event.cancel = true;

	  }

	});

	$("#list_type").on('change', function(e) {

		demandgen.show_entry_section();

	});

	demandgen.show_entry_section();

	$("#demandgen_logo").on('change', function(e) {

		demandgen.image_error(false);
		$("#logo-image-form").trigger('submit');

	});

	$("#recipients_file").on('change', function(e) {

		demandgen.list_error(false);
		$("#recipients-form").trigger('submit');

	});

	demandgen.use_image('');

	$("#send-b").on('click press', function() {

		demandgen.send();

	});

	demandgen.default_subject = $("#subject").val();

	$("#subject-reset").on('click', function(e) {

		e.preventDefault();

		$("#subject").val(demandgen.default_subject);

	});

	$("#register-form").on('submit', function(e) {

		e.preventDefault();

		demandgen.register();

	});

	setTimeout(function() {

		$(".bootstrap-tagsinput").css('min-width', '300px');

	}, 200);


});