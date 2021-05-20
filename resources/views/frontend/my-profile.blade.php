@extends('frontend.layouts.main')
<title>
    {{getSiteName()}} - My Profile
</title>
@section('main-section')
<!-- menu page section start -->
<div class="container-fluid headtype">
    <div class="container">
        <div class="row char">
            <a href="{{url('/')}}"> Home </a>&nbsp; /&nbsp; <span class="submenu"> My Profile</span>
        </div>
    </div>
</div>
<!-- sign section start -->
<section class="container-fluid ">
    <div class="container ">
        <div class="row">
            <div class="col-12">
                <div class="inner-title">
                    My Account
                </div>
            </div>

        </div>
        <div class="row ">
            <div class="col-md-3">
                <ul class="left-user-menu">
                    <li><a href="" class="left-user-menu-active">My Order</a></li>
                    <li><a href="">Personal Profile</a></li>
                    <li><a href="">My Address</a></li>
                    <li><a href="">Payment Method</a></li>
                    <li><a href="">Wishlist</a></li>
                    <li><a href="">My Coupons</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="order-items">
                    <div class="item-code">
                        # O42A808
                    </div>
                    <div class="d-status">
                        Out for Delivery
                    </div>
                    <p>Estimated Delivery On Tue, 14 Mar     2 products</p>

                    <div class="row cart-itemlist">
                        <div class="col-3">

                            <img src="{{asset('frontend/img/cart.png')}}" class="img-fluid"/>
                        </div>
                        <div class="col-9">
                            <div class="item-details">
                                <h4>Emery</h4>
                                <p>Lounge Beech wood Armchair</p>
                            </div>
                        </div>
                    </div>
                    <div class="row cart-itemlist">

                        <div class="col-3">

                            <img src="{{asset('frontend/img/cart.png')}}" class="img-fluid"/>
                        </div>
                        <div class="col-9">
                            <div class="item-details">
                                <h4>Emery</h4>
                                <p>Lounge Beech wood Armchair</p>
                            </div>
                        </div>
                    </div>
                    <a href="')}}" class="tracking">Track <i class="fa fa-play" aria-hidden="true"></i>
                    </a>
                    <a href="')}}" class="o-details">Order Details</a>
                </div>
                <div class="order-items">

                    <div class="item-code">
                        # O42A808
                    </div>
                    <div class="d-status">
                        Out for Delivery
                    </div>
                    <p>Estimated Delivery On Tue, 14 Mar     2 products</p>

                    <div class="row cart-itemlist">
                        <div class="col-3">

                            <img src="{{asset('frontend/img/cart.png')}}" class="img-fluid"/>
                        </div>
                        <div class="col-9">
                            <div class="item-details">
                                <h4>Emery</h4>
                                <p>Lounge Beech wood Armchair</p>
                            </div>
                        </div>
                    </div>
                    <div class="row cart-itemlist">

                        <div class="col-3">

                            <img src="{{asset('frontend/img/cart.png')}}" class="img-fluid"/>
                        </div>
                        <div class="col-9">
                            <div class="item-details">
                                <h4>Emery</h4>
                                <p>Lounge Beech wood Armchair</p>
                            </div>
                        </div>
                    </div>

                    <a href="')}}" class="o-details">Order Details</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- sign section closed -->
<!-- End why us    -->

@endsection
