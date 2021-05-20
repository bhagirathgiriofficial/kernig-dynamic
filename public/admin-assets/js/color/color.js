var Color = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Color.validateColorForm();
            Color.initializeComponents();
            Color.customValidationMethods();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-color-form");

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
         * Validate video Color form.
         */
         validateColorForm: function () {
            var $form = $(".add-color-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    color_name: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#color_name").data("url"),
                            type: "get",
                            data: {
                                color_name: function () {
                                    return $("#color_name").val();
                                }
                            }
                        }
                    },
                    colorpicker1:{
                        required: true,
                    }
                },
                //------------------

                // @validation error messages
                messages: {
                    color_name: {
                        required: "Please enter Color name.",
                        remote:
                        "The Color name you have entered is already registered."
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

Color.init();
