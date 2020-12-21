<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') | Panel de administración</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Toggle CSS -->
    <link href="{{ asset('admin/plugins/toggle/css/toggle.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Toggle JavaScript -->
    <script src="{{ asset('admin/plugins/toggle/js/toggle.min.js') }}"></script>

    @yield('js')
</body>
</html>
