@extends('frontend.layouts.main-layout')

@php 
    $title   = $pageTitle;
@endphp

@section('title') {!! $title !!} @endsection
@section('content')
@include('frontend.layouts.common')

<section class="loginRegister">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="customer_loginBlock forgot_password mx-auto">
          <p class="common_description">Please enter your new password to reset.</p>
          <form id="reset_password" autocomplete="off">
            <div class="registerError"></div>
            
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
              <input type="text" name="email" value="{{ urldecode($email)}}" class="form-control mx-auto" placeholder="Email Address" readonly="readonly">
            </div>
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control mx-auto" placeholder="New Password">
            </div>
            <div class="form-group">
              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control mx-auto" placeholder="Confirm Password">
            </div>
            <button class="common_btn angleinleft bouncein" title="Reset My Password" id="resetPassword">Reset My Password</button>
          </form>
          <a href="{{ url('login') }}" class="forgotPassword backlogin pt-3" title="I already have an account">Back to Login</a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection