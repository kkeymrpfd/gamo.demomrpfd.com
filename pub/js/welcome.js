var resizeWindow = function() {
    var windowWidth = $(window).outerWidth();
    var windowHeight = $(window).outerHeight();
    if (windowHeight < windowWidth) {
        windowHeight = Math.min(windowWidth*1.5, 800);
        $('body').css({
            overflow: 'auto',
            height: windowHeight
        });
    } else {
        $('body').css({
            overflow: 'hidden',
            height: '100%'
        });
    }
}

$(function() {
    var zindex = 250;
    $('.slidePage:not(.last)').draggable({
        addClasses: false,
        axis: 'x',
        revert: true,
        drag: function(e, ui) {
            if (ui.position.left > 0) {
                ui.position.left = 0;
            }
            if (ui.position.left < -parseInt(ui.helper.outerWidth()/3)) {
                ui.originalPosition.left = '-100%';
                ui.helper.prev('.slidePage').addClass('hideTab');
            } else {
                ui.originalPosition.left = 0;
                ui.helper.prev('.slidePage').removeClass('hideTab');
            }
        },
        stop: function(e, ui) {
            $('.bullet').removeClass('selected');
            if (ui.originalPosition.left == '-100%') {
                $('.bullet[data-slide="'+ui.helper.attr('id')+'"]').next('.bullet').addClass('selected');
            } else {
                $('.bullet[data-slide="'+ui.helper.attr('id')+'"]').addClass('selected');
            }
            console.log(ui.helper);
            if (ui.helper.next('.slidePage').is('.last') && ui.originalPosition.left === '-100%') {
                $('#enterSiteFooter').fadeIn(600);
                $('#swipeLeftFooter').fadeOut(600);
            } else {
                $('#enterSiteFooter').fadeOut(600);
                $('#swipeLeftFooter').fadeIn(600);
            }
        }
    }).each(function(){
        $(this).css({'z-index' : zindex});
        zindex--;
    });
    $(window).bind('resize', resizeWindow);
    $(window).trigger('resize');
});