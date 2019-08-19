@if ( (int)$message->is_read === 0 )
<div class="message unread">
    <div class="unread-bubble"></div>
@else
<div class="message">
@endif
    <div class="message-image">
        <img src="{{ $message->image }}" alt="" class="avatar">
    </div>
    <div class="message-info">
        <div class="title">
        {{ $message->sender }}
        <span style="float: right;">
        {{ $message->date_sent }}
        </span>
        </div>
        <div class="message-text">
        {{ $message->message }}
        </div>
    </div>
</div>