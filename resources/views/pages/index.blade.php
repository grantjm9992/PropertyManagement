@inject('translator', 'App\Providers\TranslationProvider')
<div class="row">
    <div id="items" style="margin: 20px auto;" class="col-10">
        {!! $pages !!}
    </div>
</div>

<script>
    $('body').delegate('[divid]', 'click', function() {
        $(this).hide();
        var val = $(this).attr('divid');
        $('[inputid='+val+']').show();
        $('[data-id='+val+']').focus();
    });
    $('body').delegate('[hideinputid]', 'click', function() {
        showDiv(this);
    });

    $('body').delegate('input[data-id]', 'keydown', function(e) {
        if ( event.which == 13 ) {
            var id = $(this).attr('data-id');
            var input = $('[hideinputid="'+id+'"]');
            showDiv(input[0]);
        }
    });
    function showDiv($this)
    {
        var val = $($this).attr('hideinputid');
        $('[inputid='+val+']').hide();
        $('[divid='+val+']').show();
        var inputs = $('input[data-id="'+val+'"]');
        var name = $(inputs[0]).val();
        $('[divid='+val+']').html(name);
        $.ajax({
            type: "POST",
            url: "Pages.update",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: val,
                name: name
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    md.showNotification("top", "center", "Name updated correctly");
                }
            }
        })
    }
    

    $(document).ready( function() {
        $('#items').sortable({
            update: function() {
                updateOrder();
            }
        });
    })

    function updateOrder()
    {        
        var elements = $('.cc-sortable');
        var ids = "";
        for ( var i = 0; i < elements.length; i++ ) {
            ids += $(elements[i]).attr('data-id')+"@#";
        }
        $.ajax({
            type: "POST",
            url: "Pages.updateOrder",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                ids: ids
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    md.showNotification("top", "center", "Order updated correctly");
                }
            }
        })
    }
</script>