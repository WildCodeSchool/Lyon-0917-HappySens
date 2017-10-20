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
        }
        else if ($window.scrollTop() < 10) {
            $('.nav-wrapper').addClass('navbarTop').removeClass('navbarFixed');
            $('.linkNav').addClass('linkTopColor').removeClass('linkFixedColor');
        }
        else {
            $('.nav-wrapper').addClass('navbarTop').removeClass('navbarFixed');
            $('.linkNav').addClass('linkTopColor').removeClass('linkFixedColor');
        }
    })
}