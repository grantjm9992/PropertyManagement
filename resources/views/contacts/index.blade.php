{!! $listado !!}

<script>

    function getContact(id)
    {
        $.ajax({
            type: "POST",
            url: "Contacts.detail",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {id: id},
            success: function(data)
            {
                $('#contact').remove();
                $('body').append(data);
            }
        })
    }
    function sendMessage(id)
    {
        $.ajax({
            type: "POST",
            url: "Contacts.message",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {id: id},
            success: function(data)
            {
                $('#message').remove();
                $('body').append(data);
            }
        })
    }

    function submitMessage()
    {
        $.ajax({
            type: "POST",
            url: "Messages.add",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $("#sendMessage").serialize(),
            success: function(data)
            {
                if ( data == "OK" )
                {
                    $('#message').modal("hide");
                    md.showNotification("top", "center", "Message sent successfully");
                }
            }
        })
    }
</script>