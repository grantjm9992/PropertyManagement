<div style="width: 100%">
	<div style="width: 100%; max-width: 400px; margin: 20px auto;">
		<div style="padding: 50px; background: #007daf; color: #fff">
			<h1>
                New enquiry at MyCasaAway.com
			</h1>
		</div>
		<div style="background:#fff; color: black; padding: 30px;">
        @if ( $msg != "" )
			<ul style="list-style: none; font-size: 16px;">
				<li>
					Name: {{ $name }}
				</li>
				<li>
					Email: {{ $email }}
				</li>
				<li>
					Subject: {{ $subject }}
				</li>
				<li>
					Message: {!! $msg !!}
				</li>
			</ul>
        @else
        <div style="width: 100%; font-size: 18px;">
            Enquiry through email card
		</div>
        <div style="width: 100%; font-size: 16px;">
            Email {{ $email }}
        </div>
        @endif
	</div>
</div>