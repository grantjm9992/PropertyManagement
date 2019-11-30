<div style="width: 100%; max-width: 800px; margin:0 auto; padding: 25px;">
	<h3 style="margin-bottom: 15px;">New notification from {{ $company->application_name }}</h3>
	<h5>Hi, {{ $user->name }}, you have recieved a new notification:</h5>
	<div style="margin-top: 20px; width: 100%;">
		{!! $notification->text !!}
	</div>
</div>