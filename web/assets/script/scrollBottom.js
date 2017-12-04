$(function() {
    $('#scrollBottom a').on('click', function(e) {
        $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 450, 'linear');
        e.preventDefault();

    });
});