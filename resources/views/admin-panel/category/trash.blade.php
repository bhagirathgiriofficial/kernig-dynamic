@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Trash | Category | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="page-title">Category</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('adminPanel.category.index') }}">Category</a></li>
                    <li class="breadcrumb-item active">Trash</li>
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
                                            <div class="col-lg-6 col-md-12 pd-0">
                                                <div class="form-group">
                                                    {!! Form::text('category_name', '', ['class' => 'form-control', 'id' => 'category_name', 'autocomplete' => 'off', 'placeholder' =>__('language.category_name'), ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary" name="Search" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Filter Category">
                                                                <i class="fa fa-search"></i> &nbsp; {{ __('language.filter_category') }}
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
                                                {!!Form::open(['id' => 'change-order-form', 'url' => route('adminPanel.category.changeOrder') ])!!}
                                                <table class="table table-bordered table-hover table-striped dataTable w-full" data-url="{{ route('adminPanel.category.getTrashCategories') }}" data-change-status-url="{{ route('adminPanel.category.changeStatus') }}" data-destroy-url="{{ route('adminPanel.category.moveToTrash') }}" data-change-order="">
                                                    <thead class="table-header">
                                                        <tr>
                                                            <th width="30" class="">
                                                                <div class="checkbox-custom checkbox-primary">
                                                                    <input type="checkbox" id="record" name="select_all" value="1">
                                                                    <label for="record"></label>
                                                                </div>
                                                            </th>
                                                            <th>#</th>
                                                            <th>Name</th>
                                                            <th>Id</th>
                                                            <th>Parent</th>
                                                            <th>Sub Parent</th>
                                                            <th>Image</th>
                                                            <th>Size Chart</th>
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
<script src="{{ asset('admin-assets/js/category/view.js') }}"></script>
@endpush
