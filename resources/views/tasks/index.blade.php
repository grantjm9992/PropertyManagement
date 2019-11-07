<div class="container-fluid">
    <div class="row" id="filter">
        @if ( $user->role == "SA" )
        <div class="col-12 col-lg-4 form-group">
            <label for="">Company</label>
            <select name="id_company" id="id_company" class="form-control">
                <option value="">All</option>
                @foreach ( $companies as $row )
                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="col-12 col-lg-4 form-group">
            <label for="">Type of task</label>
            <select name="id_type" id="id_type" class="form-control">
                <option value="">All</option>
                @foreach ( $types as $type )
                    <option value="{{ $type->id }}">{{ $type->description }}</option>
                @endforeach
            </select>
        </div>
        @if ( isset( $_REQUEST["id_type"] ) && $_REQUEST["id_type"] != "" )
            <script>
                $(document).ready( function(){
                    $("#id_type").val("{{ $_REQUEST['id_type'] }}");
                })
            </script>
        @endif
        @if ( $user->role != "SA" )
        <div class="col-12 col-lg-4 form-group">
            <label for="">Assigned to</label>
            <input type="text" name="id_user" id="id_user" hidden />
            <input type="text" id="user" class="form-control" autocomplete="off">
        </div>
        @endif
        <div class="col-12 col-lg-4 form-group">
            <label for="">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">All</option>
                <option value="1">Pending</option>
                <option value="3">Complete</option>
            </select>
        </div>
        <div class="col-12 col-lg-4 form-group">
            <label for="">From</label>
            <input type="text" name="from" id="from" class="form-control">
        </div>
        <div class="col-12 col-lg-4 form-group">
            <label for="">To</label>
            <input type="text" name="to" id="to" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-12" id="tasks">
            {!! $tasks !!}
        </div>
    </div>
</div>

<script>
    $(document).ready( function() {
        $('#user').mention({
            url: "Users.getMention?mycompany=1",
            selectFunction: selectContact
        });


        $('#from').datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('#from').datepicker("setDate", new Date());
        $('#to').datepicker({
            dateFormat: "yy-mm-dd"
        });

        $('#filter input').on("change", function() {
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "Tasks.getTasks",
                data: {
                    id_user: $('#id_user').val(),
                    id_company: $('#id_company').val(),
                    id_type: $("#id_type").val(),
                    to: $('#to').val(),
                    from: $('#from').val(),
                    status: $('#status').val()
                },
                success: function (data)
                {
                    $('#tasks').html(data);
                }
            })  
        });
        $('#filter select').on("change", function() {
            $.ajax({
                type: "POST",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "Tasks.getTasks",
                data: {
                    id_user: $('#id_user').val(),
                    id_company: $('#id_company').val(),
                    id_type: $("#id_type").val(),
                    to: $('#to').val(),
                    from: $('#from').val(),
                    status: $('#status').val()
                },
                success: function (data)
                {
                    $('#tasks').html(data);
                }
            })  
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
        $.ajax({
            type: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "Tasks.getTasks",
            data: {
                id_user: $('#id_user').val(),
                id_company: $('#id_company').val(),
                id_type: $("#id_type").val()
            },
            success: function (data)
            {
                $('#tasks').html(data);
            }
        })
	}
	function selectContact( info )
	{
        $('#id_user').val( info.id );
        $.ajax({
            type: "POST",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url: "Tasks.getTasks",
            data: {
                id_user: $('#id_user').val(),
                id_company: $('#id_company').val()
            },
            success: function (data)
            {
                $('#tasks').html(data);
            }
        })
	}
</script>