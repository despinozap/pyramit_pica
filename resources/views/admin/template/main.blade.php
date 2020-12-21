<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Administrador de Aguas Subterráneas pica">
    <meta name="author" content="pyramIT Ingeniería Informática">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('admin/img/favicon.png') }}">

    <title>@yield('title', 'Admin') | Panel de administración</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('admin/plugins/metisMenu/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('admin/plugins/sbadmin2/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Pretty Photo CSS -->
    <link href="{{ asset('admin/plugins/prettyPhoto/css/prettyPhoto.css') }}" rel="stylesheet">

    <!-- Toggle CSS -->
    <link href="{{ asset('admin/plugins/toggle/css/toggle.min.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('admin/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- SweetAlert -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/sweetalert/sweetalert.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/chosen/chosen.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/trumbowyg/ui/trumbowyg.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/croppie/croppie.css') }}">

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

    @yield('style')

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            @include('admin.template.partials.header')
            @include('admin.template.partials.nav')
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('title')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            @yield('content')

        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery Form -->
    <script src="{{ asset('admin/plugins/jquery-form/jquery.form.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('admin/plugins/metisMenu/metisMenu.min.js') }}"></script>

    <!-- Pretty Photo JavaScript -->
    <script src="{{ asset('admin/plugins/prettyPhoto/js/prettyPhoto.js') }}"></script>

    <!-- Toggle JavaScript -->
    <script src="{{ asset('admin/plugins/toggle/js/toggle.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('admin/plugins/sbadmin2/js/sb-admin-2.js') }}"></script>

    <!-- SweetAlert JavaScript -->
    <script type="text/javascript" src="{{ asset('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('admin/plugins/chosen/chosen.jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plugins/trumbowyg/trumbowyg.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plugins/trumbowyg/langs/es.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/plugins/croppie/croppie.js') }}"></script>

    @yield('js')

</body>

</html>
