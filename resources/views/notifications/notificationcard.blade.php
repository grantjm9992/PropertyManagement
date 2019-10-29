@isset( $class )
<div class="alert {{$class}}" notification="{{ $notification->id }}">
@else
<div class="alert alert-success" notification="{{ $notification->id }}">
@endisset
@if ( (int)$notification->is_seen === 0 )
    <button type="button" class="close" onclick="seenNotification({{ $notification->id }})">
        <i class="material-icons">close</i>
    </button>
@endif
    <span>
        {!! $notification->text !!}
    </span>
</div>