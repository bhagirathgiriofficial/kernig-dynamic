  @extends('admin-panel.layouts.main-layout')
  @section('page-title', 'Update Product | Admin Panel')
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
        <li class="breadcrumb-item active">Update Product</li>
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
                      {!! Form::open(['class' => 'add-product-form', 'method' => 'post', 'url' => route('adminPanel.product.update',['id' => ev($product->product_id) ]), 'files' => true ]) !!}
                      <div class="row">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group required">
                                <label class="form-control-label" for="product_name">@lang('language.product_name')</label>
                                {!! Form::text('product_name', old('product_name',($product->product_name ?? "")) , ['class' => 'form-control', 'id' => 'product_name', 'autocomplete' => 'off','maxLength' => 100,  'placeholder' =>__('language.product_name'), required =>"required", 'data-url' => route('adminPanel.product.checkProductName', ['id' => ev($product->product_id)])])!!}
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group required">
                                <label class="form-control-label" for="product_code">@lang('language.product_code')</label>
                                {!! Form::text('product_code', old('product_code',($product->product_code ?? "")) , ['class' => 'form-control', 'id' => 'product_code', 'autocomplete' => 'off', 'maxLength' => 100, 'placeholder' =>__('language.product_code'), required =>"required", 'data-url' => route('adminPanel.product.checkProductCode', ['id' => ev($product->product_id)])])!!}
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group required">
                                <label class="form-control-label" for="product_order">@lang('language.product_order')</label>
                                {!! Form::text('product_order', old('product_order',($product->product_order ?? "")) , ['class' => 'form-control', 'id' => 'product_order', 'autocomplete' => 'off', 'placeholder' =>__('language.product_order'), 'maxLength' => 100, required =>"required"])!!}
                              </div>
                            </div>
                          </div>
                          <div class="row">
                           <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="product_time">@lang('language.product_time')</label>
                              {!! Form::text('product_time', old('product_time',(trim(strtolower($product->product_timetoship)," days") ?? "")) , ['class' => 'form-control',  'max' => '100', 'id' => 'product_time', 'autocomplete' => 'off', 'placeholder' =>__('language.product_time') ]) !!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group required">
                              <label class="form-control-label" for="product_price">@lang('language.product_price')</label>
                              {!! Form::number('product_price', old('product_price',($product->product_price ?? "")) , ['class' => 'form-control', 'id' => 'product_price', 'autocomplete' => 'off', 'step' => 'any', 'min' => 0,  'max' => 99999 , 'placeholder' =>__('language.product_price'), required =>"required"]) !!}
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="product_discount">@lang('language.product_discount')</label>
                              {!! Form::number('product_discount', old('product_discount',($product->product_discounted_price ?? "")) , ['class' => 'form-control', 'id' => 'product_discount', 'autocomplete' => 'off', 'step' => 'any','mix' => '0', 'max' => $product->product_price-1, 'placeholder' =>__('language.product_discount')]) !!}
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="product_weight">@lang('language.product_weight')</label>
                              {!! Form::number('product_weight', old('product_weight',($product->product_weight ?? ""))  , ['class' => 'form-control', 'id' => 'product_weight', 'autocomplete' => 'off', 'step' => 'any', 'min' => 0 , 'max' => '99999', 'placeholder' =>__('language.product_weight')]) !!}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group required">

                              <label class="form-control-label" for="package">@lang('language.category_name')</label>
                                @php  $catIds = explode(',', $product->product_categories);  @endphp
                               <select name="category[]" class="form-control select-picker category-picker" multiple="" required="" title="Please select category">
                                <?php
                                foreach ($categories as  $category) {
                                  if (count($category['sub_categories'])>0){
                                    echo "<optgroup label='".$category['category_name']."'>";
                                    foreach ($category['sub_categories'] as  $sub_category) {
                                      if (count($sub_category['sub_sub_categories'])>0) {
                                        echo "<option value='".$sub_category['category_id']."' disabled='ture' style='margin-left:5px;'>".$sub_category['category_name']."</option>";
                                        foreach ($sub_category['sub_sub_categories'] as  $sub_sub_category) {
                                          if (in_array($sub_sub_category['category_id'],$catIds)) {
                                            echo "<option value='".$sub_sub_category['category_id']."' selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_sub_category['category_name']."</option>";
                                          }
                                          else
                                          {
                                            echo "<option value='".$sub_sub_category['category_id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_sub_category['category_name']."</option>";
                                          }
                                        }
                                      }
                                      else{
                                        if (in_array($sub_category['category_id'],$catIds)) {
                                          echo "<option value='".$sub_category['category_id']."' selected>".$sub_category['category_name']."</option>";
                                        }
                                        else{
                                          echo "<option value='".$sub_category['category_id']."'>".$sub_category['category_name']."</option>";
                                        }
                                      }
                                    }
                                  }
                                  else{
                                    if (in_array($category['category_id'],$catIds)) {
                                      echo "<option value='".$category['category_id']."' selected>".$category['category_name']."</option>";
                                    }
                                    else{
                                      echo "<option value='".$category['category_id']."'>".$category['category_name']."</option>";
                                    }
                                  }
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="package">@lang('language.accessory_name')</label>
                              {!! Form::select('accessory[]', create_select_options($accessories, 'accessory_name', 'accessory_id'), explode(',', $product->product_accessories),  ['class' => 'form-control select-picker', 'id' => 'accessory', 'autocomplete' => 'off', 'multiple','title' => 'Please select accessory' ]) !!}
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group not-required">
                              <label class="form-control-label" for="package">@lang('language.custom_measurement')</label>
                              <select name="measurement" id = "measurement"  class="form-control select-picker">
                                <option value="">Please select measurement</option>
                                @foreach($measurement as $value)
                                <option {{$product->measurement_id==$value->measurement_id ? "selected" : ""}} value="{{$value->measurement_id}}">{{$value->measurement_title}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group not-required">
                            <label class="form-control-label" for="package">@lang('language.hot_seller')</label>
                              <select name="hot_seller" class="form-control select-picker" title="Hot Seller">
                                <option selected="" value="0">Select a type</option>
                                <option value="1" {{$product->hot_seller==1?"selected":""}}>New</option>
                                <option value="2" {{$product->hot_seller==2?"selected":""}}>Sale</option>
                                <option value="3" {{$product->hot_seller==3?"selected":""}}>Special</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row" style="margin-top: 5px;">
                         <div class="col-md-3">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="color">@lang('language.color_name')</label>
                            {!! Form::select('color[]', create_select_options($colors, 'color_name', 'color_id'), explode(',', $product->product_colors) ,  ['class' => 'form-control select-picker', 'id' => 'color', 'autocomplete' => 'off', 'multiple','title' => 'Please select  color' ]) !!}
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="fabric">@lang('language.fabric_name')</label>
                            {!! Form::select('fabric[]', create_select_options($fabrics, 'fabric_name', 'fabric_id'), explode(',', $product->product_fabrics) ,  ['class' => 'form-control select-picker', 'id' => 'fabric', 'autocomplete' => 'off', 'multiple','title' => 'Please select  fabric' ]) !!}
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="occasion">@lang('language.occasion_name')</label>
                            {!! Form::select('occasion[]', create_select_options($occasions, 'occasion_name', 'occasion_id'), explode(',', $product->product_occasions) ,  ['class' => 'form-control select-picker', 'id' => 'occasion', 'autocomplete' => 'off', 'multiple','title' => 'Please select  occasion' ]) !!}
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="size">@lang('language.size')</label>
                            {!! Form::select('size[]', create_select_options($sizes, 'size_measure', 'size_id'), explode(',', $product->product_sizes),  ['class' => 'form-control select-picker', 'id' => 'size', 'autocomplete' => 'off', 'multiple','title' => 'Please select size' ]) !!}
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="product_description">@lang('language.product_description')
                            </label>
                            {!! Form::textarea('product_description', old('product_description', ($product->product_description??'')), ['class'=>'form-control', 'id' => 'product_description','autocomplete' => 'off']) !!}
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group not-required">
                            <label class="form-control-label" for="product_notes">@lang('language.product_notes')
                            </label>
                            {!! Form::textarea('product_notes', old('product_notes', ($product->product_notes??'')) , ['class'=>'form-control','id' => 'product_notes','autocomplete' => 'off']) !!}
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group not-required">
                            <label for="input-file-disable-remove">Small Image</label>
                            <input type="file" name="product_image_small" id="input-file-disable-remove" class="dropify" data-show-remove="flase" data-default-file="{{get_image_url(config('constants.products.images_path_thumb'), $product->product_image_small)}}"/>
                            <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group not-required">
                            <label for="input-file-disable-remove">Default Image</label>
                            <input type="file" name="default_image" id="input-file-disable-remove" class="dropify" data-show-remove="flase" data-default-file="{{get_image_url(config('constants.products.images_path'), $product->product_image)}}"/>
                            <div class="invalid-feedback extension-error">This file is not allowed! Only jpeg, jpg, gif, png images are allowed.</div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group not-required">
                            <label for="input-file-disable-remove">Other Images</label>
                            <input type="file" name="other_images[]" id="input-file-disable-remove" multiple="multiple" class="dropify" data-show-remove="true" data-default-file="" data-allowed-file-extensions="jpeg jpg gif png" />
                          </div>
                        </div>
                      </div>
                      @if(count($otherImages)>0)
                      <h4>Other Images (Preview)</h4>
                      <div class="row">
                          @foreach($otherImages as $otherImage)
                          <div class="col-md-3 mt-20">
                            <img src="{{get_image_url(config('constants.products.images_path'),$otherImage->product_image)}}" height="200px" width="200px"/>
                            <button type="button"class="btn btn-icon btn-default text-danger remove-other-image" data-remove-url="{{route('adminPanel.product.removeImage')}}" data-toggle="tooltip" data-trigger="hover"  data-original-title="Delete Image" data-id="{{ev($otherImage->product_image_id)}}"><i class="icon wb-trash" aria-hidden="true"></i></button>
                          </div>
                          @endforeach
                      </div>
                      @endif
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 mt-20">
                      <div class="form-group mb-0">
                        <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.update_product') }}">
                          <i class="fa fa-save"></i> &nbsp; {{ __('language.update_product') }}
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

