<form action="AdminCompanies.saveSkin">
    <div class="container-fluid">
        <div class="row">
            <input type="text" name="id" value="{{ $skin->id }}" hidden>
            <div class="col-12 form-group">
                <label for="application_name">Application name</label>
                <input type="text" name="application_name" value="{{ $skin->application_name }}" class="form-control">
            </div>
            <div class="col-6 col-lg-4 form-group">
                <label for="c1">Background colour 1</label>
                <input scheme="1" id="c1" name="c1" value="{{ $skin->c1 }}" type="text" class="form-control">
            </div>
            <div class="col-6 col-lg-4 form-group">
                <label for="t1">Text colour 1</label>
                <input scheme="1" id="t1" name="t1" value="{{ $skin->t1 }}" type="text" class="form-control">
            </div>
            <div class="col-12 col-lg-4">
                <div id="result1" style="border-radius: 4px; padding: 10px;width: 96%; margin: 15px 2%; min-height: 38px; font-size: 16px; color: {{ $skin->t1 }}; background-color: {{ $skin->c1 }};">
                    Lorem Ipsum Oletete
                </div>
            </div>
            <div class="col-4 col-lg-4 form-group">
                <label for="c2">Background colour 2</label>
                <input id="c2" name="c2" value="{{ $skin->c2 }}" type="text" class="form-control">
            </div>
            <div class="col-4 col-lg-4 form-group">
                <label for="t2">Text colour 2</label>
                <input id="t2" name="t2" value="{{ $skin->t2 }}" type="text" class="form-control">
            </div>
            <div class="col-12 col-lg-4">
                <div id="result2" style="border-radius: 4px; padding: 10px;width: 96%; margin: 15px 2%; min-height: 38px; font-size: 16px; color: {{ $skin->t2 }}; background-color: {{ $skin->c2 }};">
                    Lorem Ipsum Oletete
                </div>
            </div>
            <div class="col-4 col-lg-4 form-group">
                <label for="c3">Background colour 3</label>
                <input id="c3" name="c3" value="{{ $skin->c3 }}" type="text" class="form-control">
            </div>
            <div class="col-4 col-lg-4 form-group">
                <label for="t3">Text colour 3</label>
                <input id="t3" name="t3" value="{{ $skin->t3 }}" type="text" class="form-control">
            </div>
            <div class="col-12 col-lg-4">
                <div id="result3" style="border-radius: 4px; padding: 10px;width: 96%; margin: 15px 2%; min-height: 38px; font-size: 16px; color: {{ $skin->t3 }}; background-color: {{ $skin->c3 }};">
                    Lorem Ipsum Oletete
                </div>
            </div>
            <div class="col-4 col-lg-4 form-group">
                <label for="c4">Background colour 4</label>
                <input id="c4" name="c4" value="{{ $skin->c4 }}" type="text" class="form-control">
            </div>
            <div class="col-4 col-lg-4 form-group">
                <label for="t4">Text colour 4</label>
                <input id="t4" name="t4" value="{{ $skin->t4 }}" type="text" class="form-control">
            </div>
            <div class="col-12 col-lg-4">
                <div id="result4" style="border-radius: 4px; padding: 10px;width: 96%; margin: 15px 2%; min-height: 38px; font-size: 16px; color: {{ $skin->t4 }}; background-color: {{ $skin->c4 }};">
                    Lorem Ipsum Oletete
                </div>
            </div>
        </div>
        <button type="submit" id="submit" hidden></button>
    </div>
</form>
<div class="container-fluid">
    <div class="row">
        @if ( file_exists( $skin->logo ) )
        <div  class="col-12 text-center" uploaded>
            <div>
                <img src="{{ $skin->logo }}?v={{ time() }}" style="max-width: 400px; max-height: 300px;" alt="">
            </div>
            <div class="btn btn-danger" onclick="removeLogo()" style="margin-top: 15px;">
                <i class="fas fa-minus-circle"></i> Remove logo
            </div>
        </div>
        <div class="col-12 form-group" style="display: none;" upload>
        @endif
        <div class="col-12 form-group" upload>
            <label for="logo">Logo</label>
            <form action="AdminCompanies.uploadLogo" class="dropzone" id="my-awesome-dropzone">
                <input type="text" name="id" hidden value="{{ $skin->id }}">
                @csrf()
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready ( function() {
    $('#c1').ejColorPicker({value: '{{ $skin->c1 }}', select: function(args) {
        $('#result1').css('background-color', args.value);
    }});
    $('#c2').ejColorPicker({value: '{{ $skin->c2 }}', select: function(args) {
        $('#result2').css('background-color', args.value);
    }});
    $('#c3').ejColorPicker({value: '{{ $skin->c3 }}', select: function(args) {
        $('#result3').css('background-color', args.value);
    }});
    $('#c4').ejColorPicker({value: '{{ $skin->c4 }}', select: function(args) {
        $('#result4').css('background-color', args.value);
    }});
    $('#t1').ejColorPicker({value: '{{ $skin->t1 }}', select: function(args) {
        $('#result1').css('color', args.value);
    }});
    $('#t2').ejColorPicker({value: '{{ $skin->t2 }}', select: function(args) {
        $('#result2').css('color', args.value);
    }});
    $('#t3').ejColorPicker({value: '{{ $skin->t3 }}', select: function(args) {
        $('#result3').css('color', args.value);
    }});
    $('#t4').ejColorPicker({value: '{{ $skin->t4 }}', select: function(args) {
        $('#result4').css('color', args.value);
    }});


    $('[scheme]').on("change", function() {
        var scheme = $(this).attr('scheme');
        var textId = "#t"+scheme;
        var colId = "#c"+scheme;
        console.log(colId);
        $('[result="'+scheme+'"]').css({
            color: $(textId).val(),
            backgroundColor: $(colId).val()
        });
    });

});

function removeLogo()
{
    $.ajax({
        type: "POST",
        url: "AdminCompanies.removeLogo",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {id: '{{ $skin->id }}'},
        success: function(data)
        {
            if ( data == "OK" )
            {
                $('[uploaded]').hide();
                $('[upload]').show();
            }
        }
    })
}

function deleteSkin()
{
    $.ajax({
        type: "POST",
        url: "AdminCompanies.removeSkin",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: {id: '{{ $skin->id }}'},
        success: function(data)
        {
            window.location = "Admin";
        }
    }) 
}
</script>