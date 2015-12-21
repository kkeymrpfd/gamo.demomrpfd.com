var quiz_broadcast = new function() {
		
	this.quiz_id = 67;

	this.running = 0;

	this.get_state = function() {

		$.get('/?a=get_quiz&quiz_id='+quiz_broadcast.quiz_id+'&v=json', function(data) {

			Core.log(data);
			data = $.parseJSON(data);

			var questions = data['question_set']['questions'];
			
			var broadcast_question = -1;

			// Find locked ID
			for(k in questions) {

				if(questions[k]['locked'] == 1) {

					broadcast_question = questions[k];
					break;

				}

			}

			var html_broadcast = '';

			if(broadcast_question == -1) {

				html_broadcast = '<div style="font-weight:bold;font-size:2em;text-align:center">There are no more questions for this quiz to broadcast</div>';

			} else {

				html_broadcast = '<button class="btn btn-success" style="width:100%;border:none;font-size:2em;font-weight:bold" broadcast-question="'+broadcast_question['question_id']+'" id="broadcast-b">Broadcast</button>'
				+'<div style="margin:1em;font-weight:bold;color:#000;text-align:center;font-size:1.3em">'+questions[k]['sort_order']+') '+broadcast_question['question']+'</div>';

			}

			var html_questions = '';
			var question_class = '';

			for(k in questions) {

				question_class = (questions[k]['locked'] == 2) ? 'btn-default' : 'btn-primary';

				html_questions += '<div class="'+question_class+'" style="width:100%;border:none;font-size:1em;padding:0.7em;margin:0.5em 0em">'+questions[k]['sort_order']+') '+questions[k]['question']+'</div>';

			}

			if(quiz_broadcast.broadcast_result != '') {

				if(quiz_broadcast.broadcast_result['success'] == 1) {

					html_broadcast = '<div style="font-weight:bold;font-size:1.2em;text-align:center;margin:1em" id="result-h">Question has been broadcast!</div>'+html_broadcast;

				} else {

					html_broadcast = '<div style="font-weight:bold;font-size:1.2em;text-align:center;margin:1em;color:#ff0000" id="result-h">Oops. Question might not have broadcast.</div>'+html_broadcast;

				}

				quiz_broadcast.broadcast_result = '';

				quiz_broadcast.result_to = setTimeout(function() {

					$("#result-h").fadeOut(300);

				}, 2000);

			}

			$("#broadcast-h").html(html_broadcast);
			$("#questions-h").html(html_questions);

		});

	};

	this.broadcast_result = '';
	this.result_to = '';

	this.broadcast_question = function(question_id) {

		if(quiz_broadcast.running == 1) {

			return false;

		}

		quiz_broadcast.running = 1;

		$("#broadcast-b").css('opacity', 0.3).html("Sending...");

		$.get('/?a=quiz_question_unlock&v=json&question_id='+question_id, function(data) {

			setTimeout(function() {

				quiz_broadcast.running = 0;

			}, 500);
			
			$("#broadcast-b").css('opacity', 1);

			Core.log(data);
			quiz_broadcast.broadcast_result = $.parseJSON(data);
			clearTimeout(quiz_broadcast.result_to);
			quiz_broadcast.get_state();

		});

	};

};

$(document).ready(function() {

	$('body').on('click', 'button[broadcast-question]', function(e) {

		e.preventDefault();

		var question_id = $(this).attr('broadcast-question');
		Core.log(question_id);

		quiz_broadcast.broadcast_question(question_id);

	});

	$("#broadcast-winner").click(function(e) {

		e.preventDefault();

		$.get('/?a=broadcast_winner&quiz_id='+quiz_broadcast.quiz_id+'&v=json', function(data) {

			data = $.parseJSON(data);
			var send = {};
			send['question'] = 'winner';
			send['sound'] = 'game_complete';

			for(k in data) {

				send[k] = data[k];

			}
			Core.log(send);
			rtclient.send('triviafever', JSON.stringify(send));

		});

	});

	var rtclient = '';

	loadOrtcFactory(IbtRealTimeSJType, function (factory, error) {

		if (error != null) {

			alert("Factory error: " + error.message);

		} else {

			if (factory != null) {

				// Create Cloud Messaging client
				rtclient = factory.createClient();
				        
				// Set client properties              
				rtclient.setConnectionMetadata('Some connection metadata');
				rtclient.setClusterUrl('http://ortc-developers.realtime.co/server/2.1/');
				        
				rtclient.onConnected = function (theClient) {
				  // client theClient is connected
				            
					rtclient.subscribe('triviafever', true,
				           function (theClient, channel, msg) {
				             

				           }
				    );  

				};

				rtclient.onSubscribed = function (theClient, channel) {
				   // Subscribed to the channel 'channel');
				   // Send a message to the channel 

				};
				       
				rtclient.connect('JqrwmM', 'o9Hdy4qoFUwS');

			}
		}
	});

	$("[broadcast-copy]").each(function() {

		$(this).css('font-size', '1.2em').html(($(this).attr('broadcast-copy') != '') ? $(this).attr('broadcast-copy') : 'Blank');

		$(this).click(function() {

			var send = {
				question: $(this).attr('broadcast-copy').replace('Pin Code: ', 'Pin Code:<br>').replace(', visit:', ', visit:<br>').replace(' Your password', '<br>Your password').replace("'trivia'", '"trivia"'),
				sound: $(this).attr('broadcast-sound')
			};

			rtclient.send('triviafever', JSON.stringify(send));

		});

	});

});