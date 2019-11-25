@inject('translator', 'App\Providers\TranslationProvider')
<form action="Resorts.save" id="form">
    <div class="container-fluid">
        <div class="row">
            <input type="text" name="id" value="{{ $resort->id }}" hidden>
            <div class="col-12 form-group">
                <label for="">Name</label>
                <input type="text" name="title" value="{{ $resort->name }}" class="form-control">
            </div>
            <div class="col-12 form-group">
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $resort->description }}</textarea>
            </div>
        </div>
    </div>
</form>


<div class="row" style="margin-bottom: 20px;">
    @if ( $image === 1 )
    <div class="col-12" style="text-align: center;" id="img">
    @else
    <div class="col-12" style="text-align: center; display: none;" id="img">
    @endif
        <img src="{{ $resort->image }}" style="height: 300px;" alt="">
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
        <form action="Resorts.uploadImage" class="dropzone" id="my-awesome-dropzone">
            <input type="text" name="id" hidden value="{{ $resort->id }}">
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

    $(document).ready ( function() {
        if ( $('#active').val() == "1" ) $('#active_checkbox').click();
        $('#active_checkbox').change( function() {
            if ( $(this).is(':checked') )
            {
                $('#active').val(1);
            }
            else
            {
                $('#active').val(0);
            }
        });
        if ( $('#include_slider').val() == "1" ) $('#slider_checkbox').click();
        $('#slider_checkbox').change( function() {
            if ( $(this).is(':checked') )
            {
                $('#include_slider').val(1);
            }
            else
            {
                $('#include_slider').val(0);
            }
        });
        $('#description').summernote({
            height: 500
        });

        $.ajax({
            type: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "Resorts.getResort",
            data:{
                id: "{{$resort->id}}"
            },
            success: function(data)
            {
                var resp = $.parseJSON(data);
                $('#description').summernote('code', resp.description);
            }
        })
    })

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
            url: "Resorts.deleteSection",
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
            url: "Resorts.removeImage",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $resort->id }}"
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
            url: "Resorts.updateSection",
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
            url: "Resorts.newSection",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id_resort: "{{ $resort->id }}"
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
            url: "Resorts.updateSectionOrder",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                ids: ids,
                id: "{{ $resort->id }}"
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