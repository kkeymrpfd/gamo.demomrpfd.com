var quiz_host = new function() {
	
	this.quiz_id = 67;
	this.last_question = {};
	this.get_board_to = '';

	this.get_board = function(delay) {

		clearTimeout(quiz_host.get_board_to);

		if(delay == 1) {

			quiz_host.get_board_to = setTimeout(function() {

				quiz_host.get_board();

			}, 3000);

			return false;

		};

		$.get('/?a=quiz_host_question&v=json&quiz_id='+quiz_host.quiz_id, function(data) {

			Core.log(data);
			data = $.parseJSON(data);

			quiz_host.get_board(1);
			
			quiz_host.render(data);			

		});	

	};

	this.render = function(rt_data) {
		Core.log(rt_data);
		if(rt_data['question_id'] != quiz_host.last_question['question_id']) {

			quiz_host.last_question = rt_data;

			Core.log(rt_data);

			var html = '<div">'+rt_data['question']+'</div>';

			$('#question-h').hide().html(html).fadeIn(500);		
			$("#audio-quiz-timer").trigger('pause').prop("currentTime", 0).trigger('play');

		}

	};

};

$(document).ready(function() {


	$(".navbar").hide();


	loadOrtcFactory(IbtRealTimeSJType, function (factory, error) {

		if (error != null) {

			alert("Factory error: " + error.message);

		} else {

			if (factory != null) {

				// Create Cloud Messaging client
				var client = factory.createClient();
				        
				// Set client properties              
				client.setConnectionMetadata('Some connection metadata');
				client.setClusterUrl('http://ortc-developers.realtime.co/server/2.1/');
				        
				client.onConnected = function (theClient) {
				  // client theClient is connected
				            
					theClient.subscribe('triviafever', true,
				           function (theClient, channel, msg) {
				             Core.log("Received message triviafever: "+msg);
				             
				            var rt_data = $.parseJSON(msg);
				            
				            if(rt_data['question'] == 'Show Badges') {

				            	var html = '<table style="display:inline-block;"> <tr> <td align="center"><img src="img/badges/30.png" style="width:250px"><td> </tr> <tr> <td align="center"><div style="font-size:2.75em;margin-top:1em">Identity Elite</div></td> </tr> </table> <table style="display:inline-block"> <tr> <td align="center"><img src="img/badges/31.png" style="width:250px;margin:0px 130px"><td> </tr> <tr> <td align="center"><div style="font-size:2.75em;margin-top:1em">Fraud Elite</div></td> </tr> </table> <table style="display:inline-block"> <tr> <td align="center"><img src="img/badges/32.png" style="width:250px"><td> </tr> <tr> <td align="center"><div style="font-size:2.75em;margin-top:1em">Clinical Elite</div></td> </tr> </table>';
				            	$('#question-h').hide().html(html).fadeIn(500);		

				            	return false;

				            } else if(rt_data['question'] == 'winner') {

				            	Core.log('winner!');
				            	Core.log(rt_data);

				            	var html = '';

				            	if(rt_data['winners'].length == 1) {

				            		html = 'The winner is:';

				            	} else {

				            		html = "It's a tie! The top scorers are:";

				            	}

				            	for(k in rt_data['winners']) {

				            		html += '<div style="margin:0.5em">'+rt_data['winners'][k]['first_name']+' '+rt_data['winners'][k]['last_name']+'</div>';

				            	}

				            	$('#question-h').hide().html(html).fadeIn(500);		

				            	return false;

				            }

				            if(rt_data['polling'] == 1) {

				            	rt_data['question'] = "Answer now for 50 bonus points!";

				            }

				             	var html = '<div">'+rt_data['question']+'</div>';

								$('#question-h').hide().html(html).fadeIn(500);

								$("[id^='audio-']").trigger('pause').prop("currentTime", 0);

								if(rt_data['polling'] != 1) {

									if(rt_data['sound'] == 'game_description') {
										Core.log('description sound');

										$("#audio-game-description").trigger('play');

									} else if(rt_data['sound'] == 'game_complete') {
										Core.log('answer sound');
										$("#audio-game-complete").trigger('play');

									} else if(rt_data['sound'] != 0) {
										Core.log('answer sound');
										$("#audio-quiz-timer").trigger('play');

									}

								}

				           }
				    );  

				};

				client.onSubscribed = function (theClient, channel) {
				   // Subscribed to the channel 'channel');
				   // Send a message to the channel 

				};
				       
				client.connect('JqrwmM', 'o9Hdy4qoFUwS');

			}
		}
	});

});