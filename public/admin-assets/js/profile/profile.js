   var Profile = function () {

   return {

      /**
       * Initialization.
       */
      init: function () {
         Profile.initializeComponents();
         Profile.customValidationMethods();
         Profile.validateUpdateProfileForm();
         Profile.validateChangePasswordForm();
         Profile.passwordToggle();
      },

      /**
       * Initialize components.
       */
      initializeComponents: function () {
         var $form = $('.update-profile-form');

         // Date picker
         Components.datePicker($form);
         //------------

         // Image preview
         Components.imagePreview($form);
         //--------------
      },

      /**
       * Custom validation methods.
       */
      customValidationMethods: function () {
         jQuery.validator.addMethod('lettersOnly', function (value, element) {
            return this.optional(element) || /^[a-zA-Z][a-zA-Z ]+$/i.test(value);
         }, 'Please enter only alphabets.');

         jQuery.validator.addMethod('emailChecker', function (value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
         }, 'Please enter a valid email address.');

         jQuery.validator.addMethod('mobileChecker', function (value, element) {
            if (value) {
               return this.optional(element) || /^[\+[1-9]{1}[0-9]{9,13}]*$/i.test(value);
            } else {
               return true;
            }
         }, 'Please enter a valid mobile number.');

         jQuery.validator.addMethod('passwordChecker', function (value, element) {
          var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
            return this.optional(element) || strongRegex.test(value);
         }, 'Password must contain minimum 8 characters including one uppercase , one lowercase, one special character and numeric value.');
      },

      /**
       * Validate change password form.
       */
      validateUpdateProfileForm: function () {
         var $form = $('.update-profile-form');

         $form.validate({

            // @validation states + elements
            errorClass: 'invalid-feedback',
            errorElement: 'span',
            //------------------------------

            // @validation rules 
            rules: {
               name: {
                  required: true,
                  lettersOnly: true
               },
               mobile_number: {
                  required: false,
                  mobileChecker: true
               },
               image: {
                  required: false,
                  accept: 'image/jpg,image/jpeg,image/png,image/gif'
               },
            },
            //------------------

            // @validation error messages 
            messages: {
               name: {
                  required: 'Please enter name.',
               },
               image: {
                  accept: 'Uploaded file is not a valid image. Only JPG, PNG and GIF files are allowed.',
               }
            },
            //---------------------------

            highlight: function (element, errorClass, validClass) {
               $(element).closest('.form-group').addClass('has-danger').removeClass('has-success');
               $(element).addClass('is-invalid').removeClass('is-valid');
				},
				unhighlight: function (element, errorClass, validClass) {
               $(element).closest('.form-group').addClass('has-success').removeClass('has-danger');
               $(element).addClass('is-valid').removeClass('is-invalid');
				},
            submitHandler: function (form) {
               App.formLoading($form);
               form.submit();
            }
         });
      },

      /**
       * Validate profile form.
       */
      validateChangePasswordForm: function () {
         var $form = $('.change-password-form');

         $form.validate({

            // @validation states + elements
            errorClass: 'invalid-feedback',
            errorElement: 'span',
            //------------------------------

            // @validation rules 
            rules: {
               current_password: {
                  required: true
               },
               new_password: {
                  required: true,
                  passwordChecker: true
               },
               new_password_again: {
                  required: true,
                  equalTo: "#new_password"
               }
            },
            //------------------

            // @validation error messages 
            messages: {
               current_password: {
                  required: 'Please enter current password.',
               },
               new_password: {
                  required: 'Please enter new password.',
               },
               new_password_again: {
                  required: 'Please enter confirm password.',
                  equalTo: 'Your password and confirmation password do not match.',
               }
            },
            //---------------------------

            highlight: function (element, errorClass, validClass) {
               $(element).closest('.form-group').addClass('has-danger').removeClass('has-success');
               $(element).addClass('is-invalid').removeClass('is-valid');
				},
				unhighlight: function (element, errorClass, validClass) {
               $(element).closest('.form-group').addClass('has-success').removeClass('has-danger');
               $(element).addClass('is-valid').removeClass('is-invalid');
            },
            submitHandler: function (form) {
               App.formLoading($form);
               form.submit();
            }
         });
      },
      passwordToggle: function(){
         $("#showPassword").on("click",function(){
            var flag = $(this).data("flag");
            if (flag == 1) {
              $(".show-hide-me").attr("type","text");
              $(this).data("flag",0);
              $(this).html("Hide Password");
              $(this).attr("class","btn btn-danger");
           }
           else{
              $(".show-hide-me").attr("type","password");
              $(this).data("flag",1);
              $(this).html("Show Password");
              $(this).attr("class","btn btn-primary");
           }
        });
      },
   }

}();

Profile.init();
