@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Add Measurement | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Measurement</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.measurement.index') }}">Measurement</a></li>
            <li class="breadcrumb-item active">{{trans('language.create_measuerment')}}</li>
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
                                        {!! Form::open(['class' => 'add-measurement-form', 'method' => 'post', 'url' => route('adminPanel.measurement.store'), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group required">
                                                                <label class="form-control-label" for="measurement_title">@lang('language.measurement_title')</label>
                                                                {!! Form::text('measurement_title', '', ['class' => 'form-control', 'id' => 'measurement_title', 'autocomplete' => 'off', 'placeholder' =>__('language.measurement_title'), 'maxLength' => 100,  'data-url' => route('adminPanel.measurement.checkMeasurementTitle')]) !!}
                                                            </div>
                                                            <div class="col-md-6 form-group required">
                                                                <label class="form-control-label" for="measurement_price">@lang('language.measurement_price')</label>
                                                                {!! Form::number('measurement_price', '', ['class' => 'form-control', 'id' => 'measurement_price', 'autocomplete' => 'off', 'placeholder' =>__('language.measurement_price'),  'data-url' => route('adminPanel.measurement.checkMeasurementTitle'), 'step' =>'any', 'min' => 0, 'max' => 99999]) !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group required">
                                                                    <label class="form-control-label" for="measurement_description">@lang('language.measurement_desc')
                                                                    </label>
                                                                    <span class="total-char"> (Note: Upto 3000 characters only) </span>
                                                                    {!! Form::textarea('measurement_description', '', ['class' => 'form-control count-me', 'maxLength' => 3000, 'id' => 'measurement_description', 'rows' => 5, 'autocomplete' => 'off']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label for="input-file-disable-remove">Size Chart </label>
                                                            <span class="text-primary"> (Note: Only jpeg, jpg, gif, png images are allow) </span>
                                                            <input type="file" name="size_chart" id="input-file-disable-remove" class="dropify" data-show-remove="true" data-default-file="" required="true" />
                                                             <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table id="myTable" class=" table order-list">
                                                            <thead>
                                                                <tr>
                                                                    <td class="required" width="33.33%"><label>Title</label></td>
                                                                    <td class="required" width="99.66%"><label>{{ trans('language.measurement_tip') }}</label></td>
                                                                    <td align="center"> Action </td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" name="measurement[0][title]" class="form-control" autocomplete="off" required="" maxlength="100" />
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="measurement[0][tip]" class="form-control" autocomplete="off" required=""  maxlength="2000"/>
                                                                    </td>
                                                                </td>
                                                                <td>
                                                                    <input type="button" class="btn btn-primary" id="addrow" value="Add Row" />
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-20">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.create_measuerment') }}">
                                                    <i class="fa fa-save"></i> &nbsp; {{ __('language.create_measuerment') }}
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
  $('.dropify').on("change",function(e) {
    var drEvent = $(this);
    drEvent = drEvent.data('dropify');
    var _imgExts = ["jpg", "jpeg", "png", "gif"];
    var fileName = e.target.files[0].name;
    var extension = fileName.substr( (fileName.lastIndexOf('.') +1) );
    var result = false;
    var i;
    if (extension) {
        extension = extension.toLowerCase();
        for (i = 0; i < _imgExts.length; i++) {
            if (_imgExts[i].toLowerCase() === extension) {
                result = true;
                break;
            }
        }
    }
    if (!result) {
            // $("#input-file-disable-remove-error").html("This file is now allowed, Please check!");
            $(".extension-error").fadeIn(100);
            drEvent.resetPreview();
            drEvent.clearElement();
        }else{
            $(".extension-error").fadeOut(200);
        }
    })
</script>
<script src="{{ asset('admin-assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/measurement/measurement.js') }}"></script>
<script src="{{ asset('admin-assets/js/char-count.js') }}"></script>
@endpush

