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

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0; // For Chrome, Safari and Opera 
    document.documentElement.scrollTop = 0; // For IE and Firefox
}