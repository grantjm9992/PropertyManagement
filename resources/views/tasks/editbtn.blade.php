@if ( $task->id_user != $user->id && $task->id_creator != $user->id )
<div id="watch" class="d-inline" style="cursor:pointer;" onclick="toggleWatch()">
    @if ( $watch === 1 )
    <i class="fas fa-eye-slash"></i> Stop watching task
    @else
    <i class="fas fa-eye"></i> Watch task
    @endif
</div>
@endif
@if ( (int)$task->archived === 1 )
<div class="btn btn-warning" id="archive" style="display: none;">
    <i class="fas fa-archive"></i> Archive
</div>
<div class="btn btn-warning" id="unarchive">
    <i class="fas fa-archive"></i> Restore
</div>
@else
<div class="btn btn-warning" id="archive">
    <i class="fas fa-archive"></i> Archive
</div>
<div class="btn btn-warning" id="unarchive" style="display: none;">
    <i class="fas fa-archive"></i> Restore
</div>
@endif


<div onclick="deleteElement()" class="btn btn-danger">
    <i class="fas fa-minus-circle"></i> Delete
</div><div onclick="submitForm()" class="btn btn-primary">
    <i class="fas fa-save"></i> Save
</div>