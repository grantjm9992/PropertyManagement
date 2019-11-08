<div class="container-fluid">
    <form action="TaskCategories.save" id="form">
    <div class="row">
    <input type="text" hidden name="id" value="{{ $category->id }}">
        <div class="col-12 form-group">
            <label for="">Description</label>
            <input type="text" name="description" value="{{ $category->description }}" class="form-control">
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
    })

    function submitForm()
    {
        $('#form').submit();
    }
</script>