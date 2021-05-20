var Occasion = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Occasion.validateOccasionForm();
            Occasion.initializeComponents();
            Occasion.customValidationMethods();
        },
        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-occasion-form");
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
         * Validate video Occasion form.
         */
         validateOccasionForm: function () {
            var $form = $(".add-occasion-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    occasion_name: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#occasion_name").data("url"),
                            type: "get",
                            data: {
                                occasion_name: function () {
                                    return $("#occasion_name").val();
                                }
                            }
                        }
                    },
                },
                //------------------
                // @validation error messages
                messages: {
                    occasion_name: {
                        required: "Please enter Occasion name.",
                        remote:
                        "The Occasion name you have entered is already registered."
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

Occasion.init();
