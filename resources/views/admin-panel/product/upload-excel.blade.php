  @extends('admin-panel.layouts.main-layout')
  @section('page-title', 'Upload Excel | Admin Panel')
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
        <li class="breadcrumb-item active">Upload Excel</li>

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
                    <h4 class="example-title mb-1">Upload Excel</h4>
                    <p class="">Please upload an excel file.</p>
                    <div class="example">
                      {!! Form::open(['class' => 'upload-excel-form', 'method' => 'post', 'url' => route('adminPanel.product.uploadExcel'), 'files' => true ]) !!}
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group required">
                            <label class="form-label">Select an excel file.</label>
                             <span class="text-primary">(Note: Only  xls, xlsx, csv files are allowed)</span>
                            <input type="file" name="product_excel" class="form-control dropify" data-show-remove="true" required=""/>
                            <div class="invalid-feedback extension-error">This file is not allowed! Only  xls, xlsx, csv files are allowed.</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2 mt-20">
                          <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.upload_excel') }}">
                              <i class="fa fa-save"></i> &nbsp; {{ __('language.upload_excel') }}
                            </button>
                          </div>
                        </div>
                        <div class="col-md-2 mt-20">
                          <div class="form-group mb-0">
                            <a href="{{route('adminPanel.product.downloadExcel')}}">
                              <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="{{ __('language.dowload_example') }}">
                                <i class="fa fa-download"></i> &nbsp; {{ __('language.dowload_example') }}
                              </button>
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
  <script src="{{ asset('admin-assets/global/vendor/dropify/dropify.min.js') }}"></script>
  <script type="text/javascript">
    $('.dropify').dropify();
    $('.dropify').on("change",function(e) {
      var drEvent = $(this);
      drEvent = drEvent.data('dropify');
      var _imgExts = ["xls", "xlsx", "csv"];
      var fileName = e.target.files[0].name;
      var extension = fileName.substr( (fileName.lastIndexOf('.') +1) );
      var result = false;
      var i;
      if (extension) {
        extension = extension.toLowerCase();
        for (i = 0; i < _imgExts.length; i++) {
          if (_imgExts[i].toLowerCase() === extension) {
            result = true;
            break;
          }
        }
      }
      if (!result) {
        $(".extension-error").fadeIn(100);
        drEvent.resetPreview();
        drEvent.clearElement();
      }else{
        $(".extension-error").fadeOut(200);
      }
    })
  </script>
  <script src="{{ asset('admin-assets/js/summernote-bs4.js') }}"></script>
  <script src="{{ asset('admin-assets/global/vendor/switchery/switchery.js') }}"></script>
  <script src="{{ asset('admin-assets/global/js/Plugin/switchery.js') }}"></script>
  <script src="{{asset('admin-assets/global/js/Plugin/bootstrap-select.js')}}"></script>
  <script src="{{asset('admin-assets/global/vendor/multi-select/jquery.multi-select.js')}}"></script>
  <script src="{{ asset('admin-assets/js/components.js') }}"></script>
  <script src="{{ asset('admin-assets/js/product/upload-excel.js') }}"></script>
  @endpush
