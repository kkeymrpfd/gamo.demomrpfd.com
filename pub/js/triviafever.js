// JavaScript Document

$(function(){
	
	$('.registerbutton').click(function(){
		$('#landing').fadeOut(function(){
				$('#register').fadeIn();
				window.scrollTo(0, 0);
		});
		
	});
	
});