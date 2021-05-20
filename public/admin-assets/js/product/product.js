var Product = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Product.validateProductForm();
            Product.initializeComponents();
            Product.customValidationMethods();
            Product.validatePrice();
            Product.removeOtherImage();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-product-form");

            // Description Editor
            Components.descriptionEditor($form);
            //-------------------

            // Bootstrap select
            Components.bootstrapSelect($form);
            //-----------------
        },

        /**
         * Custom validation methods.
         */
         customValidationMethods: function () {
            jQuery.validator.addMethod(
                "alphaNumbericOnly",
                function (value, element) {
                    return (
                        this.optional(element) ||
                        /^\\s+$/i.test(value)
                        );
                },
                "Please enter alphanumeric characters only."
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
                "Please enter valid whole number."
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
         * Validate video Product form.
         */
         validateProductForm: function () {
            var $form = $(".add-product-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    product_name: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#product_name").data("url"),
                            type: "get",
                            data: {
                                product_name: function () {
                                    return $("#product_name").val();
                                }
                            }
                        }
                    },
                    product_code:{
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#product_code").data("url"),
                            type: "get",
                            data: {
                                product_code: function () {
                                    return $("#product_code").val();
                                }
                            }
                        }
                    },
                    product_time:{
                        numericOnly: true,                        
                    },
                    product_price:{
                        required: true,
                    },
                    product_order: {
                        numericOnly: true,
                    },
                },
                //------------------

                // @validation error messages
                messages: {
                    product_name: {
                        required: "Please enter product name.",
                        remote:
                        "The product name you have entered is already registered."
                    },
                    product_code: {
                        required: "Please enter product code",
                        remote:
                        "The product code you have entered is already registered."
                    },
                    product_order: {
                        numericOnly: "Please enter valid order number."
                    },
                    product_price:{
                        required: "Please enter product price",
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
        validatePrice: function(){
            $("#product_price").on('change',function(){
                var price = $(this).val();
                $("#product_discount").attr('max', price-1);
                return;
            })
        },
        removeOtherImage: function(){
                $(".remove-other-image").on('mouseenter', function(){
                $(this).prev("img").addClass("border border-danger rounded shadow p-3 bg-white rounded");
             });
              $(".remove-other-image").on('mouseleave', function(){
                $(this).prev("img").removeClass("border border-danger rounded shadow p-3 bg-white rounded");
              });
            $(".remove-other-image").on('click',function(){
                var id       = $(this).data("id");
                var block    = $(this).closest('div');
                var goToUrl  = $(this).data("remove-url");
                iziToast.question({
                    timeout: 20000,
                    close: false,
                    overlay: true,
                    displayMode: "once",
                    color: "yellow",
                    id: "question",
                    zindex: 99999,
                    title: "Hey!",
                    message: "Are you sure, you want to delete?",
                    position: "center",
                    progressBar: false,
                    buttons: [
                    [
                    "<button><b>YES</b></button>",
                    function (instance, toast) {
                        $.ajax({
                            type: "POST",
                            url :  goToUrl,
                            data : {
                             'id' : id,
                         },
                         success: function(response){
                            App.showNotification(response);
                            block.remove();
                         }
                     })
                        instance.hide(
                            { transitionOut: "fadeOut" },
                            toast,
                            "button"
                            );
                    },
                    true
                    ],
                    [
                    "<button>NO</button>",
                    function (instance, toast) {
                        instance.hide(
                            { transitionOut: "fadeOut" },
                            toast,
                            "button"
                            );
                    }
                    ]
                    ],
                    onClosing: function (instance, toast, closedBy) {
                        console.info("Closing | closedBy: " + closedBy);
                    },
                    onClosed: function (instance, toast, closedBy) {
                        console.info("Closed | closedBy: " + closedBy);
                    }
                }); 
            })
        },
    };
})();

Product.init();
