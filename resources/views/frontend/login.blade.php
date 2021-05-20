@extends('frontend.layouts.main')
<title>
    {{getSiteName()}} - Sign
</title>
@section('main-section')

    <!-- menu page section start -->
    <div class="container-fluid headtype">
        <div class="container">
            <div class="row char">
                <a href="{{url('/')}}"> Home </a>&nbsp; /&nbsp; <span class="submenu"> Login </span>
            </div>
        </div>
    </div>
    <!-- sign section start -->
    <section class="container-fluid ">
        <div class="container signin">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12 col-lg-6 col-xl-6 signform">
                    <div class="p-4">
                        <h2>Sign In</h2>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <button><i class="fab fa-facebook-f" aria-hidden="true"></i> LOGIN USING FACEBOOK</button>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <a href="{{url('/google-login')}}">
                            <button class="googleplus"> <i class="fab fa-google"></i> LOGIN USING GOOGLE</button>
                            </a>
                        </div>
                    </div>
                    <div class="or">OR</div>
                    <div class="inputfild">
                        <form onsubmit="return loginUser(this)" id="login-form">
                            <div class="emailsec">
                                <h3>Email</h3>
                                <input type="email" name="email" required onkeyup="validateEmail(this.value,'login-email-message')" id="login-email" autocomplete="off"/>
                                <span class="pt-2 text-danger" id="login-email-message" style="display: block"></span>
                            </div>

                            <div class="emailsec">
                                <h3>Password</h3>
                                <input type="password" name="password" required  autocomplete="off"/>
                            </div>

                            <div class="submisec">
                                <a href="{{url('/forgot-password')}}">  <h3>Forgot Password?</h3></a>
                                <button class="googleplus" type="submit" id="sign-in-btn">SIGN IN</button>
                            </div>
                            <span class="d-block" id="login-message">
                                @if (session()->has('error'))
                                    {{session('error')}}
                                @endif
                            </span>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-12 col-lg-6 col-xl-6 signform" style="border-right: none;">
                    <div class="p-4">
                        <h2>Create An Account</h2>
                    <div class="inputfild">
                        <form onsubmit="return registerUser(this)">
                            <div class="emailsec">
                                <h3>Name</h3>
                                <input type="name" name="name" required autocomplete="off"/>
                                <span class="pt-2 text-danger" id="name-message" style="display: block"></span>
                            </div>
                            <div class="emailsec">
                                <h3>Email</h3>
                                <input type="email" name="email" required onkeyup="validateEmail(this.value,'register-email-message')" autocomplete="off"/>
                                <span class="pt-2 text-danger" id="register-email-message" style="display: block"></span>
                            </div>
                            <div class="emailsec">
                                <h3>Password</h3>
                                <input type="password" name="password" required  autocomplete="off"/>
                            </div>
                            <div class="emailsec mb-2">
                                <h3>Confirm Password</h3>
                                <input type="password" name="confirm_password" required  autocomplete="off"/>
                            </div>
                            <div class="submisec">
                                <button class="googleplus" type="submit" id="sign-up-btn">SIGN UP</button>
                            </div>
                            <span class="d-block" id="register-message"></span>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- sign section closed -->
@endsection
@push('script')
<script>
    var loginMessageBox = $('#login-message');
    var signInBtn  = $('#sign-in-btn');
    function loginUser(form){
        var data = $(form).serialize();
        signInBtn.text('LOADING...');
        $.ajax({
            type:"post",
            url:"{{url('/login')}}",
            data:data,
            success:function(response){
                if(response.status){
                    loginMessageBox.addClass("text-success").removeClass("text-danger").text(response.message);
                    $(form).trigger('reset');
                    var timer = 5;
                        setInterval(function() {
                            timer--;
                            loginMessageBox.text(`Login successful, Redirecting you in ${timer} seconds`);
                        }, 1000)
                        setTimeout(function() {
                            window.location.href = "{{url('/')}}";
                        }, 4000);
                }else{
                    loginMessageBox.addClass("text-danger").removeClass("text-success").text(response.message);
                }
                signInBtn.text('SIGN IN');
            }
        })
        return false;
    }
</script>
<script>
    var registerMessageBox = $('#register-message');
    var signUpBtn  = $('#sign-up-btn');
    function registerUser(form){
        var data = $(form).serialize();
        signUpBtn.text('LOADING...');
        $.ajax({
            type:"post",
            url:"{{url('/register')}}",
            data:data,
            success:function(response){
                if(response.status){
                    registerMessageBox.addClass("text-success").removeClass("text-danger").text(response.message);
                    $(form).trigger('reset');
                    $("#login-email").focus();
                    $("#login-form").trigger('reset');

                }else{
                    registerMessageBox.addClass("text-danger").removeClass("text-success").text(response.message);
                }
                signUpBtn.text('SIGN UP');
            }
        })
        return false;
    }
</script>
@endpush
@push('script')
@endpush
