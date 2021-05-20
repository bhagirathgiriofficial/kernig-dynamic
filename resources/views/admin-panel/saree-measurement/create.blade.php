@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Add Saree Measurement | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Saree Measurement</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.sareeMeasurement.index') }}">Saree Measurement</a></li>
            <li class="breadcrumb-item active">{{trans('language.create_saree_measurement')}}</li>
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
                                    <h4 class="example-title mb-1">Measurement Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-saree-measurement-form', 'method' => 'post', 'url' => route('adminPanel.sareeMeasurement.store'), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4 form-group required">
                                                        <label class="form-control-label" for="measurement_title">@lang('language.measurement_title')</label>
                                                        {!! Form::text('measurement_title', '', ['class' => 'form-control', 'id' => 'measurement_title', 'autocomplete' => 'off', 'placeholder' =>__('language.measurement_title'), 'maxLength' => '100', 'data-url' => route('adminPanel.sareeMeasurement.checkMeasurementTitle')]) !!}
                                                    </div>
                                                    <div class="col-md-4 form-group required">
                                                        <label class="form-control-label" for="measurement_price">@lang('language.measurement_price')</label>
                                                        {!! Form::number('measurement_price', '', ['class' => 'form-control', 'min' => 0, 'max' => 99999,  'step' => 'any', 'id' => 'measurement_price', 'autocomplete' => 'off', 'placeholder' =>__('language.measurement_price'), ]) !!}
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label class="form-control-label" for="custom">@lang('language.custom_measurement')</label>
                                                        <select name="custom" id="custom" class="form-control">
                                                            <option value=""> Select Custom Measurement </option>
                                                            @foreach($custom as $value)
                                                            <option value="{{$value['measurement_id']}}"> {{$value['measurement_title']}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.create_saree_measurement') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.create_saree_measurement') }}
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
<script src="{{ asset('admin-assets/global/vendor/dropify/dropify.min.js') }}"></script>
<script type="text/javascript">
$('.dropify').dropify();

</script>
<script src="{{ asset('admin-assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/sareeMeasurement/measurement.js') }}"></script>
@endpush
