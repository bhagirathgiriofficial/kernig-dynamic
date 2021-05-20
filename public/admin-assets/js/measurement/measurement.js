var Measurement = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Measurement.validateMeasurementForm();
            Measurement.initializeComponents();
            Measurement.customValidationMethods();
            Measurement.addRows();
            Measurement.addRowsUpdate();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-measurement-form");

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
         * Validate video Measurement form.
         */
         validateMeasurementForm: function () {
            var $form = $(".add-measurement-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    measurement_title: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#measurement_title").data("url"),
                            type: "get",
                            data: {
                                measurement_title: function () {
                                    return $("#measurement_title").val();
                                }
                            }
                        }
                    },
                    measurement_price:{
                        required: true,
                    },
                    measurement_description:{
                       required: true, 
                   },
                   measurement:{
                       required: true,
                   }
               },
                //------------------

                // @validation error messages
                messages: {
                    measurement_title: {
                        required: "Please enter Measurement Title.",
                        remote:
                        "The Measurement title you have entered is already registered."
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
        /**
        * To Add More Rows 
        */
        addRows: function () {
            $(document).ready(function () {
                var counter = 1;

                $("#addrow").on("click", function () {
                    var newRow = $("<tr>");
                    var cols = "";

                    cols += '<td><input type="text" class="form-control" name="measurement[' + counter + '][title]" required=""/></td>';
                    cols += '<td><input type="text" class="form-control" name="measurement[' + counter + '][tip]" required=""/></td>';
                    cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger white"  value="Delete"></td>';
                    newRow.append(cols);
                    $("table.order-list").append(newRow);
                    counter++;
                });
                $("table.order-list").on("click", ".ibtnDel", function (event) {
                    $(this).closest("tr").remove();       
                    counter -= 1
                });
            });
        },
        addRowsUpdate: function(){
         $(document).ready(function () {
            var counter = $("#addrow-update").data("count");
            $("#addrow-update").on("click", function () {
                var newRow = $("<tr>");
                var cols = "";
                cols += '<td><input type="hidden" name="measurement[' + counter + '][id]" class="form-control"  autocomplete="off" value=""/><input type="text" class="form-control" name="measurement[' + counter + '][title]"/></td>';
                cols += '<td><input type="text" class="form-control" name="measurement[' + counter + '][tip]"/></td>';
                cols += '<td><input type="button" class="ibtnDel-update btn btn-md btn-danger white" value="Delete" data-url=""/></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });
            $("table.order-list").on("click", ".ibtnDel-update", function (event) {
                var goToUrl = $(this).data('url');
                if (goToUrl!="") {
                    $.ajax({
                        type: "GET",
                        url: goToUrl,
                    })
                }
                $(this).closest("tr").remove();       
                counter -= 1
            });
        });
     }
 };
})();

Measurement.init();
