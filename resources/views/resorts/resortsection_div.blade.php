<div data-id="{{ $section->id }}" class="cc-sortable">
    <span style="width: 20px; line-height: 38px; font-size: 20px;">
        <i class="fas fa-arrows-alt"></i>
    </span>
    <div class="sortable-title">
        <div divid="{{ $section->id }}" style="margin-left: 20px;
    height: 38px;
    line-height: 38px;
    padding: 0px 15px;
    border-radius: 4px;
    border: 1px solid rgba(0,123,255,.25);">
            {{ $section->title }}
        </div>
        <div inputid="{{ $section->id }}" class="input-group" style="display: none;">
            <div class="input-group-prepend">
                <span hideinputid="{{ $section->id }}" class="input-group-text" id="basic-addon1"><i style="color: green;" class="fas fa-check"></i></span>
            </div>
            <input type="text" class="form-control " data-id="{{ $section->id }}" value="{{ $section->title }}">
        </div>
    </div>
    <div style="line-height: 38px; width: 50px; display: inline-flex; justify-content: space-around;">
        <a href="Resorts.sectionDetail?id={{ $section->id }}"><i class="fas fa-pencil-alt"></i></a>
    </div>
</div>