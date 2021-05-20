var Coupon = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Coupon.validateCouponForm();
            Coupon.initializeComponents();
            Coupon.customValidationMethods();
            Coupon.checkPrice();
        },
        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-coupon-form");
            // Date range picker
            Components.dateRangePicker($form);
            //------------------
        },

        /**
         * Custom validation methods.
         */
         customValidationMethods: function () {
            jQuery.validator.addMethod(
                "alphaNumbericOnly",
                function (value, element) {
                    return (
                        this.optional(element) ||
                        /^[a-zA-Z0-9 ][a-zA-Z0-9 ]+$/i.test(value)
                        );
                },
                "Please enter only alpha numberic."
                );
            jQuery.validator.addMethod(
                "nowhitespace",
                function(value, element) {
                 var regex = "^\\s+$"; 
                 if (value.match(regex)) {
                     return false;
                 } else {
                    return true;
                }
            }, 
            "White Space is not allowed."
            );
        },

        /**
         * Validate Coupon form.
         */
         validateCouponForm: function () {
            var $form = $(".add-coupon-form");
            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    coupon_code: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#coupon_code").data("url"),
                            type: "get",
                            data: {
                                coupon_code: function () {
                                    return data=$("#coupon_code").val();
                                }
                            }
                        }
                    },
                    coupon_discount: {
                        required: true,
                    },
                    start_date: {
                        required: true,
                    },
                    end_date: {
                        required: true,
                    },
                    price_start: {
                        required: true,
                    },
                    price_end: {
                        required: true,
                    },
                    
                },
                //------------------
                // @validation error messages
                messages: {
                    coupon_code: {
                        required: "Please enter Coupon code.",
                        remote:
                        "The Coupon code you have entered is already registered."
                    }
                },
                //---------------------------

                highlight: function (element, errorClass, validClass) {
                    $(element)
                    .closest(".form-group")
                    .addClass("has-danger")
                    .removeClass("has-success");
                    $(element)
                    .addClass("is-invalid")
                    .removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element)
                    .closest(".form-group")
                    .addClass("has-success")
                    .removeClass("has-danger");
                    $(element)
                    .addClass("is-valid")
                    .removeClass("is-invalid");
                },
                submitHandler: function (form) {
                    App.formLoading($form);
                    form.submit();
                }
            });
        },
        checkPrice: function(){
            $("#price_start").on('change', function(){
                var price = parseInt($(this).val())+1;
                $("#price_end").attr('min', price);
            });
        },
    };
})();

Coupon.init();
/*is-invalid*/
