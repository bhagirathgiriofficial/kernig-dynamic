<div class="modal-content">
    {!! Form::open(['class' => 'add-video-category-form', 'method' => 'post', 'url' => route('adminPanel.video-category.saveNewVideoCategory') ]) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title">Add Video Category</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12" id="custom-error"> </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-control-label" for="category-name">@lang('language.category_name')</label>
                        {!! Form::text('category_name', '', ['class' => 'form-control required', 'id' => 'category_name', 'autocomplete' => 'off', 'placeholder' =>__('language.category_name'),  'title' => 'Please enter valid video category name.', 'pattern' => '[a-zA-Z][a-zA-Z ]+$' ]) !!}
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-submit">
                <i class="fa fa-save"></i> &nbsp; {{ __('language.create_video_category') }}
            </button>
        </div>
    {!! Form::close() !!}
</div>
