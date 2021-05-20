@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Gallery | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Gallery</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.gallary.index') }}">Gallery</a></li>
            <li class="breadcrumb-item active">{{trans('language.update_gallary')}}</li>
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
                                    <h4 class="example-title mb-1">Gallery Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-gallary-form', 'method' => 'post', 'url' => route('adminPanel.gallary.update', ['id' => ev($gallary->image_id)]), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-12 form-group required">
                                                                <label class="form-control-label" for="image_title">@lang('language.image_title')</label>
                                                                {!! Form::text('image_title', old(image_title, ($gallary->image_title ??'')), ['class' => 'form-control', 'id' => 'image_title', 'autocomplete' => 'off', 'placeholder' =>__('language.image_title'), 'data-url' => route('adminPanel.gallary.checkGallaryTitle', ['id' => ev($gallary->image_id)])]) !!}
                                                            </div>
                                                            <!-- <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="image_description">@lang('language.image_description') | 
                                                                    </label>
                                                                    <span id="total-char">Upto 3000 characters only</span>
                                                                    {!! Form::textarea('image_description', old(image_description , ($gallary->image_desc ??'')), ['class' => 'editor-textarea', 'id' => 'image_description', 'autocomplete' => 'off']) !!}
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group required">
                                                            <label for="input-file-disable-remove"> @lang('language.gallary_image') </label>
                                                            <span class="text-primary">(Note: Only jpeg, jpg, gif, png images are allowed)</span>
                                                            <input type="file" name="gallary_image" id="input-file-disable-remove" class="dropify" data-show-remove="false" data-default-file="{{$image_url}}" />
                                                            <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_gallary') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.update_gallary') }}
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
<script src="{{ asset('admin-assets/js/gallary/gallary.js') }}"></script>
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
