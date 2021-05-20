<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('title')
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Prata&display=swap">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <!--Main Menu File-->
    <link id="effect" rel="stylesheet" type="text/css" media="all" href="{{asset('frontend/css/fade-down.css')}}" />
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('frontend/css/webslidemenu.css')}}"/>
    <!--Main Menu File-->
    {{-- <link rel="stylesheet" href="{{asset('frontend/js/fm.revealator.jquery.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('frontend/css/global.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
    <!-- End Comman Css Files  -->

    <!-- Start Page Css Files -->
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
    <!-- End Page Css Files -->
    <script src="https://kit.fontawesome.com/695c3c16fc.js" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Start Alert Bar  -->
    <div class="alert warning-bar text-uppercase mb-0 rounded-0" role="alert">
        {{accountSettingData()->top_tagline}}
    </div>
    <!-- End Alert Bar  -->
    <!-- Mobile Header -->
    <div class="wsmobileheader clearfix">
        <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
        <span class="smllogo"><img src="{{getSiteLogo()}}" width="110" alt="" /></span>
        <!-- <div class="wssearch clearfix">
            <i class="wsopensearch fas fa-search"></i>
            <i class="wsclosesearch fas fa-times"></i>
            <div class="wssearchform clearfix">
                <form>
                    <input type="text" placeholder="Search Here">
                </form>
            </div>
        </div> -->
    </div>
    <!-- Mobile Header -->



    <div class="headerfull">
        <div class="wsmain container clearfix">
            <div class="smllogo"><a href="{{url('/')}}"><img src="{{getSiteLogo()}}" alt="" /></a></div>
            <nav class="wsmenu clearfix">
                <ul class="wsmenu-list">
                    @php
                    $categoriesData = catgeoriesData();
                    $limit = 0;
                    if(!is_null($categoriesData))
                    $categoriesData = $categoriesData->toArray();
                    // p($categoriesData);
                    @endphp
                    @foreach ($categoriesData as $categoryData)
                    @php
                        $limit++;
                        if($limit>5)
                            break;
                    @endphp
                    <li aria-haspopup="true">
                        <a href="#" class="navtext"><span></span><span>{{$categoryData['category_name']}}</span></a>
                        <div class="wsmegamenu clearfix">
                            <div class="container-fluid">
                                <div class="row">
                                    @foreach ($categoryData['sub_categories'] as $subCategory)
                                    <div class="col-lg-3 col-md-12">
                                        <ul class="wstliststy02 clearfix">
                                            @if(count($subCategory['sub_sub_categories']))
                                            <li class="wstheading clearfix">
                                                {{$subCategory['category_name']}}
                                                @else
                                            </li>
                                            <li class="clearfix">
                                                <a href="{{url('/')}}/category/{{$categoryData['category_slug']}}/{{$subCategory['category_slug']}}">
                                                    {{$subCategory['category_name']}}
                                                </a>
                                            </li>
                                                @endif
                                                @foreach ($subCategory['sub_sub_categories'] as $subSubCategory)
                                                <li>
                                                    <a href="{{url('/')}}/category/{{$categoryData['category_slug']}}/{{$subCategory['category_slug']}}/{{$subSubCategory['category_slug']}}">{{$subSubCategory['category_name']}}</a>
                                                    {{-- <span class="wstmenutag redtag">Popular</span> --}}
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                            <li class="wscarticon clearfix">
                                <a href="{{url('/cart')}}">
                                    <i class="fas fa-shopping-basket"></i> <em class="roundpoint">8</em>
                                    <span class="hidetxt">Shopping Cart</span>
                                </a>
                            </li>
                            <li aria-haspopup="true" class="wsshopmyaccount">

                                @if(session()->has('user_id'))
                                <a href="{{url('/login')}}">
                                    <!-- <i class="fas fa-align-justify"></i> -->
                                    {{session('user_name')}}
                                </a>
                                <ul class="wstliststy02 sub-menu">
                                    <li><a href="{{url('/my-profile')}}"><i class="fas fa-user-tie"></i>View Profile</a></li>
                                    <li><a href="#"><i class="fas fa-heart"></i>My Wishlist</a></li>
                                    <li><a href="#"><i class="fas fa-bell"></i>Notification</a></li>
                                    <li><a href="#"><i class="fas fa-question-circle"></i>Help Center</a></li>
                                    <li><a href="{{url('/logout')}}"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
                                </ul>
                                @else
                                <a href="{{url('/sign-in')}}">
                                    <!-- <i class="fas fa-align-justify"></i> -->
                                    Sign In
                                </a>
                                @endif
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
                <!-- End Web Menu  -->
