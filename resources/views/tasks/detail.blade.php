@inject('translator', 'App\Providers\TranslationProvider')
<form id="form" action="Tasks.update">
<input type="text" name="id" hidden value="{{ $task->id }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 form-group">
                <label for="">{{ $translator->get("title") }}</label>
                <input type="text" name="title" value="{{ $task->title }}" class="form-control">
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="1">Pending</option>
                    <option value="3">Completed</option>
                </select>
                <script>
                    $(document).ready( function() {
                        $('#status').val("{{ $task->status }}");
                    });
                </script>
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="">{{ $translator->get("type_task") }}</label>
                <select name="id_type" id="id_type" class="form-control">
                    @foreach ( $types as $type )
                        <option value="{{ $type->id }}">{{ $type->description }}</option>
                    @endforeach
                </select>
                <script>
                    $(document).ready( function() {
                        $('#id_type').val("{{ $task->id_type }}");
                    });
                </script>
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="">{{ $translator->get("start") }}</label>
                <input type="text" name="date_start" id="date_start" class="form-control">
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="">{{ $translator->get("end") }}</label>
                <input type="text" name="date_end" id="date_end" class="form-control">
            </div>
            <div class="col-12 form-group">
                <label for="">{{ $translator->get("description") }}</label>
                <textarea name="description" cols="30" rows="5" class="form-control">{{ $task->description }}</textarea>
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="">Created by</label>
                <input type="text" readonly value="{{ $task->creator }}" class="form-control">
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="">Assigned to</label>
                <input type="text" id="user" style="display:none;" class="form-control" autocomplete="off">
                <input type="text" name="id_user" id="id_user" hidden value="{{ $task->id_user }}" />
                <div id="mentionAlert" class="alert alert-primary mention-alert" style=""><div>{{ $task->assigned_to }}</div>&nbsp;&nbsp;<i onclick="refreshMention()" class="fas fa-times-circle"></i></div>
            </div>
        </div>
    </div>
