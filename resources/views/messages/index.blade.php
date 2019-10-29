<div class="container-fluid" style="padding: 0;display: inline-flex; height: calc(100vh - 160px); box-shadow: 0 0 10px rgba(0,0,0,.4);">
    <div class="message-holder">
        <div class="w-100" onclick="newConversation()">
            <i class="fas fa-plus"></i> New conversation
        </div>
        {!! $conversations !!}
    </div>
    <div style="max-height: 100vh; width: calc(100% - 300px); height: calc(100vh - 160px);" id="conversation">
    
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
</script>