var Excel = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Excel.validateExcelForm();
            Excel.initializeComponents();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".upload-excel-form");

            // Description Editor
            Components.descriptionEditor($form);
            //-------------------

            // Bootstrap select
            Components.bootstrapSelect($form);
            //-----------------
        },

        /**
         * Validate video Excel form.
         */
         validateExcelForm: function () {
            var $form = $(".upload-excel-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

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

Excel.init();
