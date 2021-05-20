<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 d-none d-lg-block">
                <!-- Start Row  -->
                <div class="row">
                    <div class="col-lg-4">
                        <h5 class="text-uppercase">COMPANY</h5>
                        <ul class="footer-links">
                            <li>
                                <a href="#">About Us</a>
                            </li>
                            <li>
                                <a href="#">Blog Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="text-uppercase">CUSTOMER ASSISSTANCE</h5>
                        <ul class="footer-links">
                            <li>
                                <a href="#">Order Status</a>
                            </li>
                            <li>
                                <a href="{{url('/faq')}}">FAQs</a>
                            </li>
                            <li>
                                <a href="#">Shipping & Delivery</a>
                            </li>
                            <li>
                                <a href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="text-uppercase">RESOURCES</h5>
                        <ul class="footer-links">
                            <li>
                                <a href="#">3D Design Services</a>
                            </li>
                            <li>
                                <a href="#">Catalogs</a>
                            </li>
                            <li>
                                <a href="#">Bulk</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Row  -->
            </div>
            <div class="col-lg-4">
                <div class="social-links">
                    <h6>Connect with us</h6>
                    <ul>
                        <li>
                            <a href="{{accountSettingData()->instagram_url}}" title="Instagram" target="_blank">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{accountSettingData()->facebook_url}}" title="facebook" target="_blank">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{accountSettingData()->pinterest_url}}" title="Pinterest" target="_blank">
                                <i class="fab fa-pinterest-p"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="subscribe-form">
                    <h6>DISCOVER THE LATEST STYLES</h6>
                    <form action="" id="news-letter">
                        <input type="text" name="email"
                        class="form-control border-bottom border-top-0 border-left-0 border-right-0 rounded-0 "
                        placeholder="YOUR EMAIL ADDRESS" required onkeyup="validateEmail(this.value,'subscribe-msg')" autocomplete="off"/>
                        <div id="subscribe-msg" class="mt-2"></div>
                        <button class="btn w-100 rounded-0" id="subscribe-btn">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Start Copywrite text Row  -->
<section class="copywrite-text">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <p class="text-center">&copy; 2021 {{getSiteName()}}. ALL RIGHTS RESERVED
                    Privacy Policy I Terms & Conditions I Site Index</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Copywrite text Row    -->
</body>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{asset('frontend/js/webslidemenu.js')}}"></script>
<script src="{{asset('frontend/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/js/custom.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $("#news-letter").on("submit",function(){
        var form = $(this);
        $("#subscribe-btn").text("Submitting");
        $.ajax({
            url: "{{url('/')}}/subscribe-newsletter",
            data: form.serialize(),
            method:"post",
            success:function(data){
                $("#subscribe-msg")[0].classList = [];
                switch(data.status){
                    case 1:
                    $("#subscribe-msg").addClass("mt-2 text-success");
                    break;
                    case 2:
                    $("#subscribe-msg").addClass("mt-2 text-info");
                    break;
                    case 0:
                    $("#subscribe-msg").addClass("mt-2 text-danger");
                    break;
                }
                $("#subscribe-msg").text(data.message);
                $("#subscribe-btn").text("Submit");
                form.trigger("reset");
            }
        });
        return false;
    });
    // Validate Email
    function validateEmail(email,error_id)
    {
        $("#"+error_id)[0].classList = [];
        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
        {
            $("#"+error_id).text("")
            return (true);
        }
        $("#"+error_id).text("You have entered an invalid email address!").addClass("mt-2 text-danger");
        return (false)
    }
</script>
@stack('script')
</html>
