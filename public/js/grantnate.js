let granty = 0;

(function ( $ ) {
 
    $.fn.grantnate = function( options ) {

        var settings = $.extend({
            elementsPerPage: 6
        }, options );
        
        
        var kids = this.children();
        $(kids).hide();
        var element = document.createElement("div");
        $(element).addClass('paging-holder');
        var next = document.createElement('div');
        next.id = "grantnate_next";
        $(next).html('Next page <i class="fas fa-arrow-right"></i>');
        var prev = document.createElement('div');
        prev.id = "grantnate_prev";
        $(prev).html('<i class="fas fa-arrow-left"></i> Previous page');
        $(element).append(prev);
        $(element).append(next);

        $(this).append(element);
        if ( kids.length > settings.elementsPerPage )
        {
            $('#grantnate_next').attr('onclick', "nextPage()");        
        }
        else
        {
            $('#grantnate_next').addClass('disable_nav');
        }
        $('#grantnate_prev').addClass('disable_nav');
        
        return {
            init: function()
            {
                for ( var i = 0; i < settings.elementsPerPage; i++ )
                {
                    $(kids[i]).fadeIn(1500);
                }
            },
            nextPage: function()
            {
                $('#grantnate_prev').attr('onclick', "prevPage()");
                $('#grantnate_prev').removeClass('disable_nav');
                granty += 1;
                $(kids).hide();
                for( var i = granty*settings.elementsPerPage; i < (granty+1)*settings.elementsPerPage; i++ )
                {
                    $(kids[i]).fadeIn(1500);
                }
                if ( kids.length < (granty+1)*settings.elementsPerPage )
                {
                    $('#grantnate_next').attr('onclick', '');
                    $('#grantnate_next').addClass('disable_nav');
                }
                else
                {
                    $('#grantnate_next').attr('onclick', "nextPage()");  
                    $('#grantnate_next').removeClass('disable_nav');
                }
            },

            prevPage: function()
            {
                $('#grantnate_next').attr('onclick', "nextPage()");
                $('#grantnate_next').removeClass('disable_nav');
                granty -= 1;
                $(kids).hide();
                for( var i = granty*settings.elementsPerPage; i < (granty+1)*settings.elementsPerPage; i++ )
                {
                    $(kids[i]).fadeIn(1500);
                }
                if ( granty === 0 )
                {
                    $('#grantnate_prev').attr('onclick', '');
                    $('#grantnate_prev').addClass('disable_nav');
                }
                else
                {
                    $('#grantnate_prev').attr('onclick', "prevPage()");
                    $('#grantnate_prev').removeClass('disable_nav');
                }
            },

            goToPage: function(j)
            {
                granty += 1;
                $(kids).hide();
                for( var i = j*settings.elementsPerPage; i < (j+1)*settings.elementsPerPage; i++ )
                {
                    $(kids[i]).fadeIn(1500);
                }
            }
        }
    };
 
}( jQuery ));