@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Add Coupon | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Coupon</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.coupon.index') }}">Coupon</a></li>
            <li class="breadcrumb-item active">Add Coupon</li>
        </ol>
    </div>
    <!-- / Page breadcrumbs -->
    <!-- Page --> 
    <div class="page-profile">
        <div class="page-content container-fluid pt-0">
            <!-- Validation error -->
            @component('admin-panel.validation.errors')
            @slot('title')
            Error!
            @endslot
            @endcomponent
            <!-- / Validation error -->
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <!-- Example Basic Form (Form grid) -->
                                <div class="example-wrap">
                                    <h4 class="example-title mb-1">Coupon Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-coupon-form', 'method' => 'post', 'url' => route('adminPanel.coupon.store'), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="coupon_code">@lang('language.coupon_code')</label>
                                                            {!! Form::text('coupon_code', '', ['class' => 'form-control', 'id' => 'coupon_code', 'autocomplete' => 'off', 'placeholder' =>__('language.coupon_code'), 'maxLength' => '100', 'data-url' => route('adminPanel.coupon.checkCouponCode')]) !!}
                                                             
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="coupon_discount">@lang('language.coupon_discount')</label>
                                                            {!! Form::number('coupon_discount', '', ['class' => 'form-control', 'id' => 'coupon_discount', 'autocomplete' => 'off', 'placeholder' =>__('language.coupon_discount'), 'step' => 'any' , 'max' => 99.99 , 'min' => 0])!!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Example Date Range -->
                                                <div class="example-wrap">
                                                    <div class="example required">
                                                        <label class="form-control-label">Validate Between</label>
                                                        <div class="input-daterange">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="icon wb-calendar" aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control dateValidator start-date-picker" id="start_date" data-plugin="datepicker" name="start_date" style="text-align: left;" placeholder="dd-mm-yyyy" autocomplete="off" readonly="">
                                                            </div>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">to</span>
                                                                </div>
                                                                <input type="text" class="form-control dateValidator end-date-picker" id="end_date" data-plugin="datepicker" name="end_date" style="text-align: left;" placeholder="dd-mm-yyyy" autocomplete="off" readonly=""/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Example Date Range -->
                                            </div>
                                            <div class="col-md-6">
                                                <div class="example-wrap">
                                                    <div class="example required">
                                                        <label class="form-control-label">Price Range</label>
                                                        <div class="input-daterange">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="icon fa fa-usd" aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                                <input type=number step=any class="form-control" name="price_start" id="price_start" min="0" style="text-align: left;" placeholder="Start Price" maxlength="8"/>
                                                            </div>
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">to</span>
                                                                </div>
                                                                <input type=number step=any class="form-control" name="price_end" id="price_end" min="0" style="text-align: left;" placeholder="End Price" maxlength="8"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.create_coupon') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.create_coupon') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                <!-- End Example Basic Form (Form grid) -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/coupon/coupon.js') }}"></script>
@endpush
