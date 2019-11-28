<div class="container-fluid" style="padding: 0;display: inline-flex; height: calc(100vh - 160px); box-shadow: 0 0 10px rgba(0,0,0,.4);">
    <div class="message-holder">
        <div class="w-100 p-4" style="cursor: pointer;" onclick="newConversation()">
            <i class="fas fa-plus"></i> New conversation
        </div>
        <div class="w-100" id="conversations">
            {!! $conversations !!}
        </div>
    </div>
    <div style="max-height: 100vh; width: calc(100% - 300px); height: calc(100vh - 160px);display: flex; flex-direction: column-reverse; overflow-y: scroll;" id="conversation">
    
    </div>
</div>

<script>
    function newConversation()
    {
        $.ajax({
            type: "POST",
            url: "Messages.newModal",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $('body').append(data);
            }
        })
    }

    function send(id_conversation)
    {
        $.ajax({
            type: "POST",
            url: "Messages.addFromConversation",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id_conversation: id_conversation,
                message: $("#msg").val()
            },
            success: function(data)
            {
                var resp = data ;
                var html = $("#message_holder").html() + resp;
                $('#message_holder').html(html);
                updateConversations();
            }
        })
    }

    function updateConversations()
    {
        $.ajax({
            type: "POST",
            url: "Messages.conversations",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $('#conversations').html(data);
            }
        })
    }

    $("body").delegate(".message", "click", function() {
        var rel = $(this).attr("rel");
        $(this).removeClass("unread");
        $(this).find(".unread-bubble").remove();
        $.ajax({
            type: "POST",
            url: "Messages.getConversation",
            data: {id: rel},
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(data)
            {
                $("#conversation").html(data);
            }
        })
    });

    function updateCurrentConvo()
    {
        $.ajax({
            type: "POST",
            url: "Messages.getConversation",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data:
            {
                id: $("#current_convo").val()
            },
            success: function(data)
            {
                $('#conversation').html(data);
            }
        })
    }

    $(document).ready( function() {
        setInterval(() => {
            updateConversations();
        }, (10000));

        setInterval(() => {
            if ( document.getElementById("current_convo") )
            {
                updateCurrentConvo();
            }
        }, 10000);
    });
</script>