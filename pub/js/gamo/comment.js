var gamo_comment = new function() {

	this.reply_to_comment = function(reply_to_id) {

		var inputs = {
			reply_to_id: reply_to_id,
			reply_message: $("[comment-reply='"+reply_to_id+"']").val()
		}

        if(inputs['reply_message']== ''){

            Core.modal({
                msg: 'You did not compose a reply',
                alert: 'error'
            });

            return false;
        }

		$.post('/?a=reply_to_comment&v=json', inputs, function(data) {
			
			var data = $.parseJSON(data);
           		
			if(data['error_msg'] != null) {

				Core.modal({
					msg: data['error_msg'],
					alert: 'error'
				});

			    return false;

			} else {

				/*Core.modal({
					msg: "Your reply has been submitted!",
					alert: 'success'
				});*/

				$("[comment-reply]").val('');
		        
                gamo_comment.refresh_comments();	
				gamo.update_dash();

			}

		});

	};

	this.create_comment = function() {

		var inputs = Core.get_inputs({
			holder: $('#create-comment-form')
		});

		$.post('/?a=create_comment&v=json', inputs, function(data) {
			var data = $.parseJSON(data);

			if(data['error_msg'] != null) {

				Core.modal({
					msg: data['error_msg'],
					alert: 'error'
				});

			    return false;

			} else {


				$('#create-comment-form').find(':input').val('');

				gamo_comment.refresh_comments();

                gamo.update_dash();

                Core.modal({
					msg: "Your comment has been submitted!",
					alert: 'success'
				});

			}

		});

	};


	this.get_comments = function(options) {

		$.get('/?a=get_comments&v=json&page='+options['page'], function(data) {

			var data = $.parseJSON(data);

			var status = 0;
			var points = 0;

			if(data['actions_history']['actions'].length > 0) {
    
                var html = '';

				for(k in data['actions_history']['actions']) {
					
					var highlight = '';

					if( Core.compare_to_local_offset(data['actions_history']['actions'][k]['datetime'],8) ){
						highlight = ' style="color:#00868B"';
					}

                    html += '<div class="imageBox comment">'
                                +'<div class="image stretchImg">'
                                    +'<img src="/get_user_img/'+data['actions_history']['actions'][k]['user_id']+'.png" class="border-curved" alt=""/>'
                                +'</div>'
                                +'<div class="info">'
                                    +'<h6'+highlight+'>Posted by '+Core.safe_echo(data['actions_history']['actions'][k]['display_name'])+' on '+Core.local_time(data['actions_history']['actions'][k]['datetime'])
                                    +'</h6>'
                                    +'<p>'+Core.safe_echo(data['actions_history']['actions'][k]['msg'])
                                    +'</p>'
                                    +'<div class="replies"  style="margin-top:0.5em">';

                    for(j in data['actions_history']['actions'][k]['replies']){
                    	
                    	var highlight_reply = '';

    					if( Core.compare_to_local_offset(data['actions_history']['actions'][k]['replies'][j]['datetime'],8) ){
    						highlight_reply = ' style="color:#00868B"';
    					}

                        html +=          '<div class="imageBox reply">'
                                            +'<div class="image stretchImg">'
                                                +'<img src="/get_user_img/'+data['actions_history']['actions'][k]['replies'][j]['user_id']+'.png" class="border-curved" alt="" />'
                                            +'</div>'
                                            +'<div class="info">'
                                                +'<h6'+highlight_reply+'>Posted by '+Core.safe_echo(data['actions_history']['actions'][k]['replies'][j]['display_name'])+' on ' +Core.local_time(data['actions_history']['actions'][k]['replies'][j]['datetime'])
                                                +'</h6>'
                                                +'<p>'+Core.safe_echo(data['actions_history']['actions'][k]['replies'][j]['msg'])
                                                +'</p>'
                                             +'</div>'
                                             +'<div class="clearer">&nbsp;</div>'
                                         +'</div>';
                    }

                    html +=          '</div>'
                                    +'<form style="margin-top:0.5em" id="reply-to-comment-form" onsubmit="return false">'
                                        +'<input id="reply_to_id" type="hidden" value="'+data['actions_history']['actions'][k]['comment_id']+'"/>'
                                        +'<textarea comment-reply="'+data['actions_history']['actions'][k]['comment_id']+'"></textarea>'
                                        +'<button id="reply-to-comment-submit" type="submit" class="button xsmall quarterRight" onclick="gamo_comment.reply_to_comment('+data['actions_history']['actions'][k]['comment_id']+')">Reply</button>'
                                    +'</form>'
                                 +'</div>'
                                 +'<div class="clearer">&nbsp;</div>'
                              +'</div>';

				}
            	
				pager.set({
					holder: options['pager'],
					current: data['actions_history']['current_page'],
					last: data['actions_history']['last_page'],
					getter_id: options['getter_id']
				});
				
				window.scrollTo(0,0);

			} else {

				var html = 'Be the first to leave a comment!';

			}

			$('#comments-holder').html(html);

		});

	};

	this.get_reply_history = function(options) {

		$.get('/?a=get_reply_history&v=json&page='+options['page'], function(data) {

			var data = $.parseJSON(data);
			
			var status = 0;

			if(data['actions_history']['actions'].length > 0) {

				var html = '<div class="list">'
			                    +'<div class="listRow title">'
			                        +'<div class="listCell width30">Date &amp; Time</div>'
			                        +'<div class="listCell width15">Points</div>'
			                        +'<div class="listCell width40">Comment</div>'
                                    +'<div class="listCell width15">&nbsp;</div>'
			                    +'</div>';

				for(k in data['actions_history']['actions']) {

					html += '<div class="listRow">'
	                            +'<div class="listCell width30">'+Core.local_time(data['actions_history']['actions'][k]['datetime'])+'</div>'
	                            +'<div class="listCell width15">'+data['actions_history']['actions'][k]['points']+'</div>'
	                            +'<div class="listCell width40">'+Core.safe_echo(data['actions_history']['actions'][k]['msg'])+'</div>'
                                +'<div class="listCell width15">&nbsp;</div>'
	                        +'</div>';


				}

				html += '</div>';	
            	
				pager.set({
					holder: options['pager'],
					current: data['actions_history']['current_page'],
					last: data['actions_history']['last_page'],
					getter_id: options['getter_id']
				});

			} else {

				var html = 'You have not replied to any comments yet.';

			}

			$('#reply-history-holder').html(html);

		});

	};

	this.get_comment_history = function(options) {

		$.get('/?a=get_comment_history&v=json&page='+options['page'], function(data) {

			var data = $.parseJSON(data);

			var status = 0;

			if(data['actions_history']['actions'].length > 0) {

				var html = '<div class="list">'
			                    +'<div class="listRow title">'
			                        +'<div class="listCell width30">Date &amp; Time</div>'
			                        +'<div class="listCell width15">Points</div>'
			                        +'<div class="listCell width40">Comment</div>'
                                    +'<div class="listCell width15">&nbsp;</div>'
			                    +'</div>';

				for(k in data['actions_history']['actions']) {

					html += '<div class="listRow">'
	                            +'<div class="listCell width30">'+Core.local_time(data['actions_history']['actions'][k]['datetime'])+'</div>'
	                            +'<div class="listCell width15">'+data['actions_history']['actions'][k]['points']+'</div>'
	                            +'<div class="listCell width40">'+Core.safe_echo(data['actions_history']['actions'][k]['msg'])+'</div>'
                                +'<div class="listCell width15">&nbsp;</div>'
	                        +'</div>';


				}

				html += '</div>';
			
            	
				pager.set({
					holder: options['pager'],
					current: data['actions_history']['current_page'],
					last: data['actions_history']['last_page'],
					getter_id: options['getter_id']
				});

			} else {

				var html = 'You have not commented yet.';

			}

			$('#comment-history-holder').html(html);

		});

	};

	this.refresh_comments = function() {

		 Core.functions[Core.reference["comments_actions_new"]](1, Core.reference["comments_actions_new"]);
		 Core.functions[Core.reference["comment_history_actions_new"]](1, Core.reference["comment_history_actions_new"]);
		 Core.functions[Core.reference["reply_history_actions_new"]](1, Core.reference["reply_history_actions_new"]);

	};

};

