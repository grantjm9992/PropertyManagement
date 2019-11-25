@inject('translator', 'App\Providers\TranslationProvider')
<form id="form" action="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-8 form-group">
                <label for="">{{ $translator->get("title") }}</label>
                <input type="text" name="" value="{{ $task->title }}" class="form-control" readonly>
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="">Status</label>
                <select name="" id="status" class="form-control" disabled>
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
                <select name="" id="id_type" class="form-control" disabled>
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
                <input type="text" name="" id="date_start" class="form-control" readonly>
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="">{{ $translator->get("end") }}</label>
                <input type="text" name="" id="date_end" class="form-control" readonly>
            </div>
            <div class="col-12 form-group">
                <label for="">{{ $translator->get("description") }}</label>
                <textarea name="" cols="30" rows="5" class="form-control" readonly>{{ $task->description }}</textarea>
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="">Created by</label>
                <input type="text" readonly value="{{ $task->creator }}" class="form-control">
            </div>
            <div class="col-12 col-md-6 form-group">
                <label for="">Assigned to</label>
                <input type="text" value="{{ $task->assigned_to }}" class="form-control" readonly>
            </div>
        </div>
    </div>
</form>
<div class="container-fluid">
    <div class="row mt-4">
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
</script>