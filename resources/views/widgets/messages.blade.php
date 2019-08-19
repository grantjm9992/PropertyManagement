<div class="col-12 col-lg-6">
    <div class="card message-widget">
        <div class="card-header">
            Unread messages
        </div>
        <div class="card-body">
            @if ( $messages === null )
                <i class="fas fa-exclamation-triangle"></i> You have no new messages
            @else
                @foreach ( $messages as $message)
                    <div class="message">
                        <div class="message-image">
                            <img src="{{$message->avatar}}" alt="" class="avatar">
                        </div>
                        <div class="message-info">
                            <div class="title">
                                {{ $message->sender }}
                            </div>
                            <div class="message-text">
                                {{ $message->message }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="card-footer text-center">
            <a href="Messages" class="btn btn-outline-black">
                <i class="fas fa-envelope"></i> View all messages
            </a>
        </div>
    </div>
</div>