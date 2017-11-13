$(document).ready(function() {
    $(window).scroll(function() {
        evoNavbar();
    })
});
function evoNavbar() {
    $window = $(window);
    $window.scroll(function() {
        if ($window.scrollTop() > 100){
            $('.nav-wrapper').removeClass('navbarTop').addClass('navbarFixed');
            $('.linkNav').removeClass('linkTopColor').addClass('linkFixedColor');
            $('#target').addClass('navbar-fixed');
            $('.logoOut').removeClass('hide');
        }
        else if ($window.scrollTop() < 10) {
            $('.nav-wrapper').addClass('navbarTop').removeClass('navbarFixed');
            $('.linkNav').addClass('linkTopColor').removeClass('linkFixedColor');
            $('#target').removeClass('navbar-fixed');
            $('.logoOut').addClass('hide');

        }
        else {
            $('.nav-wrapper').addClass('navbarTop').removeClass('navbarFixed');
            $('.linkNav').addClass('linkTopColor').removeClass('linkFixedColor');
        }
    })
}

