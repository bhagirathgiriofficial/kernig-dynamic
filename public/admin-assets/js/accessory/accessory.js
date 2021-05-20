var Accessory = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Accessory.validateAccessoryForm();
            Accessory.initializeComponents();
            Accessory.customValidationMethods();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-accessory-form");

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
                "numericOnly",
                function (value, element) {
                    if (value) {
                        return (
                            this.optional(element) ||
                            /^[\+[0-9]{0}[0-9]{1,5}]*$/i.test(value)
                            );
                    } else {
                        return true;
                    }
                },
                "Please enter valid order number."
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
         * Validate video Accessory form.
         */
         validateAccessoryForm: function () {
            var $form = $(".add-accessory-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    accessory_name: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#accessory_name").data("url"),
                            type: "get",
                            data: {
                                accessory_name: function () {
                                    return $("#accessory_name").val();
                                }
                            }
                        }
                    },
                    accessory_price:{
                        required: true,
                    }
                },
                //------------------

                // @validation error messages
                messages: {
                    accessory_name: {
                        required: "Please enter Accessory name.",
                        remote:
                        "The Accessory name you have entered is already registered."
                    },
                    accessory_price:{
                        required: 'Please enter Accessory price.',
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

Accessory.init();
