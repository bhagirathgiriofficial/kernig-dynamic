var Faq = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Faq.validateFaqForm();
            Faq.initializeComponents();
            Faq.customValidationMethods();

        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-faq-form");

            // Description Editor 
            Components.descriptionEditor($form);
            //-------------------
        },

        customValidationMethods: function () {
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
         * Validate video Faq form.
         */
         validateFaqForm: function () {
            var $form = $(".add-faq-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    faq_question: {
                        required: true,
                        nowhitespace:true,
                        remote: {
                            url: $("#faq_question").data("url"),
                            type: "get",
                            data: {
                                faq_question: function () {
                                    return $("#faq_question").val();
                                }
                            }
                        }
                    },
                    faq_answer:{
                        required: true,
                        nowhitespace:true,
                    },
                },
                //------------------

                // @validation error messages
                messages: {
                    faq_question: {
                        required: "Please enter Faq Question.",
                        remote:
                        "The Faq Question you have entered is already registered."
                    },
                    faq_answer: {
                        required: "Please enter Faq Answer.",

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

Faq.init();
