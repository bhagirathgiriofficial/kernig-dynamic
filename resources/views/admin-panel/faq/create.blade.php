@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Add Faq | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Faq</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.faq.index') }}">Faq</a></li>
            <li class="breadcrumb-item active">{{trans('language.create_faq')}}</li>
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
                                    <h4 class="example-title mb-1">Faq Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-faq-form', 'method' => 'post', 'url' => route('adminPanel.faq.store')]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12 form-group required">
                                                                <label class="form-control-label" for="faq_question">@lang('language.faq_question')</label>
                                                                {!! Form::text('faq_question', '', ['class' => 'form-control', 'id' => 'faq_question', 'autocomplete' => 'off', 'placeholder' =>__('language.faq_question'), 'maxLength' => '500' ,'data-url' => route('adminPanel.faq.checkQuestion')]) !!}
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group required">
                                                                    <label class="form-control-label" for="faq_answer">@lang('language.faq_answer')
                                                                    </label>
                                                                    <div class="total-char">(Note: Upto 3000 characters only)</div>
                                                                    {!! Form::textarea('faq_answer', '', ['class' => 'form-control count-me', 'maxLength' => 3000, 'id' => 'faq_answer', 'autocomplete' => 'off']) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.create_faq') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.create_faq') }}
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
<script src="{{ asset('admin-assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/faq/faq.js') }}"></script>
<script src="{{ asset('admin-assets/js/char-count.js') }}"></script>
@endpush
