<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <!-- Favicon -->
   <link rel="icon" href="{{ asset('admin-assets/src/images/favicon.png') }}" type="image/x-icon">
   <!--/ Favicon -->

   <title> @yield('code') | Admin Panel </title>

   <!-- Include css/scss -->
   <link href="{{ asset('admin-assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
   <link href="{{ asset('admin-assets/global/css/bootstrap-extend.min.css') }}" rel="stylesheet">
   <link href="{{ asset('admin-assets/css/site.min.css') }}" rel="stylesheet">
   <link href="{{ asset('admin-assets/global/vendor/animsition/animsition.css') }}" rel="stylesheet">
   <link href="{{ asset('admin-assets/assets/examples/css/pages/errors.css') }}" rel="stylesheet">
   <!--/ Include css/scss -->

</head>
<body class="animsition page-error page-error-404 layout-full">

   <!-- Page -->
   <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content vertical-align-middle">
         <header>
            <h1 class="animation-slide-top">@yield('code')</h1>
            <p>@yield('message') !</p>
         </header>
         <p class="error-advise">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
         <a class="btn btn-primary btn-round" href="{{ route('adminPanel.dashboard') }}">GO TO ADMIN PANEL</a>
      </div>
   </div>
   <!-- End Page -->
   
   <script src="{{ asset('admin-assets/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
   <script src="{{ asset('admin-assets/global/vendor/jquery/jquery.js') }}"></script>
   <script src="{{ asset('admin-assets/global/vendor/popper-js/umd/popper.min.js') }}"></script>
   <script src="{{ asset('admin-assets/global/vendor/bootstrap/bootstrap.js') }}"></script>
   <script src="{{ asset('admin-assets/global/vendor/animsition/animsition.js') }}"></script>


   <script src="{{ asset('admin-assets/global/js/Component.js') }}"></script>
   <script src="{{ asset('admin-assets/global/js/Base.js') }}"></script>
   <script src="{{ asset('admin-assets/assets/js/Site.js') }}"></script>
   
   <script>
   (function(document, window, $){
      'use strict';
   
      var Site = window.Site;
      $(document).ready(function(){
         Site.run();
      });
   })(document, window, jQuery);
   </script>
</body>
</html>