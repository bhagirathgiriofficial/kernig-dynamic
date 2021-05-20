<!DOCTYPE html>
<html
  lang="en"
  xmlns="http://www.w3.org/1999/xhtml"
  xmlns:v="urn:schemas-microsoft-com:vml"
  xmlns:o="urn:schemas-microsoft-com:office:office"
>
  <head>
    <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="x-apple-disable-message-reformatting" />
    <title>Invoice</title>
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,500,400,600,700,800"
      rel="stylesheet"
    />
    <style>
      h1,
      h2,
      h3,
      h4,
      h5,
      h6 {
        font-family: "Work Sans", sans-serif;
        color: #000000;
        margin-top: 0;
        font-weight: 400;
      }

      body {
        font-family: "Work Sans", sans-serif;
        font-weight: 400;
        font-size: 15px;
        line-height: 1.8;
        color: rgba(0, 0, 0, 0.4);
      }
      @media screen and (max-width: 990px) {
        .logo_img {
          width: 81px !important;
        }
        .bg_white {
          padding: 0px 10px !important;
        }
        .order_id {
          font-size: 12px !important;
        }
        .user_name {
          padding: 35px 0px 10px 0px !important;
          font-size: 15px !important;
        }
        .responsiveTabletrtd {
          font-size: 18px !important;
        }
        .responsiveTable {
          font-size: 14px !important;
        }
        .secnd_section {
          padding: 0px 15px 28px !important;
        }
        .ptag {
          font-size: 12px !important;
        }
        .home_img {
          height: 21px !important;
        }
        .adress {
          margin-top: 5px !important;
          margin-bottom: 4px !important;
          padding-top: 9px !important;
          font-size: 12px !important;
        }
        .creditcard {
          width: 26px !important;
        }
        .address_left {
          width: 56% !important;
        }
        .order_details {
          padding-top: 10px !important;
          font-size: 15px !important;
        }
        .widthTable {
          font-size: 13px !important;
        }
        .product_names {
          padding-left: 14px !important;
        }
        .quantity {
          padding-left: 15px !important;
        }
        .quantity-count {
          font-size: 14px !important;
        }
        .blank_div {
          width: 30% !important;
        }
        .textservices22 {
          width: 70% !important;
        }
        .textservices22 p {
          font-size: 12px !important;
        }
        .text-services2 p {
          font-size: 12px !important;
        }
        .web_link {
          font-size: 12px !important;
        }
        .again_soon {
          font-size: 14px !important;
        }
        .again_soon2 {
          font-size: 12px !important;
        }
        .total_amt {
          width: 30% !important;
        }
        .total_rate {
          width: 25% !important;
        }
      }
    </style>
  </head>

  @php
    $accountSettingData = accountSettingData();
  @endphp
  <body style="width: 700px; margin: 0px auto; padding: 0px 0px !important;  background-color: #f2f2f2;">
    <table style="width: 100%; background-color: #f2f2f2;">
      <tr>
        <td valign="top" class="bg_white" style="padding: 0px 30px;">
          <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-bottom: 2px solid #f0f0f0; height: 100px;">
            <tr>
                <td class="logo" style="text-align: left;">
                    @if(get_image_url(config('constants.accountSetting.images_path'), $accountSettingData->email_logo) != '')
                      <img src="{{ get_image_url(config('constants.accountSetting.images_path'), $accountSettingData->email_logo) }}" class="logo_img"/>
                    @else
                      <img src="{{ asset('frontend/images/logo.png') }}" class="logo_img"/>
                    @endif
                </td>
              <td class="order_id" style="text-align: center; color: #727272; font-weight:500; font-size: 14px;">
                Order ID:
                <span class="order_id" style="color: #2e2e2d; font-size: 14px; font-weight: 500;">{{ $order_number }}</span>
              </td>
              <td class="order_id" style="text-align: right;">
                Order Date:
                <span style="font-weight: 500; font-size: 14px; color: #333333; " class="w-100 order_id">{{ date( 'd F Y') }}</span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <table style="width: 100%; background: #fff;">
        <tr>
          <td class="secnd_section" style="padding: 0px 30px 10px; border-bottom: 1px solid #e8e8e8;">
            <table width="100%">
              <tr>
                <td>
                  <table class="textTop ">
                    <tr>
                      <td class="user_name" style="padding: 15px 0px 10px 0px; color: #2e2e2d; font-size: 20px; font-weight: 400;">
                        Hi {{ $name }},
                      </td>
                    </tr>
                    <tr>
                      <td class="responsiveTabletrtd" style="padding: 0px 0px; color: #2e2e2d; font-size: 16px; font-weight: 600;">
                        <img src="{{ asset('frontend/images/email/check2.png') }}" style="vertical-align: middle;"/>
                        {{ $order_message }}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <table style="width: 100%;  padding: 0% 5%;">
        <tr>
          @if($bill_shipping == 1)
            <td class="text-services ptag address_left" style="text-align: left; width: 70%; padding-top: 19px; font-size: 18px; color: #1c1c1c; font-weight: 400;">
              <img class="home_img" src="{{ asset('frontend/images/email/home.png') }}" style="vertical-align: middle;  height: 25px; margin-right: 5px;">
              Billing Address
              <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px; padding-top: 10px;"> {{ $billing_address }}</p>
              <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px;"> {{ $billing_email }} </p>
              <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px;"> {{ $billing_phone }} </p>
            </td>
          @else
          <td class="text-services ptag address_left" style="text-align: left; width: 35%; padding-top: 19px; font-size: 18px; color: #1c1c1c; font-weight: 400;">
            <img class="home_img" src="{{ asset('frontend/images/email/home.png') }}" style="vertical-align: middle;  height: 25px; margin-right: 5px;">
            Shipping Address
            <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px; padding-top: 10px;"> {{ $shipping_address }}</p>
            <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px;"> {{ $shipping_email }} </p>
            <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px;"> {{ $shipping_phone }} </p>
          </td>

          <td class="text-services ptag address_left" style="text-align: left; width: 35%; padding-top: 19px; font-size: 18px; color: #1c1c1c; font-weight: 400;">
            <img class="home_img" src="{{ asset('frontend/images/email/home.png') }}" style="vertical-align: middle;  height: 25px; margin-right: 5px;">
            Billing Address
            <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px; padding-top: 10px;"> {{ $billing_address }}</p>
            <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px;"> {{ $billing_email }} </p>
            <p class="adress" style="font-size: 14px; color: #888888; padding-left: 36px;"> {{ $billing_phone }} </p>
          </td>
          @endif
        </tr>
      </table>

        
        <table style="width: 100%; padding: 0px 5%">
            <tr>
                <td class="order_details" style="text-align: left; font-size: 18px; color: #1c1c1c; letter-spacing: 1px; padding-bottom: 20px;"> Order Details are following :
                </td>
            </tr>
        </table>

        <table style="width: 100%; padding: 0px 5%; border-bottom: 1px solid gainsboro;">
            <tr>
                <td class="product_names" valign="top" width="10%" style="padding-left: 20px;">
                    <p class="widthTable" style="font-weight: 600; font-size: 14px; color: #555555; padding-top: 5px;">Image</p>
                </td>
                <td class="product_names" valign="top" width="50%" style="padding-left: 20px;">
                    <p class="widthTable" style="font-weight: 600; font-size: 14px; color: #555555; padding-top: 5px;"> Product Info </p>
                </td>
                <td valign="top" style="padding-left: 20px; text-align: center;" class="quantity">
                    <p class="quantity-count" style="font-weight: 600; padding-top: 5px; font-size: 14px; color: #555555;"> Quantity </p>
                </td>
                <td valign="top" style=" text-align: right; ">
                    <p style="font-weight: 600; padding-top: 5px; font-size: 14px; color: #555555;"> Unit Price </p>
                </td>
                <td valign="top" style=" text-align: right; ">
                    <p style="font-weight: 600; padding-top: 5px; font-size: 14px; color: #555555;"> Total Price </p>
                </td>
            </tr>
        </table>

        @foreach($order_detail as $product_order_details)
        <table style="width: 100%; padding: 0px 5%; border-bottom: 1px solid gainsboro;">
            <tr>
                <td valign="top" width="10%" style="padding-bottom: 20px; padding-top: 15px;">
                    <p style="border:1px solid #e8e8e8; background-color: #fff;width: 70px; height: 100px; text-align: center;">
                      @if($product_order_details['product_image_small'] != '')
                        <img src="{{ url('/')}}/public/storage/uploads/images/product/product_image/thumb/{{ $product_order_details['product_image_small'] }}" style="width: 100%; margin: 0px auto; display:block;"/>
                      @elseif($product_order_details['product_image'] != '')
                        <img src="{{ url('/')}}/public/storage/uploads/images/product/product_image/{{ $product_order_details['product_image'] }}" style="width: 100%; margin: 0px auto; display:block;"/>
                      @else
                        <img src="{{ asset('frontend/images/preview_product.png') }}" style="width: 100%; margin: 0px auto; display:block;"/>
                      @endif
                    </p>
                </td>
                <td class="product_names" valign="top" width="50%" style="padding-left: 20px;">
                    <p class="widthTable" style="font-weight: 600; font-size: 14px; color: #555555; padding-top: 5px;"> {{ $product_order_details['product_name'] }} </p>

                        @if($product_order_details['product_code'] != '')
                            <span><b>Product Code :</b> {{ $product_order_details['product_code'] }}</span> <br>
                        @endif

                        @if($product_order_details['product_size'] != '')
                            <span><b>Size :</b> {{ floatval($product_order_details['product_size']) }}</span> <br>
                        @endif

                        @if($product_order_details['product_weight'] != '')
                            <span><b>Weight :</b> {{ $product_order_details['product_weight'] }} GM</span> <br>
                        @endif

                        @if($product_order_details['product_accessories'] != '')
                            <span> {!! $product_order_details['product_accessories'] !!}</span>
                        @endif

                        @if($product_order_details['product_salwar_measurement'] != '')
                            <span> {!! $product_order_details['product_salwar_measurement'] !!}</span>
                        @endif

                        @if($product_order_details['product_saree_measurement'] != '')
                            <span> {!! $product_order_details['product_saree_measurement'] !!}</span>
                        @endif

                        @if($product_order_details['product_measurement'] != '')
                            <span> {!! $product_order_details['product_measurement'] !!}</span>
                        @endif

                        @if($product_order_details['custom_measurement'] != '')

                            @php
                              $customMeasurements = json_decode($product_order_details['custom_measurement']);
                            @endphp

                            <!-- <p><b>Custom Measurement Details</b></p> -->
                            <span><b>Measurment In :</b> {{ $customMeasurements->measurement_in }}</span> <br>
                            @foreach(json_decode($customMeasurements->customMeasurement) as $customMeasurement)
                                <span><b>Title :</b> {{ $customMeasurement->measurement_title }}</span> <br>
                                <span><b>Measurement :</b> {{ $customMeasurement->measurement }}</span> <br>
                            @endforeach
                            @if($customMeasurements->other != '')
                                <span><b>Other :</b> {{ $customMeasurements->other }}</span> <br>
                            @endif

                        @endif


                        @if($product_order_details['salwar_measurment'] != '')

                            @php
                              $salwarMeasurementJson = json_decode($product_order_details['salwar_measurment']);
                            @endphp

                            @foreach($salwarMeasurementJson as $salwarMeasurementJson)

                                <!-- <p><b>Top Measurement Details</b> </p> -->
                                <span><b>Measurment In :</b> {{ $salwarMeasurementJson->measurement_in }}</span> <br>
                                @foreach(json_decode($salwarMeasurementJson->salwarTopMeasurement) as $salwarTopMeasurement)
                                    <span><b>Title :</b> {{ $salwarTopMeasurement->top_title }}</span> <br>
                                    <span><b>Measurement :</b> {{ $salwarTopMeasurement->measurement }}</span> <br>
                                @endforeach

                                <!-- <p><b>Bottom Measurement Details</b> </p> -->
                                <span><b>Measurment :</b> {{ $salwarMeasurementJson->measurement }}</span> <br>
                                @if($salwarMeasurementJson->bottom_pattern != '')
                                    <span><b> Bottom Pattern :</b> {{ $salwarMeasurementJson->bottom_pattern }} </span> <br>
                                @endif
                                @foreach(json_decode($salwarMeasurementJson->salwarBottomMeasurement) as $salwarBottomMeasurement)
                                    <span><b>Title :</b> {{ $salwarBottomMeasurement->bottom_title }}</span> <br>
                                    <span><b>Measurement :</b> {{ $salwarBottomMeasurement->measurement }}</span> <br>
                                @endforeach

                                @if($salwarMeasurementJson->other != '')
                                    <span><b> Other :</b> {{ $salwarMeasurementJson->other }} </span> <br>
                                @endif
                            @endforeach
                        @endif

                        @if($product_order_details['saree_measurement'] != '')
                            @php
                                $sareeMeasurement       = json_decode($product_order_details['saree_measurment_details']);
                                $sareeMeasurmentJson    = json_decode($product_order_details['saree_measurement']);
                            @endphp

                            <!-- <p><b>Saree Measurement Details</b> </p> -->
                            @foreach($sareeMeasurement as $sareeMeasurements)
                                
                                @foreach($sareeMeasurmentJson as $sareeMeasurmentJsons)
                                    @if($sareeMeasurmentJsons->saree_measurement_id == $sareeMeasurements->saree_measurement_id)

                                        <p><b>{{$sareeMeasurements->saree_measurement_title}} Details<p><b>
                                        <span><b>Measurment In :</b> {{ $sareeMeasurmentJsons->measurement_in }}</span> <br>
                                        
                                        @foreach(json_decode($sareeMeasurmentJsons->sareeMeasurement) as $sareeMeasurement)
                                            <span><b>Title :</b> {{ $sareeMeasurement->measurement_title }}</span> <br>
                                            <span><b>Measurement :</b> {{ $sareeMeasurement->measurement }}</span> <br>
                                        @endforeach

                                        @if($sareeMeasurmentJsons->other != '')
                                            <span><b> Other :</b> {{ $sareeMeasurmentJsons->other }} </span> <br>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endif

                </td>
                <td valign="top" style="padding-left: 20px; text-align: center;" class="quantity">
                    <p class="quantity-count" style="font-weight: 600; padding-top: 5px; font-size: 14px; color: #555555;"> {{ $product_order_details['product_quantity'] }} </p>
                </td>
                <td valign="top" style=" text-align: right; ">
                    <p style="font-weight: 600; padding-top: 5px; font-size: 14px; color: #555555;"> ${{ number_format($product_order_details['product_price'],2) }} </p>
                </td>
                <td valign="top" style=" text-align: right; ">
                    <p style="font-weight: 600; padding-top: 5px; font-size: 14px; color: #555555;"> ${{ number_format($product_order_details['product_quantity'] * $product_order_details['product_price'],2) }} </p>
                </td>
            </tr>
        </table>
        @endforeach


      <table style=" width: 100%; background: #fff; padding-right: 5%;">
        <tr>
          <!-- <td class="blank_div" style="width: 50%;"></td> -->

          <td valign="top" width="50%" class="textservices22" style="border-bottom: 1px solid #e8e8e8; padding-bottom: 15px;">
            <p style=" font-weight: 500; color: #888888; font-size: 14px;"> Payment Method </p>
            <p style=" font-weight: 500; color: #888888; font-size: 14px;"> Estimated Delivery </p>
            <p style=" font-weight: 500; color: #888888; font-size: 14px;"> Subtotal </p>
            @if($discount_amount != 0)
            <p style=" font-weight: 500; color: #888888; font-size: 14px;"> Discount(-) </p>
            @endif
            <p style=" font-weight: 500; color: #888888; font-size: 14px;"> Shipping and handling(+) </p>
          </td>
          <td valign=" top" width="50%" style="text-align: right; border-bottom: 1px solid #e8e8e8;  padding-bottom: 15px;" class="text-services2">
            <p style=" font-weight: 600; color: #555555; font-size: 14px;"> PayPal </p>
            <p style=" font-weight: 600; color: #555555; font-size: 14px;"> {{ Date('d F Y', strtotime("+".$dispatch_till)) }} </p>
            <p style=" font-weight: 600; color: #555555; font-size: 14px;"> $ {{ $total_amount }} </p>
            @if($discount_amount != 0)
            <p style=" font-weight: 600; color: #555555; font-size: 14px;"> $ {{ $discount_amount }} </p>
            @endif
            <p style=" font-weight: 600; color: #555555; font-size: 14px;"> $ {{ $shipping_charge }} </p>
          </td>
        </tr>
      </table>

      <table style="width: 100%;  background: #fff; padding-right: 4%;">
        <tr>
          <td style="width:25%; text-align:right; " class="total_amt">
            <p style="padding-bottom: 30px;  font-weight: 600; color: #555555; font-size: 14px;"> Total Amount </p>
          </td>
          <td valign="top" width="15%" class="total_rate">
            <p style="padding-bottom: 30px;  font-weight: 600; color: #555555; font-size: 14px; text-align: right;"> $ {{ $net_amount }} </p>
          </td>
        </tr>
      </table>

      <table style=" width: 100%; padding: 0px 3%;">
        <tr>
          <td valign="top" width="100%">
            <p class="again_soon" style="font-weight: 600; font-size: 18px; color: #555555; text-align: center;"> We look <br>
            <span class="again_soon2" style=" font-weight: 600; font-size: 15px; color: #555555;text-align: center;">Forward to seeing you again soon.</span><br>
            <span class="again_soon2" style=" font-weight: 600; font-size: 15px; color: #555555; text-align: center;">Team {{$accountSettingData->site_name}}</span><br>
            <span class="again_soon2" style=" font-weight: 600; font-size: 15px; color: #555555; text-align: center;">
            <img src="{{ asset('frontend/images/email/add.png') }}" style="vertical-align: middle; margin-right: 4px;"/>
            <a href="{{ url('/') }}" target="_blank" class="web_link" style="font-weight: 600; color: #555555; font-size: 15px;">www.bagteshfashion.com</a></span></p>
          </td>
        </tr>
      </table>

      <table style=" width: 100%;">
        <tr>
          <td valign="middle" width="100%" style="text-align: center;" class="footerImg">

            @if($accountSettingData->facebook_url != "")
              <a href="{{ $accountSettingData->facebook_url }}" style="text-decoration: none;">
                <img src="{{ asset('frontend/images/email/f.png') }}" />
              </a>
            @endif
            @if($accountSettingData->googleplus_url != "")
              <a href="{{ $accountSettingData->googleplus_url }}" style="text-decoration: none;">
                <img src="{{ asset('frontend/images/email/g.png') }}" />
              </a>
            @endif
            @if($accountSettingData->pinterest_url != "")
              <a href="{{ $accountSettingData->pinterest_url}}" style="text-decoration: none;">
                <img src="{{ asset('frontend/images/email/pinterest.png') }}" style="width: 38px;"/>
              </a>
            @endif
            @if($accountSettingData->twitter_url != "")
              <a href="{{ $accountSettingData->twitter_url}}" style="text-decoration: none;">
                <img src="{{ asset('frontend/images/email/t.png') }}" />
              </a>
            @endif
            @if($accountSettingData->instagram_url != "")
              <a href="{{ $accountSettingData->instagram_url}}" style="text-decoration: none;">
                <img src="{{ asset('frontend/images/email/insta2.png') }}" style="width: 33px;"/>
              </a>
            @endif
            <p style="m color: #666666; font-size: 14px;">
              ©{{ date('Y') }} {{$accountSettingData->site_name}} - All Rights Reserved.
            </p>
          </td>
        </tr>
      </table>
    </table>
  </body>
</html>