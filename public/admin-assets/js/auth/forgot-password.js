var ForgotPassword = function () {

   return {

      /**
       * Initialization.
       */
      init: function () {
         ForgotPassword.validateForm();
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

         $('.forgot-password-form').validate({

            // @validation states + elements
            errorClass: 'invalid-feedback',
            errorElement: 'span',
            //------------------------------

            // @validation rules 
            rules: {
               email: {
                  required: true,
                  email: true,
                  emailChecker: true
               }
            },
            //------------------

            // @validation error messages 
            messages: {
               email: {
                  required: 'Please enter email.',
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
      }
   }

}();

ForgotPassword.init();
