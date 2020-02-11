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
            <div class="select2-purple">
                <select class="select2" multiple="multiple" data-placeholder="Select a State" name="assignedTo[]" id="assignedTo" data-dropdown-css-class="select2-purple" style="width: 100%;">
                    @foreach( $users as $user )
                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                    @endforeach
                </select>
            </div>
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
        <div class="col-12 col-lg-4 form-group">
            <label for="">Include archived tasks</label>
            <select name="archived" id="archived" class="form-control">
                <option value="">No</option>
                <option value="1">Yes</option>
            </select>
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
        $('.select2').select2()
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
                    id_user: $('#assignedTo').val(),
                    id_company: $('#id_company').val(),
                    id_type: $("#id_type").val(),
                    to: $('#to').val(),
                    from: $('#from').val(),
                    status: $('#status').val(),
                    archived: $("#archived").val()
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
                    id_user: $('#assignedTo').val(),
                    id_company: $('#id_company').val(),
                    id_type: $("#id_type").val(),
                    to: $('#to').val(),
                    from: $('#from').val(),
                    status: $('#status').val(),
                    archived: $("#archived").val()
                },
                success: function (data)
                {
                    $('#tasks').html(data);
                }
            })  
        });
    });
</script>