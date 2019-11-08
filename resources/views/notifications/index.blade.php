<div class="row">
    <div class="col-12 col-md-6">
        <h3>Unread notifications</h3>
        <div id="unread" class="container-fluid">
            {!! $notifications !!}
        </div>
        <h3 class="my-4">Seen notifications</h3>
        <div id="read" class="container-fluid">
            {!! $seen !!}
        </div>
    </div>
    <div class="col-12 col-md-6">
        <h3>Notification settings</h3>
        <div class="row">
            <div class="form-group col-12">
                <label for="notify_email">Notify me be email</label>
                <div class="form-check">
                    <label class="form-check-label">
                        @if ( $user->notify_email === 1 )
                        <script>
                        $(document).ready( function() {
                            $('#notify_email').click();
                        })
                        </script>
                        @endif
                        <input class="form-check-input" type="checkbox" value="1" name="notify_email" id="notify_email">
                        <span class="form-check-sign">
                            <span class="check"></span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="form-group col-12">
                <label for="email">Email address</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
            <div class="form-group col-12">
                <div onclick="updateUser()" class="btn btn-success">
                    Submit
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function seenNotification( id )
    {
        $.ajax({
            type: "POST",
            url: "Notifications.seen",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: id
            },
            success: function(data)
            {
                if ( data == "OK" )
                {                
                    var divs = $("[notification='"+id+"']");
                    var div = divs[0];
                    setTimeout(() => {
                        $(div).remove();
                        $(div).removeClass("alert-success");
                        $(div).addClass("bg-light");
                        $('#read').prepend(div);
                    }, 500);
                }
            }
        })
    }

    function updateUser()
    {
        var notify = 0;
        if ( $('#notify_email').is(":checked") )
        {
            notify = 1;
        }
        $.ajax({
            type: "POST",
            url: "Users.updateForNotifications",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: "{{ $user->id }}",
                notify_email: notify,
                email: $('#email').val()
            },
            success: function(data)
            {
            }
        })        
    }
</script>