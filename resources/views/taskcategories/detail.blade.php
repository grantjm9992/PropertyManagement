<div class="container-fluid">
    <form action="TaskCategories.save" id="form">
    <div class="row">
    <input type="text" hidden name="id" value="{{ $category->id }}">
        <div class="col-12 form-group">
            <label for="">Description</label>
            <input type="text" name="description" value="{{ $category->description }}" class="form-control">
        </div>
            <div class="col-4 col-lg-4 form-group">
                <label for="c1">Background colour</label>
                <input id="c1" name="colour" value="{{ $category->colour }}" type="text" class="form-control">
            </div>
            <div class="col-4 col-lg-4 form-group">
                <label for="t1">Text colour</label>
                <input id="t1" name="text_colour" value="{{ $category->text_colour }}" type="text" class="form-control">
            </div>
            <div class="col-12 col-lg-4">
                <div id="result1" style="border-radius: 4px; padding: 10px;width: 96%; margin: 15px 2%; min-height: 38px; font-size: 16px; color: {{ $category->text_colour }}; background-color: {{ $category->colour }};">
                    Lorem Ipsum Oletete
                </div>
            </div>
        <div class="col-12 col-md-3 form-group">
            <label style="font-weight: normal; font-size: 18px;" for="">Show in menu</label>
            <input type="text" id="menu" value="{{ $category->menu }}" name="menu" hidden="">
            <label class="switch" style="display: block;">
                <input type="checkbox" id="active_checkbox">
                <span class="slider round"></span>
            </label>                
        </div>
    </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        if ( $('#menu').val() == "1" )
        {
            $('#active_checkbox').click();
        }
        $('#active_checkbox').on("click", function() {
            if ( $('#menu').val() == "1" )
            {
                $('#menu').val("0");
            }
            else
            {
                $("#menu").val("1");
            }
        })
        $('#c1').ejColorPicker({value: '{{ $category->colour }}', select: function(args) {
            $('#result1').css('background-color', args.value);
        }});
        $('#t1').ejColorPicker({value: '{{ $category->text_colour }}', select: function(args) {
            $('#result1').css('color', args.value);
        }});
    })

    function submitForm()
    {
        $('#form').submit();
    }

    function deleteCategory()
    {
        var options = Array();
        options.type = "confirm";
        options.text = "Are you sure you want to delete this task type?";
        options.title = "Warning";
        options.icon = "warning";
        options.thenFunction = confirmedDelete;
        sweetAlert(options);
    }

    function confirmedDelete()
    {
        $.ajax({
            type: "POST",
            url: "TaskCategories.delete",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $category->id }}"
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    window.location = "TaskCategories";
                }
            }
        })
    }
</script>