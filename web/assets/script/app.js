$(document).ready(function() {
    $('select').material_select();
    $(".button-collapse").sideNav();
    $('#modal1').modal();
    $('.datepicker').pickadate({
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true
    });
    $('.collapsible').collapsible();
    $(".button").sideNav();
    $('#modal2').modal();

});
