var social_share = new function() {
	
	this.tweet = function(copy) {

		var url = 'http://twitter.com/intent/tweet?text='+encodeURIComponent(copy)+'&related=yarrcat';
		window.open(url);

	};

	this.linkedin = function(copy) {

		var url = 'http://www.linkedin.com/shareArticle?mini=true&url='+encodeURIComponent('http://gettriviafever.com')+'&title='+encodeURIComponent('Trivia Fever')+'&summary='+encodeURIComponent(copy)+'&source='+encodeURIComponent('http://gettriviafever.com');
		window.open(url);

	};

};

$(document).ready(function() {

	$('body').on('click', '[twitter-share]', function(e) {

		e.preventDefault();

		var copy = $(this).attr('twitter-share');
		social_share.tweet(copy);

	});

	$('body').on('click', '[linkedin-share]', function(e) {

		e.preventDefault();

		var copy = $(this).attr('twitter-share');
		social_share.linkedin(copy);

	});

});