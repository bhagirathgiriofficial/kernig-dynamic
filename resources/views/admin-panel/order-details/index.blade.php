@extends('admin-panel.layouts.main-layout')

@section('page-title', 'Order Details | Admin Panel')

@push('styles')
<link href="{{ asset('admin-assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="page">
 <!-- Page breadcrumbs -->
 <div class="page-header">
    <div class="row">
        <div class="col-md-6">
            <h1 class="page-title">Order Details Management</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Order Details</li>
            </ol>
        </div>
    </div>
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
                        @php
                        $type = Request::segment(3);
                        @endphp
                        <!-- Example Basic Form (Form grid) -->
                        <div class="example-wrap ">
                            <div style="float: left;"><h4 class="example-title mb-1">{{$type}} Details</h4>
                            <p class="">Below are the list of Order Details.</p>
                            </div>
                            <!-- <div style="float: right;">
                               <a href="{{route('adminPanel.orderDetails.viewTrash')}}"> <button class="btn btn-primary"> View Trashed </button> </a>
                            </div> -->
                            <div class="example">
                                <div class="data-table-container">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped dataTable w-full" data-url="{{route('adminPanel.orderDetails.getOrderDetails', ['type' => $type] )}}"  data-change-status-url="{{ route('adminPanel.orderDetails.changeStatus') }}" data-destroy-url="{{ route('adminPanel.orderDetails.moveToTrash') }}">
                                            <thead class="table-header">
                                                <tr>
                                                    <th width="30" class="">
                                                        <div class="checkbox-custom checkbox-primary">
                                                            <input type="checkbox" id="record" name="select_all" value="1">
                                                            <label for="record"></label>
                                                        </div>
                                                    </th>
                                                    <th>#</th>
                                                    <th>Order Number</th>
                                                    <th>User Details</th>
                                                    <th>Price Details</th>
                                                    <th>Order Date</th>
                                                    <th>Order Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
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
<script src="{{ asset('admin-assets/global/vendor/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/datatables.net-buttons/dataTables.buttons.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/datatables.net-buttons/buttons.html5.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/datatables.net-buttons/buttons.print.js') }}"></script>
<script src="{{ asset('admin-assets/js/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin-assets/js/datatable/dataTables.checkboxes.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/orderDetails/view.js') }}"></script>
@endpush
