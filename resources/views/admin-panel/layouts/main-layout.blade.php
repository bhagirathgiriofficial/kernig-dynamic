<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('admin-assets/images/favicon.png') }}" type="image/x-icon">
    <!--/ Favicon -->
    <title>@yield('page-title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin-assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/css/bootstrap-extend.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/site.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/animsition/animsition.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/asscrollable/asScrollable.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/slidepanel/slidePanel.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/jquery-mmenu/jquery-mmenu.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/bootstrap-select/bootstrap-select.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    <link href="{{ asset('admin-assets/css/iziToast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/custom.css') }}" rel="stylesheet">
    @stack('styles')
    <!--/ Include css/scss -->
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/global/fonts/web-icons/web-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/global/fonts/glyphicons/glyphicons.css') }}">
    <!-- / Fonts -->
    <script src="{{ asset('admin-assets/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
    Breakpoints();

    </script>
</head>

<body class="animsition site-navbar-small site-menubar-unfold">
    <!-- Include header -->
    @include('admin-panel.layouts.main-header')
    <!--/ Include header -->
    <!-- Include sidebar  -->
    @include('admin-panel.layouts.main-sidebar')
    <!--/ Include sidebar  -->
    <!-- Include Content  -->
    @yield('content')
    <!-- Include Content  -->
    <!-- Include footer  -->
    @include('admin-panel.layouts.main-footer')
    <!--/ Include footer  -->
    <!-- Add new entity modal -->
    <div class="modal fade modal-3d-sign" id="add-new-entity-modal" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
            <div class="modal-content">
                <div class="loading">Loading...</div>
            </div>
        </div>
    </div>
    <!--/ Add new entity modal -->
    <!-- Import questions modal -->
    <div class="modal fade example-modal-lg modal-3d-sign" id="add-new-entity-modal-large" aria-hidden="true" aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple modal-lg">
            <div class="modal-content">
                <div class="loading">Loading...</div>
            </div>
        </div>
    </div>
    <!--/ Import questions modal -->
    <script>
    // Input date format
    var INPUT_DATE_FORMAT = @json(config('constants.date_formats.INPUT.value'));
    //------------------

    </script>
    <script src="{{ asset('admin-assets/global/vendor/babel-external-helpers/babel-external-helpers.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/popper-js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/animsition/animsition.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/asscrollbar/jquery-asScrollbar.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/asscrollable/jquery-asScrollable.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/slidepanel/jquery-slidePanel.js') }}"></script>
    {{-- <script src="{{ asset('admin-assets/global/vendor/toastr/toastr.js') }}"></script> --}}
    <script src="{{ asset('admin-assets/global/js/Component.js') }}"></script>
    <script src="{{ asset('admin-assets/global/js/Plugin.js') }}"></script>
    <script src="{{ asset('admin-assets/global/js/Base.js') }}"></script>
    <script src="{{ asset('admin-assets/global/js/Config.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/Section/Menubar.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/Section/Sidebar.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/Section/PageAside.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/Section/GridMenu.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/Site.js') }}"></script>
    <script src="{{ asset('admin-assets/global/js/Plugin/asscrollable.js') }}"></script>
    <script src="{{ asset('admin-assets/global/js/Plugin/slidepanel.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/select2.js')}}"></script>
    <script src="{{ asset('admin-assets/global/vendor/bootstrap-select/bootstrap-select.js') }}"></script>
     <script src="{{ asset('admin-assets/global/js/Plugin/multi-select.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('admin-assets/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    @stack('scripts')
    <script>
    (function(document, window, $) {
        'use strict';

        var Site = window.Site;
        // console.log(Site);
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);

    </script>
    <script>
    @if(Session::has('notification'))
    var notification = @json(Session::get('notification'));

    // Show notification
    $(document).ready(function() {
        App.showNotification(notification);
    });
    //------------------
    @endif

    </script>
</body>

</html>
