var Fabric = (function () {
    return {
        /**
         * Initialization.
         */
        init: function () {
            Fabric.validateFabricForm();
            Fabric.initializeComponents();
            Fabric.customValidationMethods();
        },

        /**
         * Initialize components.
         */
        initializeComponents: function () {
            var $form = $(".add-fabric-form");
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
                        /^[a-zA-Z0-9%][a-zA-Z0-9% ]+$/i.test(value)
                    );
                },
                "Only alphanumeric characters and  % are allowed"
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
                function (value, element) {
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
         * Validate video Fabric form.
         */
        validateFabricForm: function () {
            var $form = $(".add-fabric-form");
            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------
                // @validation rules
                rules: {
                    fabric_name: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#fabric_name").data("url"),
                            type: "get",
                            data: {
                                fabric_name: function () {
                                    return $("#fabric_name").val();
                                },
                            },
                        },
                    },
                    // fabric_order: {
                    //     required: true,
                    //     numericOnly: true
                    // }
                },
                //------------------

                // @validation error messages
                messages: {
                    fabric_name: {
                        required: "Please enter Fabric name.",
                        remote:
                            "The Fabric name you have entered is already registered.",
                    },
                },
                //---------------------------

                highlight: function (element, errorClass, validClass) {
                    $(element)
                        .closest(".form-group")
                        .addClass("has-danger")
                        .removeClass("has-success");
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element)
                        .closest(".form-group")
                        .addClass("has-success")
                        .removeClass("has-danger");
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
                submitHandler: function (form) {
                    App.formLoading($form);
                    form.submit();
                },
            });
        },
    };
})();

Fabric.init();
