$(document).ready(function() {
    $('select').material_select();
    $(".button-collapse").sideNav();
    $('#modal1').modal();
    $('ul.tabs').tabs({
        swipeable: true
    });
    $('select').material_select();
    $('.datepicker').pickadate({
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: true // Close upon selecting a date,
    });
});

