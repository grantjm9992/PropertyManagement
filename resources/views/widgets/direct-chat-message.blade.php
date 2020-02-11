
    @if ( (int)$message->id_sender === (int)$user->id )
    <div class="direct-chat-msg right">
        <div class="direct-chat-infos clearfix">
            <span class="direct-chat-name float-right">You</span>
            <span class="direct-chat-timestamp float-left">{{ $message->date_sent }}</span>
        </div>
        <!-- /.direct-chat-infos -->
        <img class="direct-chat-img" src="{{ $message->image }}" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
            {!! $message->message !!}
        </div>
        <!-- /.direct-chat-text -->
    </div>
    @else
    <div class="direct-chat-msg">
        <div class="direct-chat-infos clearfix">
            <span class="direct-chat-name float-left">{{ $message->sender }}</span>
            <span class="direct-chat-timestamp float-right">{{ $message->date_sent }}</span>
        </div>
        <!-- /.direct-chat-infos -->
        <img class="direct-chat-img" src="{{ $message->image }}" alt="message user image">
        <!-- /.direct-chat-img -->
        <div class="direct-chat-text">
            {!! $message->message !!}
        </div>
        <!-- /.direct-chat-text -->
    </div>
    @endif