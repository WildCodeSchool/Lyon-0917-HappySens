$(document).ready(function() {
    var duration = 350;
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            // Si un défillement de 50 pixels ou plus.
            // Ajoute le bouton
            $('.scrollToTop').fadeIn(duration);
        } else {
            // Sinon enlève le bouton
            $('.scrollToTop').fadeOut(duration);
        }


    });

    $('.scrollToTop').click(function(event) {
        // Un clic provoque le retour en haut animé.
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});