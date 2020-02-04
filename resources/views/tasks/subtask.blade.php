<div data-id="{{ $subtask->id }}" class="cc-sortable" completed="{{ $subtask->completed }}">
    <span style="width: 20px; line-height: 38px; font-size: 20px;">
        <i class="fas fa-arrows-alt"></i>
    </span>
    <div class="sortable-title">
        <div divid="{{ $subtask->id }}" style="margin-left: 20px;
    height: 38px;
    line-height: 38px;
    padding: 0px 15px;
    border-radius: 4px;
    border: 1px solid rgba(0,123,255,.25);">
            {{ $subtask->title }}
        </div>
        <div inputid="{{ $subtask->id }}" class="input-group" style="display: none;">
            <div class="input-group-prepend">
                <span hideinputid="{{ $subtask->id }}" class="input-group-text" id="basic-addon1"><i style="color: green;" class="fas fa-check"></i></span>
            </div>
            <input type="text" class="form-control " data-id="{{ $subtask->id }}" value="{{ $subtask->title }}">
        </div>
    </div>
    <div style="line-height: 38px; width: 70px; display: inline-flex; justify-content: space-around;">
        <input type="text" value="1" hidden="" >
        <label class="switch" style="display: block;">
            <input type="checkbox" id="subtask_active_checkbox_{{ $subtask->id }}">
            <span id="" class="slider round"  onclick="updateStatus({{$subtask->id}})"></span>
        </label>
    </div>
    @if ( (int)$subtask->completed === 1 )
        <script>
            $("#subtask_active_checkbox_{{ $subtask->id }}").prop("checked", true);            
        </script>
    @endif
</div>