$(document).ready(function() {
    var duration = 800;
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.scrollToTop').fadeIn(duration);
        } else {
            $('.scrollToTop').fadeOut(duration);
        }
    });
    $('.scrollToTop').click(function(event) {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    });
});