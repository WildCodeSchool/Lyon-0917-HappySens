jQuery(document).ready(function() {
    var duration = 350;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 50) {
            // Si un défillement de 50 pixels ou plus.
            // Ajoute le bouton
            jQuery('.scrollToTop').fadeIn(duration);
        } else {
            // Sinon enlève le bouton
            jQuery('.scrollToTop').fadeOut(duration);
        }


    });

    jQuery('.scrollToTop').click(function(event) {
        // Un clic provoque le retour en haut animé.
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});