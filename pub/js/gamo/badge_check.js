var badge_check = new function() {

	this.badge = {};

	this.check = function(badge_ids) {

		$.get('/?a=badge_check&v=json&badge_ids='+badge_ids, function(data) {

			Core.log(data);
			data = $.parseJSON(data);
			badge_check.render(data);			

		});

	};

	this.render = function(data) {

		if(data['badge_id'] != -1) {

			var html = '<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">'
			  +'<div class="modal-dialog">'
				+'<div class="modal-content">'
				  +'<div class="modal-header" style="font-size:3em">'
					+'<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff">&times;</button>'
				  +'</div>'
				  +'<div class="modal-body">'
					+'<div class="container">'
						+'<div class="row">'
							+'<div class="col-xs-12 text-center">'
								+'<div class="unlocked">'
									+'<h1 class="title" style="font-size:1em;padding:0.5em">'
										+'You\'ve unlocked the <span id="badge-name">max deductible elite</span> badge!'
									+'</h1>'
								+'</div>'
								+'<p>&nbsp;</p>'
								+'<img id="badge-img" class="img-responsive center-block">'
								//+'<h2 id="badge-descrip">For your exceptional performance in live trivia!</h2>'
								+'<p>&nbsp;</p>'
								+'<div class="modal-control" twitter-share="'+data['social_share']+'">'
									+'Tweet'
									+'<span class="label red-bg pull-right">10 pts</span>'
								+'</div>'
								+'<div class="modal-control">'
									+'<a href="#" data-dismiss="modal">Return to Game</a>'
								+'</div>'
							+'</div>'
						+'</div>'
					+'</div>'
				  +'</div>'
				+'</div>'
			  +'</div>'
			+'</div>';

			$('#myModal').remove();
			$('body').append(html);

			$("#badge-img").attr('src', 'img/badges/'+data['badge_id']+'.png');
			$("#badge-name").html(data['badge_name']);
			//$("#badge-descrip").html(data['display_earned']);
			$('#myModal').modal('show');

			badge_check.badge = data;

		}

	}

};