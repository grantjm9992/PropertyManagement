<div data-id="{{ $resort->id }}" class="cc-sortable">
    <span style="width: 20px; line-height: 38px; font-size: 20px;">
        <i class="fas fa-arrows-alt"></i>
    </span>
    <div class="sortable-title">
        <div divid="{{ $resort->id }}" style="margin-left: 20px;
    height: 38px;
    line-height: 38px;
    padding: 0px 15px;
    border-radius: 4px;
    border: 1px solid rgba(0,123,255,.25);">
            {{ $resort->name }}
        </div>
        <div inputid="{{ $resort->id }}" class="input-group" style="display: none;">
            <div class="input-group-prepend">
                <span hideinputid="{{ $resort->id }}" class="input-group-text" id="basic-addon1"><i style="color: green;" class="fas fa-check"></i></span>
            </div>
            <input type="text" class="form-control " data-id="{{ $resort->id }}" value="{{ $resort->name }}">
        </div>
    </div>
    <div style="line-height: 38px; width: 50px; display: inline-flex; justify-content: space-around;">
        <a href="Pages.item?id={{ $resort->id }}"><i class="fas fa-pencil-alt"></i></a>
    </div>
</div>