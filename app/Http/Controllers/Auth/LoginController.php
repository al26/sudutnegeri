<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'logoutUser']);
    }

    public function showLoginForm(Request $request)
    {
        $data['continue'] = $request->query('continue') ?? null;   
        return view('auth.login', $data);
    }

    protected function authenticated(Request $request, $user)
    {
        if ( $request->continue ) {
            $ret = base64_decode(urldecode($request->continue));
            return redirect($ret);
        }

        return redirect('/dashboard/overview');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
