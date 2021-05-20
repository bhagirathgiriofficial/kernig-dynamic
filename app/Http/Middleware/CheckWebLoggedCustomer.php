<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Request;
use Session;

class CheckWebLoggedCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'frontend')
    {
        $user = Auth::guard($guard)->user();
        if (!empty($user['id']) && $user['user_status'] != '1') {
            session(['autoLogoutReason' => 'Your account is currently deactivated. Please contact Bagtesh Fashion support for more information.']);
            Auth::guard($guard)->logout();
            return redirect('/');
        } else {
            return $next($request);
        }
    }
}
