var ResetPassword = function () {

   return {

      /**
       * Initialization.
       */
      init: function () {
         ResetPassword.validateForm();
         ResetPassword.passwordToggle();

      },

      /**
       * Validate form.
       */
      validateForm: function () {

         jQuery.validator.addMethod('lettersonly', function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
         }, 'Please enter only alphabets.');

         jQuery.validator.addMethod('emailChecker', function(value, element) {
            return this.optional(element) || /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i.test(value);
         }, 'Please enter a valid email address.');

         jQuery.validator.addMethod('passwordChecker', function (value, element) {
          var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
            return this.optional(element) || strongRegex.test(value);
         }, 'Password must contain minimum 8 characters including one uppercase , one lowercase, one special character and numeric value.');

         $('.reset-password-form').validate({

            // @validation states + elements
            errorClass: 'invalid-feedback',
            errorElement: 'span',
            //------------------------------

            // @validation rules 
            rules: {
               password: {
                  required: true,
                  passwordChecker: true
               },
               password_confirmation: {
                  equalTo: "#password"
               }
            },
            //------------------

            // @validation error messages 
            messages: {
               password: {
                  required: 'Please enter password.',
               },
               password_confirmation: {
                  required: 'Please enter confirm password.',
                  equalTo: 'Your password and confirmation password do not match.',
               }
            },
            //---------------------------

            // @validation highlighting + error placement  
            highlight: function ( element, errorClass, validClass ) {
               $(element).closest('.form-group').addClass('has-danger').removeClass('has-success');
               $(element).addClass('is-invalid').removeClass('is-valid');
				},
				unhighlight: function (element, errorClass, validClass) {
               $(element).closest('.form-group').addClass('has-success').removeClass('has-danger');
               $(element).addClass('is-valid').removeClass('is-invalid');
				}
            //-------------------------------------------

         });
      },
      passwordToggle: function(){
         $("#showPassword").on("click",function(){
            var flag = $(this).data("flag");
            if (flag == 1) {
              $(".show-hide-me").attr("type","text");
              $(this).data("flag",0);
              $(this).html('<i class="fa fa-eye-slash"> </i>');
              $(this).attr("class","btn btn-danger");
              $(this).attr('data-original-title','Hide Password');
           }
           else{
              $(".show-hide-me").attr("type","password");
              $(this).data("flag",1);
              $(this).html('<i class="fa fa-eye"> </i>');
              $(this).attr("class","btn btn-warning");
              $(this).attr('data-original-title','show Password');
           }
        });
      },
   }

}();

ResetPassword.init();
