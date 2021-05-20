@extends('frontend.layouts.main-layout')
@php

if($resultData['masterPageData']->page_meta_title != ''){
    $title = $resultData['masterPageData']->page_meta_title;
} else {
    $title = $pageTitle;
}

if($resultData['masterPageData']->page_meta_description != ''){
    $description = $resultData['masterPageData']->page_meta_description;
} else {
    $description = '';
}

if($resultData['masterPageData']->page_meta_keyword != ''){
    $keywords = $resultData['masterPageData']->page_meta_keyword;
} else {
    $keywords = '';
}

@endphp
@section('title') {!! $title !!} @endsection
@section('keywords') {!! $keywords !!} @endsection
@section('description') {!! $description !!} @endsection
@section('content')
@include('frontend.layouts.common')

<section class="loginRegister">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="customer_loginBlock forgot_password mx-auto">
          <p class="common_description">Please enter your email address below to receive a password reset link.</p>
          <form id="forgot_password" autocomplete="off">
            <div class="registerError"></div>
            <div class="form-group">
              <input type="" name="email" class="form-control mx-auto" placeholder="Email">
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
