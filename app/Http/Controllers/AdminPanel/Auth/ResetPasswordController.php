<?php

namespace App\Http\Controllers\AdminPanel\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Password;
use Auth;
use Illuminate\Support\Facades\DB;
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
    protected $redirectTo = '/admin-panel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin.guest');
    }

    /**
     * View rest password page.
     *
     * @summary custom rest password page UI.
     * @author Sumit
     * @created 17 July 2019
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showResetForm(Request $request, $token = null)
    {


        $hash_token = Hash::make($token);
        $email = urldecode($request->email);
        $pass_data = DB::select('select * from password_resets where email = :email', ['email' => $email]);

        $current_date = Carbon::now();

        if (!empty($pass_data)) {
            foreach ($pass_data as $res) {
                if ($res->created_at >= $current_date and  $current_date <= date("Y-m-d H:i:s", strtotime("+24 hours", strtotime($res->created_at)))) {
                    return redirect()->route('adminPanel.tokenExpired');
                } else {
                    if (Hash::check($token, $res->token)) {
                        return view('admin-panel.auth.passwords.reset')->with(
                            ['token' => $token, 'email' => $request->email]
                        );
                    } else {
                        return redirect()->route('adminPanel.tokenExpired');
                    }
                }
            }
        } else {
            return redirect()->route('adminPanel.tokenExpired');
        }
    }
}
