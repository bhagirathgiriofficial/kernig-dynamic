@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Product Details | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('admin-assets/global/vendor/multi-select/multi-select.css') }}">
@endpush
@section('content')
<div class="page">
  <!-- Page breadcrumbs -->
  <div class="page-header">
    <h1 class="page-title">Product</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('adminPanel.product.index') }}">Product</a></li>
      <li class="breadcrumb-item active">Product Details</li>

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
                  <div class="example">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-12">
                          <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                            <thead class="table-header" >
                              <th>Product Name</th>
                              <th>Product Code</th>
                            </thead>
                            <tr>
                              <th>{{$product->product_name}}</th>
                              <th>{{$product->product_code}}</th>
                            </tr>
                          </table>
                          <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                            <thead class="table-header" >
                              <th>Product Price</th>
                              <th>Product Discounted Price</th>
                              <th>In Stock ?</th>
                              <th>Product Weight</th>
                              <th>Product Time To Ship</th>
                              <th>Product Views</th>
                              <th>Hot Seller</th>
                            </thead>
                            <tr>
                              <th>{{$product->product_price}}</th>
                              <th>{{$product->product_discounted_price}}</th>
                              <th>
                                @if($product->out_of_stock == 2)
                                  Yes
                                @else
                                  No
                                @endif
                              </th>
                              <th>{{$product->product_weight}}</th>
                              <th>{{$product->product_timetoship}}</th>
                              <th>{{$product->product_views}}</th>
                              <th>
                                @if($product->hot_seller == 0)
                                No
                                @else
                                Yes
                                @endif
                              </th>
                            </tr>
                          </table>
                          <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                            <thead class="table-header" >
                              <th>Product Category(s)</th>
                              <th>Product Color(s)</th>
                              <th>Product Fabric(s)</th>
                              <th>Product Size(s)</th>
                              <th>Product Occasion(s)</th>
                              <th>Product Accessory(s)</th>
                            </thead>
                            <tr>
                              <th>
                                <ul>
                                  @foreach($product->category as $category)
                                  <li>{{$category->category_name}}</li>
                                  @endforeach
                                </ul>
                              </th>
                              <th>
                                <ul>
                                  @foreach($product->color as $color)
                                  <li>{{$color->color_name}}</li>
                                  @endforeach
                                </ul>
                              </th>
                              <th>
                                <ul>
                                  @foreach($product->fabric as $fabric)
                                  <li>{{$fabric->fabric_name}}</li>
                                  @endforeach
                                </ul>
                              </th>
                              <th>
                                <ul>
                                  @foreach($product->size as $size)
                                  <li>{{floatval($size->size_measure)}}</li>
                                  @endforeach
                                </ul>
                              </th>
                              <th>
                                <ul>
                                  @foreach($product->occasion as $occasion)
                                  <li>{{$occasion->occasion_name}}</li>
                                  @endforeach
                                </ul>
                              </th>
                               <th>
                                <ul>
                                  @foreach($product->accessory as $accessory)
                                  <li>{{$accessory->accessory_name}}</li>
                                  @endforeach
                                </ul>
                              </th>
                           </tr>
                          </table>
                           <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                            <thead class="table-header" >
                              <th>Product Description</th>
                              <th>Product Note</th>
                            </thead>
                            <tr>
                              <th width="50%"><?php echo $product->product_description ?></th>
                              <th width="50%"><?php echo $product->product_notes ?></th>
                            </tr>
                          </table>
                          <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                            <thead class="table-header" >
                              <th>Product Default Image</th>
                              <th>Other Image(s)</th>
                            </thead>
                            <tr>
                              <td style="padding-left: 5%;" width="20%"><img class="img-thumbnail"  src="{{get_image_url(config('constants.products.images_path'),$product->product_image)}}" width="100px"></td>
                              <td>
                                @foreach($product->getImages as $key => $image)
                                <img class="img-thumbnail" src="{{get_image_url(config('constants.products.images_path'),$image->product_image)}}" width="120px" />
                                @endforeach
                              </td>
                            </tr>
                          </table>
                        </div>
                        </div>
                      </div>
                    </div>
                      <div class="row">
                        <div class="col-md-12 mt-20">
                          <div class="form-group mb-0">
                            @if($product->deleted_at == "")
                            <a href="{{route('adminPanel.product.edit', ['id' => ev($product->product_id)])}}">
                            <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.edit_product') }}">
                             <i class="icon wb-edit" aria-hidden="true"></i> &nbsp; {{ __('language.edit_product') }}
                            </button>
                            </a>
                            @endif
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
  <script src="{{asset('admin-assets/global/js/Plugin/bootstrap-select.js')}}"></script>
  <script src="{{asset('admin-assets/global/vendor/multi-select/jquery.multi-select.js')}}"></script>
  <script src="{{ asset('admin-assets/js/components.js') }}"></script>
  <script src="{{ asset('admin-assets/js/product/product.js') }}"></script>
  @endpush
