<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
<<<<<<< HEAD
        switch ($guard) {
            case 'admin':
                $redirect = redirect()->route('admin.dashboard');
                break;
            
            default:
                $redirect = redirect()->route('home');
                break;
        }

        if (Auth::guard($guard)->check()) {
            return $redirect;
=======
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.home');
                }
                break;
            
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('home');
                }
                break;
>>>>>>> e07b1cb4aa087676456dc3b987e16ae4943721b4
        }

        return $next($request);
    }
}
