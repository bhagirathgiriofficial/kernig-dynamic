var Shipping = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Shipping.validateShippingForm();
            Shipping.initializeComponents();
            Shipping.customValidationMethods();
        },
        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-shipping-form");
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
                    "notEqualToZero", 
                    function (value, element) { // Adding rules for Amount(Not equal to zero)
                     return this.optional(element) || value != '0';
            });
            },

        /**
         * Validate video Shipping form.
         */
         validateShippingForm: function () {
            var $form = $(".add-shipping-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules:{
                    country: {
                        notEqualToZero: true,
                    },
                },
                //------------------
                // @validation error messages
                messages: {
                    country: {
                        notEqualToZero: "Please select a country",
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

Shipping.init();
