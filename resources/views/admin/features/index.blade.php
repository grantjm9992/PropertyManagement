@inject('translator', 'App\Providers\TranslationProvider')
<div class="row">
    <div class="col-10 mx-auto">
        <div class="buttons">
            <div class="btn btn-primary" onclick="newFeature()">
                <i class="fas fa-plus"></i> New feature
            </div>
        </div>
    </div>
    <div id="items" style="margin: 20px auto;" class="col-10">
        {!! $featureHTML !!}
    </div>
</div>

<script>
    
    function newFeature()
    {
        $.ajax({
            type: "POST",
            url: "AdminPropertyFeatures.new",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $('#items').append(data);
            }
        })
    }
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
            showDiv(input[1]);
        }
    });
    function showDiv($this)
    {
        var val = $($this).attr('hideinputid');
        $('[inputid='+val+']').hide();
        $('[divid='+val+']').show();
        var inputs = $('input[data-id="'+val+'"]');
        var name = $(inputs[0]).val();
        var icon = $(inputs[1]).val();
        var conts = $('[divid='+val+'] > div');
        $(conts[0]).html(name);
        $(conts[1]).html(icon);
        $.ajax({
            type: "POST",
            url: "AdminPropertyFeatures.update",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: val,
                title: name,
                icon: icon                
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
            url: "AdminPropertyFeatures.updateOrder",
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

function deleteType( id )
{
    var options = Array();
    options.text = "Are you sure you want to delete this feature?";
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
        url: "AdminPropertyFeatures.delete",
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
                options.text = "This feature cannot be deleted because it is currently in use";
                options.title = "Error";
                options.icon = "error";
                sweetAlert( options );
            }
        }
    })
}
</script>