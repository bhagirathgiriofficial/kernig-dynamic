var Country = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Country.validateCountryForm();
            Country.initializeComponents();
            Country.customValidationMethods();
        },
        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-country-form");
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
         * Validate video Country form.
         */
         validateCountryForm: function () {
            var $form = $(".add-country-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    country_name: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#country_name").data("url"),
                            type: "get",
                            data: {
                                country_name: function () {
                                    return $("#country_name").val();
                                }
                            }
                        }
                    },
                },
                //------------------
                // @validation error messages
                messages: {
                    country_name: {
                        required: "Please enter Country name.",
                        remote:
                        "The Country name you have entered is already registered."
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
        
    };
})();

Country.init();
