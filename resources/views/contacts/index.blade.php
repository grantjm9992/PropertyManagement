{!! $listado !!}

<script>
    function addContact()
    {
        $('#register').remove();
        $.ajax({
            type: "POST",
            url: "Contacts.addModal",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $('body').append(data);
            }
        })
    }

    function submitContact()
    {
        var id = $('#id').val();
        $.ajax({
            type: "POST",
            url: "Contacts.addContact",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $('#addContact').serialize(),
            success: function(data)
            {
                var s = jQuery.parseJSON(data);
                $('#register').modal('hide');
                if ( s.status === 1 )
                {
                    $.notify("Contact updated successfully", {
                        clickToHide: true,
                        autoHide: true,
                        position: "bottom-left",
                        className: "success"
                    });
                    $('[contact="'+id+'"]').remove();
                }
                else
                {
                    $.notify("Contact created successfully", {
                        clickToHide: true,
                        autoHide: true,
                        position: "bottom-left",
                        className: "success"
                    });
                }
                $('#contacts').append(s.response);
            }
        })
    }

    function sendMesage(id)
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

    function editContact(id)
    {
        $.ajax({
            type: "POST",
            url: "Contacts.editModal",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {id: id},
            success: function(data)
            {
                $('#register').remove();
                $('body').append(data);
            }
        })
    }
</script>