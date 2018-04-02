<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\CheckRole;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(['auth:admin','admin'])->except(['showLoginForm', 'login']);
    }

    public function index() {
        return view('admin.dashboard');
    }

    public function showLoginForm() {
        return view('admin.login');
    }

    public function login (Request $request) {
        $this->validate($request, [
            'email' => ['required','email','exists:users,email', new CheckRole('users', 'admin')],
            'password' => 'required|min:6',
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ]; 

        if ( Auth::guard('admin')->attempt($credential, $request->member) ) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
