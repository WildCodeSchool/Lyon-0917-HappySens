$(document).ready(function() {
    $('select').material_select();
    $(".button-collapse").sideNav();
    $('#modal1').modal();
    $('.datepicker').pickadate({
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
    });
    $('.slider').slider({
        interval: 2700,
        transition: 700
    });
    $('.collapsible').collapsible();
    $(".button").sideNav();
});

