$(document).ready(function() {
    $('.scrollTo').on('click', function () {
        var page = $(this).attr('href');
        var speed = 1000;
        $('html, body').animate({
            scrollTop: $(page).offset().top - 75
        }, speed);
        return false;
    });
    $('')
});