<div class="col-12 col-lg-6">
    <div class="card message-widget">
        <div class="card-header">
            New notifications
        </div>
        <div class="card-body">
            @if ( $notifications === null )
                <i class="fas fa-exclamation-triangle"></i> You have no new notifications
            @else
                @foreach ( $notifications as $notification)
                    <div class="message">
                        <div class="title">
                            {{ $notification->type }}
                        </div>
                        <div class="message-text">
                            {{ $notification->text }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="card-footer text-center">
            <a href="Notifications" class="btn btn-outline-black">
                <i class="fas fa-envelope"></i> View all notifications
            </a>
        </div>
    </div>
</div>