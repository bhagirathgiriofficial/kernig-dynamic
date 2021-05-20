<?php

namespace App\Http\Controllers\Frontend;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\User\User;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function profile()
    {
        return view('frontend.my-profile');
    }

    private function checkUserExist($email)
    {
        $user = null;
        $user = User::where(['email' => $email])->first();
        return $user;
    }

    public function showLogin()
    {
        return view('frontend.login');
    }

    public function login(Request $request)
    {
        $email = $request['email'];
        $password = md5($request['password']);
        $user = $this->checkUserExist($email);
        if (is_null($user)) {
            $response['status'] = 0;
            $response['message']  = "You might have entered an invalid email";
        } else {
            if ($user->user_status == 1) {
                if ($user->password == $password) {
                    $response['status'] = 1;
                    $response['message']  = "Login successful, Redirecting you in 5 seconds";
                    session()->put('user_id', $user->id);
                    session()->put('user_name', $user->f_name);
                } else {
                    $response['status'] = 0;
                    $response['message']  = "You have entered a wrong password";
                }
            } else {
                $response['status'] = 0;
                $response['message']  = "Your account is temporary inactive, please contact us at " . accountSettingData()->site_email;
            }
        }
        return response()->json($response);
    }

    public function register(Request $request)
    {
        if ($request['password'] == $request['confirm_password']) {
            $name = $request['name'];
            $email = $request['email'];
            $password = md5($request['password']);
            $user = $this->checkUserExist($email);
            if (!is_null($user)) {
                $response['status'] = 0;
                $response['message']  = "User with this email address already exists";
            } else {
                DB::beginTransaction();
                try {
                    $newUser = new User;
                    $newUser->f_name = $name;
                    $newUser->email = $email;
                    $newUser->password = $password;
                    $newUser->save();
                    $response['status'] = 1;
                    $response['message']  = "Account Created Successfully. Please login once!";
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    $response['status'] = 0;
                    $response['message']  = "Unable to create the account, please try agin later.";
                }
            }
        } else {
            $response['status'] = 0;
            $response['message']  = "Password and Confirm Password does not match";
        }
        return response()->json($response);
    }

    public function logout()
    {
        session()->forget(['user_name', 'user_id']);
        return redirect()->back();
    }

    public function googleLogin()
    {
        $googleUser = Socialite::driver('google')->user();
        $name = $googleUser->getName();
        $email = $googleUser->getEmail();
        $user = $this->checkUserExist($email);
        if (is_null($user)) {
            DB::beginTransaction();
            try {
                $newUser = new User;
                $newUser->f_name = $name;
                $newUser->email = $email;
                $newUser->save();
                DB::commit();
                session()->put('user_id', $newUser->id);
                session()->put('user_name', $newUser->f_name);
                return redirect('/');
            } catch (\Exception $e) {
                return redirect('/sign-in')->with('error', 'Unable to login using Google, Please try again');
                DB::rollBack();
            }
        } else {
            session()->put('user_id', $user->id);
            session()->put('user_name', $user->f_name);
            return redirect('/');
        }
    }

    public function sendResetLinkEmail(Request $request)
    {
        $user = $this->checkUserExist($request['email']);
        if (is_null($user)) {
            return redirect()->back()->withErrors(['email' => 'You have entered an invalid email']);
        } else {
            $tempPass = md5(Str::random(15));
            $user->password = $tempPass;
            $user->save();
            $actionUrl = url('/password/reset') . "/$tempPass/$user->email";
            $data = [
                'user' => $user->toArray(),
                'actionUrl' => $actionUrl
            ];
            try {
                Mail::send('emails.forgot_mail', $data, function ($message) use ($data) {
                    $message->from('info@kerig.com', 'kerig');
                    $message->to($data['user']['email'], $data['user']['f_name']);
                    $message->subject('Forgot Password');
                });
                return redirect()->back()->with('status', 'Reset password link sent to your email.');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['Unable to send email, please try again later.']);
            }
        }
    }

    public function showResetPasswordPage($temp_pass, $email)
    {
        $user = $this->checkUserExist($email);
        if (is_null($user)) {
            return view('frontend.reset-password')->withErrors(['Invalid email provided']);
        } else {
            if ($user->password == $temp_pass) {
                $data = [
                    'email' => $user->email
                ];
                return view('frontend.reset-password')->with($data);
            } else {
                return view('frontend.reset-password')->withErrors(['The reset password key does not match.']);
            }
        }
    }
}
