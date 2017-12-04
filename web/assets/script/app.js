$(document).ready(function() {
    $('select').material_select();
    $(".button-collapse").sideNav();
    $('#modal1').modal();
    $('.datepicker').pickadate({
        close: 'Ok',
        monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
        today: 'aujourd\'hui',
        clear: 'effacer',
        format: 'dd/mm/yyyy',
        closeOnSelect: true
    });
    $('.collapsible').collapsible();
    $(".button").sideNav();
    $('#modal2').modal();

});
