$(function() {
    /*$(".nav-link").on('click', function(e) {
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
    });*/
    $("a").on("click", function(e) {
        var hash = "#";
        if ( $(this).attr("href").includes( hash ) )
        {
            e.preventDefault();
            var href = $(this).attr("href");
            if ( $(href).length > 0 )
            {
                var position = $(href).offset();
                $("html, body").animate({
                    scrollTop: position.top
                }, 1000);
            }
        }
    })
});

$(document).ready ( function() {
    $("#example").flipster({
        style: 'flat',
        spacing: -.250,
        buttons: "custom",
        buttonPrev: '<i class="fas fa-arrow-left mycasanav"></i>',
        buttonNext: '<i class="fas fa-arrow-right mycasanav"></i>',
        scrollwheel: false,
        loop: true
    });

   var owl = $('#testimonials').owlCarousel({
        items: 1,
        nav: false,
        loop: true,
        autoplay: true
    });
    $('.next').click(function() {
        owl.trigger('next.owl.carousel');
    })
    $('.prev').click(function() {
        owl.trigger('prev.owl.carousel');
    })
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


function playVideo()
{
    var video = document.createElement("video");
    $(video).attr("src", "img/mycasaaway/intro.mp4");
    $(video).attr("autoplay", true);
    $(video).prop("id", "intro_video");
    video.onended = function() {
        $(".video-section *").show();
        $("#intro_video").remove();
    }
    $(".video-section *").hide();
    $(".video-section").append(video);
}