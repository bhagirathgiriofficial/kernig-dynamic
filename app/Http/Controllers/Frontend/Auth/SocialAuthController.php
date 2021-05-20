<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Model\User\User;
use DB;
use Mail;

class SocialAuthController extends Controller
{
    public function redirectToFacebookProvider()
    {
        $urlSegment = \Request::segment(1);
        session(['link' => url()->previous() . '#']);
        session(['use_from' => $urlSegment]);
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderFacebookCallback(Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect(session('link'));
        }
        try {

            $user = Socialite::driver('facebook')->user();
            if($user->email == ''){
                session(['loginErrorMessage' => "Please allow access to your Email-Id. Bagtesh Fashion cannot proceed further without your Email-Id."]);
                    return redirect(session('link'));
            }
            $existUser = User::where('email', $user->email)->first();
            if ($existUser) {
                Auth::guard('frontend')->loginUsingId($existUser->id);
                $user = Auth::guard('frontend')->user();
            } else {
                $name               = explode(" ", $user->name);
                $email              = $user->email;
                $socialId           = $user->id;
                $userRegType        = 'facebook';

                DB::beginTransaction();
                try {
                    $user                       = new User;
                    $user->f_name               = $name[0];
                    if (isset($name[1])) {
                        $user->l_name           = $name[1];
                    }
                    $user->email                = $email;
                    $user->email_verified_at    = date('Y-m-d H:i:s');
                    $user->user_social_id       = $socialId;
                    $user->user_reg_type        = $userRegType;
                    $user->save();


                    $accountSettingData     = accountSettingData();

                    $emailContent = array(
                        'email'             => $email,
                        'user_name'         => $name[0].' '.$name[1],
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
                    
                } catch (\Exception $e) {
                    //failed logic here
                    DB::rollback();
                    return redirect(session('link'));
                }
                DB::commit();
                Auth::guard('frontend')->loginUsingId($user->id);
            }
            addToCart();
            userCartUpdate();
            if(session('backUrl') != ''){
                return redirect(session('backUrl'). '#');
            } else {
                return redirect(session('link'));    
            }
        } catch (Exception $e) {
            if(session('backUrl') != ''){
                return redirect(session('backUrl'). '#');
            } else {
                return redirect(session('link'));    
            }
        }
    }

    public function redirectToGoogleProvider()
    {

        $urlSegment = \Request::segment(1);
        session(['link' => url()->previous() . '#']);
        session(['use_from' => $urlSegment]);
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderGoogleCallback(Request $request)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect(session('link'));
        }
        try {

            $user       = Socialite::driver('google')->user();
            $existUser  = User::where('email', $user->email)->first();
            if ($existUser) {
                Auth::guard('frontend')->loginUsingId($existUser->id);
                $user = Auth::guard('frontend')->user();
                $user->save();
            } else {
                $name               = explode(" ", $user->name);
                $email              = $user->email;
                $socialId           = $user->id;
                $userRegType        = 'google';

                DB::beginTransaction();
                try {
                    $user                       = new User;
                    $user->f_name               = $name[0];
                    if (isset($name[1])) {
                        $user->l_name           = $name[1];
                    }
                    $user->email                = $email;
                    $user->email_verified_at    = date('Y-m-d H:i:s');
                    $user->user_social_id       = $socialId;
                    $user->user_reg_type        = $userRegType;
                    $user->save();

                    $accountSettingData     = accountSettingData();

                    $emailContent = array(
                        'email'             => $email,
                        'user_name'         => $name[0].' '.$name[1],
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


                } catch (\Exception $e) {
                    //failed logic here
                    DB::rollback();
                    return redirect(session('link'));
                }
                DB::commit();
                Auth::guard('frontend')->loginUsingId($user->id);
            }
            addToCart();
            userCartUpdate();
            if(session('backUrl') != ''){
                return redirect(session('backUrl'). '#');
            } else {
                return redirect(session('link'));    
            }
            
        } catch (Exception $e) {
            if(session('backUrl') != ''){
                return redirect(session('backUrl'). '#');
            } else {
                return redirect(session('link'));    
            }
        }
    }
}
