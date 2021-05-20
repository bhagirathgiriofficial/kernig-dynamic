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
              <td class="logo" style="text-align: center;">
                @if(get_image_url(config('constants.accountSetting.images_path'), $accountSettingData->email_logo) != '')
                  <img src="{{ get_image_url(config('constants.accountSetting.images_path'), $accountSettingData->email_logo) }}" class="logo_img"/>
                @else
                  <img src="{{ asset('frontend/images/logo.png') }}" class="logo_img"/>
                @endif
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
                  <table class="textTop">
                    <tr>
                      <td class="user_name" style="padding: 15px 0px 10px 0px; color: #2e2e2d; font-size: 20px; font-weight: 400;">
                        Dear Admin,
                      </td>
                    </tr>
                    <tr>
                      <td class="responsiveTabletrtd" style="padding: 0px 0px; color: #2e2e2d; font-size: 16px; font-weight: 600;">
                        <img src="{{ asset('frontend/images/email/check2.png') }}" style="vertical-align: middle;"/>
                        There is a new sign up on the website. Please find the details as follows-
                      </td>
                    </tr>
                    <tr>
                      <td class="responsiveTable" style="padding: 10px 0px; color: #888888; font-size: 16px; font-weight: 500; letter-spacing: 1px;">
                        User Name : {{ $user_name }}
                      </td>
                    </tr>
                    <tr>
                      <td class="responsiveTable" style="padding: 10px 0px; color: #888888; font-size: 16px; font-weight: 500; letter-spacing: 1px;">
                        Email Id : {{ $email }} 
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
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
