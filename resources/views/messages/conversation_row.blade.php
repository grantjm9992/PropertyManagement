@if ( (int)$message->id_sender === (int)$user->id )
<div class="col-10 offset-2 msg-mine">
    <div class="msg-msg">
        {!! $message->message !!}
    </div>
    <div class="d-inline-flex justify-content-between w-100">
        <div class="msg-sender">You</div>
        <div class="msg-sender">{{ $message->date_sent }}</div>
    </div>
</div>
@else
<div class="col-10 msg">
    <div class="msg-msg">
        {!! $message->message !!}
    </div>
    <div class="d-inline-flex justify-content-between w-100">
        <div class="msg-sender">{{ $message->sender }}</div>
        <div class="msg-sender">{{ $message->date_sent }}</div>
    </div>
</div>
@endif