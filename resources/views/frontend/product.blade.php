@extends('frontend.layouts.main')
@section('main-section')

@push('title')
    <title>
        {{$categoryData->category_name}} - Products
    </title>
@endpush
<div class="container-fluid headtype">
    <div class="container">
        <div class="row char">
            <a href="{{url('/')}}"> Home </a>&nbsp; /&nbsp; <span class="submenu"> {{$categoryData->category_name}}</span>
        </div>
        <div class="row">
            <div class="tapdata">
                <h2>{{$categoryData->category_name}}</h2>
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
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 col-6 text-decoration-underline">{{count($productData)}} Products</div>
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
            @foreach ($productData as $product)
            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                @if ($sub_sub_category != "" && $sub_category != "")
                    @php $baseUrl = url('/')."/product"; @endphp
                @elseif($sub_category != "")
                    @php $baseUrl = url('/')."/product"; @endphp
                @endif
                <a href="{{$baseUrl}}/{{$product->product_slug}}" style="color:inherit">
                    <img src="{{ get_image_url(config('constants.products.thumb_images_path'), $product->product_image)}}" height="230">

                <p>{{$product->product_name}}</p>
                {{-- <p>Beech wood Armchair</p> --}}
            </a>
                <h6 class="mt-4">Rs. <del> {{$product->product_price}} </del>  ( {{$product->product_discount_percent}} % Off )</h6>
                <div class="price mt-2">Rs. {{$product->product_discounted_price}} </div>
            </div>
            @endforeach
            {{-- <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-6 product">
                <img src="{{asset('frontend/img/p4.png')}}">
                <p>Emery Emerald</p>
                <p>Beech wood Armchair</p>
                <div class="price">Rs. 8900</div>
            </div> --}}
        </div>
    </div>
</div>
<!-- tab section closed -->

<!-- sign section closed -->
<!-- End why us    -->

@endsection
