@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Dashboard | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/chartist/chartist.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/aspieprogress/asPieProgress.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css') }}" rel="stylesheet">
<!-- <link href="{{ asset('admin-assets/assets/examples/css/dashboard/ecommerce.css') }}" rel="stylesheet"> -->
<style type="text/css">
  .welcome-text{
    letter-spacing: 0px;
    text-transform: uppercase;
    font-family: verdana;
  }
</style>
@endpush
@section('content')
<div class="page">
  <!-- Page Breadcrumbs -->
  <div class="page-header">
    <h1 class="page-title">Dashboard</h1>
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="../index.html">Home</a></li> --}}
      {{-- <li class="breadcrumb-item active">Dashboard</li> --}}
    </ol>
  </div>
  <!-- / Page Breadcrumbs -->
  <!-- Page -->
  <div class="page-content container-fluid">
    <div class="row">
      <!-- First Row -->
      <div class="col-xl-3 col-md-6 info-panel">
        <div class="card card-shadow">
          <div class="card-block bg-white p-20">
            <a style="text-decoration: none;" href="{{ route('adminPanel.users.index') }}">
              <button type="button" class="btn btn-floating btn-sm btn-warning">
                <i class="icon fa fa-users"></i>
              </button>
              <span class="ml-15 font-weight-500 font-size-20">USERS</span>
            </a>
            <div class="content-text text-center mb-0">
            </i>
            <span class="font-size-20 font-weight-100">Total: {{$users}}</span>
            <!-- <p class="blue-grey-400 font-weight-100 m-0"> + {{$users - Count($usersThisMonth)}} More than last month</p> -->
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6 info-panel">
      <div class="card card-shadow">
        <div class="card-block bg-white p-20">
          <a style="text-decoration: none;" href="{{ route('adminPanel.product.index') }}">
            <button type="button" class="btn btn-floating btn-sm btn-primary">
              <i class="icon fa fa-shopping-bag"></i>
            </button>
            <span class="ml-15 font-weight-500 font-size-20">PRODUCTS</span>
          </a>
          <div class="content-text text-center mb-0">
          </i>

          <span class="font-size-20 font-weight-100">Total: {{$products}}</span>
          <!-- <p class="blue-grey-400 font-weight-100 m-0">+ {{$products - Count($productsThisMonth)}} More than last month</p> -->

        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-md-6 info-panel">
    <div class="card card-shadow">
      <div class="card-block bg-white p-20">
        <a style="text-decoration: none;" href="{{ route('adminPanel.orderDetails.index', ['type' => 'all-orders']) }}">
          <button type="button" class="btn btn-floating btn-sm btn-danger">
            <i class="icon fa fa-shopping-cart"></i>
          </button>
          <span class="ml-15 font-weight-500 font-size-20">ORERS</span>
        </a>
        <div class="content-text text-center mb-0">
        </i>
        <span class="font-size-20 font-weight-100">Total: {{$productOrders}}</span>
        <!-- <p class="blue-grey-400 font-weight-100 m-0">+ {{$productOrders - Count($productOrdersThisMonth)}} More than last month</p> -->
      </div>
    </div>
  </div>
</div>
<div class="col-xl-3 col-md-6 info-panel">
  <div class="card card-shadow">
    <div class="card-block bg-white p-20">
     <a style="text-decoration: none;" href="{{ route('adminPanel.transaction.index') }}">
      <button type="button" class="btn btn-floating btn-sm btn-success">
        <i class="icon fa fa-dollar"></i>
      </button>
      <span class="ml-15 font-weight-500 font-size-20">PAYMENT</span>
    </a>
    <div class="content-text text-center mb-0">

    </i>
    <span class="font-size-20 font-weight-100">Total: $ {{$totalPayment}}</span>
    <!-- <p class="blue-grey-400 font-weight-100 m-0">+ $ {{$totalPayment - $totalPaymentThisMonth}} More than last month</p> -->
  </div>
</div>
</div>
</div>
<!-- End First Row -->
<!-- second Row -->
           <!--  <div class="col-12" id="ecommerceChartView">
                <div class="card card-shadow">
                    <div class="card-header card-header-transparent py-20">
                        <div class="btn-group dropdown">
                            <a href="#" class="text-body dropdown-toggle blue-grey-700" data-toggle="dropdown">PRODUCTS SALES</a>
                            <div class="dropdown-menu animate" role="menu">
                                <a class="dropdown-item" href="#" role="menuitem">Sales</a>
                                <a class="dropdown-item" href="#" role="menuitem">Total sales</a>
                                <a class="dropdown-item" href="#" role="menuitem">profit</a>
                            </div>
                        </div>
                        <ul class="nav nav-pills nav-pills-rounded chart-action">
                            <li class="nav-item"><a class="active nav-link" data-toggle="tab" href="#scoreLineToDay">Day</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToWeek">Week</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#scoreLineToMonth">Month</a></li>
                        </ul>
                    </div>
                    <div class="widget-content tab-content bg-white p-20">
                        <div class="ct-chart tab-pane active" id="scoreLineToDay"></div>
                        <div class="ct-chart tab-pane" id="scoreLineToWeek"></div>
                        <div class="ct-chart tab-pane" id="scoreLineToMonth"></div>
                    </div>
                </div>
              </div> -->
              <!-- End Second Row -->
              <!-- Third Row -->
              <!-- Third Left -->
              <div class="col-lg-12">
               <div class="card card-shadow p-20">
                 <h1 class="text-center welcome-text">Welcome To {{getSiteName()}} Admin Panel</h1>
               </div>
             </div>
             <div class="col-lg-12">
              <div class="card card-shadow p-20">
                <img src="{{getSiteLogo()}}" height="250px">
              </div>
            </div>
            <!-- End Third Left -->
            <!-- End Third Row -->
          </div>
        </div>
        <!-- / End Page -->
      </div>
      @endsection
      @push('scripts')
      <script src="{{ asset('admin-assets/global/vendor/chartist/chartist.min.js') }}"></script>
      <script src="{{ asset('admin-assets/global/vendor/aspieprogress/jquery-asPieProgress.js') }}"></script>
      <script src="{{ asset('admin-assets/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.js') }}"></script>
      <script src="{{ asset('admin-assets/global/js/Plugin/aspieprogress.js') }}"></script>
     @endpush
