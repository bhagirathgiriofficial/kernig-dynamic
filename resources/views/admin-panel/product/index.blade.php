@extends('admin-panel.layouts.main-layout')
@section('page-title', 'Product | Admin Panel')
@push('styles')
<link href="{{ asset('admin-assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet"/>
<style type="text/css">
    option:disabled{
        color: #3e8ef7;
        font-weight: bolder;
    }
</style>
@endpush
@section('content')
<div class="page">
    <!-- Page breadcrumbs -->
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="page-title">Product</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </div>
            <div class="col-md-6">
                <a href="{{ route('adminPanel.product.create') }}">
                    <button type="button" class="btn btn-floating btn-primary float-right btn-sm mt-1" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="Add Product"><i class="icon wb-plus" aria-hidden="true"></i></button>
                </a>
                <span class="float-right" style="margin: 5px;"></span>
                <a href="{{route('adminPanel.product.uploadExcelIndex')}}">
                    <button type="button" class="btn btn-floating btn-primary float-right btn-sm mt-1" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Upload Excel"><i class="icon fa fa-upload" aria-hidden="true"></i></button>
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
                                        {!! Form::open(['files'=>TRUE, 'id' => 'search-form', 'class'=>'form-horizontal','autocomplete' => 'off' ]) !!}
                                        <div class="row clearfix">
                                            <div class="col-lg-3 col-md-6 pd-0">
                                                <div class="form-group">
                                                    {!! Form::text('product_name', '', ['class' => 'form-control', 'id' => 'product_name', 'autocomplete' => 'off', 'placeholder' =>__('language.product_name_or_code'), ]) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 pd-5">
                                                <div class="form-group required">
                                                    <select name="category" class="form-control category-picker" required="" title="Please select category">
                                                        <option selected="" value="0">Select a category</option>
                                                        <?php
                                                        foreach ($categories as  $category) {
                                                            if (count($category['sub_categories'])>0){
                                                                echo "<optgroup label='".$category['category_name']."'>";
                                                                foreach ($category['sub_categories'] as  $sub_category) {
                                                                    if (count($sub_category['sub_sub_categories'])>0) {
                                                                        echo "<option value='".$sub_category['category_id']."' disabled='ture' style='margin-left:5px;'>".$sub_category['category_name']."</option>";
                                                                        foreach ($sub_category['sub_sub_categories'] as  $sub_sub_category) {
                                                                            echo "<option value='".$sub_sub_category['category_id']."'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$sub_sub_category['category_name']."</option>";
                                                                        }
                                                                    }
                                                                    else{
                                                                        echo "<option data-bold='true' value='".$sub_category['category_id']."'>".$sub_category['category_name']."</option>";
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
                                           <div class="col-lg-6 col-md-12">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-primary" name="Search" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" data-original-title="Filter Product">
                                                                <i class="fa fa-search"></i> &nbsp; {{ __('language.filter_product') }}
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
                                        {!! Form::close() !!}
                                        </div>
                                    </div>
                                    <div class="example">
                                        <div class="data-table-container">
                                            <div class="table-responsive">
                                                <form class="change-type-from">
                                                    <table class="table table-bordered table-hover table-striped dataTable w-full" data-url="{{ route('adminPanel.product.getProducts') }}" data-change-status-url="{{ route('adminPanel.product.changeStatus') }}" data-destroy-url="{{ route('adminPanel.product.destroy') }}" data-change-type-url="{{route('adminPanel.product.changeType')}}" data-change-stock-status-url="{{route('adminPanel.product.changeStockStatus')}}">
                                                        <thead class="table-header">
                                                            <tr>
                                                                <th width="30" class="">
                                                                    <div class="checkbox-custom checkbox-primary">
                                                                        <input type="checkbox" id="record" name="select_all" value="1">
                                                                        <label for="record"></label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>Image</th>
                                                                <th>Id</th>
                                                                <th width="200px">Name</th>
                                                                <th>Code</th>
                                                                <th>Price</th>
                                                                <th>Category</th>
                                                                <th width="75px">Hot Seller</th>
                                                                <th>Order</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </form>
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
<script src="{{ asset('admin-assets/js/product/view.js') }}"></script>
@endpush
