@extends('frontend.layouts.main-layout')

@php 
	$resultData['accountSettingData']       = accountSettingData();
    $resultData['categoryData']             = catgeoriesData();
    $resultData['mensCategoryData']         = mainCategoryData(28);
    $resultData['womensCategoryData']       = mainCategoryData(29);
    $resultData['masterCategoryData']       = masterCategoryData(28,$subCategory1,$subCategory2);
    $resultData['userData']                 = Auth::guard('frontend')->user();
    $resultData['imagesUrl']                = config('constants');

    $title   = '404';
@endphp

@section('title') {!! $title !!} @endsection
@section('content')

<!-- Start Bredcrumbs===== -->
<section class="bredcrumbs">
  <div class="container contianer_padding">
    <div class="row">
      <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}" title="{{ $resultData['accountSettingData']->site_name }}">{{ $resultData['accountSettingData']->site_name }}</a></li>
        <li class="breadcrumb-item active">404</li>
      </ol>
    </div>
  </div>
</section>
<!-- End Bredcrumbs===== -->

<section class="error-page">
  	<div class="container centered-wrapper contianer_padding">
	    <div class="row">
	      <div class="col-lg-7 col-12 col-md-7 centered-content text-left">
	        <div class="error-detail">
	          <h2 class="pb-3 pt-5 text-capitalize"> oops! page not be found </h2>
	          <p class="">We are Sorry, But the page you requested was not found</p>
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