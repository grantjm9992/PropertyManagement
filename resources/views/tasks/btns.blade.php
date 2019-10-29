<div class="btn btn-success" onclick="createTask()">
    <i class="fas fa-calendar-plus"></i> New task
</div>

<script>
    function createTask()
    {
        $.ajax({
            type: "POST",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "Tasks.addModal",
            success: function( data ) 
            {
                $('#modal').remove();
                $('body').append(data);
                $('#modal').show();
            }
        })
    }
</script>