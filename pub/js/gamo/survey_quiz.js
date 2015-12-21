var survey_quiz = new function() {
	
	this.quiz_id = 2;
	this.current_question_id = -1;
	this.answer_to = '';
	this.timelimit_hit = 0;

	this.get_state = function() {

		$.get('/?a=quiz_state&v=json&quiz_id='+survey_quiz.quiz_id, function(data) {
			
			data = $.parseJSON(data);

			Core.log(data);

			var questions = data['question_set']['questions'];
			var html = '';
			var text_field = 0;
			var radio_class = '';

			for(k in questions) {

				html += '<div class="row">'
              	+'<div class="question-h" style="color:#000">'
                +'<div class="question" question-id="'+questions[k]['question_id']+'" style="color:#000">'+questions[k]['question']+'</div>'

                for(k2 in questions[k]['answers']) {

                	radio_class = ( (k+1) % 2 == 0 ) ? 2 : 1;
					radio_class = 'radio-h'+radio_class;

                	html += '<div class="radio-h '+radio_class+'" radio-select="1"><table><tr><td valign="top"><input type="radio" for-question-id="'+questions[k]['question_id']+'" name="question-'+questions[k]['question_id']+'" value="'+questions[k]['answers'][k2]['answer_id']+'" text-field="'+questions[k]['answers'][k2]['text_field']+'" class="radio"></td><td valign="top" style="color:#000">'+questions[k]['answers'][k2]['answer']+'</td></tr></table></div>';

                }

                html += '</div></div>';

			}

			$("#quiz-h").html(html);

			setInterval(function() {

				$(".question").css('color', '#000');

			}, 100);

			$(window).trigger('resize');

			$("div[radio-select]").click(function() {

				var input = $(this).find('input');

				if($(this).find("[text-field-input='"+input.val()+"']").length > 0) {

					return false;

				}

				var question_id = input.attr('for-question-id');
						
				$("input[name='question-"+question_id+"']").parent().parent().parent().parent().find('[text-field-input]').remove();
				Core.log('answer id: '+input.val());
				Core.log("input[name='question-"+question_id+"']");

				Core.log('here');
						

				if(input.hasAttr('text-field')) {

					if(input.attr('text-field') == 1) {

						$(this).find("[text-field-input='"+input.val()+"']").remove();
						$(this).append('<input type="text" text-field-input="'+input.val()+'" style="margin-left:6px" placeholder="Please specify">');

					}
				}

			});

		});

	};

	this.submit_quiz = function() {

		var params = {
			quiz_id: survey_quiz.quiz_id
		};

		$("[question-id]").each(function() {

			var question_id = $(this).attr('question-id');
			var val = $(":input[name='question-"+question_id+"']:checked").val();

			if(val != null && val != undefined) {

				params['question_'+question_id] = val;

				var text_field = $("[text-field-input='"+val+"']");

				if(text_field.length > 0) {

					params['answer_field_'+val] = text_field.val();

				}

			}

		});

		Core.log(params);

		$('#quiz-result-h').hide();

		$.post('/?a=quiz_full_submit&v=json', params, function(data) {

			Core.log(data);
			data = $.parseJSON(data);
			Core.log(data['error']);
			if(data['error'] != '') {

				$('#quiz-result-h').html('<div class="alert alert-danger">'+data['error']+'</div>').fadeIn(400);

			} else {

				var html = '<div class="reg_title" style="margin-top:2.5em">Thank you for registering!<br><span style="font-size:0.4em">You\'ll receive an email notification when Trivia Fever goes live. Participate in social promotions before the conference, and join us for live sessions taking place each day at Institute 2014! Good luck!</span>';
	
				html += '<br><br>';

				html += '<center><table><tr><td><a href="https://www.linkedin.com/groups?home=&gid=3662416&trk=anet_ug_hm" target="_blank"><img src="img/linkedin-icon.png" border="0"></a></td>';

				html += '<td><a href="https://twitter.com/LexisHealthCare" target="_blank" style="margin-left:1em"><img src="img/twitter-icon.png" border="0"></a></td></table></center>'

				html += '</div>';

				$("#quiz-content").hide().html(html).fadeIn(500);
				window.location = gamo_register.redirect;

			}

		});

	};

}

$(document).ready(function() {
	
	$('#quiz-form').submit(function(e) {

		e.preventDefault();

		survey_quiz.submit_quiz();

	});

	$(window).resize(function() {

		var small = ($(window).width() < 985);

		var color = (small) ? '#fff' : '#fff';
		var margin = (small) ? 30 : 140;

		$(".radio-h, .question").css('color', color);
		$(".reg_content").css('margin-top', margin+'px');

	});

});