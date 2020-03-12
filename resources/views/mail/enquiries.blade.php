<div style="width: 100%">
	<div style="width: 100%; max-width: 400px; margin: 20px auto;">
		<div style="padding: 50px; background: rgba(0,0,0,1); color: #fff">
			<h1>
				You have a new enquiry
			</h1>
		</div>
		<div style="background:#fff; color: black; padding: 30px;">
			<ul style="list-style: none; font-size: 16px;">
				<li>
					Name: {{ $enq->name }}
				</li>
				<li>
					Surname: {{ $enq->surname }}
				</li>
				<li>
					Email: {{ $enq->email }}
				</li>
				<li>
					Phone: {{ $enq->phone }}
				</li>
				<li>
					Message: {{ $enq->message }}
				</li>
				<li>
					Bedrooms: {{ $enq->bedrooms }}
				</li>
				@if ( $apt !== null )
					<li>
						Apartment: <a style="color: black;" href="{{ url('Admin.apartmentDetail?id=') }}{{ $apt->id }}">{{ $apt->code }}</a>
					</li>
				@endif
			</ul>
		</div>
	</div>
</div>