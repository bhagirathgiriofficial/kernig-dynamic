@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update '.$page->page_name.' | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Page</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Update {{$page->page_name}}</li>
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
                                    <h4 class="example-title mb-1">{{$page->page_name}} Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'update-page-form', 'method' => 'post', 'url' => route('adminPanel.page.update', ['id' => ev($page->page_id)]), 'files' => true ]) !!}
                                        <input type="hidden" name="id" value="{{ev($page->page_id)}}" />
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="page_name">@lang('language.page_name')</label>
                                                            {!! Form::text('page_name', old('page_name', ($page->page_name ?? '')), ['class' => 'form-control', 'id' => 'page_name', 'autocomplete' => 'off', 'disabled' => 'true' ,'placeholder' =>__('language.page_name')]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($page->image_flag!=0)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="input-file-disable-remove">Page Image</label>
                                                            <input type="file" name="page_image" id="input-file-disable-remove" class="dropify" data-show-remove="false" data-default-file="{{$image_path}}" data-allowed-file-extensions="jpeg jpg gif png" />
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($page->description_flag!=0)   
                                                <div class="row"> 
                                                    <div class="col-md-12 required">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="page_long_description">
                                                            @lang('language.page_long_description')
                                                            </label>
                                                             <div id="total-char"> (Note: Upto 3000 characters only) </div>
                                                            {!! Form::textarea('page_long_description', old('page_long_description', ($page->page_long_description ?? '')), 
                                                            [
                                                             'class' => 'editor-textarea',
                                                             'maxLength' => '3000',
                                                             'id' => 'page_long_description',
                                                             'autocomplete' => 'off',
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="page_short_description">@lang('language.page_short_description') </label>
                                                             <div class="total-char"> (Note: Upto 3000 characters only) </div>
                                                            {!! Form::textarea('page_short_description', old('page_short_description', ($page->page_short_description ?? '')), 
                                                            [
                                                            'class' => 'form-control count-me',
                                                            'maxLength' => '3000',
                                                            'id' => 'page_short_description',
                                                            'rows' => '6',
                                                            'autocomplete' => 'off'
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="page_meta_title">@lang('language.meta_title')</label>
                                                            <div class="total-char">(Note: Upto 3000 characters only)</div>
                                                            {!! Form::textarea('page_meta_title', old('page_meta_title', ($page->page_meta_title ?? '')), 
                                                            [
                                                            'class' => 'form-control count-me',
                                                            'rows' => '6',
                                                            'maxLength' => '3000',
                                                            'id' => 'page_meta_title',
                                                            'autocomplete' => 'off'
                                                             ]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="page_meta_title">@lang('language.meta_title')</label>
                                                            <div class="total-char">(Note: Upto 3000 characters only)</div>
                                                            {!! Form::textarea('page_meta_title', old('page_meta_title', ($page->page_meta_title ?? '')), 
                                                            [
                                                            'class' => 'form-control count-me',
                                                            'rows' => '6',
                                                            'maxLength' => '3000',
                                                            'id' => 'page_meta_title',
                                                            'autocomplete' => 'off'
                                                             ]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif  
                                                <!-- For Meta Keywords and descriptions -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="page_meta_keyword">@lang('language.meta_keywords')
                                                            </label>
                                                            <div class="total-char">(Note: Upto 3000 characters only)</div>
                                                            {!! Form::textarea('page_meta_keyword', old('page_meta_keyword', ($page->page_meta_keyword ?? '')), 
                                                            [
                                                            'class' => 'form-control count-me',
                                                            'maxLength' => '3000', 
                                                            'id' => 'page_meta_keyword',
                                                            'autocomplete' => 'off'
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="page_meta_description">@lang('language.meta_description')
                                                            </label>
                                                            <div class="total-char">(Note: Upto 3000 characters only)</div>
                                                            {!! Form::textarea('page_meta_description', old('page_title', ($page->page_meta_description ?? '')), 
                                                            [
                                                            'class' => 'form-control count-me',
                                                            'maxLength' => '3000',
                                                            'id' => 'page_meta_description',
                                                            'autocomplete' => 'off'
                                                            ]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_page') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.update_page') }}
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
<script src="{{ asset('admin-assets/js/page/page.js') }}"></script>
<script src="{{ asset('admin-assets/js/char-count.js') }}"></script>
@endpush
