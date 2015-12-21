$(function() {
    var pad = function(n, width, z) {
        z = z || '0';
        n = n + '';
        return n.length >= width ? n : new Array(width - n.length + 1).join(z) + n;
    }
    
    var timerTimeout = '';

    var decrement = function($timer) {
        var totalTime = parseInt($timer.attr('data-time-total'));
        var currTime = parseInt($timer.attr('data-time'));
        if(currTime >= 0) {

            $timer.find('.time').html('<span style="font-size:5em">'+pad(currTime, 2)+'</span>');

        }
        
        if (currTime <= -9999) {
            // Submit the form
        } else {
            $timer.attr('data-time', currTime - 1);
            timerTimeout = setTimeout(function(){
                decrement($timer);
            }, 1000);
        }
    }
    
    $.fn.timer = function() {
        clearTimeout(timerTimeout);
        return this.each(function() {
            var $timer = $(this);
            decrement($timer);
        });
    }
});
    