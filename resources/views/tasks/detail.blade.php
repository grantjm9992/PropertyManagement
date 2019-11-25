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
</script>