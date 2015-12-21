var gamo_quiz = new function() {
	
	this.submit_answer = function() {

		var question_id = $('#question-id').val();
		var answer_id = $('input[name=questionOption]:checked').val();
		
		$("#result-msg").hide();
		
		if(answer_id == undefined) {

			$("#result-msg").html('<div class="alert alert-error" style="font-weight:bold">Please choose an answer</div>').css("margin", '1em').fadeIn(250);
			window.scrollTo(0, 0);

			return false;

		}

		$.get('/?a=quiz_answer&question_id='+question_id+'&answer_id='+answer_id+'&v=json', function(data) {

			window.location = '/?p=quiz_question_result&set_id='+$('#question-set-id').val();

		});

	};

};

$(document).ready(function() {

	$("#quiz-question").on('submit', function() {

		gamo_quiz.submit_answer();

	});

});