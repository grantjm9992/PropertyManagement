
<div>
    <i class="fas fa-clock bg-blue"></i>
    <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i> {{ $event->date }}</span>
        <h3 class="timeline-header">
            {!! $event->text !!}
        </h3>

        @if ( $event->detail != "" )
            <div class="timeline-body">
                {!! $event->detai !!}
            </div>
        @endif
        <div class="timeline-footer">
            
        </div>
    </div>
</div>