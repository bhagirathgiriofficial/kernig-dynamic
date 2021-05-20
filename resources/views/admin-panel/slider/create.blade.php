@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Add Slider | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Slider</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.slider.index') }}">Slider</a></li>
            <li class="breadcrumb-item active">{{trans('language.create_slider_image')}}</li>
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
                                    <h4 class="example-title mb-1">slider Design Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-slider-form', 'method' => 'post', 'url' => route('adminPanel.slider.store'), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group required">
                                                                <label class="form-control-label" for="slider_title">@lang('language.slider_title')</label>
                                                                {!! Form::text('slider_title', '', ['class' => 'form-control', 'id' => 'slider_title', 'autocomplete' => 'off', 'minLength'=> 10, 'maxLength'=> 30, 'placeholder' =>__('language.slider_title'), 'data-url' => route('adminPanel.slider.checkSliderTitle')]) !!}
                                                            </div>
                                                            <div class="col-md-6 form-group required">
                                                                <label class="form-control-label" for="slider_link">@lang('language.slider_link')</label>
                                                                {!! Form::url('slider_link', '', ['class' => 'form-control', 'id' => 'slider_link', 'autocomplete' => 'off','maxLength'=> 3000, 'placeholder' =>__('language.slider_link').' e.g: (https://www.bagteshfashion.com/new)', 'data-bv-uri-message' => "The website address is not valid" ]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group required">
                                                            <label for="input-file-disable-remove">Short Description</label>
                                                            <!-- <span class="total-char">(Note: Upto 100 characters only)</span> -->
                                                            <textarea name="slider_description" class="form-control" rows="3" maxlength="100"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group required">
                                                            <label for="input-file-disable-remove">Slider Image ( SIZE: 1500 X  750 )</label>
                                                            <div class="text-primary"> (Note: Only jpeg, jpg, gif, png images are allow) </div>
                                                            <input type="file" name="slider_image" id="file_input" class="dropify" data-show-remove="true" data-default-file="" required=""/>
                                                            <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.create_slider_image') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.create_slider_image') }}
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
<script src="{{ asset('admin-assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/slider/slider.js') }}"></script>
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
            $(".extension-error").fadeIn(100);
            drEvent.resetPreview();
            drEvent.clearElement();
        }else{
            $(".extension-error").fadeOut(200);
        }
    })
</script>
<!-- <script src="{{ asset('admin-assets/js/char-count.js') }}"></script> -->
@endpush
