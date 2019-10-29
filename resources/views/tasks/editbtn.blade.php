@if ( $task->id_user != $user->id && $task->id_creator != $user->id )
<div id="watch" class="d-inline" style="cursor:pointer;" onclick="toggleWatch()">
    @if ( $watch === 1 )
    <i class="fas fa-eye-slash"></i> Stop watching task
    @else
    <i class="fas fa-eye"></i> Watch task
    @endif
</div>
@endif
<div onclick="deleteElement()" class="btn btn-danger">
    <i class="fas fa-minus-circle"></i> Delete
</div><div onclick="submitForm()" class="btn btn-primary">
    <i class="fas fa-save"></i> Save
</div><a href="{{ $url }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Back
</a>