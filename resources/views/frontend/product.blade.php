@extends('frontend.layouts.main')
@section('main-section')


<div class="container-fluid headtype">
    <div class="container">
        <div class="row char">
            <a href="{{url('/')}}"> Home </a>&nbsp; /&nbsp; <span class="submenu"> Chairs</span>
        </div>
        <div class="row">
            <div class="tapdata">
                <h2>Chair</h2>
                <div class="chair">
                    <img src="{{asset('frontend/img/c1.png')}}">
                    <h5>Solid Wood Chair</h5>

                </div>
                <div class="chair">
                    <img src="{{asset('frontend/img/c2.png')}}">
                    <h5>Bar Chair</h5>
                </div>
                <div class="chair">
                    <img src="{{asset('frontend/img/c3.png')}}">
                    <h5>Solid Wood Chair</h5>
                </div>
                <div class="chair">
                    <img src="{{asset('frontend/img/c4.png')}}">
                    <h5>Solid Wood Chair</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row short">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6">70 Product</div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6 shortby">
                <select>
                    <option>Short By</option>
                    <option>Our Picks</option>
                    <option>New</option>
                    <option>Price: Low to High </option>
                    <option>Price: High to Low</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p1.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p2.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p3.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p4.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p1.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p2.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p3.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p4.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p1.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p2.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p3.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p4.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p1.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p2.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p3.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p4.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div>
        </div>
    </div>
</div>
<!-- tab section closed -->

<!-- sign section closed -->
<!-- End why us    -->

@endsection
