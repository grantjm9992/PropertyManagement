@inject('translator', 'App\Providers\TranslationProvider')
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="{{ $description }}">

        <title>{{ $title }}</title>
		<meta name="keywords" content="{{ $keywords }}" />
		<meta name="author" content="" />

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link rel="shortcut icon" href="img/mapicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

		<!-- Stylesheets -->
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/font-awesome.min.css"/>
		<link rel="stylesheet" href="css/animate.css"/>
		<link rel="stylesheet" href="css/owl.carousel.css"/>
		<link rel="stylesheet" href="{{ asset('https://use.fontawesome.com/releases/v5.3.1/css/all.css')}}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ asset('/css/slick.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/slick-theme.css') }}">
		<link rel="stylesheet" href="{{ asset('/css/swipebox.min.css') }}">
		@if ( !$safari )
		<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
		@endif
		<link rel="stylesheet" href="css/style.css"/>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body style="">
        {!! $header !!}
		<script src="js/jquery-3.2.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
        <script src="{{ asset('/js/slick.min.js')}}"></script>
        <script src="{{ asset('/js/jquery.swipebox.min.js')}}"></script>
        <script src="{{ asset('/js/sweetalert.min.js')}}"></script>
		@if ( !$safari )
		<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
		@endif
		<script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js')}}"></script>
        <div class="{{ $bodyClass }}">
            {!! $content !!}
		</div>
		{!! $footer !!}
		<script src="js/main.js?v2.3"></script>
    </body>
</html>
