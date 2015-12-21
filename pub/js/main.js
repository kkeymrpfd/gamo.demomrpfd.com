// Preload Images Plugin
$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}

$(function(){
    // Preload Images
    $(preloadImages).preload();
    
    $('.closeSection').click(function(e){
        e.preventDefault();
        $(this).closest('.section').slideUp(600);

        $.get('/?a=scan_prompt_closed', function(data) {});

    });

});