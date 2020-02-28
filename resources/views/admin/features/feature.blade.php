<div data-id="{{ $feature->id }}" class="cc-sortable">
    <span style="width: 20px; line-height: 38px; font-size: 20px;">
        <i class="fas fa-arrows-alt"></i>
    </span>
    <div class="sortable-title">
        <div divid="{{ $feature->id }}" style="margin-left: 20px;
    height: 38px;
    line-height: 38px;
    display: flex;">
            <div style="width: 45%; margin-right: 5%; display: inline-block;
    border-radius: 4px;
    padding: 0px 15px;
    border: 1px solid rgba(0,123,255,.25);">
                {{ $feature->title }}
            </div>
            <div style="width: 45%; display: inline-block;
    border-radius: 4px;
    padding: 0px 15px;
    border: 1px solid rgba(0,123,255,.25);">
                {{ $feature->icon }}
            </div>
        </div>
        <div inputid="{{ $feature->id }}" class="input-group" style="display: none;">
            <div style="width: 50%; display: inline-block;">
                <div class="input-group-prepend">
                    <span hideinputid="{{ $feature->id }}" class="input-group-text" id="basic-addon1"><i style="color: green;" class="fas fa-check"></i></span>
                </div>
                <input type="text" class="form-control " data-id="{{ $feature->id }}" value="{{ $feature->title }}">
            </div>
            <div style="width: 50%; display: inline-block;">
                <div class="input-group-prepend">
                    <span hideinputid="{{ $feature->id }}" class="input-group-text" id="basic-addon1"><i style="color: green;" class="fas fa-check"></i></span>
                </div>
                <input type="text" class="form-control " data-id="{{ $feature->id }}" value="{{ $feature->icon }}">
            </div>
        </div>
    </div>
    <div style="line-height: 38px; width: 50px; display: inline-flex; justify-content: space-around;">
        <div onclick="deleteType({{ $feature->id }})"><i class="fas fa-times-circle"></i></div>
    </div>
</div>