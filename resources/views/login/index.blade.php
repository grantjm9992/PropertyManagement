@inject('translator', 'App\Providers\TranslationProvider')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Admin Panel</title>
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href="{{ asset('https://fonts.googleapis.com/css?family=Poppins:300,400,500') }}'" rel="stylesheet">
	<link href="{{ asset('https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i') }}" rel="stylesheet">
	
	<!-- Bootstrap  -->
        <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' ) }}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css')}}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
	<link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css')}}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('https://use.fontawesome.com/releases/v5.3.1/css/all.css')}}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body style="background: url(img/about.jpg); background-size: cover; background-repeat: no-repeat; background-position: center;    height: 100vh;">
        <script src="{{ asset('https://code.jquery.com/jquery-3.3.1.min.js')}}" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js')}}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js')}}"></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('js/jquery.easing.1.3.js')}}"></script>
	<script src="{{ asset('js/sweetalert.min.js')}}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>
	<!-- Date Picker -->
	<script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>

        <script src="{{ asset('/js/jsrender.min.js')}}"></script>
        <script src="{{ asset('/js/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('/js/jquery.datetimepicker.full.min.js')}}"></script>
	<script src="{{ asset('/js/admin.js')}}"></script>
	<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.min.js') }}"></script>

	<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js') }}"></script>
	<div style="position: absolute; bottom: 40px; right: 20px; width: calc( 100vw - 40px );max-width: 400px;" class="card">
		<div class="card-header">
			Login
		</div>
		<div class="card-body">
			<form action="Login.checkUser">
            @csrf()
				<div class="row">
					<div class="form-group col-12">
						<label for="username">Username</label>
						<input type="text" name="username" class="form-control">
					</div>
					<div class="form-group col-12">
						<label for="password">Password</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group col-12">
						<button type="submit" class="btn-black btn">Log in</button>
					</div>
				</div>
			</form>
		</div>
	</div>
    </body>
</html>
<script>
</script>