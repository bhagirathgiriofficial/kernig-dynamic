<?php

namespace App\Http\Controllers\Website\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Configuration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Model\Customer;
use DB;
use App\Model\PursueitOTP;

class OtpVerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | OTP Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */
    /**
     * Define auth guard
     *
     * @return guard
     */
    protected function guard()
    {
        return auth()->guard('customer_web');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { }

    public function otpVerification(Request $request)
    {

        $otp_record = PursueitOTP::where(function ($query) use ($request) {
            $query->where('customer_id', "=", $request->get('signin_customer_id'));
            $query->where('opt_number', "=", $request->get('customer_verify_otp'));
        })->first();

        if (empty($otp_record)) {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Sorry, Incorrect OTP code.</div>';

            return response()->json(['status' => false, 'message' => $message]);
        } else {
            $pursueitOtp = PursueitOTP::find($otp_record->pursueit_otp_id);
            $pursueitOtp->delete();

            $customerInfo = Customer::find($request->get('signin_customer_id'));
            $customerInfo->is_email_verified = 1;
            $customerInfo->save();

            $this->validate($request, [
                'signin_customer_email'   => 'required|email',
                'signin_customer_password'  => 'required|min:3'
            ]);

            $user_data = array(
                'email'  => $request->get('signin_customer_email'),
                'password' => $request->get('signin_customer_password')
            );

            if (Auth::attempt($user_data)) {
                $message = "Success";
                return response()->json(['status' => true, 'message' => $message]);
            } else {
                $message = '<div class="alert alert-message alert-message-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Invalid Email or Password. </div>';

                return response()->json(['status' => 'invalid', 'message_invalid' => $message]);
            }
        }
    }

    public function sendOtpVerification(Request $request)
    {
        $otpType = $request->get('otp_type');
        $otp = sendOtpToCustomer($request->signin_customer_id, $otpType);
        $message = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please check your email for OTP. </div>';

        return response()->json(['status' => true, 'message' => $message]);
    }

    public function sendForgotOtpVerification(Request $request)
    {
        $otpType = $request->get('otp_type');
        $otp = sendOtpToCustomer($request->forgot_customer_id, $otpType);
        $message = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please check your email for OTP. </div>';

        return response()->json(['status' => true, 'message' => $message]);
    }

    public function forgotOtpVerification(Request $request)
    {

        $otpRecord = PursueitOTP::where(function ($query) use ($request) {
            $query->where('customer_id', "=", $request->get('forgot_customer_id'));
            $query->where('opt_number', "=", $request->get('customer_forgot_verify_otp'));
        })->first();

        $customerInfo = Customer::find($request->get('forgot_customer_id'));
        if (empty($otpRecord)) {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Sorry, Incorrect OTP code.</div>';

            return response()->json(['status' => false, 'message' => $message]);
        } else {
            $pursueitOtp = PursueitOTP::find($otpRecord->pursueit_otp_id);
            $pursueitOtp->delete();

            $message = "Success";

            return response()->json(['status' => true, 'message' => $message, 'email' => $customerInfo->email, 'token' => $pursueitOtp->opt_token]);
        }
    }
}
