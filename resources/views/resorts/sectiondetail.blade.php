@inject('translator', 'App\Providers\TranslationProvider')
<form action="Resorts.saveSection" id="form">
<div class="row">
    <input type="text" name="id" value="{{ $section->id }}" hidden>

    <div class="form-group col-12">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $section->title }}">
    </div>
    <div class="form-group col-12">
        <label for="">Subtitle</label>
        <input type="text" name="subtitle" value="{{ $section->subtitle }}" class="form-control">
    </div>
    <div class="form-group col-12">
        <label for="description">Description</label>
        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group col-12 col-lg-4">
        <label for="button">Button</label>
        <select name="button" id="button" class="form-control">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    <div class="form-group col-12 col-lg-4 button">
        <label for="button_text">Button text</label>
        <input type="text" class="form-control" name="button_text" value="{{ $section->button_text }}">
    </div>
    <div class="form-group col-12 col-lg-4 button">
        <label for="button_link">Button link</label>
        <input type="text" class="form-control" name="button_link" value="{{ $section->button_link }}">
    </div>
</div>
</form>
<div class="row" style="margin-bottom: 20px;">
    @if ( $image === 1 )
    <div class="col-12" style="text-align: center;" id="img">
    @else
    <div class="col-12" style="text-align: center; display: none;" id="img">
    @endif
        <img src="{{ $section->image }}" style="height: 300px;" alt="">
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
        <form action="Resorts.uploadSectionImage" class="dropzone" id="my-awesome-dropzone">
            <input type="text" name="id" hidden value="{{ $section->id }}">
            @csrf()
        </form>
    </div>
</div>

<script>
    $(document).ready( function()
    {
        $('#button').change( function() {
            if ( $(this).val() == "0" )
            {
                $('.button').hide();
            }
            else
            {
                $('.button').show();
            }
        });
        $('#button').val('{{ $section->button }}')
        $('#description').summernote({
            height: 250
        });
        var html = '{!! $section->description !!}';
        $('#description').summernote('code', html);
    });
    function deleteImage()
    {
        $.ajax({
            type: "POST",
            url: "Sections.removeImage",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $section->id }}"
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
</script>