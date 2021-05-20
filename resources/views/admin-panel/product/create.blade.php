  @extends('admin-panel.layouts.main-layout')
  @section('page-title', 'Add Product | Admin Panel')
  @push('styles')
  <link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
  <link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin-assets/global/vendor/multi-select/multi-select.css') }}">
  <style type="text/css">
    .dropdown-header span[class = "text"]{
      color: #000;
      font-weight: bolder;
    }
    .disabled span[class = "text"]{
      color: #000;
      font-weight: bold;
    }
  </style>
  @endpush
  @section('content')
  <div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
      <h1 class="page-title">Product</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('adminPanel.product.index') }}">Product</a></li>
        <li class="breadcrumb-item active">Add Product</li>

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
                    <h4 class="example-title mb-1">Product Information</h4>
                    <p class="">Please fill the below information.</p>
                    <div class="example">
                      {!! Form::open(['class' => 'add-product-form', 'method' => 'post', 'url' => route('adminPanel.product.store'), 'files' => true ]) !!}
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group required">
                                <label class="form-control-label" for="product_name">@lang('language.product_name')</label>
                                {!! Form::text('product_name', '' , ['class' => 'form-control', 'id' => 'product_name', 'autocomplete' => 'off', 'placeholder' =>__('language.product_name'), 'maxLength' => 100, required =>"required", 'data-url' => route('adminPanel.product.checkProductName')])!!}
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group required">
                                <label class="form-control-label" for="product_code">@lang('language.product_code')</label>
                                {!! Form::text('product_code', '' , ['class' => 'form-control', 'id' => 'product_code', 'autocomplete' => 'off', 'placeholder' =>__('language.product_code'), 'maxLength' => 100, required =>"required", 'data-url' => route('adminPanel.product.checkProductCode')])!!}
                              </div>
                            </div>
                            {{-- <div class="col-md-3">
                              <div class="form-group required">
                                <label class="form-control-label" for="product_order">@lang('language.product_order')</label>
                                {!! Form::text('product_order', '' , ['class' => 'form-control', 'id' => 'product_order', 'autocomplete' => 'off', 'placeholder' =>__('language.product_order'), 'maxLength' => 100, required =>"required"])!!}
                              </div>
                            </div> --}}
                          </div>
                          <div class="row">
                           <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="product_time">@lang('language.product_time')</label>
                              {!! Form::number('product_time', '' , ['class' => 'form-control', 'max' => '100', 'id' => 'product_time', 'autocomplete' => 'off', 'placeholder' =>__('language.product_time').' in days',]) !!}
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group required">
                              <label class="form-control-label" for="product_price">@lang('language.product_price')</label>
                              {!! Form::number('product_price','', ['class' => 'form-control', 'id' => 'product_price', 'autocomplete' => 'off', 'step' => 'any', 'min' => 0 , 'max' => 99999 , 'placeholder' =>__('language.product_price'), required =>"required"]) !!}
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="product_discount">@lang('language.product_discount')</label>
                              {!! Form::number('product_discount','', ['class' => 'form-control', 'id' => 'product_discount', 'autocomplete' => 'off', 'step' => 'any', 'min' => 0 , 'placeholder' =>__('language.product_discount')]) !!}
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="product_weight">@lang('language.product_weight')</label>
                              {!! Form::number('product_weight','', ['class' => 'form-control', 'id' => 'product_weight', 'autocomplete' => 'off', 'step' => 'any', 'min' => 0 , 'max' => '99999', 'placeholder' =>__('language.product_weight')]) !!}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group required">
                              <label class="form-control-label" for="package">@lang('language.category_name')</label>
                              <select name="category[]" class="form-control select-picker category-picker" multiple="" required="" title="Please select category">
                               <?php
                                 foreach ($categories as  $category) {
                                  if (count($category['sub_categories'])>0){
                                    echo "<optgroup label='".$category['category_name']."'>";
                                    foreach ($category['sub_categories'] as  $sub_category) {
                                      if (count($sub_category['sub_sub_categories'])>0) {
                                        echo "<option data-level = '2' value='".$sub_category['category_id']."' disabled='ture' style='margin-left:5px;'>".$sub_category['category_name']."</option>";
                                        foreach ($sub_category['sub_sub_categories'] as  $sub_sub_category) {
                                          echo "<option value='".$sub_sub_category['category_id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_sub_category['category_name']."</option>";
                                        }
                                      }
                                      else{
                                        echo "<option data-level = '2' data-bold='true' value='".$sub_category['category_id']."'>".$sub_category['category_name']."</option>";
                                      }
                                    }
                                  }
                                  else{
                                    echo "<option value='".$category['category_id']."'>".$category['category_name']."</option>";
                                  }
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          {{-- <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="package">@lang('language.accessory_name')</label>
                              {!! Form::select('accessory[]', create_select_options($accessories, 'accessory_name', 'accessory_id'), null,  ['class' => 'form-control select-picker', 'id' => 'accessory', 'autocomplete' => 'off', 'multiple','title' => 'Please select accessory' ]) !!}
                            </div>
                          </div> --}}
                          {{-- <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="package">@lang('language.custom_measurement')</label>
                              <select name="measurement" id = "measurement"  class="form-control select-picker">
                                <option value="">Please select measurement</option>
                                @foreach($measurement as $value)
                                <option value="{{$value->measurement_id}}">{{$value->measurement_title}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div> --}}
                          <div class="col-md-6">
                            <div class="form-group not-required">
                            <label class="form-control-label" for="package">@lang('language.hot_seller')</label>
                              <select name="hot_seller" class="form-control" title="Hot Seller">
                                <option value="0">No</option>
                                <option value="2">Yes</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                         <div class="col-md-4">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="color">@lang('language.color_name')</label>
                            {!! Form::select('color[]', create_select_options($colors, 'color_name', 'color_id'), null,  ['class' => 'form-control select-picker', 'id' => 'color', 'autocomplete' => 'off', 'multiple','title' => 'Please select  color' ]) !!}
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="fabric">@lang('language.fabric_name')</label>
                            {!! Form::select('fabric[]', create_select_options($fabrics, 'fabric_name', 'fabric_id'), null,  ['class' => 'form-control select-picker', 'id' => 'fabric', 'autocomplete' => 'off', 'multiple','title' => 'Please select Wood Type' ]) !!}
                          </div>
                        </div>
                        {{-- <div class="col-md-4">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="occasion">@lang('language.occasion_name')</label>
                            {!! Form::select('occasion[]', create_select_options($occasions, 'occasion_name', 'occasion_id'), null,  ['class' => 'form-control select-picker', 'id' => 'occasion', 'autocomplete' => 'off', 'multiple','title' => 'Please select  occasion' ]) !!}
                          </div>
                        </div> --}}
                        <div class="col-md-4">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="size">@lang('language.size')</label>
                            {!! Form::select('size[]', create_select_options($sizes, 'size_measure', 'size_id'), null,  ['class' => 'form-control select-picker', 'id' => 'size', 'autocomplete' => 'off', 'multiple','title' => 'Please select size' ]) !!}
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="product_description">@lang('language.product_description')
                            </label>
                            {!! Form::textarea('product_description', '', ['class'=>'form-control',  'id' => 'product_description','autocomplete' => 'off']) !!}
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group bot-required">
                            <label class="form-control-label" for="product_notes">@lang('language.product_notes')
                            </label>
                            {!! Form::textarea('product_notes', '', ['class'=>'form-control',  'id' => 'product_notes','autocomplete' => 'off']) !!}
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group required">
                            <label for="input-file-disable-remove">Small Image</label>
                            <input type="file" name="product_image_small" id="input-file-disable-remove" class="dropify" data-show-remove="true" data-default-file="" required=""/>
                             <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group required">
                            <label for="input-file-disable-remove">Default Image</label>
                            <input type="file" name="default_image" id="input-file-disable-remove" class="dropify" data-show-remove="true" data-default-file="" required=""/>
                             <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group not-required">
                            <label for="input-file-disable-remove">Other Images</label>
                            <input type="file" name="other_images[]" id="input-file-disable-remove" multiple="multiple" class="dropify" data-show-remove="true" data-default-file="" data-allowed-file-extensions="jpeg jpg gif png"/>
                            <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mt-20">
                      <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.create_product') }}">
                          <i class="fa fa-save"></i> &nbsp; {{ __('language.create_product') }}
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
<script src="{{asset('admin-assets/global/js/Plugin/bootstrap-select.js')}}"></script>
<script src="{{asset('admin-assets/global/vendor/multi-select/jquery.multi-select.js')}}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/product/product.js') }}"></script>
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
