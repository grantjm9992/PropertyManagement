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
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/dropzone.css') }}">

        <link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.min.css')}}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<link href="{{ asset('https://cdn.syncfusion.com/17.1.0.38/js/web/flat-azure/ej.web.all.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('https://use.fontawesome.com/releases/v5.3.1/css/all.css')}}" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">

	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <script src="{{ asset('https://code.jquery.com/jquery-3.3.1.min.js')}}" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js')}}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js')}}"></script>
	<!-- jQuery Easing -->
	<script src="{{ asset('js/jquery.easing.1.3.js')}}"></script>
	<script src="{{ asset('js/sweetalert.min.js')}}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.js')}}"></script>
	<script src="{{ asset('js/grantnate.js')}}"></script>

    <script src="{{ asset('/js/jsrender.min.js')}}"></script>
    <script src="{{ asset('/js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('/js/jquery.datetimepicker.full.min.js')}}"></script>
	<script src="{{ asset('/js/notify.min.js')}}"></script>
	<script src="{{ asset('https://cdn.syncfusion.com/17.1.0.38/js/web/ej.web.all.min.js')}}"></script>
	<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/themes/fas/theme.min.js') }}"></script>
	<script src="{{ asset('/js/dropzone.js') }}"></script>
	<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.1/js/fileinput.min.js') }}"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
        {!! $header !!}
        <div class="body">
			<h3>
				<i class="fas {!! $iconClass !!}"></i> {!! $titulo !!}
				<div class="buttons">
					{!! $botonera !!}
                </div>
			</h3>
            {!! $content !!}
        </div>
        <script>

            $(document).ready( function() {
                function reportWindowSize() {
                    var width = window.innerWidth;
                    if ( width > 800 )
                    {
                        $('#menu').show();
                    }
                    else
                    {
                        $('#menu').hide();
                    }
                }

                window.onresize = reportWindowSize;

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                window.swalOptions = Array();
                window.swalOptions.title = "Error";
                window.swalOptions.text = "";
                window.swalOptions.icon = "";
                window.swalOptions.className = "";
                window.swalOptions.closeOnClickOutside = true;
                window.swalOptions.dangerMode = false;
                window.swalOptions.timer = null;
                window.swalOptions.thenParameters = null;
                window.swalOptions.thenFunction = null;
                window.swalOptions.buttons = {
                    cancel: {
                        text: "Accept",
                        value: null,
                        visible: true,
                        closeModal: true
                    }
                }

                window.swalOptions.className = "";
                window.swalOptions.closeOnClickOutside = true;
                window.swalOptions.dangerMode = false;
                window.swalOptions.timer = null;

                window.swalConfirmOptions = Array();
                window.swalConfirmOptions.title = "Warning";
                window.swalConfirmOptions.text = "";
                window.swalConfirmOptions.icon = "warning";
                window.swalConfirmOptions.thenFunction = null;
                window.swalConfirmOptions.thenParameters = null;
                window.swalConfirmOptions.buttons = {
                    confirmar: {
                        text: "Confirm",
                        value: 1,
                        className: "btn-success"
                    },
                    cancelar: {
                        text: "Cancel",
                        value: null,
                        className: "btn-danger"
                    }
                };
            })
            function sweetAlert( options, icon = null )
            {
                var config = window.swalOptions;
                if ( typeof options === "string" )
                {
                    config.title = options;
                    config.icon = icon;
                }
                else
                {
                    if ( options.type && options.type == "confirm" )
                    {
                        config = window.swalConfirmOptions;
                    }
                    $.extend ( config, options );
                }
                swal( 
                    {
                        title: config.title,
                        text: config.text,
                        icon: config.icon,
                        buttons: config.buttons,
                        content: config.content,
                        className: config.className,
                        closeOnClickOutside: config.closeOnClickOutside,
                        dangerMode: config.dangerMode,
                        timer: config.timer
                    }
                 ).then((result) => {
                    window.result = result;
                    if (result) {
                        config.thenFunction(config.thenParameters);
                    } else {

                    }
                });
            }
        </script>
    </body>
    {!! $footer !!}
</html>
<script>
</script>