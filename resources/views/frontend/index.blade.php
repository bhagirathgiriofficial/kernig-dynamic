@extends('frontend.layouts.main')
@push('title')
<title>
    {{getSiteName()}}
</title>
@endpush
@section('main-section')
<!-- Start kitchan slider -->
<div class="owl-carousel owl-theme kitchan-slider" id="kitchan_slider">
    @php
    $sliderData = sliderData();
    @endphp
    @foreach ($sliderData as $slider)
    <div class="item">
        <a href="{{$slider->slider_link}}">
            <img src="{{get_image_url(config('constants.slider.images_path'), $slider->slider_image)}}" alt="" height="590"/>
        </a>
    </div>
    @endforeach
    {{-- <div class="item">
        <img src="{{asset('frontend/img/banner1.png')}}" alt="">
    </div> --}}
</div>
<!-- End kitchan slider -->

<!-- Start Hot Sellers  -->
<section class="hot-sellers">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="comman-heading text-uppercase text-center">Hot sellers</h1>
            </div>
        </div>
        <div class="hot-sellers-cards row justify-content-center">
            @foreach (getHotSellerProduct() as $hotSellerProduct)
            <div class="col-6 col-md-4 col-lg-2 col  text-center">
                <div class="hot-sellers-card">

                    <img src="{{get_image_url(config('constants.products.images_path'), $hotSellerProduct->product_image)}}" alt="" class="img-fluid">
                    <h4>{{$hotSellerProduct->product_name}}</h4>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>
<!-- End Hot Sellers    -->

<!-- Start Spotlight -->
<section class="spotlight">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="comman-heading text-uppercase text-center">spotlight</h2>
            </div>
        </div>
        <div class="spotlight-cards row">
            <div class="col-12  col-sm-6 col-lg-4">
                <div class="spotlight-card">
                    <img src="{{asset('frontend/img/cafe.png')}}" alt="" class="img-fluid">
                    <div class="card-body text-center">
                        <h4>Cafe/Restaurant</h4>
                        <p class="text-uppercase">Shop Now</p>
                    </div>

                </div>
            </div>
            <div class="col-12  col-sm-6 col-lg-4">
                <div class="spotlight-card">
                    <img src="{{asset('frontend/img/whole-house.png')}}" alt="" class="img-fluid">
                    <div class="card-body text-center">
                        <h4>Plan Your Whole House</h4>
                        <p class="text-uppercase">Shop Now</p>
                    </div>

                </div>
            </div>
            <div class="col-12  col-sm-6 col-lg-4">
                <div class="spotlight-card">
                    <img src="{{asset('frontend/img/hotel.png')}}" alt="" class="img-fluid">
                    <div class="card-body text-center">
                        <h4>Resort/Hotel</h4>
                        <p class="text-uppercase">Shop Now</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- End Spotlight   -->
<!-- Start Recent Work -->
<section class="spotlight recent-work bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="comman-heading text-uppercase text-center font-weight-lighter">recent work</h2>
            </div>
        </div>
        <div class="spotlight-cards row">
            <div class="col-sm-6 col-lg-4">
                <div class="spotlight-card">
                    <img src="{{asset('frontend/img/cafe.png')}}" alt="" class="img-fluid">
                    <div class="card-body text-center">
                        <h4>Soul Brew</h4>
                        <p class="text-uppercase">AHMEDABAD</p>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="spotlight-card">
                    <img src="{{asset('frontend/img/whole-house.png')}}" alt="" class="img-fluid">
                    <div class="card-body text-center">
                        <h4>OTP</h4>
                        <p class="text-uppercase">MUMBAI</p>
                    </div>

                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="spotlight-card">
                    <img src="{{asset('frontend/img/hotel.png')}}" alt="" class="img-fluid">
                    <div class="card-body text-center">
                        <h4>Thambi</h4>
                        <p class="text-uppercase">CHENNAI</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- End Recent Work   -->

<!-- Start Our Valued Clientele -->
<section class="our-valued bg-white">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="comman-heading text-uppercase text-center font-weight-lighter">our valued clientele</h3>
            </div>
        </div>
        <div class="owl-carousel owl-theme logos-slider row" id="logos_slider">
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/Imperfecto.png')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/TD-Since-1959.png')}}" alt="">
                </a>
            </div>
            <a href="#" target="_blank">
                <div class="col-12 logo-card item">
                    <img src="{{asset('frontend/img/Sotally-Tober.jpg')}}" alt="">
                </div>
            </a>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/TBSE.png')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/C-B-Patel.jpg')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/Double-Barrel.jpg')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/Imperfecto.png')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/TD-Since-1959.png')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/Sotally-Tober.jpg')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/TBSE.png')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/C-B-Patel.jpg')}}" alt="">
                </a>
            </div>
            <div class="col-12 logo-card item">
                <a href="#" target="_blank">
                    <img src="{{asset('frontend/img/Double-Barrel.jpg')}}" alt="">
                </a>
            </div>
        </div>
    </div>
</section>
<!-- End Our Valued Clientele   -->

<!-- Start why us  -->
<section class="why-us">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="comman-heading text-uppercase text-center font-weight-normal">why us?</h3>
            </div>
        </div>

        <div class="row whyus-cards">
            <div class="col">
                <div class="whyus-card text-center">
                    <div class="whyus-card-img">
                        <img src="{{asset('frontend/img/customize-every-details.png')}}" alt="">
                    </div>
                    <div class="card-body">
                        <h5>Customise every detail</h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="whyus-card text-center">
                    <div class="whyus-card-img">
                        <img src="{{asset('frontend/img/high-quality-furniture.png')}}" alt="">
                    </div>
                    <div class="card-body">
                        <h5>Affordable, high quality furniture </h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="whyus-card text-center">
                    <div class="whyus-card-img">
                        <img src="{{asset('frontend/img/row-mate.png')}}" alt="">
                    </div>
                    <div class="card-body">
                        <h5>Ethical sourcing of
                            raw material</h5>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="whyus-card text-center">
                        <div class="whyus-card-img">
                            <img src="{{asset('frontend/img/delivery.png')}}" alt="">
                        </div>
                        <div class="card-body">
                            <h5>Delivered to
                                your doorstep</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="whyus-card text-center">
                            <div class="whyus-card-img">
                                <img src="{{asset('frontend/img/project-complete.png')}}" alt="">
                            </div>
                            <div class="card-body">
                                <h5>700+ projects completed</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End why us    -->

        @endsection
