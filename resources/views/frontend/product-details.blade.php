@extends('frontend.layouts.main')
@section('main-section')
<!-- menu page section start -->
<div class="container-fluid headtype">
    <div class="container">
        <div class="row char">
            Home / <span class="submenu"> {{$product['product_name']}}</span>
        </div>
    </div>
</div>
<!-- me page section closed -->

<!-- product detail section start -->
<section class="container-fluid cart">
    <div class="container">
        <div class="row">
            {{-- <div class="col-sm-12 col-xm-12 col-md-6 col-lg-8 col-xl-8 proslide">
                <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                    <!-- slides -->
                    <div class="carousel-inner">
                        <div class="carousel-item  active">
                            <img src="{{asset('frontend/img/charebig.png')}}" alt="Hills">
                        </div>

                        <div class="carousel-item">
                            <img src="{{asset('frontend/img/charebig.png')}}" alt="Hills">
                        </div>

                        <div class="carousel-item">
                            <img src="{{asset('frontend/img/charebig.png')}}" alt="Hills">
                        </div>

                        <div class="carousel-item">
                            <img src="{{asset('frontend/img/charebig.png')}}" alt="Hills">
                        </div>

                    </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                    <ol class="carousel-indicators list-inline">
                        <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="{{asset('frontend/img/charebig.png')}}" class="img-fluid thumbimg"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="{{asset('frontend/img/charebig.png')}}" class="img-fluid thumbimg"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="{{asset('frontend/img/charebig.png')}}" class="img-fluid thumbimg"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel"> <img src="{{asset('frontend/img/charebig.png')}}" class="img-fluid thumbimg"> </a> </li>

                    </ol>
                </div>
            </div> --}}
            <div class="col-sm-12 col-xm-12 col-md-6 col-lg-8 col-xl-8 proslide">
                <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center">
                    <!-- slides -->
                    <div class="carousel-inner">
                        <div class="carousel-item  active">
                            <img src="{{asset('frontend/img/charebig.png')}}" alt="Hills">
                        </div>

                        <div class="carousel-item">
                            <img src="{{asset('frontend/img/charebig.png')}}" alt="Hills">
                        </div>

                        <div class="carousel-item">
                            <img src="{{asset('frontend/img/charebig.png')}}" alt="Hills">
                        </div>

                        <div class="carousel-item">
                            <img src="{{asset('frontend/img/charebig.png')}}" alt="Hills">
                        </div>

                    </div> <!-- Left right --> <a class="carousel-control-prev" href="#custCarousel" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#custCarousel" data-slide="next"> <span class="carousel-control-next-icon"></span> </a> <!-- Thumbnails -->
                    <ol class="carousel-indicators list-inline">
                        <li class="list-inline-item active"> <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#custCarousel"> <img src="{{asset('frontend/img/charebig.png')}}" class="img-fluid thumbimg"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-1" data-slide-to="1" data-target="#custCarousel"> <img src="{{asset('frontend/img/charebig.png')}}" class="img-fluid thumbimg"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="2" data-target="#custCarousel"> <img src="{{asset('frontend/img/charebig.png')}}" class="img-fluid thumbimg"> </a> </li>
                        <li class="list-inline-item"> <a id="carousel-selector-2" data-slide-to="3" data-target="#custCarousel"> <img src="{{asset('frontend/img/charebig.png')}}" class="img-fluid thumbimg"> </a> </li>

                    </ol>
                </div>
            </div>
            <div class="col-sm-12 col-xm-12 col-md-6 col-lg-4 col-xl-4 prosingle">
                <h1> {{$product['product_name']}}</h1>
                <p>Emery Lounge</p>
                <p>Beech wood Armchair</p>
                <h5 class="mt-3">Rs. <del> {{$product['product_price']}} </del> ( {{$product['product_discount_percent']}} % off. )</h5>
                <h3 class="mt-3">Rs. {{$product['product_discounted_price']}} </h3>
                <div class="procolor">
                    <h3>Color</h3>
                    @foreach ($product['color'] as $color)
                    <div class="colorcirclechild">
                        <div class="colorcircle" style="background-color:{{$color['color_code']}};"></div>
                        <p>{{$color['color_name']}}</p>
                    </div>
                    @endforeach
                </div>

                <div class="clear"></div>
                <div class="procolor">
                    <h3>Wood Finish</h3>
                    @foreach ($product['fabric'] as $fabric)
                    <div class="colorcirclechild">
                        <div class="colorcircle"><img src="{{asset('frontend/img/w1.jpg')}}"></div>
                        <p>{{$fabric['fabric_name']}}</p>
                    </div>
                    @endforeach

                </div>

                <button type="submit" class="cartbu">Add To Cart</button>
                {{-- <div class="dimation">
                    <h3 id="flip" style="cursor: pointer">Dimensions  <i class='fas fa-angle-right'></i></h3>
                    <ul id="panel">
                        <li>Height (cm)     89</li>
                        <li>Width (cm)      74 </li>
                        <li>Depth (cm)      84 </li>
                        <li>Weight (kg)     15 </li>
                        <li>Packaging dimensions: H61 x W86 x D76 cm</li>
                    </ul>
                </div> --}}

                <div class="dimation">
                    <h3 id="flip1" style="cursor: pointer">Product Detail  <i class='fas fa-angle-right'></i></h3>
                    <p id="panel1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
                    </p>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- product detail section closed -->

