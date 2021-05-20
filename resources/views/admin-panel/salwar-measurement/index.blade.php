@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Salwar Measurement | Admin Panel')
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
            <li class="breadcrumb-item active">Update Salwar Measurement</li>
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
                                        {!! Form::open(['class' => 'add-salwar-measurement-form', 'method' => 'post', 'url' => $url, 'files' => true ]) !!}
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <input type="hidden" name="salwar_id" value="$salwar->salwar_measurement_id" />
                                                            <div class="col-md-6 form-group required">
                                                                <label class="form-control-label" for="measurement_title">@lang('language.measurement_title')</label>
                                                                {!! Form::text('measurement_title', $salwar->salwar_measurement_titles ? $salwar->salwar_measurement_titles : '' , ['class' => 'form-control', 'id' => 'measurement_title', 'autocomplete' => 'off','maxLength' => 100, 'placeholder' =>__('language.measurement_title'), 'data-url' => route('adminPanel.measurement.checkMeasurementTitle')]) !!}
                                                            </div>
                                                            <div class="col-md-6 form-group required">
                                                                <label class="form-control-label" for="measurement_price">@lang('language.measurement_price')</label>
                                                                {!! Form::text('measurement_price', $salwar->salwar_measurement_price ? $salwar->salwar_measurement_price : '' , ['class' => 'form-control', 'id' => 'measurement_price', 'max' => 99999, 'autocomplete' => 'off', 'placeholder' =>__('language.measurement_price'), ]) !!}
                                                            </div>
                                                           <!--  <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="measurement_description">@lang('language.measurement_desc') | 
                                                                    </label><span class="total-char"> Upto 1000 characters only</span>
                                                                    {!! Form::textarea('measurement_description', $salwar->salwar_description ? $salwar->salwar_description : '', ['class' => 'form-control count-me','maxLength' => 1000, 'required' => 'true' , 'rows' => 5, 'id' => 'measurement_description', 'autocomplete' => 'off']) !!}
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group required">
                                                            <label for="input-file-disable-remove">Size Chart </label>
                                                            <input type="file" name="size_chart" id="input-file-disable-remove" class="dropify" data-show-remove="false" data-default-file="{{ get_image_url(config('constants.salwarMeasurement.images_path'), $salwar->salwar_measurement_chart)}}" data-allowed-file-extensions="jpeg jpg gif png"/>
                                                            <div class="text-primary"> (Note: Only jpeg, jpg, gif, png images are allow) </div>    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- Begin for top -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-9 form-control-label"> <b>{{ trans('language.salwar_measurement_top')}} </b></label>
                                                            <!-- <div class="col-md-3 add-more-btn">
                                                                <button type="button" class="btn btn-floating btn-primary float-right btn-sm mt-1" data-toggle="tooltip" data-placement="left" data-trigger="hover" data-original-title="Add More"><i class="icon wb-plus" aria-hidden="true" id="addrow1" data-count="@if(!empty($top)){{count($top)}} @else 0 @endif"></i></button>
                                                            </div> -->
                                                        </div>
                                                        <div id="myTable" class="order-list1">
                                                            @if(!empty($top))
                                                            @foreach($top as $key => $value)
                                                            <div class="add-section-panel">
                                                                <div class="panel border">
                                                                    <div class="panel-heading">
                                                                        <h3 class="panel-title">Title {{$key+1}} </h3>
                                                                        <!-- <div class="panel-actions panel-actions-keep font-size-18 text-danger btn-remove ibtnDel" data-id="{{$value->top_id}}" data-url="{{route('adminPanel.salwarMeasurement.destroy')}}">
                                                                            <i class="icon wb-trash" aria-hidden="true"></i>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="panel-body pb-10">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group required">
                                                                                    <input type="hidden" name="top[{{$key}}][id]" value="{{$value->top_id}}" />
                                                                                    <label class="display-block form-control-label" for="title"> Title</label>
                                                                                    <textarea rows="3" class="form-control spaceValidation" autocomplete="off" name="top[{{$key}}][title]" type="text" required="">{{$value->top_title}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group required">
                                                                                    <label class="display-block form-control-label" for="description"> Description </label>
                                                                                    <textarea rows="3" class="form-control spaceValidation" autocomplete="off" name="top[{{$key}}][description]" type="text" required="">{{$value->top_description}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- End for top -->
                                                    <!-- Begin for bottom -->
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <label class="col-md-9 form-control-label"> <b>{{ trans('language.salwar_measurement_bottom')}} </b></label>
                                                            <!-- <div class="col-md-3 add-more-btn">
                                                                <button type="button" class="btn btn-floating btn-primary float-right btn-sm mt-1" data-toggle="tooltip" data-placement="left" data-trigger="hover" data-original-title="Add More"><i class="icon wb-plus" aria-hidden="true" id="addrow2" data-count="@if(!empty($bottom)){{count($bottom)}} @else 0 @endif"></i></button>
                                                            </div> -->
                                                        </div>
                                                        <div id="myTable" class="order-list2">
                                                            @if(!empty($bottom))
                                                            @foreach($bottom as $key => $value)
                                                            <div class="add-section-panel">
                                                                <div class="panel border">
                                                                    <div class="panel-heading">
                                                                        <h3 class="panel-title">Title {{$key+1}}</h3>
                                                                        <!-- <div class="panel-actions panel-actions-keep font-size-18 text-danger btn-remove ibtnDel" data-id="{{$value->bottom_id}}" data-url="{{route('adminPanel.salwarMeasurement.destroy')}}">
                                                                            <i class="icon wb-trash" aria-hidden="true"></i>
                                                                        </div> -->
                                                                    </div>
                                                                    <div class="panel-body pb-10">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group required">
                                                                                    <input type="hidden" name="bottom[{{$key}}][id]" value="{{$value->bottom_id}}" />
                                                                                    <label class="display-block form-control-label" for="title"> Title</label>
                                                                                    <textarea rows="3" class="form-control spaceValidation" autocomplete="off" name="bottom[{{$key}}][title]" type="text" required="">{{$value->bottom_title}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <div class="form-group required">
                                                                                    <label class="display-block form-control-label" for="description"> Description </label>
                                                                                    <textarea rows="3" class="form-control spaceValidation" autocomplete="off" name="bottom[{{$key}}][description]" type="text" required="">{{$value->bottom_description}}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <!-- End for bottom -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-20">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="@if(!empty($salwar)) {{ __('language.update_salawar_measurement')}} @else {{ __('language.create_salwar_measuerment') }} @endif">
                                                        <i class="fa fa-save"></i> &nbsp; @if(!empty($salwar)) {{ __('language.update_salawar_measurement')}} @else {{ __('language.create_salwar_measuerment') }} @endif
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
<script src="{{ asset('admin-assets/js/salwar-measurement/measurement.js') }}"></script>
<script src="{{ asset('admin-assets/js/char-count.js') }}"></script>
@endpush
