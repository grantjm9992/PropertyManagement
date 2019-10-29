
<div class="col-lg-6 col-md-12">
    <div class="card">
        <div class="card-header card-header-tabs card-header-warning">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title">Notifications:</span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content">
                {!! $notifications !!}
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
                    $("[notification='"+id+"']").hide(500);
                    setTimeout(() => {
                        $("[notification='"+id+"']").remove();
                    }, 500);
                }
            }
        })
    }
</script>