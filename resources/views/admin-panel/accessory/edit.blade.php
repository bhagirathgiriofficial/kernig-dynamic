@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Accessory | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Accessories</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.accessory.index') }}">Accessories</a></li>
            <li class="breadcrumb-item active">Update Accessory</li>
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
                                    <h4 class="example-title mb-1">Accessory Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-accessory-form', 'method' => 'post', 'url' => route('adminPanel.accessory.update', ['id' => ev($accessory->accessory_id)]), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="accessory_name">@lang('language.accessory_name')</label>
                                                            {!! Form::text('accessory_name', old('accessory_name',($accessory->accessory_name ?? '')), ['class' => 'form-control', 'id' => 'accessory_name', 'autocomplete' => 'off', 'placeholder' =>__('language.accessory_name'), required =>"required", 'maxlength' => '100', 'data-url' => route('adminPanel.accessory.checkAccessoryName', ['id' => ev($accessory->accessory_id)])]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="colorpicker1">@lang('language.accessory_price')</label>
                                                            {!! Form::number('accessory_price', old('accessory_price',($accessory->accessory_price ?? '')), ['min' => 0, 'step' => 'any' ,'class' => 'form-control', 'id' => 'accessory_price', 'maxlength' => '6', 'autocomplete' => 'off', 'placeholder' =>__('language.accessory_price'), required =>"required"]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_accessory') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.update_accessory') }}
                                                    </button>
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
    </div>
    <!-- End Page -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('admin-assets/global/vendor/ascolor/jquery-asColor.min.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/ascolorpicker/jquery-asColorPicker.min.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/ascolorpicker.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/accessory/accessory.js') }}"></script>
@endpush
