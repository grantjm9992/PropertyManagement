<div class="container-fluid px-4">
    <div class="row" id="message_holder">
        {!! $html !!}
    </div>
    <div class="row pt-3">
        <div class="col-12 col-lg-10 p-1">
            <textarea name="msg" id="msg" cols="30" rows="3" class="form-control"></textarea>
        </div>
        <div class="col-12 col-lg-2 p-1">
            <div class="btn btn-primary" onclick="send({{$conversation->id}})">Send</div>
        </div>
        <input id="current_convo" hidden value="{{ $conversation->id}}" type="text" />
    </div>
</div>