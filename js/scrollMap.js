$(document).ready(function () {

        // you want to enable the pointer events only on click;

        $('#mapa').addClass('scrolloff'); // set the pointer events to none on doc ready
        $('#ubicacion').on('click', function () {
            $('#mapa').removeClass('scrolloff'); // set the pointer events true on click
        });

        // you want to disable pointer events when the mouse leave the canvas area;

        $("#mapa").mouseleave(function () {
            $('#mapa').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
        });
    });