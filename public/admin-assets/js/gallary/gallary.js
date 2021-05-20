var Gallary = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Gallary.validateGallaryForm();
            Gallary.initializeComponents();
            Gallary.customValidationMethods();
        },

        /**
         * Initialize components.
         */
        initializeComponents: function () {
            var $form = $(".add-gallary-form");

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
                "numericFloatOnly",
                function (value, element) {
                    if (value) {
                        return (
                            this.optional(element) ||
                            /^\d+(?:[.,]\d+)*$/i.test(value)
                            );
                    } else {
                        return true;
                    }
                },
                "Please enter valid number."
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
         * Validate video Gallary form.
         */
         validateGallaryForm: function () {
            var $form = $(".add-gallary-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    image_title: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#image_title").data("url"),
                            type: "get",
                            data: {
                                image_title: function () {
                                    return $("#image_title").val();
                                }
                            }
                        }
                    },
                },
                //------------------

                // @validation error messages
                messages: {
                    image_title: {
                        required: "Please enter Image Title / Alt.",
                        remote:
                        "The Image Title / Alt you have entered is already registered."
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

Gallary.init();
