var Size = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Size.validateSizeForm();
            Size.initializeComponents();
            Size.customValidationMethods();
        },
        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-size-form");
        },

        /**
         * Custom validation methods.
         */
         customValidationMethods: function () {
            // jQuery.validator.addMethod(
            //     "lettersOnly",
            //     function (value, element) {
            //         return (
            //             this.optional(element) ||
            //             /^[a-zA-Z][a-zA-Z ]+$/i.test(value)
            //             );
            //     },
            //     "Please enter only alphabets."
            //     );
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
            // jQuery.validator.addMethod(
            //     "nowhitespace",
            //     function(value, element) {
            //      var regex = "^\\s+$"; 
            //      if (value.match(regex)) {
            //          return false;
            //      } else {
            //         return true;
            //     }
            // }, 
            // "White Space is not allowed."
            // ); 
        },

        /**
         * Validate video Size form.
         */
         validateSizeForm: function () {
            var $form = $(".add-size-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    size_name: {
                        required: true,
                        remote: {
                            url: $("#size_name").data("url"),
                            type: "get",
                            data: {
                                size_name: function () {
                                    return $("#size_name").val();
                                }
                            }
                        }
                    },
                    size_price: {
                        required: true,
                    },
                    size_order: {
                        numericOnly: true,
                    }
                },
                //------------------
                // @validation error messages
                messages: {
                    size_name: {
                        required: "Please enter Size title.",
                        remote:
                        "The Size name you have entered is already registered."
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

Size.init();