<!-- product feature section closed -->
<section class="container-fluid feature">
    <div class="container">
        <div class="row">
            <h1>Product Feature</h1>
            <div class="col-sm-12 col-xm-12 col-md-4 col-lg-4 col-xl-4 feat">
                <h2>PROPERTIES</h2>
                <ul>
                    <li>- Name :  Emery Armchair</li>
                    <li>- SKU : CHADRI024ORA</li>
                    <li>- Dimensions : </li>
                    <li>- Assembly :  Legs to be fitted</li>
                    <li>- Fabric composition : 100% Polyester</li>
                    <li>- Foam specification : 30Kg/cbm</li>
                    <li>- Foam type : Polyethylene</li>
                    <li>- Leg material : Beech</li>
                    <li>- Filling type : Foam</li>
                    <li>- Seating Capacity : </li>
                </ul>
            </div>
            <div class="col-sm-12 col-xm-12 col-md-4 col-lg-4 col-xl-4 feat">
                <h2>QUALITY</h2>
                <ul>
                    <li>-  Extremely comfortable design</li>
                    <li>-  Premium quality fabric</li>
                    <li>-  High quality treated wood</li>
                    <li>-  Available in 4 colours</li>
                    <li>-  Indoor use only</li>
                </ul>
            </div>

            <div class="col-sm-12 col-xm-12 col-md-4 col-lg-4 col-xl-4 feat">

                <h2>CARE INSTRUCTIONS</h2>
                <ul>
                    <li>-  Any spillage should be wiped dry with a soft cloth immediately as there is a chance of staining.</li>
                    <li>-  Any cleaning needs to be done with water only </li>

                    <li>-  Clean your upholstery at least once a week with a soft brush or vacuum cleaner as accumulated dirt will accelerate wear and dull the colours.</li>


                </ul>
            </div>



        </div>
    </div>
</section>
<!-- product feature section closed -->



<!-- tab section start -->



