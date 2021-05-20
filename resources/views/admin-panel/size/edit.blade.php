@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Size | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Size</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.size.index') }}">Size</a></li>
            <li class="breadcrumb-item active">Update Size</li>
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
                                    <h4 class="example-title mb-1">Size Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-size-form', 'method' => 'post', 'url' => route('adminPanel.size.update', ['id' => ev($size->size_id)]), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="size_name">@lang('language.size_name')</label>
                                                            {!! Form::number('size_name', old('size_name',(floatval($size->size_measure) ?? '')), ['class' => 'form-control', 'id' => 'size_name', 'autocomplete' => 'off', 'placeholder' =>__('language.size_name'),'step' => 'any', 'min' => 0 , 'max' => 99999, 'maxLength' => 6, 'data-url' => route('adminPanel.size.checkSizeTitle', ['id' => ev($size->size_id)])]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="size_price">@lang('language.size_price')</label>
                                                            {!! Form::number('size_price', old('size_price', ($size->price_percent ?? '')), ['class' => 'form-control', 'id' => 'size_price', 'autocomplete' => 'off', 'placeholder' =>__('language.size_price'), 'step' => 'any', 'min' => 0 , 'maxLength' => 6])!!}
                                                        </div>
                                                    </div>
                                                   <!--  <div class="col-md-4">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="size_order">@lang('language.size_order')</label>
                                                            {!! Form::number('size_order', old('size_order', ($size->size_order ?? '')), ['class' => 'form-control', 'id' => 'size_order', 'autocomplete' => 'off', 'placeholder' =>__('language.size_order'), 'step' => 1, 'min' => 0 ])!!}
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_size') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.update_size') }}
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
<script src="{{ asset('admin-assets/js/size/size.js') }}"></script>
@endpush
