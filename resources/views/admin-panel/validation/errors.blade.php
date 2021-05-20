@if ($errors->any())
    <div class="alert dark alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h4>{{ $title }}</h4>
        
        @foreach ($errors->all() as $error)
            <div> {{ $error }} </div>
        @endforeach

    </div>
@endif
