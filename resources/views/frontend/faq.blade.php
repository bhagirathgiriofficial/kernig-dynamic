@extends('frontend.layouts.main')
@section('main-section')
<style>

    .faq-section {
        background: #fdfdfd;
        min-height: 100vh;
        padding: 10vh 0 0;
    }
    .faq-title h2 {
        position: relative;
        margin-bottom: 45px;
        display: inline-block;
        font-weight: 600;
        line-height: 1;
    }
    .faq-title h2::before {
        content: "";
        position: absolute;
        left: 50%;
        width: 60px;
        height: 2px;
        background: #b78723;
        bottom: -25px;
        margin-left: -30px;
    }
    .faq-title p {
        padding: 0 190px;
        margin-bottom: 10px;
    }

    .faq {
        background: #FFFFFF;
        box-shadow: 0 2px 48px 0 rgba(0, 0, 0, 0.06);
        border-radius: 4px;
    }

    .faq .card {
        border: none;
        background: none;
        border-bottom: 1px dashed #CEE1F8;
    }

    .faq .card .card-header {
        padding: 0px;
        border: none;
        background: none;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
    }

    .faq .card .card-header:hover {
        background: rgba(183, 135, 35, 0.1);
        padding-left: 10px;
    }
    .faq .card .card-header .faq-title {
        width: 100%;
        text-align: left;
        padding: 0px;
        padding-left: 30px;
        padding-right: 30px;
        font-weight: 400;
        font-size: 15px;
        letter-spacing: 1px;
        color: #3B566E;
        text-decoration: none !important;
        -webkit-transition: all 0.3s ease 0s;
        -moz-transition: all 0.3s ease 0s;
        -o-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        cursor: pointer;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .faq .card .card-header .faq-title .badge {
        display: inline-block;
        width: 20px;
        height: 20px;
        line-height: 14px;
        float: left;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
        text-align: center;
        background: #b78723;
        color: #fff;
        font-size: 12px;
        margin-right: 20px;
    }

    .faq .card .card-body {
        padding: 30px;
        padding-left: 35px;
        padding-bottom: 16px;
        font-weight: 400;
        font-size: 16px;
        color: #6F8BA4;
        line-height: 28px;
        letter-spacing: 1px;
        border-top: 1px solid #F3F8FF;
    }

    .faq .card .card-body p {
        margin-bottom: 14px;
    }

    @media (max-width: 991px) {
        .faq {
            margin-bottom: 30px;
        }
        .faq .card .card-header .faq-title {
            line-height: 26px;
            margin-top: 10px;
        }
    }
</style>
<!-- Start kitchan slider -->
<!-- menu page section start -->
<div class="container-fluid headtype">
    <div class="container">
        <div class="row char">
            <a href="{{url('/')}}"> Home </a>&nbsp; /&nbsp; <span class="submenu"> FAQs </span>
        </div>
    </div>
</div>
<!-- me page section closed -->

<!-- cart section start -->
<section class="container-fluid cart">
    <div class="container">
        <section class="faq-section">
            <div class="container">
                <div class="row">
                    <!-- ***** FAQ Start ***** -->
                    <div class="col-md-9 mx-auto">
                        <div class="faq-title text-center pb-3">
                            <h2>FAQ</h2>
                        </div>
                    </div>
                    <div class="col-md-9 mx-auto">
                        <div class="faq" id="accordion">
                            @php
                                $faqs = getFaqs();
                                $i = 1;
                            @endphp
                            @foreach ($faqs as $faq)
                            <div class="card">
                                <div class="card-header" id="faqHeading-<?php echo $i?>">
                                    <div class="mb-0">
                                        <h5 class="faq-title" data-toggle="collapse" data-target="#faqCollapse-<?php echo $i?>" data-aria-expanded="false" data-aria-controls="faqCollapse-<?php echo $i?>">
                                            <span class="badge">{{$i}}</span>{{$faq->faq_question}}
                                        </h5>
                                    </div>
                                </div>
                                <div id="faqCollapse-<?php echo $i?>" class="collapse" aria-labelledby="faqHeading-<?php echo $i?>" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>{{$faq->faq_answer}}</p>
                                    </div>
                                </div>
                            </div>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<!-- End why us    -->

@endsection
