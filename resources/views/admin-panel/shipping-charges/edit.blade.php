@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Update Shipping Charges | Admin Panel')
@push('styles')

<link href="{{ asset('admin-assets/css/select2.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/select2/select2.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <h1 class="page-title">{{$country->country_name}}'s Shipping Charges</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('adminPanel.shippingCharges.index') }}">Shipping Charges</a></li>
            <li class="breadcrumb-item active">Update {{$country->country_name}}'s Charges</li>
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
                                    <p class="">Please fill the below information.</p>
                                    <div class="example">
                                        {!! Form::open(['class' => 'add-shipping-form', 'method' => 'post', 'url' => route('adminPanel.shippingCharges.update',['id' => ev($country->country_id)]), 'files' => true ]) !!}
                                        <div class="row" id="shipping_data">
                                            @for($i = 0;$i<40;$i++) 
                                            @if($i==0)
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="hidden" name="shipping[{{$i}}][id]" value="{{$shipping[$i][shipping_id]}}">
                                                            <label class="form-control-label" for="shipping_weight">Weight {{$i+1}} (gms)</label>
                                                            <input type="number" min="0"  name="shipping[{{$i}}][weight]" class="form-control shipping-weight" autocomplete="off" placeholder="{{__('language.shipping_weight')}}" value="{{$shipping[$i][shipping_weight]}}"  required="" step="1" maxlength="10"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="shipping_charges">Charges {{$i+1}}</label>
                                                            <input type="number" min="0"  name="shipping[{{$i}}][charges]" class="form-control shipping-charge" autocomplete="off" placeholder="{{__('language.shipping_charges')}}" value="{{$shipping[$i][shipping_price]}}" required="" step="1" maxlength="8"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="hidden" name="shipping[{{$i}}][id]" value="{{$shipping[$i][shipping_id]}}">
                                                            <label class="form-control-label" for="shipping_weight">Weight {{$i+1}} (gms)</label>
                                                            <input type="number" min="0" step="any" name="shipping[{{$i}}][weight]" class="form-control shipping-weight" autocomplete="off" placeholder="{{__('language.shipping_weight')}}" value="{{$shipping[$i][shipping_weight]}}"  maxlength="6"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="shipping_charges">Charges {{$i+1}}</label>
                                                            <input type="number" min="0" step="any" name="shipping[{{$i}}][charges]" class="form-control shipping-charge" autocomplete="off" placeholder="{{__('language.shipping_charges')}}" value="{{$shipping[$i][shipping_price]}}" maxlength="6"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @endfor
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-20">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-primary btn-submit" id="submit-btn" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{__('language.update_shipping')}}">
                                                    <i class="fa fa-save"></i> &nbsp; {{__('language.update_shipping')}}
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
<script src="{{ asset('admin-assets/js/select2.js')}}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/js/Plugin/select2.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/shipping/shipping.js') }}"></script>
@endpush
