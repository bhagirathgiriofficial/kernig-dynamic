@extends('admin-panel.layouts.main-layout')

@section('page-title', 'Transaction | Admin Panel')

@push('styles') 
<link href="{{ asset('admin-assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
<style>
    .dataTables_filter{
        margin-left: 57% !important;
    }
</style>
@endpush

@section('content')
<div class="page">
   <!-- Page breadcrumbs -->
   <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="page-title">Transaction</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Transaction</li>
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
                                <!-- Example Basic Form (Form grid) -->
                                <div class="example-wrap">
                                    <h5 class="example-title">Filters</h5>
                                    <div class="col-md-12 filter">
                                        {!! Form::open(['files'=>TRUE, 'id' => 'search-form', 'class'=>'form-horizontal','autocomplete' => 'off' ]) !!}
                                        <div class="row clearfix">  
                                            <div class="col-md-3 pd-0">
                                                <label>User Name</label>
                                                <div class="form-group">
                                                {!! Form::text('user_name', '', ['class' => 'form-control', 'id' => 'user_name', 'autocomplete' => 'off', 'placeholder' => "User Name", ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3 pd-3">
                                                <div class="form-group">
                                                <label>Start Date</label>
                                                {!! Form::text('start_date', '', ['class' => 'form-control date-picker start-date-picker', 'id' => 'start_date', 'autocomplete' => 'off', 'data-plugin' => 'datepicker', 'placeholder' => 'dd-mm-yyyy' ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3 pd-3">
                                                <label>End Date</label>
                                                <div class="form-group">
                                                {!! Form::text('end_date', '', ['class' => 'form-control date-picker end-date-picker', 'id' => 'end_date', 'autocomplete' => 'off', 'data-plugin' => 'datepicker', 'placeholder' => 'dd-mm-yyyy']) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-3 pd-3">
                                                <label>Status</label>
                                                <div class="form-group">
                                                    <select name="status" class="form-control" class="status-picker">
                                                        <option value="2">-- Select status --</option>
                                                        <option value="1">Success</option>
                                                        <option value="0">Failed</option>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-lg-12">
                                                <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary" name="Search" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="{{ __('language.filter_transaction') }}">
                                                            <i class="fa fa-search"></i> &nbsp; {{ __('language.filter_transaction') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <button name ='Clear' class='btn btn-primary ' id="clearBtn" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Clear">Clear</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>    
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="example">
                                        <div class="data-table-container">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover table-striped dataTable w-full" data-url="{{ route('adminPanel.transaction.getTransactions') }}">
                                                    <thead class="table-header">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>User Details</th>
                                                            <th>PayPal Payment Id</th>
                                                            <th>Order Id</th>
                                                            <th>Date</th>
                                                            <th>Total Price</th>
                                                            <th>Status</th>
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
<script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/transaction/view.js') }}"></script>
@endpush
