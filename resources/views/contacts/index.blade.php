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
            @if ( $user->role != "PO" )
            <div class="col-12 col-lg-4 form-group">
                <label for="">User type</label>
                <select name="role" id="role" class="form-control">
                    <option value="">All</option>
                    <option value="PO">Property owners</option>
                    @if ( $user->role == "AA" || $user->role == "SA" )
                    <option value="M">Property managers</option>
                    <option value="AA">Area admin</option>
                    @endif
                    @if ( $user->role == "SA" )
                    <option value="WA">Website admin</option>
                    <option value="SA">Super admnin</option>
                    @endif
                </select>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-12" id="contacts">
                {!! $listado !!}
            </div>
        </div>
    </div>
</form>
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

    function searchContacts()
    {
        $.ajax({
            type: "POST",
            url: "Contacts.getListado",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: $("#form").serialize(),
            success: function(data)
            {
                $('#contacts').html(data);
            }
        })
    }

    $(document).ready ( function() {
        $('#form input').on("keyup", function() {
            searchContacts();
        });
        $('#form select').on("change", function() {
            searchContacts();
        });
    })
</script>