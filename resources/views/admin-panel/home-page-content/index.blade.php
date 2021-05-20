@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Home Page Content | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header"> 
        <h1 class="page-title">Home Page Content</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Home Page Content</a></li>
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

            <!-- Type of the page -->
            @php 
            $type  = Request::segment(3);
            @endphp
            <!-- / Validation error -->
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <!-- Example Basic Form (Form grid) -->
                                <div class="example-wrap">
                                    <h4 class="example-title mb-1">Home Page Content</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-homePageContent-form', 'method' => 'post', 'url' => route('adminPanel.homePageContent.update',['type' => $type]), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    @foreach($homePage as $key => $value)
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <input type="hidden" name="homePageContent[{{$key}}][id]'" value="{{ev($value->id)}}" />
                                                                <div class="form-group required">
                                                                    <label class="form-control-label" for="title">@lang('language.home_page_content_title') {{$key+1}}</label>
                                                                    {!! Form::text('homePageContent['.$key.'][title]', old('title' ,($value->title ?? '')), 
                                                                        [
                                                                         'class'   => 'form-control valid-me', 
                                                                         'id' => 'title'.$value->id, 
                                                                         'autocomplete' => 'off', 
                                                                         'placeholder' =>__('language.home_page_content_title'),
                                                                         'maxLength' => 190,
                                                                        ]
                                                                    ) !!}
                                                                </div>
                                                                <div class="form-group required">
                                                                    <label class="form-control-label" for="link">@lang('language.home_page_content_link')</label>
                                                                    {!! Form::url('homePageContent['.$key.'][link]', old('link', ($value->link ?? '')),
                                                                        [
                                                                        'required'=> '' ,
                                                                        'class' => 'form-control', 
                                                                        'id' => 'link'.$value->id, 
                                                                        'autocomplete' => 'off', 
                                                                        'placeholder' =>'https://www.bagteshfashion.com',
                                                                        'maxLength' => 190,
                                                                        ]
                                                                    ) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group required">
                                                                    <label for="input-file-disable-remove">@lang('language.home_page_content_image')</label>
                                                                    <input type="file" name="homePageContent[{{$key}}][image]" id="input-file-disable-remove" class="dropify valid-image" data-show-remove="false" data-default-file="{{get_image_url(config('constants.homePageContent.images_path'),$value->image)}}" data-allowed-file-extensions="jpeg jpg gif png" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-20">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_home_page_content') }}">
                                                    <i class="fa fa-save"></i> &nbsp; {{ __('language.update_home_page_content') }}
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
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/home-page-content/homePageContent.js') }}"></script>
@endpush
