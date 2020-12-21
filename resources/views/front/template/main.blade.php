<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>@yield('title', 'Inicio') | {{ config('app.name') }}</title>
      <meta name="keywords" content="Aguas Subterráneas Pica">
      <meta name="description" content="Clidad de Aguas Subterráneas de Oasis de Pica">
      <meta name="author" content="pyramIT Ingeniería Informática">
      <meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <!-- Favicon -->
      <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/img/favicon.png') }}">

      <!-- Font -->
      <link rel='stylesheet' href="{{ asset('front/css/fonts/italic.css') }}">
      <link rel='stylesheet' href="{{ asset('front/css/fonts/oswald.css') }}">
      <link rel='stylesheet' href="{{ asset('front/css/font-awesome.min.css') }}">

      <!-- Plugins CSS -->
      <link rel="stylesheet" href="{{ asset('front/css/buttons/buttons.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/buttons/social-icons.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/myicons.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/jslider.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/settings.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/tweet-carousel.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/jquery.fancybox.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/animate.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/video-js.min.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/ladda.min.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/datepicker.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/jquery.scrollbar.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/prettyPhoto.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/sweetalert.css') }}">
      <!-- Theme CSS -->
      <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="{{ asset('front/css/responsive.css') }}">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="{{ asset('front/css/customizer/pages.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/customizer/dark-section.css') }}">
      <link rel="stylesheet" href="{{ asset('front/css/customizer/home-pages-customizer.css') }}">
      <!-- IE Styles-->
      <link rel="stylesheet" href="{{ asset('front/css/ie/ie.css') }}">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <link rel='stylesheet' href="{{ asset('front/css/ie/ie8.css') }}">
      <![endif]-->
   </head>
   <body class="fixed-header home">
      <div class="page-box">
         <div class="page-box-content">
            <!-- Page Loader -->
            <div id="pageloader">
               <div class="loader-item fa fa-spin text-color"></div>
            </div>
            <header id="divHeader" class="header header-two">
               @include('front.template.partials.header')
            </header>
            <!-- .header -->
            <div id="divHeaderDelay"></div>
            <div id="main">
                @yield('content')
            </div>
         </div>
         <!-- .page-box-content -->
          <footer id="footer" data-appear-animation="fadeInUp">
        	   @include('front.template.partials.footer')
     	    </footer>
      </div>
      <!-- .page-box -->
      <div class="clearfix"></div>

      <script src="{{ asset('front/js/jquery.min.js') }}"></script>
      <script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('front/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>
      <script src="{{ asset('front/js/jquery.touchSwipe.min.js') }}"></script>
      <script src="{{ asset('front/js/jquery.imagesloaded.min.js') }}"></script>
      <script src="{{ asset('front/js/jquery.appear.js') }}"></script>
      <script src="{{ asset('front/js/jquery.easing.1.3.js') }}"></script>
      <script src="{{ asset('front/js/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('front/js/jquery.tubular.1.0.js') }}"></script>
      <script src="{{ asset('front/js/SmoothScroll.js') }}"></script>
      <script src="{{ asset('front/js/masonry.pkgd.min.js') }}"></script>
      <script src="{{ asset('front/js/jquery.stellar.min.js') }}"></script>
      <script src="{{ asset('front/js/raphael.min.js') }}"></script>
      <script src="{{ asset('front/js/livicons-1.3.min.js') }}"></script>
      <script src="{{ asset('front/js/revolution/jquery.zozothemes.plugins.min.js') }}"></script>
      <script src="{{ asset('front/js/revolution/jquery.zozothemes.revolution.min.js') }}"></script>
      <script src="{{ asset('front/js/video.js') }}"></script>
      <script src="{{ asset('front/js/jquery.prettyPhoto.js') }}"></script>
      <script src="{{ asset('front/js/sweetalert.min.js') }}"></script>
      <script src="{{ asset('front/js/jquery.scrollbar.min.js') }}"></script>
      <script src="{{ asset('front/js/jquery.countTo.js') }}"></script>
      <script src="{{ asset('front/js/bootstrapValidator.min.js') }}"></script>
      <script src="{{ asset('front/js/main.js') }}"></script>

      <script type="text/javascript">

          $(document).ready(
                function()
                {
                    $('#divHeaderDelay').height($('#divHeader').height() - 1);
                    $('#pageloader').fadeOut(2000);
                }
          );

      </script>

      @yield('js', '')

   </body>
</html>
