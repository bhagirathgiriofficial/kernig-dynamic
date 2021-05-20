@if(!empty($charges))
@for($i = 0;$i<40;$i++) <div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="hidden" name="shipping[{{$i}}][id]" value="{{$charges[$i][shipping_id]}}">
                <label class="form-control-label" for="shipping_weight">Weight {{$i+1}} (gms)</label>
                <input type="number" min="0" step="any" name="shipping[{{$i}}][weight]" class="form-control shipping-weight" autocomplete="off" placeholder="{{__('language.shipping_weight')}}" value="{{$charges[$i][shipping_weight]}}" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="form-control-label" for="shipping_charges">Charges {{$i+1}}</label>
                <input type="number" min="0" step="any" name="shipping[{{$i}}][charges]" class="form-control shipping-charge" autocomplete="off" placeholder="{{__('language.shipping_charges')}}" value="{{$charges[$i][shipping_price]}}" />
            </div>
        </div>
    </div>
    </div>
    @endfor
    @else
    @for($i = 0;$i<40;$i++) <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <input type="hidden" name="shipping[{{$i}}]['id']" value="">
                    <label class="form-control-label" for="shipping_weight">Weight {{$i+1}} (gms)</label>
                    <input type="number" min="0" step="any" name="shipping[{{$i}}][weight]" class="form-control shipping-weight" autocomplete="off" placeholder="{{__('language.shipping_weight')}}" />
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="form-control-label" for="shipping_charges">Charges {{$i+1}}</label>
                    <input type="number" min="0" step="any" name="shipping[{{$i}}][charges]" class="form-control shipping-charge" autocomplete="off" placeholder="{{__('language.shipping_charges')}}" />
                </div>
            </div>
        </div>
        </div>
        @endfor
        @endif
