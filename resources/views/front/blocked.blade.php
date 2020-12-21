    <!DOCTYPE html>
    <html lang="en">

        <head>

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Usuario no permitido | {{ config('app.name') }}</title>

            <!-- Bootstrap Core CSS -->
            <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

            <!-- Custom CSS -->
            <link href="{{ asset('admin/plugins/sbadmin2/css/sb-admin-2.css') }}" rel="stylesheet">

            <!-- Custom Fonts -->
            <link href="{{ asset('admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">


            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- Scripts -->
            <script>
                window.Laravel = <?php echo json_encode([
                    'csrfToken' => csrf_token(),
                ]); ?>
            </script>

            <style type="text/css">

                th{
                    text-align: center;
                }

            </style>
        </head>

        <body>

            <div id="wrapper">
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <img src="{{ asset('front/img/pages/admin/access_blocked.png') }}">
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <p>
                            Contacte al administrador del sistema para obtener más información.
                        </p>
                    </div>
                    <div class="col-md-12" style="text-align: center; padding-top: 30px;">
                        <a href="{{ route('front.home') }}" class="btn btn-warning">Regresar al sitio</a>
                    </div>
                    <!-- /.col-lg-4 -->
                </div>
            </div>
            <!-- /#wrapper -->

            <!-- jQuery -->
            <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

            <!-- jQuery Form -->
            <script src="{{ asset('admin/plugins/jquery-form/jquery.form.js') }}"></script>

            <!-- Bootstrap Core JavaScript -->
            <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

            <!-- Custom Theme JavaScript -->
            <script src="{{ asset('admin/plugins/sbadmin2/js/sb-admin-2.js') }}"></script>

        </body>

    </html>
