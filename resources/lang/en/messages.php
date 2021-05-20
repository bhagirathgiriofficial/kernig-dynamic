<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Global Messages Language
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the app to show the message.
    |
     */

    // Records
    'record_found' => ':Record found.',
    'record_not_found' => 'The :record you are looking for could not be found.',

    'records_found' => ':Records found.',
    'records_not_found' => ':Records not available.',

    'record_created' => ':Record added successfully.',
    'record_creation_failed' => 'Unable to create :record, Please try again!.',

    'records_updated' => ':Record Updated successfully.',
    'records_updation_failed' => 'Unable to updated :record, Please try again!.',

    'order_updated' => ':Record order updated successfully.',
    'order_updation_failed' => 'Unable to updated :record order, Please try again!.',

    'records_saved' => ':Records saved successfully.',
    'records_saving_failed' => 'Unable to save :records, Please try again!.',

    'status_changed'            => 'Status changed successfully.',
    'status_change_failed'      => 'Unable to change status, Please try again!.',
    'status_change_not_allowed' => 'Not allowed to change the status to the previous state, Please try another!.',

    'stock_status_changed' => 'Stock status changed successfully.',
    'stock_status_change_failed' => 'Unable to change stock status, Please try again!.',

    'type_changed'        => 'Hot seller changed successfully',
    'type_change_failed'  => 'Unable to change hot seller, Please try again! ',

    'record_deleted' => ':Record deleted successfully.',
    'record_failed' => 'Unable to delete :record, Please try again!.',

    'default_destroy_failed' => 'Default :Records cannot be deleted.',

    'record_import' => ':Record import successfully .',
    'record_import_failed' => 'Unable to import :records, Please try again!.',

    'record_image_deleted' => ':Record image remove successfully.',
    'record_image_deleted_failed' => 'Unable to remove :record image, Please try again!.',

    'cannot_delete_foreign_key'    => ':Record cannot be deleted, it is being used in Product.',
    'cannot_delete'                => 'Cannot delete the :record, as the :record is/are lying in orders.',
    'cannot_delete_main_category'  => 'Cannot delete the main :record, as it has some child :record',

    'record_moved_to_trash'        => ':Record moved to trash.',
    'record_move_to_trash_failed'  => 'Unable to move :record to trash, Please try again!.',

    'record_removed_to_trash'        => ':Record removed from trash.',
    'record_remove_to_trash_failed'  => 'Unable to remove :record to trash, Please try again!.',

    'excel_file_uploaded'        => ':Success :Record from excel file uploaded successfully.',
    'excel_products_exits'       => 'All the :record in this excel already exists.',
    'excel_file_upload_failed'   => 'Unable to upload :record excel file, Please try again!.',


    'zip_file_uploaded'        => ':Record from zip file uploaded successfully.',
    'zip_file_upload_failed'   => 'Unable to upload :record from zip file, Please try again!.',

    'is_required'                => ':Record is a required filed',
    'limited_length'             => ":Record's length cannot be more than :size characters",


    //-------

    //--------

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Messages Language
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the app to show the message.
    |
     */

    // Profile
    'profile_updation_failed' => 'Unable to update profile, Please try again!.',
    'profile_updated' => 'Profile updated successfully.',
    //--------

    // Change Password
    'password_updation_failed' => 'Unable to change password, Please try again!.',
    'password_updated' => 'Password changed successfully.',
    'password_not_matched' => 'Incorrect current password, Please try again!.',
    //--------

    // Image Upload
    'image_uploaded' => 'Image uploaded successfully.',
    'image_uploading_failed' => 'Unable to upload image, Please try again!.',
    //-------------

    /*
    |--------------------------------------------------------------------------
    | API Messages Language
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the app to show the message.
    |
     */

    // Auth
    'account_created' => 'Account created.',
    'account_creation_failed' => 'Unable create an account, Please try again!',
    'logged_in' => 'Login successfully.',
    'login_failed' => 'Either e-mail address or password is incorrect.',
    'social_login_failed' => 'Unable to login, Please try again!',
    'token_verified' => 'Auth token verified.',
    'account_verified' => 'Account verified',
    'account_created_but_need_verification' => 'We have sent to you a mail for account verification, Please verify your account by entering given one time password in it.',
    'invalid_one_time_password' => 'You\'ve entered an incorrect OTP, please enter the correct OTP to continue.',
    'logged_out' => 'You have been logged out.',
    'logging_out_failed' => 'Unable to logout, Please try again!',
    'email_or_mobile_number_required' => 'Please enter a valid email address or mobile number.',
    'email_address_not_exists' => 'The email address is not registered, please enter your registered email address.',
    'mobile_number_not_exists' => 'The mobile number is not registered, please enter your registered mobile number.',
    'forgot_password_email_sent' => 'We have sent you a email, Please verify your account by entering given one time password in it.',
    'forgot_password_email_sending_failed' => 'Unable to send forgot password email, Please try again!',
    'forgot_password_sms_sending_failed' => 'Unable to send one time password, Please try again!',
    'email_address_already_exists' => 'The email address is already registered, please enter a different email address.',
    'mobile_number_already_exists' => 'The mobile number is already registered.',
    'one_time_password_required' => 'Please enter a valid one time password.',
    'invalid_one_time_password' => 'You have entered wrong OTP.',
    'invalid_one_time_password_request' => 'Invalid request token.',
    'account_inactive' => 'Your account has been deactivated by admin.',
    //-----

];
