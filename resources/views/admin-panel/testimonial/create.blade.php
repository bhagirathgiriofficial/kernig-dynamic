@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Add Testimonial | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<style type="text/css">
    .switchery{
        width: 55px;
        height: 30px;
        margin-left:30px;
    }
    .switchery > small{
        width: 30px;
        height: 30px;
    }
</style>
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Testimonial</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.testimonial.index') }}">Testimonial</a></li>
            <li class="breadcrumb-item active">{{trans('language.create_testimonial')}}</li>
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
                                    <h4 class="example-title mb-1">Testimonial Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-testimonial-form', 'method' => 'post', 'url' => route('adminPanel.testimonial.store'), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-5 form-group required">
                                                                <label class="form-control-label" for="testimonial_name">@lang('language.testimonial_name')</label>
                                                                {!! Form::text('testimonial_name', '', ['class' => 'form-control count-me', 'id' => 'testimonial_name','maxLength' => '70','autocomplete' => 'off', 'placeholder' =>__('language.testimonial_name')]) !!}
                                                            </div>
                                                          <!--   <div class="col-md-2 form-group required">
                                                                <label class="form-control-label" for="testimonial_order">@lang('language.testimonial_order')</label>
                                                                {!! Form::number('testimonial_order', 0, ['class' => 'form-control', 'id' => 'testimonial_order', 'autocomplete' => 'off', 'placeholder' =>__('language.testimonial_order'), 'step' =>'any', 'min' => 0]) !!}
                                                            </div> -->
                                                            <div class="col-md-2 form-group  mt-5">
                                                                <label class="form-control-label" for="testimonial_order">@lang('language.testimonial_homepage')</label>
                                                                <input type="checkbox" class="mt-5 form-control" id="inputBasicOff" name="testimonial_homepage" data-plugin="switchery" data-color="#007bff"/>
                                                            </div>
                                                            <div class="col-md-5 form-group required">
                                                                <label class="form-control-label" for="testimonial_place">@lang('language.testimonial_place')</label>
                                                                {!! Form::text('testimonial_place', '', ['class' => 'form-control', 'id' => 'testimonial_place', 'autocomplete' => 'off','maxLength' => 100, 'placeholder' =>__('language.testimonial_place')]) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="testimonial_message">@lang('language.testimonial_message')
                                                            </label>
                                                            <b class="total-char"> (Note: Upto 1000 characters only) </b>
                                                            {!! Form::textarea('testimonial_message', '', [
                                                            'maxLength' => 1000 ,
                                                            'class' => 'form-control count-me',
                                                            'id' => 'testimonial_message',
                                                            'autocomplete' => 'off',
                                                            'rows' => '5',
                                                            'required' => 'true']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group required">
                                                            <label for="input-file-disable-remove">@lang('language.testimonial_image') </label>
                                                            <span class="text-primary"> 
                                                            (Note: Only jpeg, jpg, gif, png images are allow) </span>
                                                            <input type="file" name="testimonial_image" id="input-file-disable-remove" class="dropify" data-show-remove="true" data-default-file="" required="" /> 
                                                            <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.create_testimonial') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.create_testimonial') }}
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
<script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/testimonial/testimonial.js') }}"></script>
<script src="{{ asset('admin-assets/js/char-count.js') }}"></script>
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
@endpush
