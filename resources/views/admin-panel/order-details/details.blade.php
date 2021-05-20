@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Product Order Details | Admin Panel')
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
    <h1 class="page-title">Product Order</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Dashboard</li>
      <li class="breadcrumb-item"><a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'all-orders']) }}">Order Details</a></li>
      <li class="breadcrumb-item active">Product Order Details</li>
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
                  <div class="row">
                    <div class="col-md-12">
                     <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                      <thead class="table-header">
                        <th>Order No:</th>
                        <th>Ordered Date:</th>
                        <th>Order Status:</th>
                        <th>Order Type:</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{$orderDetail->order_number}}</td>
                          <td>{{ date( 'D, d F Y, h:i A', strtotime($orderDetail->order_date))}}</td>
                          <td>
                            {!! Form::select('order_status',$statusOptions, $orderDetail->order_status, ['onchange'=> 'changeOrderStatus(this)','data-id' => ev($orderDetail->product_order_id) ,'class' => 'form-control select-picker', 'data-change-status-url' => route("adminPanel.orderDetails.changeStatus") ,'id' => 'order_status']) !!}
                          </td>
                          <td>
                            @if($orderDetail->order_gift == 1) 
                            Is a Gift!
                            @else
                            Not a Gift!
                            @endif
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="example-wrap">
                  <div class="example-loading vertical-align text-center admin-loader">
                    <div class="loader vertical-align-middle loader-round-circle"></div>
                  </div>
                </div>
                <div class="modal fade" id="examplePositionCenter" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-simple modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title">Custom Measurement</h4>
                      </div>
                      <div class="modal-body">
                        <p style="font-size: 20px;"></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="example">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-12">
                        <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                          <thead class="table-header" >
                          <th>Order Placed By:</th>
                          @if($orderDetail->bill_shipping == 1)
                          <th>Shipping and Billing Details:</th>
                          @else
                          <th>Shipping Details:</th>
                          <th>Billing Details:</th>
                          @endif
                          </thead>
                            <tr>
                              <td>
                              @php
                              $user .= ' <b>Name: </b>'.$orderDetail->user->f_name.' '.$orderDetail->user->l_name;
                              $user .=' </br><b>Email: </b>'.$orderDetail->user->email.'</br>';
                              $user .= '<b>Mobile: </b>'.$orderDetail->user->mobile_number;
                              echo $user;
                              @endphp
                              </td>
                            @if($orderDetail->bill_shipping == 1)
                              <td> 
                              @php
                              $billShipAddress .= ' <b>Name: </b>'.$orderDetail->billing_first_name.' '.$orderDetail->billing_last_name;
                              $billShipAddress .=' </br><b>Email: </b>'.$orderDetail->billing_email.'</br>';
                              $billShipAddress .= '<b>Mobile: </b>'.$orderDetail->billing_phone.'</br>';
                              $billShipAddress .= '<b>Address: </b>'.$orderDetail->billing_address.'</br>';
                              $billShipAddress .= '<b>City: </b>'.$orderDetail->billing_city.'</br>';
                              $billShipAddress .= '<b>State: </b>'.$orderDetail->billing_state.'</br>';
                              $billShipAddress .= '<b>Country: </b>'.$orderDetail->billingCountry->country_name.'</br>';
                              $billShipAddress .= '<b>Pin Code: </b>'.$orderDetail->billing_pincode.'</br>';
                              echo $billShipAddress;
                              @endphp
                              </td>
                            @else
                              <td> 
                              @php
                              $shippingAddress .= ' <b>Name: </b>'.$orderDetail->shipping_first_name.' '.$orderDetail->shipping_last_name;
                              $shippingAddress .=' </br><b>Email: </b>'.$orderDetail->shipping_email.'</br>';
                              $shippingAddress .= '<b>Mobile: </b>'.$orderDetail->shipping_phone.'</br>';
                              $shippingAddress .= '<b>Address: </b>'.$orderDetail->shipping_address.'</br>';
                              $shippingAddress .= '<b>City: </b>'.$orderDetail->shipping_city.'</br>';
                              $shippingAddress .= '<b>State: </b>'.$orderDetail->shipping_state.'</br>';
                              $shippingAddress .= '<b>Country: </b>'.$orderDetail->shippingCountry->country_name.'</br>';
                              $shippingAddress .= '<b>Pin Code: </b>'.$orderDetail->shipping_pincode.'</br>';
                              echo $shippingAddress;
                              @endphp
                              </td>
                              <td> 
                              @php
                              $billingAddress .= ' <b>Name: </b>'.$orderDetail->billing_first_name.' '.$orderDetail->billing_last_name;
                              $billingAddress .=' </br><b>Email: </b>'.$orderDetail->billing_email.'</br>';
                              $billingAddress .= '<b>Mobile: </b>'.$orderDetail->billing_phone.'</br>';
                              $billingAddress .= '<b>Address: </b>'.$orderDetail->billing_address.'</br>';
                              $billingAddress .= '<b>City: </b>'.$orderDetail->billing_city.'</br>';
                              $billingAddress .= '<b>State: </b>'.$orderDetail->billing_state.'</br>';
                              $billingAddress .= '<b>Country: </b>'.$orderDetail->billingCountry->country_name.'</br>';
                              $billingAddress .= '<b>Pin Code: </b>'.$orderDetail->billing_pincode.'</br>';
                              echo $billingAddress;
                              @endphp
                              </td>
                            @endif                               
                            </tr>
                        </table>
                  <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                    <thead class="table-header" >
                      <th>SR:</th>
                      <th width="25%">Name (Quantity)</th>
                      <th>Size</th>
                      <th>Image</th>
                      <th>Other Notes:</th>  
                      <th>Accessories</th>
                      <th>Unit Price</th>
                      <th>Custom <br/> Measurement</th>
                    </thead>
                    @foreach($orderDetail->productOrderDetail as $key => $product)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td><a href="{{route('adminPanel.product.details',['id' => ev($product->product_id)])}}" target="blank" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="View Product Details"> {{$product->product_name}} </a> (x {{$product->product_quantity}})</td>
                      <td>{{$product->size_measure ? floatval($product->size_measure) : "N/A"}}</td>
                      <td class="text-center">
                        <img class="img-responsive" src="{{get_image_url(config('constants.products.images_path'),$product->product_image)}}" width="100px">
                      </td>
                      <td>
                       @php
                       $array = json_decode($product->saree_measurement,true);
                       @endphp
                        @if($product->saree_measurment_details != "")
  
                          @php 
                          $array = json_decode($product->saree_measurment_details,true);
                          @endphp
                          <ul class="list-unstyled">
                          @foreach($array as $sareeData)
                          <li>{{$sareeData[saree_measurement_title]}} ( $ {{$sareeData[saree_measurement_price]}} )</li>
                          @endforeach                        
                          </ul>

                        @elseif($product->salwar_measurment_details!="")

                          
                          @php 
                          $array = json_decode($product->salwar_measurment_details,true);
                          @endphp
                          <ul class="list-unstyled"> {{$array[0][salwar_measurement_titles]}} ( $ {{$array[0][salwar_measurement_price]}}) </ul>

                        @elseif($product->custom_measurement != "")
                        
                          @php
                          $array = json_decode($product->measurment_details,true);
                          @endphp
                          <ul class="list-unstyled">
                            <li>{{$array[measurement_title]}} ( $ {{$array[measurement_price]}} )</li>  
                          </ul>

                        @else
                        <ul> N/A </ul>
                        @endif
                      </td>
                      <td>
                        @php
                        $accessoryArray = json_decode($product->accessories_details,true);
                        @endphp
                        @if(count($accessoryArray))
                        <ul class="list-unstyled">
                        @foreach($accessoryArray as $key => $accessory)
                        <li>{{ $accessory['accessory_name'] }} ( $ {{ $accessory['accessory_price'] }} )</li>
                        @endforeach
                        </ul>
                        @else
                        None
                        @endif
                      </td>
                      <td>
                        $ {{$product->total_price}} x {{$product->product_quantity}}  = $ {{$product->total_price*$product->product_quantity}}
                      </td>
                       <td>
                        @if($product->custom_measurement != "" || count(json_decode($product->saree_measurement,true)) != 0 || $product->salwar_measurment!="")
                        <button type="button" class="btn btn-primary show-measurement" data-target="#examplePositionCenter" data-url ="{{route('adminPanel.orderDetails.getMeasurmenets', ['id' => ev($product->product_order_detail_id)])}}" data-toggle="modal"> <i data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="Show Custom Measurement">Show</i></button>
                        @else
                        <button type="button" class="btn btn-primary show-measurement" data-target="#examplePositionCenter" data-url ="{{route('adminPanel.orderDetails.getMeasurmenets', ['id' => ev($product->product_order_detail_id)])}}" data-toggle="modal" disabled=""><i data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="No Custom Measurement">Show </i></button>
                        @endif
                      </td>
                    </tr>
                    @endforeach
                  </table>
                  <table class="table table-bordered table-hover table-striped dataTable w-fulls">
                    <thead class="table-header" >
                      <th>Amount:</th>
                      <th>Discounted Amount:</th>
                      <th>Shipping Charges:</th>
                      <th>Net Amount:</th>
                    </thead>
                    <tr>
                      <td>$ {{$orderDetail->total_amount}}</td>
                      <td>$ {{$orderDetail->discount_amount}}</td>
                      <td>$ {{$orderDetail->shipping_charge}}</td>
                      <td>$ {{$orderDetail->net_amount}}</td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mt-20">
              <div class="form-group mb-0">
                <a href="{{route('adminPanel.product.edit', ['id' => ev($product->product_id)])}}">
                          <!--   <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.edit_product') }}">
                             <i class="icon wb-edit" aria-hidden="true"></i> &nbsp; {{ __('language.edit_product') }}
                           </button> -->
                         </a>
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
<script type="text/javascript">

  function changeOrderStatus(elem) {
    var status   = $(elem).val();
    var id       = $(elem).data('id');
    var goToUrl  = $(elem).data('change-status-url');  
    $.ajax({
      type : "POST",
      url  : goToUrl,
      data : {
        'id'     : id,
        'status' : status,
      },
      beforeSend: function(){
        $(elem).attr("disabled","true");
      },
      success:function(response){
        App.showNotification(response);
      },
      complete: function () {
        $(elem).removeAttr("disabled");
      }
    });
  }

  $(".show-measurement").on("click",function(){
   var goToUrl  = $(this).data("url");
   $.ajax({
    url  : goToUrl,
    beforeSend: function(){
      $(".modal-body").html("");
      $(".admin-loader").attr("class", "admin-loader admin-loader-show");
    },
    success:function(response){
      $(".modal-body").html(response);
    },
    complete: function(){
      $(".admin-loader").attr("class", "admin-loader");
    }
  });
 })
</script>

@endpush
