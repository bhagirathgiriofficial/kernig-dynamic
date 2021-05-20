@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Color | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-assets/global/vendor/ascolorpicker/asColorPicker.css') }}">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Color</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.color.index') }}">Color</a></li>
            <li class="breadcrumb-item active">{{ __('language.update_color') }}</li>
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
                                    <h4 class="example-title mb-1">color Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-color-form', 'method' => 'post', 'url' => route('adminPanel.color.update', ['id' => ev($color->color_id)]), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="color_name">@lang('language.color_name')</label>
                                                            {!! Form::text('color_name', old('color_name', ($color->color_name ?? '')), ['class' => 'form-control', 'id' => 'color_name','maxLength' => '100', 'autocomplete' => 'off', 'placeholder' =>__('language.color_name'), required =>"required", 'data-url' => route('adminPanel.color.checkColorName', ['id' => ev($color->color_id)])]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="colorpicker1">@lang('language.color_code')</label>
                                                            <br />
                                                            <input type="color" class="form-control asColorpicker" data-plugin="asColorPicker" data-mode="simple" value="{{$color->color_code}}" name="colorpicker1" id="colorpicker1" required="required" data-url="{{route('adminPanel.color.checkColorName')}}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-20">
                                                    <div class="form-group mb-0">
                                                        <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_color') }}">
                                                            <i class="fa fa-save"></i> &nbsp; {{ __('language.update_color') }}
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
</div>
    @endsection
    @push('scripts')
    <script src="{{ asset('admin-assets/global/vendor/ascolor/jquery-asColor.min.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/ascolorpicker/jquery-asColorPicker.min.js') }}"></script>
    <script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
    <script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
    <script src="{{ asset('admin-assets/global/js/Plugin/ascolorpicker.js') }}"></script>
    <script src="{{ asset('admin-assets/js/components.js') }}"></script>
    <script src="{{ asset('admin-assets/js/color/color.js') }}"></script>
    @endpush
