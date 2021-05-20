var AccountSetting = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            AccountSetting.validateAccountSettingForm();
            AccountSetting.initializeComponents();
            AccountSetting.customValidationMethods();
            AccountSetting.showSvgImage();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-account-form");

            // Description Editor
            Components.descriptionEditor($form);
            //-------------------
        },
        /**
         * Custom validation methods.
         */
         customValidationMethods: function () {
            jQuery.validator.addMethod(
                "lettersOnly",
                function (value, element) {
                    return (
                        this.optional(element) ||
                        /^[a-zA-Z][a-zA-Z ]+$/i.test(value)
                        );
                },
                "Please enter only alphabets."
                );
            jQuery.validator.addMethod(
                "emailOnly",
                function (value, element) {
                    return (
                        this.optional(element) ||
                        /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i.test(value)
                        );
                },
                "Please enter a valid email address."
                );
            jQuery.validator.addMethod(
                "numericFloatOnly",
                function (value, element) {
                    if (value) {
                        return (
                            this.optional(element) ||
                            /^\d{10}$/i.test(value)
                            );
                    } else {
                        return true;
                    }
                },
                "Please enter valid number."
                );
            jQuery.validator.addMethod(
                "validUrl",
                function (value, element) {
                    if (value) {
                        return (
                            this.optional(element) ||
                            /^(?:(?:https?|ftp):\/\/)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/\S*)?$/gi.test(value)
                            );
                    } else {
                        return true;
                    }
                },
                "Please enter valid Url."
                );
            jQuery.validator.addMethod(
                "phoneNumberOnly",
                function (value, element) {
                    if (value) {
                        return (
                            this.optional(element) ||
                            /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/gi.test(value)
                            );
                    } else {
                        return true;
                    }
                },
                "Please enter valid phone number."
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
         * Validate video AccountSetting form.
         */
         validateAccountSettingForm: function () {
            var $form = $(".add-account-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    'site_name': {
                        required: true,
                        nowhitespace: true,
                    },
                    'site_email': {
                        emailOnly: true,
                        required: true,
                    },
                    'site_sales_email':{
                        emailOnly: true,
                        required: true,
                    },
                    'site_number':{
                        required: true,
                        phoneNumberOnly: true,
                    },
                    'site_address':{
                        required:true,
                    },
                    'facebook_url':{
                        required: true,
                        validUrl: true,
                    },
                    'twitter_url':{
                        required: true,
                        validUrl: true,
                    },
                    'google_plus_url':{
                        required: true,
                        validUrl: true,
                    },
                    'pintrest_url':{
                        required: true,
                        validUrl: true,
                    },
                    'instagram_url':{
                        required: true,
                        validUrl: true,
                    },
                    
                },
                //------------------
                // @validation error messages
                messages: {
                    'site_name': {
                        required: "Please enter site name.",
                    },
                    'site_email': {
                        required: "Please enter site email.",
                    },
                    'site_sales_email': {
                        required: "Please enter site sales email.",
                    },
                    'site_number':{
                        required: "Please enter site number",
                    },
                    'site_address':{
                     required: "Please enter site address",
                     },
                    
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
        showSvgImage: function() {
            $("#show-image1").on("click",function(){
                var toggle = $(this).data("toggle");
                if (toggle == 1) {
                    $(this).html("Hide Image");
                    $(this).data("toggle",0);
                    $("#image1").slideDown();
                } else {
                    $(this).html("Show Image");
                    $(this).data("toggle",1);
                    $("#image1").slideUp();
                }
            })
            $("#show-image2").on("click",function(){
                var toggle = $(this).data("toggle");
                if (toggle == 1) {
                    $(this).html("Hide Image");
                    $(this).data("toggle",0);
                    $("#image2").slideDown();
                } else {
                    $(this).html("Show Image");
                    $(this).data("toggle",1);
                    $("#image2").slideUp();
                }
            })
        },

    };
})();

AccountSetting.init();
