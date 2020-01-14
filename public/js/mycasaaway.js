$(function() {
    $(".nav-link").on('click', function(e) {
        $('.nav-item').removeClass("active");
        $(this).closest(".nav-item").addClass("active");
        if ( e.preventDefault ) e.preventDefault();
        var href = $(this).attr("href");
        if ( $(href).length > 0 )
        {
            var position = $(href).offset();
            $("html, body").animate({
                scrollTop: position.top
            }, 1000);
        }
    });
});

$(document).ready ( function() {
});