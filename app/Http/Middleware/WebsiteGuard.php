<?php

namespace App\Http\Middleware;

use Closure;

class WebsiteGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('user_id')) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
