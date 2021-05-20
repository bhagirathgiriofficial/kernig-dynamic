<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Model\User\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;
    protected $redirectTo  = '/';
    protected $maxAttempts = 100;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $_redirectTo = '';

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
     * Validate the user login.
     *
     * @param Request $request
     */
    protected function validateLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ]
        );
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout(Request $request)
    {
        session()->forget('cart');
        session()->forget('assessories');
        session()->forget('custom_measurment');
        session()->forget('saree_measurment');
        session()->forget('salwar_measurment');
        session()->forget('discountPrice');
        session()->forget('discount');
        session()->forget('couponCode');
        session()->forget('couponId');
        Auth::guard('frontend')->logout();
        return redirect('');
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        // Load user from database
        $user = \App\Model\User\User::where($this->username(), $request->{$this->username()})->first();

        // Check if user was successfully loaded, that the password matches
        // and active is not 1. If so, override the default error message.

        $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Either e-mail address or password is incorrect. Please <br />provide valid credentials to proceed. </div>';

        if ($request->expectsJson()) {
            return response()->json(['status' => false, 'backUrl' => false, 'message' => $message]);
        }
    }

    protected function authenticated(Request $request, $user)
    {
        if (count($user) != '') {
            if ($user->user_status != 1) {
                $this->logout($request);
                $messageNotActive = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Your account is currently deactivated.</div>';
                return response()->json(['status' => false, 'backUrl' => false, 'message' => $messageNotActive]);
            } elseif ($user->email_verified_at == NULL) {
                $this->logout($request);
                $messageNotVerified = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>To continue, you must first verify your account.</div>';
                return response()->json(['status' => false, 'backUrl' => false, 'message' => $messageNotVerified]);
            } else {
                $messageLogin = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Login successfully, redirecting please wait.. !!</div>';
                Auth::loginUsingId($user['id']);
                $user = Auth::guard('web')->user();
                addToCart();
                userCartUpdate();
                if (session('backUrl') != '') {
                    return response()->json(['status' => true, 'backUrl' => session('backUrl'), 'message' => $messageLogin]);
                } else {
                    return response()->json(['status' => true, 'backUrl' => false, 'message' => $messageLogin]);
                }
            }
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Either e-mail address or password is incorrect. Please provide valid credentials to proceed. </div>';
        }
    }

    // Login Page
    public function showLoginForm()
    {
        $resultData['accountSettingData']       = accountSettingData();
        $resultData['categoryData']             = catgeoriesData();
        $resultData['mensCategoryData']         = mainCategoryData(28);
        $resultData['womensCategoryData']       = mainCategoryData(29);
        $resultData['masterPageData']           = masterPageData(29);
        $resultData['userData']                 = Auth::guard('frontend')->user();
        $resultData['imagesUrl']                = config('constants');
        $resultData['countryData']              = getCountryList();

        if ($resultData['userData'] != '') {
            return redirect('my-dashboard');
        }

        $data = array(
            'pageTitle'  => "Login",
            'resultData' => $resultData
        );

        return view('frontend.auth.login')->with($data);
    }


    // Email Verification Page
    public function emailVerification($user_id)
    {

        $resultData['accountSettingData']       = accountSettingData();
        $resultData['categoryData']             = catgeoriesData();
        $resultData['mensCategoryData']         = mainCategoryData(28);
        $resultData['womensCategoryData']       = mainCategoryData(29);
        $resultData['masterPageData']           = masterPageData(1);
        $resultData['userData']                 = Auth::guard('frontend')->user();
        $resultData['imagesUrl']                = config('constants');

        $userId = get_decrypted_value($user_id, true);

        $user                             = User::Find($userId);
        $resultData['emailVerification']  = $user->email_verified_at;
        $user->email_verified_at          = date('Y-m-d');
        $user->save();

        $data = array(
            'pageTitle'  => "Email Verification",
            'resultData' => $resultData
        );

        return view('frontend.auth.email-verification')->with($data);
    }
}
