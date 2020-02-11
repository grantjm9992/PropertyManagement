
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <span class="nav-tabs-title">Tasks:</span>
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        {!! $tabs !!}
                    </ul>
                </div>
            </div>
        </h3>
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
            {!! $tabInfo !!}
        </div>
    </div>
</div>

<script>
    function toggleStatus( id )
    {
        $.ajax({
            type: "POST",
            url: "Tasks.toggleStatus",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: id
            },
            success: function(data)
            {
                if ( data == "OK" )
                {                
                    $("[task-id='"+id+"']").hide(500);
                    setTimeout(() => {
                        $("[task-id='"+id+"']").remove();
                    }, 500);
                }
            }
        })
    }

    function deleteTask( id )
    {
        var options = Array();
        options.title = "Warning";
        options.text = "Are you sure you want to delete this task and all of the material associated with it?"
        options.type = "confirm";
        options.thenFunction = sureDelete;
        options.thenParameters = id;
        sweetAlert( options );
    }

    function sureDelete( id )
    {
        $.ajax({
            type: "POST",
            url: "Tasks.deleteTask",
		    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: id
            },
            success: function(data)
            {
                if ( data == "OK" )
                {                
                    $("[task-id='"+id+"']").hide(500);
                    setTimeout(() => {
                        $("[task-id='"+id+"']").remove();
                    }, 500);
                }
            }
        })
    }
</script>