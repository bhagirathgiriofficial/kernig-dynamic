@extends('admin-panel.layouts.main-layout')

@section('page-title', 'Update Account Setting | Admin Panel')

@push('styles')
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/dropify/dropify.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/css/summernote-bs4.css') }}" rel="stylesheet">
<link href="{{ asset('admin-assets/global/vendor/switchery/switchery.css') }}" rel="stylesheet">
<style type="text/css">
  .show-me{
    display: none;
  }
  .show-me-toggle{
    cursor: pointer;
  }
</style>
@endpush

@section('content')
<div class="page">
 <!-- Page breadcrumbs -->
 <div class="page-header">
  <h1 class="page-title">Account Setting</h1>
  <ol class="breadcrumb">
   <li class="breadcrumb-item"><a href="{{ route('adminPanel.dashboard') }}">Dashboard</a></li>
   <li class="breadcrumb-item active">{{trans('language.update_account')}}</li>
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
                <h4 class="example-title mb-1">Update Account Setting</h4>
                <p class="">Please fill the below information.</p>
                <div class="example">
                  {!! Form::open(['class' => 'add-account-form', 'method' => 'post', 'url' => route('adminPanel.accountSetting.update', ['id' => ev($account->account_setting_id)]), 'files' => true ]) !!}
                  <div class="row">
                    <div class="col-md-12 form-group required">
                      <label class="form-control-label" for="site_name">@lang('language.site_name')</label>
                      {!! Form::text('site_name', old('site_name', ($account->site_name ?? '')), ['class' => 'form-control', 'id' => 'site_name', 'autocomplete' => 'off', 'placeholder' =>__('language.site_name'),'maxlength' => 100 , 'data-url' => route('adminPanel.measurement.checkMeasurementTitle')]) !!}
                    </div>
                    <abbr class="col-md-12 form-group required">
                      <label class="form-control-label" for="top_tagline">@lang('language.top_tagline')</label>
                      {!! Form::text('top_tagline', old('top_tagline', ($account->top_tagline ?? '')), ['class' => 'form-control', 'id' => 'top_tagline', 'autocomplete' => 'off', 'placeholder' =>__('language.top_tagline'),'maxlength' => 100 , 'data-url' => route('adminPanel.measurement.checkMeasurementTitle')]) !!}
                    </div>
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="row">
                           <div class="col-md-12 form-group required">
                            <label class="form-control-label" for="site_email">@lang('language.site_email')</label>
                            {!! Form::text('site_email', old('site_email', ($account->site_email ?? '')), ['class' => 'form-control', 'id' => 'site_email', 'autocomplete' => 'off', 'maxlength' => 100 , 'placeholder' =>__('language.site_email') ]) !!}
                          </div>
                          <div class="col-md-12">
                            <div class="form-group required">
                              <label class="form-control-label" for="site_sales_email">@lang('language.site_sales_email')
                              </label>
                              {!! Form::text('site_sales_email', old('site_sales_email', ($account->site_sales_email ?? '')),['placeholder' => __('language.site_sales_email'), 'class' => 'form-control', 'id' => 'site_sales_email', 'autocomplete' => 'off']) !!}
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group required">
                              <label class="form-control-label" for="site_number">@lang('language.site_number')
                              </label>
                              {!! Form::text('site_number', old('site_number', ($account->site_number ?? '')),['placeholder' => __('language.site_number'), 'class' => 'form-control', 'id' => 'site_number','minlength' => 10, 'maxlength' => 15, 'autocomplete' => 'off']) !!}
                            </div>
                          </div>
                        </div>
                      </div>
                     <!--  <input type="hidden" name="logo_name" value="{{$account->site_logo}}"/>
                      <div class="col-md-6" style="margin-top: 15px">
                        @if($image_url!="")
                        <div class="form-group required">
                          <label for="input-file-disable-remove">@lang('language.site_logo')</label>
                          <input type="file" name="site_logo" id="input-file-disable-remove" class="dropify" data-show-remove="false"  data-default-file="{{$image_url}}" data-allowed-file-extensions="jpeg jpg gif bmp"/>
                        </div>
                        @else
                        <div class="form-group required">
                          <label for="input-file-disable-remove">@lang('language.site_logo')</label>
                          <input type="file" name="site_logo" id="input-file-disable-remove" class="dropify" data-show-remove="false" data-allowed-file-extensions="jpeg jpg gif bmp" required="" />
                        </div>
                        @endif
                      </div> -->
                      <div class="col-md-6">
                        <div class="form-group required">
                          <label class="form-control-label" for="site_address">@lang('language.site_address')</label>
                          <div class="total-char">Note: Upto 1000 character only!</div>
                          <textarea name="site_address" class = "form-control count-me" maxlength="1000" rows="9" id = "site_address" placeholder="{{ __('language.site_address')}}">{{$account->site_address}}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label> Site Logo </label>
                      <input type="file" name="site_logo" class="dropify" data-show-remove="false" data-default-file="{{$siteLogoUrl}}"/>
                      <div>(Note: Only svg image is allowed) <strong class="float-right text-primary show-me-toggle" id="show-image1" data-toggle="1">Show Image</strong> </div>
                      <div class="img-thumbnail show-me" id="image1">
                      <img  src="{{$siteLogoUrl}}"  width="100%" height="100px;">
                    </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group required">
                      <label> Email Logo </label>
                      <input type="file" name="email_logo" class="dropify" data-allowed-file-extensions="png" data-show-remove="false" data-default-file="{{$emailLogoUrl}}"/>
                      <div>(Note: Only png image is allowed)</div>
                    </div>

                  </div>
                  {{-- <div class="col-md-4">
                    <div class="form-group required">
                      <label> Scroll Logo </label>
                      <input type="file" name="scroll_logo" class="dropify" data-allowed-file-extensions="svg" data-show-remove="false" data-default-file="{{$scrollLogoUrl}}"/>
                      <div>(Note: Only svg image is allowed) <strong class="float-right text-primary show-me-toggle" id="show-image2" data-toggle="1">Show Image</strong></div>
                      <div class="img-thumbnail show-me"  id="image2">
                      <img src="{{$scrollLogoUrl}}"  width="100%" height="100px;">
                    </div>
                    </div>

                  </div> --}}
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <!-- Begin of URLS -->
                      <div class="col-md-12">
                      <h4 class="well well-sm">Social URLS:</h4>
                        <div class="row">
                          <label class="col-md-9 form-control-label"><b></b></label>
                        </div>
                        <div id="myTable" class="order-list1">
                          <div class="add-section-panel">
                            <input type="hidden" name="" value=""/> <div class="panel border">
                              <div class="panel-body social-panel-padding">
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group required"> <label class="display-block form-control-label" for="title"> Title </label>
                                      <input class="form-control" autocomplete="off" name="" type="text" value="Facebook" disabled="">
                                    </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="form-group">
                                      <label class="display-block form-control-label" for="url"> Social URL | <spam> Eg: https://example.com  </spam> </label>
                                      <textarea rows="1" class="form-control" autocomplete="off" name="facebook_url" type="text">{{$account->facebook_url}}</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="col-md-12">
                        <div class="row">
                          <label class="col-md-9 form-control-label"><b></b></label>
                        </div>
                        <div id="myTable" class="order-list1">
                          <div class="add-section-panel">
                            <input type="hidden" name="" value=""/> <div class="panel border">
                              <div class="panel-body social-panel-padding">
                                <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group required"> <label class="display-block form-control-label" for="title"> Title </label>
                                      <input class="form-control" autocomplete="off" name="" type="text" value="Twitter" disabled="">
                                    </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="form-group">
                                      <label class="display-block form-control-label" for="url"> Social URL | <spam> Eg: https://example.com  </spam> </label>
                                      <textarea rows="1" class="form-control" autocomplete="off" name="twitter_url" type="text">{{$account->twitter_url}}</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> --}}
                      <div class="col-md-12">
                        <div class="row">
                          <label class="col-md-9 form-control-label"><b></b></label>
                        </div>
                        <div id="myTable" class="order-list1">
                          <div class="add-section-panel">
                            <input type="hidden" name="" value=""/> <div class="panel border">
                              <div class="panel-body social-panel-padding">
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group required"> <label class="display-block form-control-label" for="title"> Title </label>
                                      <input class="form-control" autocomplete="off" name="" type="text" value="Instagram" disabled="">
                                    </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="form-group">
                                      <label class="display-block form-control-label" for="url"> Social URL | <spam> Eg: https://example.com  </spam> </label>
                                      <textarea rows="1" class="form-control" autocomplete="off" name="instagram_url" type="text">{{$account->instagram_url}}</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="col-md-12">
                        <div class="row">
                          <label class="col-md-9 form-control-label"><b></b></label>
                        </div>
                        <div id="myTable" class="order-list1">
                          <div class="add-section-panel">
                            <input type="hidden" name="" value=""/> <div class="panel border">
                              <div class="panel-body social-panel-padding">
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group required"> <label class="display-block form-control-label" for="title"> Title </label>
                                      <input class="form-control" autocomplete="off" name="" type="text" value="Google Plus" disabled="">
                                    </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="form-group">
                                      <label class="display-block form-control-label" for="url"> Social URL | <spam> Eg: https://example.com  </spam> </label>
                                      <textarea rows="1" class="form-control" autocomplete="off" name="google_plus_url" type="text">{{$account->googleplus_url}}</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->
                      <div class="col-md-12">
                        <div class="row">
                          <label class="col-md-9 form-control-label"><b></b></label>
                        </div>
                        <div id="myTable" class="order-list1">
                          <div class="add-section-panel">
                            <input type="hidden" name="" value=""/> <div class="panel border">
                              <div class="panel-body social-panel-padding">
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group required"> <label class="display-block form-control-label" for="title"> Title </label>
                                      <input class="form-control" autocomplete="off" name="" type="text" value="Pintrest" disabled=""/>
                                    </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="form-group">
                                      <label class="display-block form-control-label" for="url"> Social URL | <spam> Eg: https://example.com </spam> </label>
                                      <textarea rows="1" class="form-control" autocomplete="off" name="pintrest_url" type="text">{{$account->pinterest_url}}</textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- End of URL -->
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 mt-20">
                    <div class="form-group mb-0">
                      <button type="submit" class="btn btn-primary btn-submit" data-toggle="tooltip" data-placement="top" data-trigger="hover" data-original-title="@if(!empty($account)) {{ __('language.update_account')}} @else {{ __('language.update_account') }} @endif ">
                        <i class="fa fa-save"></i> &nbsp;  @if(!empty($account)) {{ __('language.update_account')}} @else {{ __('language.update_account') }} @endif
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
<script src="{{ asset('admin-assets/js/components.js') }}"></script>
<script src="{{ asset('admin-assets/js/account-setting/account.js') }}"></script>
<script src="{{ asset('admin-assets/js/char-count.js') }}"></script>
@endpush
