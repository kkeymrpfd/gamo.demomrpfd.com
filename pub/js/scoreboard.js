(function($) {
    // Add to jQuery
    $.fn.scoreboard = function() {
        return init.apply(this);
    }
    
    // Initiate
    var init = function() {
        return this.each(function() {
            var $this = $(this);
            
            // Settings
            var scoreboard = {
                fade: 600,
                swipe: 1200,
                show: 8000,
                url: null,
                timeout: null,
                $currPage: null
            };
            scoreboard.url = $this.attr('data-ajax');
            $this.find('.page').css({'left' : '1920px'});
            scoreboard.$currPage = $this.find('.page:first');
            scoreboard.$currPage.css({'left' : '0'});
            $this.data('scoreboard', scoreboard);
            loadPages($this);
        });
    }
    
    // Fade elements
    var elementFade = function($this, $page) {
        var scoreboard = $this.data('scoreboard');
        
        var delay = 0;
        $page.find('.element').hide();
        $page.find('.element').each(function(){
            $(this).delay(delay).fadeIn(scoreboard.fade);
            delay+=140;
        });
    }
    
    // Load URL
    var loadPages = function($this) {
        var scoreboard = $this.data('scoreboard');
        $.ajax({
            type: 'GET',   
            url: scoreboard.url,   
            async: false,
            success: function(response) {
                var $response = $(response);
                var $queue =  $({});
                var $pages = $('.pages');
                if ($pages.length > 0) {
                    $queue.queue('transition', function(next) {
                        $pages.fadeOut(scoreboard.fade, function(){
                            next();
                        });
                    });
                }
                $queue.queue('transition', function(next) {
                    $response.find('.page').css({'left' : '1920px'});
                    scoreboard.$currPage = $response.find('.page:first');
                    scoreboard.$currPage.css({'left' : '0'});
                    scoreboard.$currPage.find('.element').hide();
                    $response.find('[data-page="#'+scoreboard.$currPage.attr('id')+'"]').addClass('curr');
                    $response.hide();
                    $this.append($response);
                    $response.fadeIn(scoreboard.fade, function() {
                        next();
                    });
                });
                $queue.queue('transition', function(next) {
                    elementFade($this, scoreboard.$currPage);
                    scoreboard.timeout = window.setTimeout(function(){ slidePage($this); }, scoreboard.show);
                    next();
                });
                $queue.dequeue('transition');
                $this.data('scoreboard', scoreboard);
            }
        });
    }
    
    // Slide in next page
    var slidePage = function($this) {
        var scoreboard = $this.data('scoreboard');
        var $nextPage = scoreboard.$currPage.next('.page');
        if ($nextPage.length < 1) {
            loadPages($this);
            return;
        }
        if($nextPage[0] !== scoreboard.$currPage[0]) {
            // Animate page swipe
            scoreboard.$currPage.animate({
                'left' : '-1920px'
            }, scoreboard.swipe);
            $nextPage.animate({
                'left' : '0'
            }, scoreboard.swipe, function(){
                $('[data-page]').removeClass('curr');
                $('[data-page="#'+$nextPage.attr('id')+'"]').addClass('curr');
                scoreboard.$currPage.css({'left' : '1920px'});
                scoreboard.$currPage = $nextPage;
                scoreboard.timeout = window.setTimeout(function(){ slidePage($this); }, scoreboard.show);
            });
        }
    }
})(jQuery);

$(function() {    
    $('.scoreboard').scoreboard();
});