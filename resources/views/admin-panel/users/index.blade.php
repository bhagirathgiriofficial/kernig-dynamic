@extends('admin-panel.layouts.main-layout')

@section('page-title', 'Users | Admin Panel')

@push('styles')
<link href="{{ asset('admin-assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="page">
   <!-- Page breadcrumbs -->
   <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="page-title">Users Management</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
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
                                    <div class="example-wrap ">
                                        <h4 class="example-title mb-1">Users</h4>
                                        <p class="">Below are the list of users.</p>
                                        <div class="example">
                                            <div class="data-table-container">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-hover table-striped dataTable w-full" data-url="{{ route('adminPanel.users.getUser') }}" data-change-status-url="{{ route('adminPanel.users.changeStatus') }}">
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
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Address</th>
                                                            <th>City</th>
                                                            <th>State</th>
                                                            <th>Country</th>
                                                            <th>Zip Code</th>
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

@push('scripts')s
<script src="{{ asset('admin-assets/global/vendor/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/datatables.net-buttons/dataTables.buttons.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/datatables.net-buttons/buttons.html5.js') }}"></script>
<script src="{{ asset('admin-assets/global/vendor/datatables.net-buttons/buttons.print.js') }}"></script>
<script src="{{ asset('admin-assets/js/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin-assets/js/datatable/dataTables.checkboxes.min.js') }}"></script>
<script src="{{ asset('admin-assets/js/user/view.js') }}"></script>
@endpush