<section class="container-fluid tabsec">
    <div class="container">
        <div class="row tabrow">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">FAQ</a></li>
                <li><a data-toggle="tab" href="#menu1">T & C</a></li>
                <li><a data-toggle="tab" href="#menu2">WARRANTY</a></li>
                <li><a data-toggle="tab" href="#menu3">DELIVERY</a></li>
            </ul>


        </div>
    </section>
    <!-- tab section closed -->

    <section class="container-fluid tabdet">
        <div class="container">
            <div class="row tabrow">
                <div class="tab-content">

                    <div id="home" class="tab-pane fade in active show">
                        <div class="faq">
                            <div class="qaques">
                                <div class="qustion">Lorem ipsum dolor sit amet ?</div>
                                <div class="arrow"><i class='fas fa-angle-right'></i></div>
                            </div>
                            <div class="clear"></div>

                            <div class="faqans">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                        </div>

                        <div class="faq">
                            <div class="qaques">
                                <div class="qustion">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ?</div>
                                <div class="arrow"><i class='fas fa-angle-right'></i></div>
                            </div>
                            <div class="clear"></div>

                            <div class="faqans">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                        </div>

                        <div class="faq">
                            <div class="qaques">
                                <div class="qustion">Ut labore et dolore magna aliqua. Ut enim ad minim veniam ?</div>
                                <div class="arrow"><i class='fas fa-angle-right'></i></div>
                            </div>
                            <div class="clear"></div>

                            <div class="faqans">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                        </div>

                        <div class="faq">
                            <div class="qaques">
                                <div class="qustion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ? </div>
                                <div class="arrow"><i class='fas fa-angle-right'></i></div>
                            </div>
                            <div class="clear"></div>

                            <div class="faqans">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                        </div>

                        <div class="faq">
                            <div class="qaques">
                                <div class="qustion">Ut labore et dolore magna aliqua. Ut enim ad minim veniam ?</div>
                                <div class="arrow"><i class='fas fa-angle-right'></i></div>
                            </div>
                            <div class="clear"></div>

                            <div class="faqans">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
                        </div>
                    </div>

                    <div id="menu1" class="tab-pane fade">
                        <h3>Terms & Conditions</h3>
                        <p>We welcome users to register on our digital platforms. We offer the below mentioned registration services which may be subject to change in the future. All changes will be appended in the terms and conditions page and communicated to existing users by email.</p>

                        <p>Registration services are offered for individual subscribers only. If multiple individuals propose to access the same account or for corporate accounts kindly contact or write in to us. Subscription rates will vary for multiple same time access.</p>
                    </div>

                    <div id="menu2" class="tab-pane fade">
                        <h3>Warranty</h3>
                        <p>A warranty is a type of guarantee that a manufacturer or similar party makes regarding the condition of its product. It also refers to the terms and situations in which repairs or exchanges will be made in the event that the product does not function as originally described or intended.</p>

                        <p>A warranty is a type of guarantee that a manufacturer or similar party makes regarding the condition of its product. It also refers to the terms and situations in which repairs or exchanges will be made in the event that the product does not function as originally described or intended.</p>
                    </div>

                    <div id="menu3" class="tab-pane fade">
                        <h3>Delivery </h3>
                        <p>Delivery is the process of transporting goods from a source location to a predefined destination. Cargo (physical goods) is primarily delivered via roads and railroads on land, shipping lanes on the sea, and airline networks in the air. Certain types of goods may be delivered via specialized networks, such as pipelines for liquid goods, power grids for electrical power and computer networks such as the Internet or broadcast networks for electronic information.[1] Car transport is a particular subgroup; a related variant is Autorack, which involves transport of autos by railroads.</p>

                        <p>Delivery is the process of transporting goods from a source location to a predefined destination. Cargo (physical goods) is primarily delivered via roads and railroads on land, shipping lanes on the sea, and airline networks in the air. Certain types of goods may be delivered via specialized networks, such as pipelines for liquid goods, power grids for electrical power and computer networks such as the Internet or broadcast networks for electronic information.[1] Car transport is a particular subgroup; a related variant is Autorack, which involves transport of autos by railroads.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recommended Products start -->
    <section class="container-fluid prodel">
        <div class="container">
            <h1 class="prodetdel">Recommended Products</h1>
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
            </div>
        </div>
    </section>
    <!-- Recommended Products start -->


    <!-- Recently Viewed Products start -->
    <section class="container-fluid prodel">
        <div class="container">
            <h1 class="prodetdel">Recently Viewed</h1>
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
            </div>
        </div>
    </section>
    <!-- Recently Viewed Products start -->
    @endsection
    @push('script')
    <script>
        $(document).ready(function(){
            $("#flip").click(function(){
                $("#panel").slideToggle("slow");
            });
        });

        $(document).ready(function(){
            $("#flip1").click(function(){
                $("#panel1").slideToggle("slow");
            });
        });

        $(document).ready(function(){
            $('.faq').click(function(e){
                $(this).find(".faqans").toggle();
                $(this).find("i").css("transform","rotate(90deg)");
            });
        });
    </script>
    @endpush
