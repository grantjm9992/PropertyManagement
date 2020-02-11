$(document).ready( function() {
})


function addTask()
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