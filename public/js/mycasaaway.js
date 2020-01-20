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
    $("#example").flipster({
        style: 'flat',
        spacing: -.250,
        buttons: "custom",
        buttonPrev: '<i class="fas fa-arrow-left mycasanav"></i>',
        buttonNext: '<i class="fas fa-arrow-right mycasanav"></i>',
        scrollwheel: false
    });

    $('#testimonials').owlCarousel({
        items: 1,
        nav: false
    });
});

$(function() {
    $(window).on("scroll", function() {
        if ( $(window).scrollTop() > 50 )
        {
            $('.navbar').addClass("navbar-light");
            $('.navbar').addClass("bg-light");
        }
        else
        {
            $('.navbar').removeClass("navbar-light");
            $('.navbar').removeClass("bg-light");            
        }
    })
});