$(document).ready(function() {
	
    Core.reference["comments_actions_new"] = Core.unique_id();
    Core.functions[Core.reference["comments_actions_new"]] = function(page, getter_id) {
        gamo_comment.get_comments({
            pager: "#comments-holder-pager",
            page: page,
            getter_id: getter_id
        });
    }
    Core.functions[Core.reference["comments_actions_new"]](1, Core.reference["comments_actions_new"]);
	
    Core.reference["comment_history_actions_new"] = Core.unique_id();
	Core.functions[Core.reference["comment_history_actions_new"]] = function(page, getter_id) {
		gamo_comment.get_comment_history({
			pager: "#comment-history-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};
	Core.functions[Core.reference["comment_history_actions_new"]](1, Core.reference["comment_history_actions_new"]);

    Core.reference["reply_history_actions_new"] = Core.unique_id();
    Core.functions[Core.reference["reply_history_actions_new"]] = function(page, getter_id) {
        gamo_comment.get_reply_history({
          pager: "#reply-history-holder-pager",
          page: page,
          getter_id: getter_id
        });
    };
    Core.functions[Core.reference["reply_history_actions_new"]](1, Core.reference["reply_history_actions_new"]);

    $("#create-comment-submit").click(function() {

        gamo_comment.create_comment();

    });

});
