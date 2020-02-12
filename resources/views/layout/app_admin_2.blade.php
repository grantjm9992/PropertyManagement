<html>
    <head>    
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bbootstrap 4 -->
        <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="css/adminlte.css" type="text/css"> 
        <link rel="stylesheet" href="css/adminlte.min.css" type="text/css"> 
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="css/jquery-ui.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <link rel="stylesheet" href="css/jquery.datetimepicker.min.css">
        <link rel="stylesheet" href="css/dropzone.css">
        <!-- summernote -->
        <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css">
        <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css">
		<link rel="stylesheet" href="{{ asset('/js/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="https://cdn.syncfusion.com/17.3.0.9/js/web/bootstrap-theme/ej.web.all.min.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="css/newAdmin.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="sidebar-mini layout-fixed">
        <div class="wrapper">
            
        <!-- jQuery -->
        <script src="plugins/jquery/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- Bootstrap 4 -->
        <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- ChartJS -->
        <script src="plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="plugins/sparklines/sparkline.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
        <!-- daterangepicker -->
        <!-- JQVMap -->
        <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <script src="plugins/moment/moment.min.js"></script>
        <script src="plugins/daterangepicker/daterangepicker.js"></script>
        <script src="plugins/select2/js/select2.full.min.js"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="plugins/summernote/summernote-bs4.min.js"></script>
        <!-- overlayScrollbars -->
        <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
        <script src="{{ asset('/js/fullcalendar.js')}}"></script>
        <script src="{{ asset('/js/sweetalert.min.js')}}"></script>
        <script src="js/dropzone.js"></script>
        <!-- AdminLTE App -->
        <script src="js/jquery.datetimepicker.full.min.js"></script>
        <script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js')}}"></script>
        <script src="https://cdn.syncfusion.com/17.3.0.9/js/web/ej.web.all.min.js"></script>
        <script src="js/adminlte.js"></script>
        <script src="js/newAdmin.js"></script>
        {!! $cont->header !!}
        {!! $cont->sidebar !!}
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        
                        <div class="col-12 p-4 d-block d-lg-inline-flex justify-content-between">
                            <h4>
                                <i class="fas {{ $iconClass }}"></i>  {!! $pageTitle !!}
                            </h4>
                            <div class="buttons">
                                {!! $botonera !!}
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <section class="content">
            {!! $cont->body !!}
            </section>
        </div>
        </div>
        <script>
        
        $(document).ready( function() {
                window.swalOptions = Array();
                window.swalOptions.title = "Error";
                window.swalOptions.text = "";
                window.swalOptions.icon = "";
                window.swalOptions.className = "";
                window.swalOptions.closeOnClickOutside = true;
                window.swalOptions.dangerMode = false;
                window.swalOptions.timer = null;
                window.swalOptions.thenParameters = null;
                window.swalOptions.buttons = {
                    cancel: {
                        text: "Accept",
                        value: null,
                        visible: true,
                        closeModal: true
                    }
                }
                window.swalOptions.thenFunction = remove;

                window.swalConfirmOptions = Array();
                window.swalConfirmOptions.title = "Warning";
                window.swalConfirmOptions.text = "";
                window.swalConfirmOptions.icon = "warning";
                window.swalOptions.className = "";
                window.swalOptions.closeOnClickOutside = true;
                window.swalOptions.dangerMode = false;
                window.swalOptions.timer = null;
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

            function remove(){console.log("Ran");}
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
</html>