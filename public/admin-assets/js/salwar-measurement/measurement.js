var Measuremenet = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Measuremenet.validateMeasuremenetForm();
            Measuremenet.initializeComponents();
            Measuremenet.customValidationMethods();
            // Measuremenet.addRows_1();
            // Measuremenet.addRows_2();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-salwar-measurement-form");

            // Description Editor
            Components.descriptionEditor($form);
            //-------------------
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
                            /^[0-9.]+$/i.test(value)
                            );
                    } else {
                        return true;
                    }
                },
                "Please enter valid number."
                );
            // jQuery.validator.addMethod(
            //     "aphanumeric",
            //     function (value, element) {
            //         return (
            //             this.optional(element) ||
            //             /^[a-zA-Z0-9-.,()/ ][a-zA-Z0-9-.,()/ ]+$/i.test(value)
            //             );
            //     },
            //     "White space and special characters are not allowed"
            //     );
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
            jQuery.validator.addClassRules("spaceValidation", {
                required:true,
                nowhitespace: true,
            });
        },

        /**
         * Validate video Measuremenet form.
         */
         validateMeasuremenetForm: function () {
            var $form = $(".add-salwar-measurement-form");

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
                    },
                    measurement_price:{
                        required: true,
                        numericFloatOnly: true,

                    },                    
                },
                //------------------

                // @validation error messages
                messages: {
                    measurement_title: {
                        required: "Please enter Measuremenet name.",
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
        // addRows_1: function () {
        //     $(document).ready(function () {
        //         var counter = parseInt($("#addrow1").attr("data-count"));
        //         var serial = counter+1;   
        //         $("#addrow1").on("click", function () {
        //             var cols = "";

        //             cols += '<div class="add-section-panel"> <input type="hidden" name=top['+counter+'][id] value="0"/> <div class="panel border"> <div class="panel-heading"> <h3 class="panel-title">Title '+ serial +' </h3> <div class="panel-actions panel-actions-keep font-size-18 text-danger btn-remove ibtnDel" data-id="0" data-url=""> <i class="icon wb-trash" aria-hidden="true"></i> </div></div><div class="panel-body pb-10"> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label class="display-block form-control-label" for="title"> Title </label> <input class="form-control" autocomplete="off" name="top['+counter+'][title]" type="text"> </div></div><div class="col-md-6"> <div class="form-group"> <label class="display-block form-control-label" for="description"> Description </label> <textarea rows="1" class="form-control" autocomplete="off" name="top['+counter+'][description]" type="text"></textarea> </div></div></div></div></div></div>';
                    
        //             $(".order-list1").append(cols);
        //             counter++;
        //             serial++;
        //         });
        //         $(".order-list1").on("click", ".ibtnDel", function (event) {
        //             var id = $(this).data('id');
        //             var goToUrl = $(this).data('url');
        //             $(this).closest(".add-section-panel").remove();    
        //                 if (id!=0) {
        //                     $.ajax({
        //                       type : "POST",
        //                       url : goToUrl,
        //                       data : {
        //                          id     : id,
        //                          delete : 'top',
        //                       },
        //                       success:function(){
        //                         location.reload();
        //                       },
        //                 });
        //             }
        //             counter -= 1;
        //             serial -= 1;
        //         });


        //     });
        // },
        /**
        * To Add More Rows 
        */
        // addRows_2: function () {
        //     $(document).ready(function () {
        //         var counter = parseInt($("#addrow2").attr("data-count"));
        //         var serial = counter+1; 
        //         $("#addrow2").on("click", function () {

        //             var cols = "";

        //             cols += '<div class="add-section-panel">  <input type="hidden" name=top['+counter+'][id] value="0"/><div class="panel border"> <div class="panel-heading"> <h3 class="panel-title">Title '+serial+' </h3> <div class="panel-actions panel-actions-keep font-size-18 text-danger btn-remove ibtnDel" data-id="0" data-url=""> <i class="icon wb-trash" aria-hidden="true"></i> </div></div><div class="panel-body pb-10"> <div class="row"> <div class="col-md-6"> <div class="form-group"> <label class="display-block form-control-label" for="title"> Title </label> <input class="form-control" autocomplete="off" name="bottom['+counter+'][title]" type="text"> </div></div><div class="col-md-6"> <div class="form-group"> <label class="display-block form-control-label" for="description"> Description </label> <textarea rows="1" class="form-control" autocomplete="off" name="bottom['+counter+'][description]" type="text"></textarea> </div></div></div></div></div></div>';
                    
        //             $(".order-list2").append(cols);
        //             counter++;
        //         });
        //         $(".order-list2").on("click", ".ibtnDel", function (event) {
        //             var id = $(this).data('id');
        //             var goToUrl = $(this).data('url');
        //             $(this).closest(".add-section-panel").remove();    
        //                 if (id!=0) {
        //                     $.ajax({
        //                       type : "POST",
        //                       url : goToUrl,
        //                       data : {
        //                          id     : id,
        //                          delete : 'bottom',
        //                       },
        //                       success:function(){
        //                         location.reload();
        //                       },
        //                 });
        //             }
        //             counter -= 1;
        //             serial -= 1;
        //         });


        //     });
        // }
    };
})();

Measuremenet.init();
