@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Category | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">Category</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.category.index') }}">Category</a></li>
            <li class="breadcrumb-item active">Update Category</li>
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
                                    <h4 class="example-title mb-1">Category Information</h4>
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-category-form', 'method' => 'post', 'url' => route('adminPanel.category.update',['id' => ev($category->category_id)]), 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="category_name">@lang('language.category_name')</label>
                                                            {!! Form::text('category_name', old('category_name',($category->category_name ?? '')), ['class' => 'form-control','maxLength' => '100' , 'id' => 'category_name', 'autocomplete' => 'off', 'placeholder' =>__('language.category_name'), required =>"required", 'data-url' => route('adminPanel.category.checkCategoryName',['id' => ev($category->category_id)])]) !!}
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group not-required">
                                                            <label class="form-control-label" for="category_order">@lang('language.category_order')</label>
                                                            {!! Form::number('category_order', old('category_order',($category->category_order ?? '')), ['class' => 'form-control', 'id' => 'category_order', 'autocomplete' => 'off', 'placeholder' =>__('language.category_order'), required =>"required", 'min' => 0, 'max' => '99999' , ]) !!}
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-6">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="description">Is Root Category</label>
                                                            <select name="isRoot" class="form-control change-is-root select-picker" id="isRoot" required="required">
                                                                @if($category->category_root_id == 0)
                                                                <option selected="" value="1">Yes</option>
                                                                <option value="2">No</option>
                                                                @else
                                                                <option value="1">Yes</option>
                                                                <option selected="" value="2">No</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group not-required">
                                                            <label class="form-control-label" for="description">Parent Category
                                                            </label>
                                                            <select name="parent" class="form-control change-parent select-picker" id="parent" data-sub-parent-url="{{route('adminPanel.category.subParents')}}" {{$category->category_root_id == 0 ? "disabled" : ""}}>
                                                                <option value=""> Select Parent Category </option>
                                                                @foreach($categories as $value)
                                                                <option value="{{ $value->category_id }}" {{$value->category_id == $category->category_root_id ? "Selected" : "" }}> {{ $value->category_name }} </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group not-required">
                                                            <label class="form-control-label" for="description">Sub Parent Category (If Any)
                                                            </label>
                                                            <select name="subParent" class="form-control change-sub-parent select-picker" id="subParent" {{$category->category_root_id == 0 ? "disabled" : ""}}>
                                                                <option value="0">Select Sub Parent Category </option>
                                                                @foreach($sub_categories as $sub_value)
                                                                <option value="{{$sub_value->category_id}}" {{$sub_value->category_id == $category->category_subroot_id ? "selected" : "" }}>{{$sub_value->category_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group required">
                                                            <label class="form-control-label" for="category_heading">@lang('language.category_heading')</label>
                                                            {!! Form::text('category_heading', old('category_heading',($category->category_heading ?? '')), ['class' => 'form-control','maxLength' => '200' , 'id' => 'category_heading', 'autocomplete' => 'off', 'placeholder' =>__('language.category_heading')]) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="input-file-disable-remove">Category Image</label>
                                                            <input type="file" name="category_image" id="input-file-disable-remove" class="dropify" data-show-remove="false" data-default-file="{{$category_image}}" data-check-extenstion="1" />
                                                            <div class="invalid-feedback extension-error1">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="input-file-disable-remove">Measurement Chart</label>
                                                            <input type="file" name="category_chart" id="input-file-disable-remove" class="dropify" data-show-remove="false" data-default-file="{{$size_chart}}"  data-check-extenstion="2"/>
                                                            <div class="invalid-feedback extension-error2">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="category_description">@lang('language.category_description')
                                                            </label>
                                                            <div id="total-char"> (Note: Upto 3000 characters only) </div>
                                                            {!! Form::textarea('category_description', old('category_description', ($category->category_desc ?? '')), ['class'=>'editor-textarea', 'id' => 'category_description','autocomplete' => 'off']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="meta_title">@lang('language.meta_title')
                                                            </label>
                                                            <div class="total-char">(Note: Upto 3000 characters only)</div>
                                                            {!! Form::textarea('meta_title', old('meta_title', ($category->category_meta_title ?? "")), ['class' => 'form-control count-me', 'rows' => 6, 'maxLength' => '3000', 'id' => 'meta_title', 'autocomplete' => 'off']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- For Meta Keywords and descriptions -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="category_description">@lang('language.meta_description')
                                                            </label>
                                                            <div class="total-char">(Note: Upto 3000 characters only)</div>
                                                            {!! Form::textarea('meta_description', old('meta_description', ($category->category_meta_description ?? "")), ['class' => 'form-control count-me', 'maxLength' => '3000', 'id' => 'meta_description', 'autocomplete' => 'off']) !!}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="meta_title">@lang('language.meta_keywords')
                                                            </label>
                                                            <div class="total-char">(Note: Upto 3000 characters only)</div>
                                                            {!! Form::textarea('meta_keywords', old('meta_keywords', ($category->category_meta_keywords ?? "")), ['class' => 'form-control count-me', 'maxLength' => '3000', 'id' => 'meta_keywords', 'autocomplete' => 'off']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_category') }}">
                                                        <i class="fa fa-save"></i> &nbsp; {{ __('language.update_category') }}
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

<style type="text/css">
    .note-editor.note-frame .note-editing-area{
        height: 128px;
    }
</style>
<script type="text/javascript">
    $('.dropify').dropify();
    $('.dropify').on("change",function(e) {
        var check = $(this).data('check-extenstion');
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
            if (check == 1) {
                $(".extension-error1").fadeIn(100);
            } else {
                $(".extension-error2").fadeIn(100);
            }
            drEvent.resetPreview();
            drEvent.clearElement();
        }else{
           if (check == 1) {
            $(".extension-error1").fadeOut(100);
        } else {
            $(".extension-error2").fadeOut(100);
        }
    }
})
</script>
<script src="{{ asset('admin-assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/category/category.js') }}"></script>
<script src="{{ asset('admin-assets/js/char-count.js') }}"></script>
@endpush
