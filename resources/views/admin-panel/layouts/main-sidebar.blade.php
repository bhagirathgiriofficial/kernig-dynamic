<div class="site-menubar">
    <ul class="site-menu">
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.dashboard') }}">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Dashboard</span>
            </a>
        </li>
        {{-- <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.accessory.index') }}">
                <i class="site-menu-icon fa fa-chain" aria-hidden="true"></i>
                <span class="site-menu-title">Accessories</span>
            </a>
        </li> --}}
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.accountSetting.index') }}">
                <i class="site-menu-icon fa fa-cog" aria-hidden="true"></i>
                <span class="site-menu-title">Account Settings</span>
            </a>
        </li>
        <li class="site-menu-item has-sub">
            <a href="{{ route('adminPanel.category.index') }}">
                <i class="site-menu-icon fa fa-sitemap" aria-hidden="true"></i>
                <span class="site-menu-title">Categories</span>
            </a>
        </li>
        <li class="site-menu-item has-sub">
            <a href="{{ route('adminPanel.color.index') }}">
                <i class="site-menu-icon glyphicon glyphicon-adjust" aria-hidden="true"></i>
                <span class="site-menu-title">Colors</span>
            </a>
        </li>
        {{-- <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.country.index') }}">
                <i class="site-menu-icon glyphicon glyphicon-globe" aria-hidden="true"></i>
                <span class="site-menu-title">Countries</span>
            </a>
        </li> --}}
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.enquiry.index') }}">
                <i class="site-menu-icon fa fa-info-circle" aria-hidden="true"></i>
                <span class="site-menu-title">Enquiries</span>
            </a>
        </li>
        <li class="site-menu-item has-sub">
            <a href="{{ route('adminPanel.faq.index') }}">
                <i class="site-menu-icon fa fa-question" aria-hidden="true"></i>
                <span class="site-menu-title">Faqs</span>
            </a>
        </li>
        <li class="site-menu-item has-sub">
            <a href="{{ route('adminPanel.gallary.index') }}">
                <i class="site-menu-icon fa fa-picture-o" aria-hidden="true"></i>
                <span class="site-menu-title">Gallery</span>
            </a>
        </li>
        {{-- <li class="site-menu-item has-sub">
            <a href="javascript:void(0)">
                <i class="site-menu-icon fa fa-home" aria-hidden="true"></i>
                <span class="site-menu-title">Home Page Content</span>
                <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.homePageContent.index', ['type' => male])}}">
                        <span class="site-menu-title"> <i class="fa fa-male"></i> For Men </span>
                    </a>
                </li>
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.homePageContent.index', ['type' => female])}}">
                        <span class="site-menu-title"> <i class="fa fa-female"></i> For Female</span>
                    </a>
                </li>
            </ul>
        </li> --}}
        {{-- <li class="site-menu-item has-sub open">
            <a href="javascript:void(0)">
                <i class="site-menu-icon wb-users" aria-hidden="true"></i>
                <span class="site-menu-title">Measurements</span>
                <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.measurement.index') }}">
                        <span class="site-menu-title"> <i class="fa fa-users"></i> Measurement Chart </span>
                    </a>
                </li>
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.sareeMeasurement.index') }}">
                        <span class="site-menu-title"> <i class="fa fa-users"></i> Saree Measurement</span>
                    </a>
                </li>
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.salwarMeasurement.index') }}">
                        <span class="site-menu-title"> <i class="fa fa-user-secret"></i> Salwar Measurement </span>
                    </a>
                </li>
            </ul>
        </li> --}}
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.newsLetter.index') }}">
                <i class="site-menu-icon fa fa-envelope" aria-hidden="true"></i>
                <span class="site-menu-title">News Letters</span>
            </a>
        </li>
        <li class="site-menu-item has-sub">
            <a href="javascript:void(0)">
                <i class="site-menu-icon fa fa-list-alt" aria-hidden="flase"></i>
                <span class="site-menu-title">Orders</span>
                <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'all-orders']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>All Orders</span>
                    </a>
                </li>

                @php
                use Illuminate\Support\Facades\DB;
                $paymentPendingOrders = DB::table('product_orders')->where('order_status',0)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'payment-pending']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>Payment Pending ({{count($paymentPendingOrders)}}) </span>
                    </a>
                </li>

                @php
                $newOrders = DB::table('product_orders')->where('order_status',1)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'new-orders']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>New Orders ({{count($newOrders)}}) </span>
                    </a>
                </li>
                <!-- @php
                $underProcessOrders = DB::table('product_orders')->where('order_status',2)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'under-process']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>Under Process ({{count($underProcessOrders)}}) </span>
                    </a>
                </li> -->
                @php
                $processedOrders = DB::table('product_orders')->where('order_status',3)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'processed']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>Processed ({{count($processedOrders)}}) </span>
                    </a>
                </li>
                @php
                $shippedOrders = DB::table('product_orders')->where('order_status',4)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'shipped']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>Shipped ({{count($shippedOrders)}}) </span>
                    </a>
                </li>
               <!--  @php
                $OutOrders = DB::table('product_orders')->where('order_status',5)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'out-for-delivery']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i> Out for Delivery ({{count($OutOrders)}}) </span>
                    </a>
                </li> -->
                @php
                $completedOrders = DB::table('product_orders')->where('order_status',6)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'completed']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>Completed ({{count($completedOrders)}}) </span>
                    </a>
                </li>
               <!--  @php
                $completedOrders = DB::table('product_orders')->where('order_status',7)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'canceled']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>Canceled ({{count($completedOrders)}}) </span>
                    </a>
                </li> -->
               <!--  @php
                $completedOrders = DB::table('product_orders')->where('order_status',8)->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'return']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>Returned ({{count($completedOrders)}}) </span>
                    </a>
                </li> -->
                <!-- @php
                $trashedOrders = DB::table('product_orders')->where('deleted_at','!=', "")->get();
                @endphp
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.orderDetails.index', ['type' => 'view-trashed']) }}">
                        <span class="site-menu-title"> <i class="fa fa-list-alt"></i>Trashed Orders ({{count($trashedOrders)}}) </span>
                    </a>
                </li> -->
            </ul>
        </li>
        {{-- <li class="site-menu-item has-sub">
            <a href="javascript:void(0)">
                <i class="site-menu-icon fa fa-file" aria-hidden="true"></i>
                <span class="site-menu-title">Pages</span>
                <span class="site-menu-arrow"></span>
            </a>
            @php
            $page = DB::table('master_pages')->orderBy('page_name')->get();
            @endphp
            <ul class="site-menu-sub">
                @foreach($page as $key => $value)
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{route('adminPanel.page.index',['id' => ev($value->page_id)])}}">
                        <span class="site-menu-title"> <i class="fa fa-file"></i> {{$value->page_name}} </span>
                    </a>
                </li>
                @endforeach
            </ul>
        </li> --}}
        <li class="site-menu-item has-sub">
            <a class="animsition-link" href="javascript:void(0)">
                <i class="site-menu-icon fa fa-shopping-bag" aria-hidden="true"></i>
                <span class="site-menu-title">Products</span>
                <span class="site-menu-arrow"></span>
            </a>
            <ul class="site-menu-sub">
                {{-- <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.productEnquiry.index') }}">
                        <span class="site-menu-title"> <i class="fa fa-info-circle"></i> Enquiry</span>
                    </a>
                </li> --}}
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{ route('adminPanel.productReview.index') }}">
                        <span class="site-menu-title"> <i class="fa fa-eye"></i> Reviews </span>
                    </a>
                </li>
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{route('adminPanel.product.index')}}">
                        <span class="site-menu-title"> <i class="fa fa-shopping-bag"></i> View </span>
                    </a>
                </li>
                {{-- <li class="site-menu-item">
                    <a class="animsition-link" href="{{route('adminPanel.product.uploadExcelIndex')}}">
                        <span class="site-menu-title"> <i class="fa fa-upload"></i> Upload Excel </span>
                    </a>
                </li>
                <li class="site-menu-item">
                    <a class="animsition-link" href="{{route('adminPanel.product.uploadZipIndex')}}">
                        <span class="site-menu-title"> <i class="fa fa-upload"></i> Upload Images Zip </span>
                    </a>
                </li> --}}
            </ul>
        </li>
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.shippingCharges.index') }}">
                <i class="site-menu-icon fa fa-dollar" aria-hidden="true"></i>
                <span class="site-menu-title">Shipping Charges</span>
            </a>
        </li>
        {{-- <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.size.index') }}">
                <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                <span class="site-menu-title">Sizes</span>
            </a>
        </li> --}}
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.slider.index') }}">
                <i class="site-menu-icon fa fa-picture-o" aria-hidden="true"></i>
                <span class="site-menu-title">Slider Image</span>
            </a>
        </li>
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.transaction.index') }}">
                <i class="site-menu-icon fa fa-usd" aria-hidden="true"></i>
                <span class="site-menu-title">Transactions</span>
            </a>
        </li>
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.testimonial.index') }}">
                <i class="site-menu-icon fa fa-comments-o" aria-hidden="true"></i>
                <span class="site-menu-title">Testimonials</span>
            </a>
        </li>
        <li class="site-menu-item">
            <a class="animsition-link" href="{{ route('adminPanel.users.index') }}">
                <i class="site-menu-icon fa fa-user-circle-o" aria-hidden="true"></i>
                <span class="site-menu-title">Users</span>
            </a>
        </li>
        <li class="site-menu-item has-sub">
            <a href="{{ route('adminPanel.fabric.index') }}">
                <i class="site-menu-icon fa fa-shirtsinbulk" aria-hidden="true"></i>
                <span class="site-menu-title">Wood Type</span>
            </a>
        </li>
    </ul>
</div>
