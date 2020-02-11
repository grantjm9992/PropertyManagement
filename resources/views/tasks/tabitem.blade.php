@if ( $i === 0 )
<div class="tab-pane active" id="task_{{ $type->id }}">
@else
<div class="tab-pane" id="task_{{ $type->id }}">
@endif
    <table class="table">
        <tbody>
            @foreach ( $tasks as $task )
            <tr task-id="{{ $task->id }}">
                <td>
                    <div class="form-check">
                    <label class="form-check-label">
                        @if ( $task->status === 3 )
                        <input class="form-check-input" type="checkbox" value="" checked onclick="toggleStatus({{$task->id}})">
                        @else
                        <input class="form-check-input" type="checkbox" value="" onclick="toggleStatus({{$task->id}})">
                        @endif
                        <span class="form-check-sign">
                        <span class="check"></span>
                        </span>
                    </label>
                    </div>
                </td>
                <td>{{ $task->title }}</td>
                <td class="td-actions text-right">
                    <a href="Tasks.edit?id={{ $task->id }}" title="Edit Task" class="" onclick="editTask({{ $task->id }})">
                        <i class="fas fa-pencil-alt text-primary"></i>
                    </a>
                    <div  rel="tooltip" title="Remove" class="d-inline-block" onclick="deleteTask({{$task->id}})">
                        <i class="fas fa-trash text-danger"></i>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>