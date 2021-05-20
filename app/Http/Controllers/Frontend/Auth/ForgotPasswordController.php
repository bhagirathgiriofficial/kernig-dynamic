<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Model\User\User;
use Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Define auth guard
     *
     * @return guard
     */
    protected function guard()
    {
        return auth()->guard('frontend');
    }

    /**
     * Forgot password Page
     *
     * @return view
     */
    public function forgotPassword()
    {
        $resultData['accountSettingData']       = accountSettingData();
        $resultData['categoryData']             = catgeoriesData();
        $resultData['mensCategoryData']         = mainCategoryData(28);
        $resultData['womensCategoryData']       = mainCategoryData(29);
        $resultData['masterPageData']           = masterPageData(32);
        $resultData['userData']                 = Auth::guard('frontend')->user();
        $resultData['imagesUrl']                = config('constants');
        $data = array(
            'pageTitle'  => "Forgot Password",
            'resultData' => $resultData
        );

        if ($resultData['userData'] != '') {
            return redirect('/');
        }
        return view('frontend.auth.forgot-password')->with($data);
    }

    /**
     * Send Email
     *
     * @return response
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);
        $customerCheck = User::where([['email', $request->email], ['user_status', 1]])->first();
        if (!is_null($customerCheck)) {

            $response = $this->broker()->sendResetLink(
                $request->only('email')
            );

            if ($response === Password::RESET_LINK_SENT) {
                $id = get_encrypted_value($customerCheck['id'], true);

                $message = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button> The password reset link has been sent to your email id.</div>";
                return response()->json(['status' => true, 'message' => $message, 'customerId' => $customerCheck['id']]);
            }
            return response()->json(['status' => false, 'message' => ['email' =>  trans($response)]]);
        } else {
            $message = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button> This e-mail address doesn't exist.</div>";
            return response()->json(['status' => false, 'message' => $message]);
        }
    }

    //defining which password broker to use, in our case its the admins
    public function broker()
    {
        return Password::broker('frontend');
    }
}
