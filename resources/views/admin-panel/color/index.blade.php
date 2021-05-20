@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Color | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="page-title">Color</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Color</li>
                </ol> 
            </div>
            <div class="col-md-6">
                <a href="{{ route('adminPanel.color.create') }}">
                    <button type="button" class="btn btn-floating btn-primary float-right btn-sm mt-1" data-toggle="tooltip" data-placement="left" data-trigger="hover" data-original-title="Add Color">
                        <Id class="icon wb-plus" aria-hidden="true"></i>
                    </button>
                </a>
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
                                        {!! Form::open(['files'=>TRUE, 'id' => 'search-form', 'class'=>'form-horizontal','autocomplete' => 'off']) !!}
                                        <div class="row clearfix">
                                            <div class="col-lg-6 col-md-12 pd-0">
                                                <div class="form-group">
                                                    {!! Form::text('color_name', '', ['class' => 'form-control', 'id' => 'color_name', 'autocomplete' => 'off', 'placeholder' =>__('language.color_name'), ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary" name="Search" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Filter Color">
                                                                <i class="fa fa-search"></i> &nbsp; {{ __('language.filter_color') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <button name='Clear' class='btn btn-primary ' id="clearBtn" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Clear">Clear</button>
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
                                                {!!Form::open(['id' => 'change-order-form', 'url' => route('adminPanel.color.changeOrder') ])!!}
                                                <table class="table table-bordered table-hover table-striped dataTable w-full" data-url="{{ route('adminPanel.color.getColors') }}" data-change-status-url="{{ route('adminPanel.color.changeStatus') }}" data-destroy-url="{{ route('adminPanel.color.destroy') }}">
                                                    <thead class="table-header">
                                                        <tr>
                                                            <th width="30" class="">
                                                                <div class="checkbox-custom checkbox-primary">
                                                                    <input type="checkbox" id="record" name="select_all" value="1">
                                                                    <label for="record"></label>
                                                                </div>
                                                            </th>
                                                            <th>#</th>
                                                            <th>Color Name</th>
                                                            <th>Id</th>
                                                            <th>Color</th>
                                                            <th width="10%">Order</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                                 {!!Form::close()!!}
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
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/color/view.js') }}"></script>
@endpush
