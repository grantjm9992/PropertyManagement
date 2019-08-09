@inject('translator', 'App\Providers\TranslationProvider')
<div class="row">
    <div id="items" style="margin: 20px auto;" class="col-10">
        {!! $types !!}
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
            url: "AdminFeatures.update",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: val,
                name: name
            },
            success: function(data)
            {
                if ( data == "OK" )
                {                    
                    $.notify( "Name updated successfully", {
                        position: "bottom-left",
                        className: "success"
                    } );
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
    
    function addFeature()
    {
        $.ajax({
            type: "POST",
            url: "AdminFeatures.new",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $('#items').append(data);
            }
        })
    }

    function updateOrder()
    {        
        var elements = $('.cc-sortable');
        var ids = "";
        for ( var i = 0; i < elements.length; i++ ) {
            ids += $(elements[i]).attr('data-id')+"@#";
        }
        $.ajax({
            type: "POST",
            url: "AdminFeatures.updateOrder",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                ids: ids
            },
            success: function(data)
            {
                if ( data == "OK" )
                {                    
                    $.notify( "Order updated successfully", {
                        position: "bottom-left",
                        className: "success"
                    } );
                }
            }
        })
    }

    function deleteFeature( id )
    {
        var options = Array();
        options.text = "Are you sure you want to delete this property type?";
        options.title = "warning";
        options.icon = "warning";
        options.type = "confirm";
        options.thenFunction = checkDelete;
        options.thenParameters = id;
        sweetAlert( options );
    }

    function checkDelete( id )
    {
        $.ajax({
            type: "POST",
            url: "AdminFeatures.delete",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: id
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    $('[data-id="'+id+'"]').remove();
                    $.notify( "Deleted successfully", {
                        position: "bottom-left",
                        className: "success"
                    } );
                }
                else
                {
                    var options = Array();
                    options.text = "This type cannot be deleted because it is currently in use";
                    options.title = "Error";
                    options.icon = "error";
                    sweetAlert( options );
                }
            }
        })
    }
</script>