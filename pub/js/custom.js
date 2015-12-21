$(document).ready(function(){
	
	/*
	var max = 0;
	$(".eqh1").each(function(i, e){ 
		var h = $(e).height();
		if(max == 0){
			max = h;
		}
		else{
			if(h > max)
				max = h;
		}
		console.log(h);
	});
	
	
	$(".eqh1").each(function(i, e){
		$(e).height(max);
	});
	*/
	//console.log(max);
	
	if(navigator.userAgent.indexOf('Mac') > 0){
	$('body').addClass('mac-os');
	}

	/*$('.inactive-badge').mouseenter(function(){
		var badgeid = $(this).attr('id');
		$(this).stop().fadeOut(20, function(){
			$('#' + badgeid + '-hover').stop().fadeIn();
		})	
	});

	$('.hide-badge').mouseleave(function(){
		var badgeid = $(this).data('origin');
		$(this).stop().fadeOut(20, function(){
			$('#' + badgeid).stop().fadeIn();
		})	
	});*/

$('.inactive-badge').hover(function(){
	$(this).attr('src', '/img/badges/' + $(this).data('badge') + '-active.png');
}, function(){
	$(this).attr('src', '/img/badges/' + $(this).data('badge') + '-inactive.png');
});
	
	
	$(".knob").knob({
		'readOnly':true,

		/*change : function (value) {
			//console.log("change : " + value);
		},
		release : function (value) {
			console.log("release : " + value);
		},
		cancel : function () {
			console.log("cancel : " + this.value);
		},*/
		draw : function () {

			// "tron" case
			if(this.$.data('skin') == 'tron') {

				var a = this.angle(this.cv)  // Angle
					, sa = this.startAngle          // Previous start angle
					, sat = this.startAngle         // Start angle
					, ea                            // Previous end angle
					, eat = sat + a                 // End angle
					, r = true;

				this.g.lineWidth = this.lineWidth;

				this.o.cursor
					&& (sat = eat - 0.3)
					&& (eat = eat + 0.3);

				if (this.o.displayPrevious) {
					ea = this.startAngle + this.angle(this.value);
					this.o.cursor
						&& (sa = ea - 0.3)
						&& (ea = ea + 0.3);
					this.g.beginPath();
					this.g.strokeStyle = this.previousColor;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
					this.g.stroke();
				}

				this.g.beginPath();
				this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
				this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
				this.g.stroke();

				this.g.lineWidth = 2;
				this.g.beginPath();
				this.g.strokeStyle = this.o.fgColor;
				this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
				this.g.stroke();

				return false;
			}
		}
	});
	
	
	$(window).on('resize', function(){
		if( $(window).width() > 480 ){
			//location.reload();
		}

	});	
	
});