</form>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <h4><i class="fas fa-upload"></i>  Upload files</h4>
            <form action="Tasks.uploadFile" class="dropzone" id="my-awesome-dropzone2">
                <input type="text" name="id" hidden value="{{ $task->id }}">
                @csrf()
            </form>
        </div>
        <div class="col-12">
            <h4 class="mb-3">Uploaded files</h4>
            <div class="row mr-0 ml-0">
                @foreach ( $files as $file )
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 file" file="{{ $file->id }}">
                        <span>
                            <a target="_blank" href="data/tasks/{{$task->id}}/{{$file->route}}">{{ $file->route }}</a>
                        </span>
                        <span>
                            <i class="fas fa-times-circle" onclick="deleteFile({{$file->id}})"></i>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-12 mb-4">
            <h4>
                <i class="fas fa-tasks"></i> To do list
                <div class="buttons">
                    <div onclick="newSubtask()" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New item
                    </div>
                </div>
            </h4>
        </div>
        <div class="col-12">
            <div class="percentage-holder">
                <span percentage-for="items">0</span>%
            </div>
            <div class="mb-4 progress">
                <div subtasks="items" class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-12">
            <div id="items" class="row no-gutters">
                {!! $subtasks !!}
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready( function() {
        $("#date_start").datetimepicker({
            value: "{{ $task->date_start }}"
        });
        $("#date_end").datetimepicker({
            value: "{{ $task->date_end }}"
        });
    })

    $(document).ready( function() {
        $('#user').mention({
            url: "Users.getMention",
            selectFunction: selectContact
        });
    });
	function refreshMention()
	{
		$('#id_user').val('');
		$('#user').val('');
		$('#user').show();
		$('.mention-alert').remove();
		$('#mentionAlert').remove();
		$('#user').focus();
	}

	function selectContact( info )
	{
		$('#id_user').val( info.id );
	}

    function submitForm()
    {
        $("#form").submit();
    }

    function deleteFile(id)
    {
        var options = Array();
        options.title = "Warning";
        options.text = "Are you sure you want to delete this file?";
        options.icon = "warning";
        options.type = "confirm";
        options.thenFunction = confirmedDelete;
        options.thenParameters = id;
        sweetAlert( options );
    }

    function confirmedDelete( id )
    {
        $.ajax({
            type: "POST",
            url: "Tasks.deleteFile",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: 
            {
                id: id
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                    $('[file="'+id+'"]').remove();
                }
            }
        })
    }

    function toggleWatch( )
    {
        $.ajax({
            type: "POST",
            url: "Tasks.toggleWatching",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: 
            {
                id: "{{$task->id}}"
            },
            success: function(data)
            {
                if ( data == 1 )
                {
                    $('#watch').html('<i class="fas fa-eye-slash"></i> Stop watching task')
                }
                else
                {
                    $('#watch').html('<i class="fas fa-eye"></i> Watch task')
                }
            }
        })
    }
    $(document).ready( function() {
        $('#items').sortable({
            update: function() {
                updateOrder();
            }
        });
        animateTaskStatusBar("items");
    })

    function updateOrder()
    {        
        var elements = $('.cc-sortable');
        var ids = "";
        for ( var i = 0; i < elements.length; i++ ) {
            ids += $(elements[i]).attr('data-id')+"@#";
        }
        $.ajax({
            type: "POST",
            url: "Tasks.updateSubtaskOrder",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                ids: ids,
                id: "{{ $task->id }}"
            },
            success: function(data)
            {
                if ( data == "OK" )
                {
                }
            }
        })
    }

    function updateStatus(id_subtask)
    {
        $.ajax({
            type: "POST",
            url: "Tasks.changeSubtaskStatus",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: id_subtask
            },
            success: function(data)
            {
                var response = $.parseJSON(data);
                if ( response.success === 1 )
                {
                    $('[data-id="'+id_subtask+'"]').attr("completed", response.completed);
                    animateTaskStatusBar("items");
                }
            }
        })
    }

    function animateTaskStatusBar(id)
    {
        var hash = "#"+id;
        var number = parseInt($('[percentage-for="'+id+'"]').text());
        var subtasks = $(hash).find(".cc-sortable");
        var ii = 0;
        var jj = 0;
        $.each(subtasks, function(i) {
            if ( $(this).attr("completed") == "1" ) jj++;
            ii++;
        });

        percent = Math.round(100*(jj/ii));
        var int = 2500/percent;
        if ( number < percent )
        {
            setInterval(() => {
                if ( number <= percent )
                {
                    $('[percentage-for="'+id+'"]').html(number);
                    number++;
                }
            }, int);
        }
        else
        {
            setInterval(() => {
                if ( number >= percent )
                {
                    $('[percentage-for="'+id+'"]').html(number);
                    number--;
                }
            }, int);
            
        }
        percentText = percent+"%";

        $('[subtasks="'+id+'"]').css({
            width: percentText
        });
    }
    
    function deleteSubtask(id_subtask)
    {
        var options = Array();
        options.type = "confirm";
        options.title = "Warning";
        options.text = "Are you sure you want to delete this subtask?";
        options.thenFunction = confirmedDeleteSubtask;
        options.thenParameters = id_subtask;
        sweetAlert( options );

    }

    function confirmedDeleteSubtask(id_subtask)
    {
        
        $.ajax({
            type: "POST",
            url: "Tasks.deleteSubtask",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id: id_subtask
            },
            success: function(data)
            {
                var response = $.parseJSON(data);
                if ( response.success === 1 )
                {
                    $('[data-id="'+id_subtask+'"]').remove();
                    animateTaskStatusBar("items");
                }
            }
        })
    }

    $(document).ready( function() {

        $('body').delegate('[divid]', 'click', function() {
            $(this).hide();
            var val = $(this).attr('divid');
            $('[inputid='+val+']').show();
            $('[data-id='+val+']').focus();
        });
        $('body').delegate('[hideinputid]', 'click', function() {
            showDiv(this);
        });

        $('body').delegate('input[data-id]', 'keydown', function(e) {
            if ( event.which == 13 ) {
                var id = $(this).attr('data-id');
                var input = $('[hideinputid="'+id+'"]');
                showDiv(input[0]);
            }
        });
        function showDiv($this)
        {
            var val = $($this).attr('hideinputid');
            $('[inputid='+val+']').hide();
            $('[divid='+val+']').show();
            var inputs = $('input[data-id="'+val+'"]');
            var name = $(inputs[0]).val();
            $('[divid='+val+']').html(name);
            $.ajax({
                type: "POST",
                url: "Tasks.updateSubtask",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: {
                    id: val,
                    name: name
                },
                success: function(data)
                {
                    if ( data == "OK" )
                    {                    
                        $.notify( "Name updated successfully", {
                            position: "bottom-left",
                            className: "success"
                        } );
                    }
                }
            })
        }
        $('#archive').on("click", function() {
            $.ajax({
                type: "POST",
                url: "Tasks.archive",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: 
                {
                    id: "{{$task->id}}",
                    archive: 1
                },
                success: function(data)
                {
                    var message = $.parseJSON(data);
                    $.notify( message.message, {
                        position: "bottom-left",
                        className: "success"
                    } );
                    $('#archive').hide();
                    $('#unarchive').show();
                }
            })
        });
        $('#unarchive').on("click", function() {
            $.ajax({
                type: "POST",
                url: "Tasks.archive",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                data: 
                {
                    id: "{{$task->id}}",
                    archive: 0
                },
                success: function(data)
                {
                    var message = $.parseJSON(data);
                    $.notify( message.message, {
                        position: "bottom-left",
                        className: "success"
                    } );
                    $('#archive').show();
                    $('#unarchive').hide();
                }
            })
        });
    })

    function newSubtask()
    {
        $.ajax({
            type: "POST",
            url: "Tasks.newSubtask",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {
                id_task: "{{ $task->id }}"
            },
            success: function(data)
            {
                $('#items').append(data);
            }
        })
    }
</script>