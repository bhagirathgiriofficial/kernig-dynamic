var Testimonial = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Testimonial.validateTestimonialForm();
            Testimonial.initializeComponents();
            Testimonial.customValidationMethods();
            Testimonial.addRows();
            Testimonial.addRowsUpdate();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-testimonial-form");

            Components.imagePreview($form);
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
            // jQuery.validator.addClassRules("image-required", {
            //     required:true,
            //     extension: "xls|csv",
            // });

        },

        /**
         * Validate video Testimonial form.
         */
         validateTestimonialForm: function () {
            var $form = $(".add-testimonial-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    testimonial_name: {
                        required: true,
                        nowhitespace: true,
                    },
                    testimonial_order:{
                        required: true,
                    },
                    testimonial_place:{
                       required: true,
                       nowhitespace:true,
                   },
                   testimonial_message:{
                       required: true,
                       nowhitespace:true,
                   },

               },
                //------------------

                // @validation error messages
                messages: {
                    testimonial_name: {
                        required: "Please enter User's name.",
                    },
                    // testimonial_image: {
                    //     accept: 'Uploaded file is not a valid image. Only JPG, PNG and GIF files are allowed.',
                    // }
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

Testimonial.init();
