$(document).ready(function() {
    $('select').material_select();
    $(".button-collapse").sideNav();
    $('.datepicker').pickadate({
        close: 'Ok',
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'aujourd\'hui',
        clear: 'effacer',
        format: 'dd/mm/yyyy',
        min: true,
        closeOnSelect: true
    });
    $('.datepickerCompany').pickadate({
        close: 'Ok',
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'aujourd\'hui',
        clear: 'effacer',
        selectMonths: true, // Enable Month Selection
       selectYears: 100, // Creates a dropdown of 10 years to control year
        format: 'dd/mm/yyyy',
        min: false,
        max: true,
        closeOnSelect: true
    });
    $('.datepickerUser').pickadate({
        close: 'Ok',
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'aujourd\'hui',
        clear: 'effacer',
        selectMonths: true, // Enable Month Selection
        selectYears: 80, // Creates a dropdown of 80 years to control year
        format: 'dd/mm/yyyy',
        max: true,
        closeOnSelect: true
    });
    $('.collapsible').collapsible();
    $(".button").sideNav();
    $('.modal').modal();

});

function hideContactFlash() {
    $('#flashNoticeContact').addClass('hide');
}

function loadingPage(change) {
    if (change !== null) {
        if($("#appbundle_changepwd_email").val().length >= 10) {
            $('#waitingDiv').removeClass('hide');
        }
    }
}