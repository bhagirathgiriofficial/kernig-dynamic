<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('admin-assets/images/favicon.png') }}" type="image/x-icon">
    <!--/ Favicon -->

    <title> Reset Password | Admin Panel  </title>

    <!-- Include css/scss -->
    <link href="{{ asset('admin-assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/css/bootstrap-extend.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/site.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/animsition/animsition.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/asscrollable/asScrollable.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/slidepanel/slidePanel.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/jquery-mmenu/jquery-mmenu.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/assets/examples/css/pages/forgot-password.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/custom.css') }}" rel="stylesheet">

    @stack('styles')
    <!--/ Include css/scss -->

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('admin-assets/global/fonts/font-awesome/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/global/fonts/web-icons/web-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <!-- / Fonts -->


    <script src="{{ asset('admin-assets/global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
        Breakpoints();
    </script>

</head>
<body class="animsition page-forgot-password layout-full">

    <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">
            <div class="">
                <img src="{{getSiteLogo()}}" title = "{{getSiteName()}}" class ="brand-img" width="100%">
                <!-- <h3 class="brand-text font-size-28">{{ getSiteName() }}</h3> -->
                <hr/>
            </div>

            <h2>{{ __('Reset Password') }}</h2>
            <p>Add your new password</p>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @elseif($errors->any())
            <div class="alert dark alert-danger">
                @foreach ($errors->all() as $error)
                    <div> {{ $error }} </div>
                @endforeach
            </div>
            @endif
            <!-- / Validation error -->

            <form method="POST" action="{{url('/change-password')}}" class="reset-password-form">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="inputBasicFirstName" name="email" placeholder="{{ __('E-Mail Address') }}" autocomplete="off" value="{{ $email ?? old('email') }}" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror show-hide-me" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
                    </div>
                    <div class="form-group col-md-12">
                        <input id="password-confirm" type="password" class="form-control show-hide-me" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group">
                    <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Show Password" id="showPassword" data-flag="1"> <i class="fa fa-eye"> </i></button>
                    <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Page -->

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
    <script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
    <script src="{{ asset('admin-assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('admin-assets/js/auth/reset-password.js') }}"></script>

    @stack('scripts')

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
