
<li>
    <a  rel="{{ $message->id }}">
        <img class="contacts-list-img" src="{{ $message->image }}">
        <div class="contacts-list-info">
            <span class="contacts-list-name">
            {{ $message->sender }}
            <small class="contacts-list-date float-right">{{ $message->date_sent }}</small>
            </span>
            @if ( (int)$message->is_read === 0 && (int)$message->id_sender !== (int)$user->id )
            <span class="contacts-list-msg"><b>{{ $message->message }}</b></span>
            @else
            <span class="contacts-list-msg">{{ $message->message }}</span>
            @endif
        </div>
        <!-- /.contacts-list-info -->
    </a>
</li>
