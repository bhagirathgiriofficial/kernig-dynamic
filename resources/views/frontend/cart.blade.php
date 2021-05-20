@extends('frontend.layouts.main')
@section('main-section')
<!-- Start kitchan slider -->
<!-- menu page section start -->
<div class="container-fluid headtype">
    <div class="container">
        <div class="row char">
            <a href="{{url('/')}}"> Home </a>&nbsp; /&nbsp; <span class="submenu"> Cart </span>
        </div>
    </div>
</div>
<!-- me page section closed -->

<!-- cart section start -->
<section class="container-fluid cart">
    <div class="container">
        <div class="row cart">
            <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7">
                product
            </div>
            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 row" style="text-align: center;">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">Unit Price</div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">Quentity</div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">Total</div>
            </div>
        </div>

        <div class="row procart">
            <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7  ">
                <div class="proimg"><img src="{{asset('frontend/img/p1.png')}}"></div>
                <div class="prodet">
                    <p class="propra">Dora Lounge Armchair, Mustard Velvet with Natural Legs</p>
                    <p>Estimated dispatch within 12 - 14 weeks</p></div>
            </div>

            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 row prodetail">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">Rs. 2000</div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
                    <input type="number"  name="" value="1">
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
                <span>Rs. 4000</span>
                <span><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            </div>
        </div>

        <div class="row procart">
            <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7  ">
                <div class="proimg"><img src="{{asset('frontend/img/p1.png')}}"></div>
                <div class="prodet">
                    <p class="propra">Dora Lounge Armchair, Mustard Velvet with Natural Legs</p>
                    <p>Estimated dispatch within 12 - 14 weeks</p></div>
            </div>

            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 row prodetail">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">Rs. 2000</div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
                    <input type="number" value="1"  name="">
                </div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
                <span>Rs. 4000</span>
                <span><i class="fa fa-times" aria-hidden="true"></i></span>
            </div>
            </div>
        </div>

        <!-- checkout section -->
        <div class="row procarttotal">
            <div class="col-sm-12 col-md-7 col-lg-7 col-xl-7  ">

            </div>

            <div class="col-sm-12 col-md-5 col-lg-5 col-xl-5 row prodetail">
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">Subtotal</div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4"></div>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-4">
                <span>Rs. 4000</span>
                <p>(Including Tax)</p>
            </div>
            </div>
        </div>
        <div class="promocode">
            <p>HAVE A PROMO CODE?</p>
            <div><input type="text" name="">
            <input type="submit" name="" value="REDDEM"></div>


        </div>

           <div class="sub row"><input type="submit" name="" class="check" value="GO TO CHECKOUT"></div>

        <!-- checkout section closed -->



    </div>
</section>
<!-- End why us    -->

@endsection
