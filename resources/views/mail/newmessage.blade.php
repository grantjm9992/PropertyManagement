<div style="width: 100%; max-width: 800px; margin:0 auto; padding: 25px;">
	<h3 style="margin-bottom: 15px;">New message from {{ $sender->name }}</h3>
	<h5>{{ $user->name }} has sent you a new message:</h5>
	<div style="margin-top: 20px; width: 100%;">
		{!! $message->message !!}
	</div>
</div>