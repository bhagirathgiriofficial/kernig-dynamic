@extends('frontend.layouts.main-layout')

@php 
    $title   = $pageTitle;
@endphp

@section('title') {!! $title !!} @endsection
@section('content')
@include('frontend.layouts.common')

<section class="thank-you p-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="thankyou-detail">
          <img src="{{ asset('frontend/images/thankyou.png') }}" alt="thankyou">

          <h2 class="pb-3 pt-4 text-capitalize"> </h2>
          @if($resultData['emailVerification'] == NULL)
            <p class="text-center">Congratulation you have successfully verified your account !</p>
          @else
            <p class="text-center">Your account has been already verified !</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

@endsection