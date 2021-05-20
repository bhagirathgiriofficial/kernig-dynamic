var Slider = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Slider.validateSliderForm();
            Slider.initializeComponents();
            Slider.customValidationMethods();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-slider-form");

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
         * Validate video Slider form.
         */
         validateSliderForm: function () {
            var $form = $(".add-slider-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    slider_title: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#slider_title").data("url"),
                            type: "get",
                            data: {
                                slider_title: function () {
                                    return $("#slider_title").val();
                                }
                            }
                        }
                    },
                    slider_link:{
                        required: true,
                    },
                    slider_description:{
                        nowhitespace:true,
                        required:true
                    }
                    /*slider_image:{
                        required:true,
                    }*/

                },
                //------------------

                // @validation error messages
                messages: {
                    slider_title: {
                        required: "Please enter Slider title.",
                        remote:
                        "The Slider title you have entered is already registered."
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

Slider.init();
