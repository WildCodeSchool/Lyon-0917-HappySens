$(document).ready(function() {
    $('select').material_select();
    $(".button-collapse").sideNav();
    $('#modal1').modal();
    $('ul.tabs').tabs({
        swipeable: true
    });
    $('.tabs-content').css("min-height", "1050px");
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

