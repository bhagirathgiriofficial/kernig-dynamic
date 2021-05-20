  @extends('admin-panel.layouts.main-layout')
  @section('page-title', 'Upload Images Zip | Admin Panel')
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
        <li class="breadcrumb-item active">Upload Images Zip</li>

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
                    <h4 class="example-title mb-1">Upload Images Zip</h4>
                    <p class="">Please upload a zip file.</p>
                    <div class="example">
                      {!! Form::open(['class' => 'upload-zip-form', 'method' => 'post', 'url' => route('adminPanel.product.uploadZip'), 'files' => true ]) !!}
                      <div class="row">
                          <div class="col-md-12">
                            <div class="form-group required">
                              <label class="form-label">Select a Zip file.</label>
                            <input type="file" name="product_zip" class="form-control dropify" data-show-remove="true" data-allowed-file-extensions="zip" required=""/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2 mt-20">
                          <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.upload_zip') }}">
                              <i class="fa fa-save"></i> &nbsp; {{ __('language.upload_zip') }}
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
  <script type="text/javascript">
    $('.dropify').dropify();
  </script>
  <script src="{{ asset('admin-assets/js/summernote-bs4.js') }}"></script>
  <script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
  <script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
  <script src="{{asset('admin-assets/global/js/Plugin/bootstrap-select.js')}}"></script>
  <script src="{{asset('admin-assets/global/vendor/multi-select/jquery.multi-select.js')}}"></script>
  <script src="{{ asset('admin-assets/js/components.js') }}"></script>
  <script src="{{ asset('admin-assets/js/product/upload-excel.js') }}"></script>
  @endpush
