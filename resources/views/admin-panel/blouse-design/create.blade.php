@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Add Blouse Design | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Blouse</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.blouse.index') }}">Blouse Design</a></li>
            <li class="breadcrumb-item active">{{trans('language.create_blouse')}}</li>
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
                                    <h4 class="example-title mb-1">Blouse Design Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-blouse-design-form', 'method' => 'post', 'url' => route('adminPanel.blouse.store'), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group required">
                                                                <label class="form-control-label" for="blouse_title">@lang('language.blouse_title')</label> 
                                                                {!! Form::text('blouse_title', '', ['class' => 'form-control', 'id' => 'blouse_title', 'autocomplete' => 'off', 'maxLength' => 100, 'placeholder' =>__('language.blouse_title'), required =>"required", 'data-url' => route('adminPanel.blouse.checkBlouseTitle')])!!}
                                                            </div>
                                                           <!--  <div class="col-md-12 form-group">
                                                                <label class="form-control-label" for="blouse_order">@lang('language.blouse_order')</label>
                                                                {!! Form::number('blouse_order', '0', ['class' => 'form-control', 'id' => 'blouse_order', 'autocomplete' => 'off', 'placeholder' =>__('language.blouse_order'), 'min' => 0 ]) !!}
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label for="input-file-disable-remove form-control-label">Blouse Design Image | Note: Image size (width 600px and height 450px)</label>
                                                            <div class="text-primary">(Note: Only jpeg, jpg, gif, png images are allowed)</div>
                                                            <input type="file" name="blouse_design_image" id="input-file-disable-remove" class="dropify" data-show-remove="true" data-default-file="" required="required"/>
                                                              <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.create_blouse') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.create_blouse') }}
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
<script src="{{ asset('admin-assets/js/blouse/blouse.js') }}"></script>
@endpush
