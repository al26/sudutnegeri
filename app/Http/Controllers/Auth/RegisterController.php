<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Notifications\ActivationEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        $data['continue'] = $request->query('continue') ?? null; 
        return view('auth.register', $data);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'activation_token' => str_random(150)
        ]);

        $user->profile()->create([
            'name' => $data['name'],            
        ]);

        $user->profile->address()->create([
            'user_profile_id' => $user->profile->id,
        ]);

        $user->profile->verification()->create([
            'user_profile_id' => $user->profile->id,
            'status' => 'unverified'
        ]);
        
        $user->profile->cv()->create([
            'user_profile_id' => $user->profile->id,
        ]);
        return $user;
    }

    public function registered(Request $request, $user) 
    {
        // dd($user);

        $when = now()->addSeconds(10);
        $user->notify((new ActivationEmail($user))->delay($when));

        $this->guard()->logout();
        
        $resend = route('auth.activate.resend');

        return redirect()->route('login')
                         ->withSuccess('Selamat, Anda telah terdaftar sebagai member SudutNegeri. -- <strong>Aktivasi Akun diperlukan</strong>.<br> Anda harus terlebih dahulu melakukan aktivasi akun untuk dapat masuk ke sistem SudutNegeri. Kami telah mengirimkan email aktivasi ke <strong>'.$user->email.'</strong>, mohon untuk memeriksa juga folder spam email Anda. Jika Anda tidak menerima email aktivasi, dapat kami <a class="alert-link" href="'.$resend.'">kirim ulang email aktivasi</a>');
    }
}
