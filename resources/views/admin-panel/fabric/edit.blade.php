@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Fabric | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Fabric</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.fabric.index') }}">Fabric</a></li>
            <li class="breadcrumb-item active">Update Fabric</li>
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
                                    <h4 class="example-title mb-1">Fabric Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-fabric-form', 'method' => 'post', 'url' => route('adminPanel.fabric.update', ['id' => ev($fabric->fabric_id)]), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="fabric_name">@lang('language.fabric_name')</label>
                                                            {!! Form::text('fabric_name', old('fabric_name', ($fabric->fabric_name ?? '')), ['class' => 'form-control', 'id' => 'fabric_name', 'autocomplete' => 'off','maxLength' => '100', 'placeholder' =>__('language.fabric_name'), 'data-url' => route('adminPanel.fabric.checkFabricName', ['id' => ev($fabric->fabric_id)]),]) !!}
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="fabric_order">@lang('language.fabric_order')</label>
                                                            {!! Form::number('fabric_order', old('fabric_order', ($fabric->fabric_order ?? '')), ['class' => 'form-control', 'id' => 'fabric_order', 'autocomplete' => 'off', 'placeholder' =>__('language.fabric_order'), 'data-url' => route('adminPanel.fabric.checkFabricName'), 'min' => 0]) !!}
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-20">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_fabric') }}">
                                                    <i class="fa fa-save"></i> &nbsp; {{ __('language.update_fabric') }}
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
<script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/fabric/fabric.js') }}"></script>
@endpush
