<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Model\User\User;
use Password;
use Auth;
use Mail;
use Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '';

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
     * Get the password reset validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:password_confirmation|min:1'
        ];
    }


    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $hash_token = Hash::make($token);
        $email      = urldecode($request->email);
        $passData   = DB::select('select * from password_resets where email = :email', ['email' => $email]);

        $currentDate = Carbon::now();

        $resultData['accountSettingData']       = accountSettingData();
        $resultData['categoryData']             = catgeoriesData();
        $resultData['mensCategoryData']         = mainCategoryData(28);
        $resultData['womensCategoryData']       = mainCategoryData(29);
        $resultData['masterPageData']           = masterPageData(1);
        $resultData['userData']                 = Auth::guard('frontend')->user();
        $resultData['imagesUrl']                = config('constants');

        if (!empty($passData)) {
            foreach ($passData as $res) {
                if ($res->created_at >= $currentDate and  $currentDate <= date("Y-m-d H:i:s", strtotime("+24 hours", strtotime($res->created_at)))) {
                    return redirect('/reset-password-link-expired');
                } else {
                    if (Hash::check($token, $res->token)) {
                        return view('frontend.auth.reset-password')->with(
                            ['token' => $token, 'email' => $request->email, 'resultData' => $resultData,'pageTitle' => "Reset Password" ]
                        );
                    } else {
                        return redirect('/reset-password-link-expired');
                    }
                }
            }
        } else {
            return redirect('/reset-password-link-expired');
        }
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\Response
     */
    protected function sendResetResponse(Request $request, $response)
    {
        $userData = Auth::guard('frontend')->user();
        $user                       = User::find($userData->id);
        $user->email_verified_at    = date('Y-m-d H:i:s');
        $user->save();

        $message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Your password has been successfully Changed. </div>';
        return response()->json(['status' => true, 'message' => $message]);
    }

    /**
     * Get the response for a failed password reset.
     *
     * @param  \Illuminate\Http\Request
     * @param  string  $response
     * @return \Illuminate\Http\Response
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(['status' => false, 'message' => '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>This link has expired. Please submit your request for Reset password again from the website. </p> </div>']);
    }

    //defining our password broker function
    protected function broker()
    {
        return Password::broker('frontend');
    }

    // Reset Link Expired Page
    public function resetLinkExpired()
    {

        $resultData['accountSettingData']       = accountSettingData();
        $resultData['categoryData']             = catgeoriesData();
        $resultData['mensCategoryData']         = mainCategoryData(28);
        $resultData['womensCategoryData']       = mainCategoryData(29);
        $resultData['masterPageData']           = masterPageData(1);
        $resultData['userData']                 = Auth::guard('frontend')->user();
        $resultData['imagesUrl']                = config('constants');
          

        if($resultData['userData'] != ''){
            return redirect('/');
        }
        
        $data = array(
          'pageTitle'  => "Reset password Link Expired",
          'resultData' => $resultData
        );

      return view('frontend.auth.link-expired')->with($data);
    }

}
