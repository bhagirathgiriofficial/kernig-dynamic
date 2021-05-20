<?php

namespace App\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin.guest');
    }

    /**
     * View forgot password.
     *
     * @summary custom forgot password page UI.
     * @author Sumit
     * @created 16 July 2019
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showLinkRequestForm()
    {
        return view('admin-panel.auth.passwords.email');
    }
}
