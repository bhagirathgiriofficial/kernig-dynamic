@extends('frontend.layouts.main-layout')

@php 
    $title   = $pageTitle;
@endphp

@section('title') {!! $title !!} @endsection
@section('content')
@include('frontend.layouts.common')

<section class="error-page">
    <div class="container centered-wrapper contianer_padding">
      <div class="row">
        <div class="col-lg-7 col-12 col-md-7 centered-content text-left">
          <div class="error-detail">
            <h2 class="pb-3 pt-5 text-capitalize"> oops! Link Expired </h2>
            <p class="">We are Sorry, But the page you requested was expired</p>
            <a href="{{ url('/') }}" class="common_btn">Go to Home Page</a>
          </div>
        </div>
        <div class="col-lg-5 col-md-5 d-none d-md-block text-right">
          <img src="{{ asset('frontend/images/error2.png') }}" alt="error2">
        </div>
      </div>
    </div>
</section>

@endsection