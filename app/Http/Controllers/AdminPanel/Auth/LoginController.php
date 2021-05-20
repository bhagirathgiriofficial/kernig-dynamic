<?php

namespace App\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin-panel/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin.guest')->except('logout');
    }

    /**
     * View login.
     *
     * @summary custom login page UI.
     * @author Sumit
     * @created 13 July 2019
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function showLoginForm()
    {
        return view('admin-panel.auth.login');
    }

    /**
     * Logout.
     *
     * @summary custom logout.
     * @author Sumit
     * @created 16 July 2019
     * @return void
     */
    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('adminPanel.login');
    }
}
