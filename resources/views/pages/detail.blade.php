@inject('translator', 'App\Providers\TranslationProvider')
<form action="Pages.save" id="form">
<div class="row">
    <input type="text" name="id" value="{{ $page    ->id }}" hidden>
    <div class="form-group col-12">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $page->name }}">
    </div>
    <div class="form-group col-12">
        <label for="description">Description</label>
        <input type="text" class="form-control" name="description" value="{{ $page->description }}">
    </div>
    <div class="form-group col-12">
        <label for="meta_title">Page title (SEO)</label>
        <input type="text" class="form-control" name="meta_title" value="{{ $page->meta_title }}">
    </div>
    <div class="form-group col-12">
        <label for="meta_keywords">Page keywords</label>
        <input type="text" class="form-control" name="meta_keywords" value="{{ $page->meta_keywords }}">
    </div>
    <div class="form-group col-12">
        <label for="meta_description">Page description (SEO)</label>
        <input type="text" class="form-control" name="meta_description" value="{{ $page->meta_description }}">
    </div>
</div>
</form>
<div class="row" style="margin-bottom: 20px;">
    @if ( $image === 1 )
    <div class="col-12" style="text-align: center;" id="img">
    @else
    <div class="col-12" style="text-align: center; display: none;" id="img">
    @endif
        <img src="{{ $page->image }}" style="height: 300px;" alt="">
        <br>
        <span class="btn btn-outline-danger" style="margin-top: 10px;" onclick="deleteImage()"">
            <i class="fas fa-minus-circle"></i> Delete image
        </span>
    </div>
    @if ( $image === 1 )
    <div class="col-12" id="upload" style="display: none;">
    @else
    <div class="col-12" id="upload">
    @endif
        <form action="Pages.uploadImage" class="dropzone" id="my-awesome-dropzone">
            <input type="text" name="id" hidden value="{{ $page->id }}">
            @csrf()
        </form>
    </div>
</div>
<div class="row">
    <h4 style="width: 100%;">
        <i class="fas fa-tiles"></i> Sections
        <div class="buttons">
            <div class="btn btn-outline-primary" onclick="addSection()">
                <i class="fas fa-plus"></i> Add section
            </div>
        </div>
    </h4>
    <div id="items" style="margin: 20px auto;" class="col-10">
        {!! $sections !!}
    </div>
</div>

<script>
    function deleteSection(id)
    {
        var options = Array();
        options.title = "Warning";
        options.text = "Are you sure you want to delete this section? This action is irreversible.";
        options.icon = "warning";
        options.type = "confirm";
        options.thenFunction = confirmedToDelete;
        options.thenParameters = id;
        sweetAlert( options );
    }

    function confirmedToDelete(id)
    {
        $.ajax({
            type: "POST",
            url: "Sections.delete",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: id
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    $('[data-id="'+id+'"]').hide(500);
                    $('[data-id="'+id+'"]').remove();
                    $.notify( "Section deleted", {
                        position: "bottom-left",
                        className: "success"
                    });
                }
            }
        })
    }
    function deleteImage()
    {
        $.ajax({
            type: "POST",
            url: "Pages.removeImage",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $page->id }}"
            },
            success: function(data)
            {
                $('#img').hide();
                $('#upload').show();
            }
        })
    }
    function submitForm()
    {
        $('#form').submit();
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
            url: "Sections.update",
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
    
    function addSection()
    {
        $.ajax({
            type: "POST",
            url: "Sections.new",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id_page: "{{ $page->id }}"
            },
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
            url: "Sections.updateOrder",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                ids: ids,
                id: "{{ $page->id }}"
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
</script>