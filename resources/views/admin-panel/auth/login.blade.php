<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('admin-assets/images/favicon.png') }}" type="image/x-icon">
    <!--/ Favicon -->

    <title> Login | Admin Panel  </title>

    <!-- Include css/scss -->
    <link href="{{ asset('admin-assets/global/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/css/bootstrap-extend.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/css/site.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/animsition/animsition.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/asscrollable/asScrollable.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/slidepanel/slidePanel.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/global/vendor/jquery-mmenu/jquery-mmenu.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/assets/examples/css/pages/login-v2.css') }}" rel="stylesheet">
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
<body class="animsition page-login-v2 layout-full page-dark">

    <!-- Page -->
    <div class="page" data-animsition-in="fade-in" data-animsition-out="fade-out">
        <div class="page-content">
            <div class="page-brand-info">
            <div class="brand">
                {{ Html::image(getSiteLogo(), '',  ['class' => 'brand-img', 'title'=> getSiteName(), 'style' => 'width:50%'] ) }}
            </div>          
            </div>

            <div class="page-login-main animation-slide-right animation-duration-1">
            <div class="brand hidden-md-up"> 
                {{ Html::image('admin-assets/assets/images/logo.png', '',  ['class' => 'brand-img', 'title'=> getSiteName(), 'style' => 'width:25%'] ) }}
                <h3 class="brand-text font-size-40">{{ getSiteName() }}</h3>
            </div>
            <h3 class="font-size-24">{{ __('Login') }}</h3>
            <p>Please enter your details to Login.</p>

            <form method="POST" class="login-form" action="{{ route('adminPanel.login') }}" data-parsley-validate>
                @csrf

                <!-- Validation error -->
                @component('admin-panel.validation.errors')
                    @slot('title') Error! @endslot
                @endcomponent
                <!-- / Validation error -->
                
                <div class="form-group">
                    <label class="sr-only" for="inputEmail">{{ __('E-Mail Address') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid  @enderror" id="inputEmail" name="email" placeholder="Email" value="{{ old('email') }}" autofocus required>
                    
                </div>
                <div class="form-group">
                    <label class="sr-only" for="inputPassword">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid  @enderror" id="inputPassword" name="password" placeholder="Password" required>
                    
                </div>
                <div class="form-group clearfix">
                    @if (Route::has('adminPanel.passwordRest'))
                    <a class="float-right" href="{{ route('adminPanel.passwordRest') }}">Forgot password?</a>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
            </form>
            </div>
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
    <script src="{{ asset('admin-assets/js/auth/login.js') }}"></script>

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