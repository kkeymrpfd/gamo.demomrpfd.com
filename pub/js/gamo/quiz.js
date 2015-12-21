var quiz = new function() {
	
	this.quiz_id = 67;
	this.current_question_id = -1;
	this.answer_to = '';
	this.timelimit_hit = 0;
	this.current_question = {};
	this.next_question = -1;
	this.resource_shown = 0;
	this.quiz_state = {};

	this.resources = {
		75: { // Quiz ID
			clinical: { // user group
				resource_id: 73,
				title: 'Five Factors for Payers.pdf'
			},
			fraud: { // user group
				resource_id: 78,
				title: 'Analytic Driven Enterprise Fraud Control.pdf'
			},
			identity: { // user group
				resource_id: 83,
				title: 'ID Management.pdf'
			}
		},
		76: { // Quiz ID
			clinical: { // user group
				resource_id: 74,
				title: 'Payer and Provider.pdf'
			},
			fraud: { // user group
				resource_id: 79,
				title: 'The Real Cost of Health Care Fraud.pdf'
			},
			identity: { // user group
				resource_id: 84,
				title: 'Data Solutions to Improve HEDIS Scores.pdf'
			}
		},
		77: { // Quiz ID
			clinical: { // user group
				resource_id: 75,
				title: 'Population Health Monitor.pdf'
			},
			fraud: { // user group
				resource_id: 80,
				title: 'Key Factors for Payers in Fraud and Abuse Prevention.pdf'
			},
			identity: { // user group
				resource_id: 85,
				title: 'How to Select an Information Solution Provider.pdf'
			}
		},
		72: { // Quiz ID
			clinical: { // user group
				resource_id: 76,
				title: 'Analytics.pdf'
			},
			fraud: { // user group
				resource_id: 81,
				title: 'Lovelace Health Plan Case Study.pdf'
			},
			identity: { // user group
				resource_id: 86,
				title: 'Fixing Provider Data Issues.pdf'
			}
		},
		73: { // Quiz ID
			clinical: { // user group
				resource_id: 77,
				title: 'Power of Predictive Analytics.pdf'
			},
			fraud: { // user group
				resource_id: 82,
				title: 'Intelligent Investigator Brochure.pdf'
			},
			identity: { // user group
				resource_id: 87,
				title: 'Reduce expenses by automating the return mail process.pdf'
			}
		}
	};

	this.get_state = function() {

		//$('body').hide();

		quiz.current_question_id  = -1;

		$.get('/?a=quiz_state&v=json&quiz_id='+this.quiz_id, function(data) {
			
			data = $.parseJSON(data);
			quiz.quiz_state = data;

			quiz.user_points(data['user_points']);
			quiz.timelimit_hit = 0;

			var html = '';
			
			if(data['allow_quiz'] == 0 && data['require_pin'] == 1) {

				window.location = '/?p=trivia_pin&quiz_id='+quiz.quiz_id;
				return false;

			}

			if(data['next_question']['next_question_id'] != undefined && data['next_question']['next_question_id'] > -1) { // Show next question

				data['next_question_key'] *= 1;

				var current_question = data['question_set']['questions'][data['next_question_key']];

				quiz.next_question = -1;

				if(data['question_set']['questions'][data['next_question_key']+1] != undefined && data['question_set']['questions'][data['next_question_key']+1] != null) {

					quiz.next_question = data['question_set']['questions'][data['next_question_key']+1];

				}

				quiz.current_question = current_question;
				
				quiz.current_question_id = current_question['question_id'];

				if(data['question_number'] == 3
					&& quiz.resource_shown == 0
					&& quiz.resources[quiz.quiz_id] != null
					&& quiz.resources[quiz.quiz_id] != undefined
					&& quiz.resources[quiz.quiz_id][data['user_group']] != null
					&& quiz.resources[quiz.quiz_id][data['user_group']] != undefined) {

					quiz.resource_shown = 1;

					var resource = quiz.resources[quiz.quiz_id][data['user_group']];

					html = '<center>'
					+'<div style="color:#000;font-size:2em;font-weight:bold;margin-top:2em">Whitepaper - '+(resource['title']).replace('.pdf', '')+'</div>'
					+'<div id="resource-result-h" style="font-size:2em;margin:1em;display:none"></div>'
					+'<img src="img/pdf.png" style="margin:2em">'
					+'<br><a class="btn btn-primary" style="border:none;font-size:2em;color:#fff" href="/resources/'+resource['title']+'" target="_blank" download-resource="'+resource['resource_id']+'">Download</a>'
					+'<br><div class="btn btn-primary" style="border:none;font-size:2em;margin-top:1em" email-resource="'+resource['resource_id']+'">E-mail</div>'
					+'<br><div class="btn btn-primary" style="border:none;font-size:3em;margin-top:1em" get-state="1">Next Question</div>'
					+'</center>';

					quiz.timer(0);

					$('body').show();
					$("#quizContent").hide().html(html).fadeIn(250);

					$("[email-resource]").click(function(e) {

						e.preventDefault();

						quiz.email_resource( $(this).attr('email-resource') );

					});

					$("[download-resource]").click(function(e) {
						Core.log('here');
						quiz.download_resource( $(this).attr('download-resource') );

					});

					return false;

				}

				if(current_question['locked'] == 1) {

					quiz.timer(0);
					var pay_attention = '';

					if(data['question_number'] == 1) {

						pay_attention = '<div style="font-size:2em;text-align:center;font-weight:bold;margin-bottom:1em">Pay attenion! Max D\'Ductible will announce the next question in just a moment!</div>';

					}

					html += '<div>'
						+pay_attention
							+'<center><div class="btn btn-default btn-xs" get-state="1">Didn\'t get next question? Press here.</div></center>'
				     	 +'</div>';

				} else {

					html += '<div class="question">'
					    +'<h3 id="question-text-h" class="textBold noMargine" style="font-weight: bold;color:#000;margin-top:1.8em">'+data['question_number']+') '+current_question['question']+'</h3>'
					    +'<div class="answers" id="answers-h">';

					if(current_question['polling'] == 0) { // Not a polling question

						for(k in current_question['answers']) {

							html += '<div class="answer">'
					            +'<input type="radio" class="inputCheckbox" id="answer-'+current_question['answers'][k]['answer_id']+'" name="question['+current_question['answers'][k]['answer_id']+']" value="'+current_question['answers'][k]['answer']+'" question-id="'+current_question['question_id']+'" answer-id="'+current_question['answers'][k]['answer_id']+'" />'
					            +'<label for="answer-'+current_question['answers'][k]['answer_id']+'">'+current_question['answers'][k]['answer']+'</label>'
					        +'</div>';

						}

					} else { // Is a polling question

						for(k in current_question['answers']) {

							html += '<div class="answer" is-poll="1" is-selected="0" >'
					            +'<div class="inputCheckbox" id="answer-'+current_question['answers'][k]['answer_id']+'" name="question['+current_question['answers'][k]['answer_id']+']" value="'+current_question['answers'][k]['answer']+'" question-id="'+current_question['question_id']+'" answer-id="'+current_question['answers'][k]['answer_id']+'"></div>'
					            +'<label for="answer-'+current_question['answers'][k]['answer_id']+'">'+current_question['answers'][k]['answer']+'</label>'
					        +'</div>';

						}

						html += '<div class="answer poll-b" no-submit="1">'
				            +'<div class="inputCheckbox"></div>'
				            +'<label style="background-color:#489e0e">Submit</label>'
				        +'</div>';

					}

					html += '</div></div>';

					if(current_question['timer_seconds'] > 0
					&& current_question['remaining_seconds'] < 999) { // There is a countdown timer

						quiz.start_timer({
							question_id: data['next_question']['next_question_id'],
							seconds: current_question['remaining_seconds']
						});

					} else { // There is no countdown timer

						quiz.timer(0);

					}

				}

			} else {

				//window.location = '/?p=dashboard';
				return false;

			}

			$('body').show();
			$("#quizContent").hide().html(html).fadeIn(250);
			
			$("[is-poll='1']").click(function(e) {
				
				e.preventDefault();

				if($(this).attr('is-selected') == 0) {

					$(this).find('label').css('background-color', '#28aae1');
					$(this).attr('is-selected', 1);

				} else {

					$(this).find('label').css('background-color', '#0f577e');
					$(this).attr('is-selected', 0);

				}

			});

			$(".poll-b").click(function(e) {

				e.preventDefault();

				var checked = Array();

				$("[is-selected]").each(function() {
					
					if($(this).attr('is-selected') == 1) {

						checked.push($(this).find('[answer-id]').attr('answer-id'));

					}

				});

				Core.log(checked);

				
				if(checked.length > 0) {

					quiz.answer({
						question_id: quiz.current_question_id,
						answer_id: quiz.poll_answer_id,
						checked: checked
					});

				}

			});

			window.scrollTo(0, 20);

		});

	};

	this.email_resource = function(resource_id) {

		$.get('/?a=email_resource&v=json&resource_id='+resource_id, function(data) {

			data = $.parseJSON(data);

			if(data['sent'] == 1) {

				$('#resource-result-h').html('<div class="alert alert-success">This resource has been e-mailed to you!</div>').fadeIn(300);
				quiz.user_points(data['user_points']);

			} else {

				$('#resource-result-h').html('<div class="alert alert-danger">There was an error while processing your request. Please refresh the page and try again.</div>').fadeIn(300);

			}

		});

	};

	this.download_resource = function(resource_id) {
		Core.log('here');
		$.get('/?a=resource_video&resource_id='+resource_id+'&v=json', function(data) {

			data = $.parseJSON(data);
			Core.log('Points: '+data['user_points']);
			quiz.user_points(data['user_points']);
			$('#resource-result-h').html('<div class="alert alert-success">Thank you for downloading this resource!</div>').fadeIn(300);

		});

	};

	this.answer = function(options) {

		clearTimeout(quiz.answer_to);

		options = Core.ensure_defaults({
			question_id: -1,
			answer_id: -1,
			checked: Array()
		}, options);

		var checked = options['checked'].join('-');

		var params = {
			question_id: options['question_id'],
			answer_id: options['answer_id'],
			poll_answers: checked
		};

		if(params['answer_id'] == -1 && params.poll_answers.length == 0) {

			return false;

		}

		quiz.timer(0);

		$("#answers-h").hide();

		$.get('/?a=quiz_answer&v=json', params, function(data) {
			Core.log(data);
			data = $.parseJSON(data);

			quiz.user_points(data['user_points']);

			var html = '';
			
			if(quiz.current_question['polling'] == 1 || quiz.current_question['all_correct'] == 1) {

				html = '<div class="textCentered" id="answer-result-h" style="display:none;font-weight:bold;text-align:center;color:#000">'
			        +'<h2 class="textBlue">Thank you!</h2>'
			        +'<a href="#" class="button blue lg" id="next-question-b" style="display:none"><span>Next Question</span></a>'
			    +'</div>';

			} else if(data['timelimit_hit'] == 1) {

				html = '<div class="textCentered" id="answer-result-h" style="display:none;font-weight:bold;text-align:center;color:#000">'
				        +'<h2 class="textBlue">Sorry, you ran out of time.</h2>'
				        +'<h5 class="textBold">The Correct Answer is:<br />'+data['answer_correct_text']+'</h5>'
				        +'<a href="#" class="button blue lg" id="next-question-b" style="display:none"><span>Next Question</span></a>'
				    +'</div>';

			} else if(data['correct'] == 0 && data['action_result']['points'] == 0) { // Incorrect answer

				html = '<div class="textCentered" id="answer-result-h" style="display:none;font-weight:bold;text-align:center;color:#000">'
				        +'<h2 class="textBlue">Sorry, You Are Incorrect</h2>'
				        +'<h5 class="textBold" style="font-size:2em;font-weight:bold">The Correct Answer is:<br />'+data['answer_correct_text']+'</h5>'
				        +'<a href="#" class="button blue lg" id="next-question-b" style="display:none"><span>Next Question</span></a>'
				    +'</div>';

			} else {

				var correct_html = (quiz.current_question['polling'] != 1) ? 'CORRECT!' : 'Thank you!';

				html = '<div class="textCentered" style="font-weight:bold;text-align:center;color:#000">'
			        +'<h2 class="textBlue" style="font-size:2.2em;font-weight:bold">'+correct_html+'</h2>';

			    if(data['action_result']['points'] > 0) {

			    	html += '<h2><span class="textGreen large">'+data['action_result']['points']+'</span> <span style="color:#000">pts</span></h2>'
			      	
			    }
			     
			    html += '<a href="#" class="button blue lg" id="next-question-b" style="display:none"><span>Next Question</span></a>'
			    +'</div>';

			}

			$("#question-text-h").hide();
			$("#answers-h").replaceWith(html);

			if(data['next_question']['next_question_id'] != -1) {

				$("#next-question-b").show();

				if(quiz.next_question != -1) {

					quiz.current_question = quiz.next_question;

					var pay_attention = '';
					var next_question_action = '<center><div class="btn btn-default btn-xs" get-state="1">Didn\'t get next question? Press here.</div></center>';

					if(quiz.current_question['question_number'] == 1) {

						pay_attention = '<div style="font-size:2em;text-align:center;font-weight:bold;margin-bottom:1em">Pay attenion! Max D\'Ductible will announce the next question in just a moment!</div>';

					}

					if(quiz.quiz_id != 70 && quiz.quiz_id != 71 && quiz.quiz_id != 78 && quiz.quiz_id != 79) { // Not a live quiz

						next_question_action = '<center><div class="btn btn-primary" style="border:none;font-size:2em" get-state="1">Next Question</div></center>';

					}
					
					var next_question_html = '<div>'
						+pay_attention
							+next_question_action
				     	 +'</div>';

				    $("#next-question-b").replaceWith(next_question_html);

				}

			} else {

				// This was a live trivia game. Redirect to meetings page after a few seconds.
				if(quiz.quiz_id == 70 || quiz.quiz_id == 71 || quiz.quiz_id == 78 || quiz.quiz_id == 79) {
					
					//badge_check.check('30_31_32_29');
					//html = '<a href="/?p=meetings&source=trivia" class="button blue lg" id="dashboard-b"><span>Continue to meeting</span></a>';
					html = '';
					$("#next-question-b").replaceWith(html);

					setTimeout(function() {

						window.location = '/?p=meetings&source=trivia';

					}, 50);

					return false;

				} else {

					var action_copy = '';

					if(quiz.quiz_id == 72 || quiz.quiz_id == 73 || quiz.quiz_id == 74) { // Check if booth boss badge has been earned

						action_copy = '<div style="color:#000;margin:1em;font-size:2em">Thank you for playing! Remember to complete all 3 of the QR Code Trivia rounds at the LexisNexis booth to earn your Booth Boss badge!</div>';
						html = '<a href="/?p=meetings&source=trivia" class="button blue lg" id="dashboard-b"><span>Schedule a Meeting</span></a>';

					} else if(quiz.quiz_id == 75 || quiz.quiz_id == 76 || quiz.quiz_id == 77) { // Check if daily double badge has been earned

						html = '<a href="/?p=meetings&source=trivia" class="button blue lg" id="dashboard-b"><span>Schedule a Meeting</span></a>';

					} else {

						html = '<a href="/?p=meetings&source=trivia" class="button blue lg" id="dashboard-b"><span>Schedule a Meeting</span></a>';

					}

					if(quiz.quiz_state['meeting_scheduled'] == 1) {

						html = '<a href="/?p=profile" class="button blue lg" id="dashboard-b"><span>Return to Dashboard</span></a>';

					}
					
					$("#next-question-b").replaceWith(action_copy+html);

				}

			}

			$("#answer-result-h").fadeIn(250);

		});

	};

	this.user_points = function(points) {

		$("#points").hide().html(points).fadeIn(250);

	};

	this.timer = function(time) {
		
		if(time <= 0) {

			$('.timer').hide();
			return false;

		}

		$('div[data-time-total]').attr('data-time-total', time).attr('data-time', time);
		$('.timeNum').html(time);
		$('.timer').fadeIn(200);

		$('.timer').timer();

		return true;

	}

	this.start_timer = function(options) {
		Core.log('start timer: '+options['seconds']);
		options = Core.ensure_defaults({
			question_id: -1
		}, options);

		quiz.timer(options['seconds']);

		$.get('/?a=quiz_start_timer', options, function(data) {

			Core.log(data);

		});

	};

};

$(document).ready(function() {

	$('body').on('click', "input[answer-id]", function(e) {

		e.preventDefault();
		
		if($(this).parent().attr('is-poll') != 1 && $(this).parent().attr('no-submit') != 1) {

			quiz.answer({
				question_id: $(this).attr('question-id'),
				answer_id: $(this).attr('answer-id')
			});

		}

	});

	$('body').on('click', "#next-question-b", function(e) {

		e.preventDefault();
		
		quiz.get_state();

	});

	$('body').on('click', "[get-state]", function(e) {

		e.preventDefault();
		
		quiz.get_state();

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
				            
					theClient.subscribe('triviafever', true,
				           function (theClient, channel, msg) {
				             Core.log("Received message triviafever: "+msg);

				             if(msg.indexOf('Set a meeting with a LexisNexis representative') != -1) {

				             	window.location = '/?p=meetings&source=trivia';
				             	return false;

				             }

				             var data = $.parseJSON(msg);

				             if(data['question'] == 'Show Badges') {

				             	badge_check.check('30_31_32_29');
				             	return false;

				             }

				             if(quiz.current_question['question_id'] == data['question_id'] && quiz.current_question['locked'] == 1) {

				             	quiz.get_state();

				             }

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

});