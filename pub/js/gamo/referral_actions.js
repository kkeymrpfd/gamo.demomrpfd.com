var referrals_actions = new function(){
	
	this.action_id = '';
	
	this.get_new = function(options){

		$.get('/?a=get_nominations&v=json&page='+options['page']).
		done( function(data) {
			
			data = $.parseJSON(data);
			
			referrals_actions.render_nominations(data);
			
			pager.set({
				holder: options['pager'],
				current: data['actions_history']['current_page'],
				last: data['actions_history']['last_page'],
				getter_id: options['getter_id']
			});

		}).
		fail(function(){
			
		});

	};
	
	this.get_history = function(options){

		$.get('/?a=get_referrals&v=json&page='+options['page']).
		done( function(data) {
			
			data = $.parseJSON(data);
			
			referrals_actions.render_history(data);
					
			pager.set({
				holder: options['pager'],
				current: data['actions_history']['current_page'],
				last: data['actions_history']['last_page'],
				getter_id: options['getter_id']
			});

		}).
		fail(function(){
			
		});

	};
	
	this.save_referral = function(){
		
		$("#referral-result-msg").hide();

		var data = {
			referralName: $("#referralName").val(),
			referralTitle: $("#referralTitle").val(),
			referralCompany: $("#referralCompany").val(),
			referralEmail: $("#referralEmail").val(),
			referralCompose: $("#referralCompose").val()
		};
		
		$.get("/?a=create_referral&referralName="+data.referralName+"&referralTitle="+data.referralTitle+"&referralCompany="+data.referralCompany+"&referralEmail="+data.referralEmail+"&referralCompose="+data.referralCompose)
		.done(function(data){
			
			data = JSON.parse(data);
			if(data['valid']){
				Core.modal({
					msg: 'Your referral was sent.',
					alert: 'success'
				});
				$("#referralName").val('');
				$("#referralTitle").val('');
				$("#referralCompany").val('');
				$("#referralEmail").val('');
				$("#referralCompose").val('');
				Core.functions[Core.reference["referral_actions_nomination"]](1, Core.reference["referral_actions_nomination"]);
				Core.functions[Core.reference["referral_actions_referrals"]](1, Core.reference["referral_actions_referrals"]);
			}else{
				
				$("#referral-result-msg").hide().html('<div class="alert alert-error">'+Core.safe_echo(data['msg'])+'</div>').fadeIn(250);

			}
			
			
			
		})
		.fail(function(){
			$("#referral-result-msg").hide().html('<div class="alert alert-error">There was an error while processing your request. Please refresh the page and try again.</div>').fadeIn(250);
		});

	}

	this.claim = function(referral_id){

		var info = referrals_actions.claimable['id-'+referral_id];

		$("#referralName").val(info['name']);
		$("#referralTitle").val(info['title']);
		$("#referralCompany").val(info['company']);
		$("#referralEmail").val(info['email']);

		window.location.hash = '';
		window.location.hash = 'referral';

		$("#referral-result-msg").hide().html('<div class="alert alert-success">Please enter a message and hit send to complete claiming this referral.</div>').fadeIn(250);

	};
	
	this.claimable = {};

	this.render_nominations = function(data, getter_id) {
		
		referrals_actions.claimable = {};

		if(data != null
				&& data['actions_history'] != null
				&& data['actions_history']['actions'][0] != null
				&& data['actions_history']['actions'][0]['id'] != null) { // These are valid users
					
					var html = '';
					
					for(k in data['actions_history']['actions']) {
						
						var pic_img = '/img/profile-pic.png';
						if( data['actions_history']['actions'][k]['profile_pic'] !== '' ){
							pic_img = data['actions_history']['actions'][k]['profile_pic'];
						}

						referrals_actions.claimable['id-'+data['actions_history']['actions'][k]['id']] = {
							referral_id: data['actions_history']['actions'][k]['id'],
							name: data['actions_history']['actions'][k]['name'],
							title: data['actions_history']['actions'][k]['title'],
							company: data['actions_history']['actions'][k]['company'],
							email: data['actions_history']['actions'][k]['email']
						};

						html += '<div class="imageBox item resource">'
                            		+'<div class="image stretchImg">'
                            			+'<img src="'+pic_img+'" alt="" />'
                            		+'</div>'
                            		+'<div class="info">'
                            			+'<h5>' + Core.safe_echo( data['actions_history']['actions'][k]['name']) + '</h5>'
                            			+'<p>' + Core.safe_echo( data['actions_history']['actions'][k]['title']) + '</p>'
                            			+'<p>' + Core.safe_echo( data['actions_history']['actions'][k]['company'] ) + '</p>'
                            			+'<p style="margin-bottom:1em">' + Core.safe_echo( data['actions_history']['actions'][k]['email'] ) + '</p>'
                            			+'<p>' + Core.safe_echo( data['actions_history']['actions'][k]['description'] ) + '</p>'
                            			+'</div>'
                            			+'<div class="clearer">&nbsp;</div>'
                            			+'<a href="#" onclick="referrals_actions.claim(\''+ data['actions_history']['actions'][k]['id'] +'\');return false;" class="button small thirdLeft">Claim</a>'
                            	+'</div>';

					}

					html += '';

					$('#referral-holder').html(html);

				} else {

					$('#referral-holder').html("No actions found matching this criteria")

				}
		
	};
	
	this.render_history = function(data, getter_id) {
		
		if(data != null
			&& data['actions_history'] != null
			&& data['actions_history']['actions'][0] != null
			&& data['actions_history']['actions'][0]['id'] != null) { // These are valid users
					
			var html = '<div class="listRow title">'
                			+'<div class="listCell width25">Name</div>'
                			+'<div class="listCell width20">Title</div>'
                			+'<div class="listCell width20">Company</div>'
                			+'<div class="listCell width15">Points</div>'
                			+'<div class="listCell width20">&nbsp;</div>'
                		+'</div>';
			
			for(k in data['actions_history']['actions']) {


				html += '<div class="listRow">'
                    		+'<div class="listCell entry width25">' + Core.safe_echo( data['actions_history']['actions'][k]['name'] )+ '</div>'
                    		+'<div class="listCell entry width20">' + Core.safe_echo( data['actions_history']['actions'][k]['title'] )+ '</div>'
                    		+'<div class="listCell entry width20">' + Core.safe_echo( data['actions_history']['actions'][k]['company'] )+ '</div>'
                    		+'<div class="listCell entry width15 highlight">' + data['actions_history']['actions'][k]['points'] + '</div>'
                    		+'<div class="listCell" style="entry width:27%"><a href="#" resend-referral="'+data['actions_history']['actions'][k]['id']+'" onclick="return false" class="button xsmall noMargin">Re-email</a></div>'
                    	+'</div>';

			}

			html += '';

			$('#history-holder').html(html);

		} else {

			$('#history-holder').html("No actions found matching this criteria")

		}
		
	};

	this.resend = function(options) {

		options = Core.ensure_defaults({
			referral_id: -1
		}, options);

		var inputs = {
			referral_id: options['referral_id']
		};
		
		$.post('/?a=resend_referral&v=json', inputs, function(data) {

			Core.log(data);

			var result = $.parseJSON(data);

			if(result['error'] != null && result['error'] != '') {

				Core.modal({
					msg: result['error'],
					alert: 'error'
				});

			} else {

				Core.modal({
					msg: "Your referral has been resent!",
					alert: 'success'
				});

			}

		});

	};

	
};


$(document).ready(function() {

	Core.reference["referral_actions_nomination"] = Core.unique_id();
	Core.functions[Core.reference["referral_actions_nomination"]] = function(page, getter_id) {

		referrals_actions.get_new({
			pager: "#referral-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};
	Core.functions[Core.reference["referral_actions_nomination"]](1, Core.reference["referral_actions_nomination"]);

	Core.reference["referral_actions_referrals"] = Core.unique_id();
	Core.functions[Core.reference["referral_actions_referrals"]] = function(page, getter_id) {

		referrals_actions.get_history({
			pager: "#history-holder-pager",
			page: page,
			getter_id: getter_id
		});

	};
	Core.functions[Core.reference["referral_actions_referrals"]](1, Core.reference["referral_actions_referrals"]);

	$('#history-holder').on('click', "[resend-referral]", function() {

		referrals_actions.resend({
			referral_id: $(this).attr('resend-referral')
		});

	});

});
