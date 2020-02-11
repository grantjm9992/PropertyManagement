
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Notifications</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            {!! $notifications !!}
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
                    $("[notification='"+id+"']").hide(500);
                    setTimeout(() => {
                        $("[notification='"+id+"']").remove();
                    }, 500);
                }
            }
        })
    }
</script>