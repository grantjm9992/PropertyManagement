<form id="form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-4 form-group">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="col-12 col-lg-4 form-group">
                <label for="">Phone number</label>
                <input type="text" name="phone" class="form-control">
            </div>            
        </div>
    </div>
</form>
<div id="list" class="container-fluid mt-3">
    {!! $listado !!}
</div>
<script>
    $("#form input").on("change", () => {
        $.ajax({
            type: "POST",
            url: "Users.listado",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $("#form").serialize(),
            success: function(data)
            {
                $('#list').html(data);
            }
        })
    });
</script>