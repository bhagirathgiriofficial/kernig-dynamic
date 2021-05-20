@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Profile | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/assets/examples/css/pages/profile.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Profile</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profile</li>
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
            <div class="row">
                <div class="col-lg-3">
                    <!-- Page Widget -->
                    <div class="card card-shadow ">
                        <div class="card-block text-center pb-10">
                            <a class="avatar avatar-lg" href="javascript:void(0)">{!! show_user_image(auth()->user()->profile_image, auth()->user()->name) !!}</a>
                            <h4 class="profile-user">{{ title_case($user->name) }}</h4>
                        </div>
                        <div class="card-block card-footer p-20">
                            <h4 class="card-title pb-1">
                                Contact Information
                            </h4>
                            @if ($user->mobile_number)
                            <p data-info-type="phone" class="mb-10 pl-1 text-nowrap">
                                <i class="icon wb-mobile mr-10"></i>
                                <span class="text-break">@lang('language.mobile_prefix') - {{ title_case($user->mobile_number) }}</span>
                            </p>
                            @endif
                            <p data-info-type="email" class="mb-10 pl-1 text-nowrap">
                                <i class="icon wb-envelope mr-10"></i>
                                <span class="text-break">{{ $user->email }}</span>
                            </p>
                        </div>
                    </div>
                    <!-- End Page Widget -->
                </div>
                <div class="col-lg-9">
                    <!-- Panel -->
                    <div class="panel">
                        <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
                            <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="{{ old('is_change_password_form') ? '' : 'active' }} nav-link" data-toggle="tab" href="#editprofile" aria-controls="editprofile" role="tab">
                                        Edit Profile
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="{{ old('is_change_password_form') ? 'active' : '' }} nav-link" data-toggle="tab" href="#changepassword" aria-controls="changepassword" role="tab">
                                        Change Password
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane {{ old('is_change_password_form') ? '' : 'active' }} animation-slide-left" id="editprofile" role="tabpanel">
                                    {!! Form::open(['class' => 'update-profile-form', 'url' => route('adminPanel.profile.update'), 'files' => true ]) !!}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="example-wrap pt-20">
                                                <div class="">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="image">@lang('language.choose_profile_pic')</label>
                                                        {!! Form::file('image', ['class' => 'image-preview', 'id' => 'image', 'autocomplete' => 'off', 'data-default-file' => (get_image_url(config('constants.adminUsers.images_path'), $user->profile_image) ?? ''), 'data-show-remove' => 'false']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="example-wrap">
                                                <div class="example">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="name">@lang('language.name')</label>
                                                                {!! Form::text('name', old('name', ($user->name ?? null)), ['class' => 'form-control', 'id' => 'name', 'autocomplete' => 'off', 'placeholder' =>__('language.name'), ]) !!}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="email">@lang('language.email')</label>
                                                                {!! Form::text('email', old('email', ($user->email ?? null)), ['class' => 'form-control', 'id' => 'email', 'autocomplete' => 'off', 'placeholder' => __('language.email'), 'readonly']) !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="mobile_number">@lang('language.mobile')</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">@lang('language.mobile_prefix')</span>
                                                                    </div>
                                                                    {!! Form::text('mobile_number', old('mobile_number', ($user->mobile_number ?? null)), ['class' => 'form-control', 'id' => 'mobile_number', 'autocomplete' => 'off', 'placeholder' => __('language.mobile')]) !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary btn-submit">
                                                            <i class="fa fa-save"></i> &nbsp; {{ __('language.update_profile') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div class="tab-pane {{ old('is_change_password_form') ? 'active' : '' }} animation-slide-left" id="changepassword" role="tabpanel">
                                    <div class="example-wrap">
                                        <div class="example">
                                            {!! Form::open(['class' => 'change-password-form', 'url' => route('adminPanel.profile.changePassword') ]) !!}
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="current_password">@lang('language.current_password')</label>
                                                        {!! Form::password('current_password', ['class' => 'form-control show-hide-me', 'id' => 'current_password', 'autocomplete' => 'off', 'placeholder' => __('language.current_password')]) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="new_password">@lang('language.new_password')</label>
                                                        {!! Form::password('new_password', ['class' => 'form-control show-hide-me', 'id' => 'new_password', 'autocomplete' => 'off', 'placeholder' => __('language.new_password')]) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="new_password_again">@lang('language.new_password_again')</label>
                                                        {!! Form::password('new_password_again', ['class' => 'form-control show-hide-me', 'id' => 'new_password_again', 'autocomplete' => 'off', 'placeholder' => __('language.new_password_again')]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-submit">
                                                    <i class="fa fa-save"></i> &nbsp; {{ __('language.change_password') }}
                                                </button>
                                                <button type="button" class="btn btn-primary" id="showPassword" data-flag="1">
                                                     Show Password
                                                </button>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Panel -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Page -->
</div>
@endsection
@push('scripts')
<script src="{{ asset('admin-assets/global/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/profile/profile.js') }}"></script>
@endpush
