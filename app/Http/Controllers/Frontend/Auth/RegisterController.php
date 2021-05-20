<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Model\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Model\Newsletter\Newsletter;
use DB;
use Mail;
use Carbon\Carbon;
use Session;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        return auth()->guard('web');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'mobile_number' => ['required', 'string', 'mobile_number', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Register Page
    public function showRegisterForm()
    {
        $resultData['accountSettingData']       = accountSettingData();
        $resultData['categoryData']             = catgeoriesData();
        $resultData['mensCategoryData']         = mainCategoryData(28);
        $resultData['womensCategoryData']       = mainCategoryData(29);
        $resultData['masterPageData']           = masterPageData(30);
        $resultData['userData']                 = Auth::guard('frontend')->user();
        $resultData['imagesUrl']                = config('constants');
        $resultData['countryData']              = getCountryList();

        if($resultData['userData'] != ''){
            return redirect('my-dashboard');
        }  
        $data = array(
          'pageTitle'  => "Register",
          'resultData' => $resultData
        );

      return view('frontend.auth.login')->with($data);
    }

    /**
     * This function for send account activation email and manage user activations
     *
     * @param  array  $data
     * @return \App\Model\User
     */

    public function signUp(Request $request)
    {   
        if($request->input('first_name') != '' && $request->input('last_name') != '' && $request->input('email') != '' && $request->input('phone') != '' && $request->input('address') != '' && $request->input('pincode') != '' && $request->input('city') != '' && $request->input('state') != '' && $request->input('country') != '' && $request->input('confirmPassword') != ''){

            $user                   = User::where(['email' => $request['email']])->first();
            $accountSettingData     = accountSettingData();
            if (!empty($user->id)) {
                return response()->json(['status'=>false,'message'=>'<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Email Id already exists !!</div>']);
            } else {
                $user                     = new User;
                $user->f_name             = $request->input('first_name');
                $user->l_name             = $request->input('last_name');
                $user->email              = $request->input('email');
                $user->mobile_number      = $request->input('phone');
                $user->address            = $request->input('address');
                $user->zip_code           = $request->input('pincode');
                $user->city               = $request->input('city');
                $user->state              = $request->input('state');
                $user->country_id         = $request->input('country');
                $user->email_verified_at  = date('Y-m-d H:i:s');
                $user->password           = Hash::make($request->input('confirmPassword'));
                $user->save();
                $user_data['user_id'] = $user->id;

                if($request->input('newsletter') == 1){
                    $newsletter  = Newsletter::where('news_letter_email',$request->input('email'))->count();
                    if($newsletter == 0){
                        $newsletter                     = New Newsletter;
                        $newsletter->news_letter_email  = $request->input('email');
                        $newsletter->save();
                    }
                }
            }

            $emailContent = array(
                'email'             => $request->input('email'),
                'user_name'         => $request->input('first_name').' '.$request->input('last_name'),
                'user_id'           => get_encrypted_value($user_data['user_id'],true),
                'user_type'         => 1
            );

            Mail::send('emails.registration_mail', $emailContent, function ($message) use ($emailContent) {
                $message->to($emailContent['email']);
                $message->subject('Welcome to Bagtesh Fashion');
            });
            
            Mail::send('emails.registration_mail_admin', $emailContent, function ($message) use ($emailContent,$accountSettingData) {
                $message->to($accountSettingData['site_sales_email']);
                $message->subject('New User Registration');
            });

            if ($user_data['user_id'] != "") {
                Auth::guard('frontend')->loginUsingId($user_data['user_id']);
                addToCart();
                userCartUpdate();
                $message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Register successfully, redirecting please wait.. !!</div>';
                
                if(session('backUrl') != ''){
                    return response()->json(['status' => true, 'backUrl' => session('backUrl'), 'message' => $message, 'userId' => $user_data['user_id']]);
                } else {
                    return response()->json(['status' => true, 'backUrl' => false, 'message' => $message, 'userId' => $user_data['user_id']]);
                }
                
                return response()->json(['status' => true, 'message' => $message, 'userId' => $user_data['user_id']]);
            } else {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Oops , Something went wrong !!</div>';
                return response()->json(['status' => false, 'message' => $message]);
            }
        } else {
            $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Required fields are missing !!</div>';
            return response()->json(['status' => false, 'message' => $message]);
        }
        
    }
}