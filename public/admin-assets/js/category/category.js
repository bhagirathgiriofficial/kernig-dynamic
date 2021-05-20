var Category = (function () {
    return {
        /**
         * Initialization.
         */
         init: function () {
            Category.validateCategoryForm();
            Category.initializeComponents();
            Category.customValidationMethods();
            Category.isRoot();
            Category.getSubCategories();
        },

        /**
         * Initialize components.
         */
         initializeComponents: function () {
            var $form = $(".add-category-form");

            // Description Editor
            Components.descriptionEditor($form);
            //-------------------
        },

        /**
         * Custom validation methods.
         */
         customValidationMethods: function () {
            jQuery.validator.addMethod(
                "alphanumeric",
                function (value, element) {
                    return (
                        this.optional(element) ||
                        /^[a-zA-Z0-9-][a-zA-Z0-9- ]+$/i.test(value)
                        );
                },
                "Please enter only alphanumeric."
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
         * Validate video category form.
         */
         validateCategoryForm: function () {
            var $form = $(".add-category-form");

            $form.validate({
                // @validation states + elements
                errorClass: "invalid-feedback",
                errorElement: "span",
                //------------------------------

                // @validation rules
                rules: {
                    category_name: {
                        required: true,
                        nowhitespace: true,
                        remote: {
                            url: $("#category_name").data("url"),
                            type: "get",
                            data: {
                                category_name: function () {
                                    return $("#category_name").val();
                                }
                            }
                        }
                    },
                    isRoot:{
                        required: true,
                    },
                    description: {
                        required: false
                    },
                    category_order: {
                        numericOnly: true
                    },
                },
                //------------------

                // @validation error messages
                messages: {
                    category_name: {
                        required: "Please Enter Category Name.",
                        remote:
                        "The category name you have entered is already registered."
                    },
                    category_order: {
                        required: "Please Enter Category Order",
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
        * 
        * To Check if Root Category
        */
        isRoot: function(){
            var $form = $(".add-category-form");
            $form.on('change', '.change-is-root' , function()
            {
                var is_root = $(this).val();
                if (is_root == 2) 
                {
                    $(".change-parent").removeAttr("disabled");
                    $(".change-parent").attr("required","true"); 
                    $(".change-parent").parent("div").removeClass("not-required");
                    $(".change-parent").parent("div").addClass("required");
                }
                else
                {
                   $(".change-parent").attr("disabled","true");
                   $(".change-parent").removeAttr("required"); 
                   $(".change-parent").parent("div").addClass("not-required");
                   $(".change-parent").removeClass("is-invalid");
                   $(".change-parent").parent("div").removeClass("required");
                   $(".change-sub-parent").attr("disabled","true");   
               }
           });  
        },

        /**
        *
        * To Get the sub categories of the selected category
        *
        */
        getSubCategories: function(){
            var $form = $(".add-category-form");
            $form.on('change','.change-parent', function(){
                var id = $(this).val()
                var goToUrl = $(this).attr("data-sub-parent-url");
                // alert(goToUrl);

                //  To get the sub categories of the selected categoreis
                $.ajax({
                    type : "GET",
                    url : goToUrl,
                    data: {
                        category_id : id,
                    },
                    beforeSend: function() {
                        $('.change-sub-parent').append(
                            '<div class="input-loading"><i class="fa fa-spinner fa-spin"></i></div>'
                            );
                    },
                    success: function(response) {
                    var options = "";
                    if (response._status == true) {
                        var sub_parent = response._data;
                        options += '<option value="">  Select a sub parent category </option>';
                        $.each(sub_parent, function( index, sub_parent) {
                           options += '<option value="'+ sub_parent.category_id +'"> '+ sub_parent.category_name +' </option>'
                        });
                    }
                    else
                    {
                        options += '<option value="">  No category found </option>';
                    }
                    $form.find(".change-sub-parent").removeAttr("disabled");
                    $form.find(".change-sub-parent").html(options);
                }
            });
                // -----------------------------------------------------
            });

        }
    };
})();

Category.init();
