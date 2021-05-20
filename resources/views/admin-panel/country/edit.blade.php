@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Country | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Country</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.country.checkCountryTitle') }}">Country</a></li>
            <li class="breadcrumb-item active">Update Country</li>
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
                                    <h4 class="example-title mb-1">Country Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-country-form', 'method' => 'post', 'url' => route('adminPanel.country.update', ['id' => ev($country->country_id)]), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="country_name">@lang('language.country_name')</label>
                                                            {!! Form::text('country_name', old('country_name', ($country->country_name ?? '')), ['class' => 'form-control', 'id' => 'country_name', 'autocomplete' => 'off', 'maxLength' => '75', 'placeholder' =>__('language.country_name'), 'data-url' => route('adminPanel.country.checkCountryTitle', ['id' => ev($country->country_id)])]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_country') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.update_country') }}
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
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/country/country.js') }}"></script>
@endpush
