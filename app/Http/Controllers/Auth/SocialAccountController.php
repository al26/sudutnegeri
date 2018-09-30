<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cookie;
use App\User;
use App\SocialAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Socialite;
use Auth;
use Exception;
use Validator;
use App\Notifications\ActivationEmail;


class SocialAccountController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return Response
     */
    protected $referer;
    protected $socialUser;
    protected $action;
    
    public function redirectToProvider(Request $req, $provider)
    {
        if($req->query('continue')) {
            // Cookie::queue('continue', $req->query('continue'), 2);
            $req->session()->put('continue', $req->query('continue'));        
        }
        $req->session()->put('action', $req->query('action'));        
        // Cookie::queue('action', $req->query('action'), 2);
        // Cookie::queue('referer', $req->header('referer'), 2);
        return Socialite::driver($provider)->redirect();
    }

    private function setSocialUser($user)
    {
        $this->socialUser = $user;
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback(Request $req, $provider)
    {
        // $this->referer = !empty($req->cookie('referer')) ? $req->cookie('referer') : '/dashboard';
        // $this->referer = !empty($req->cookie('continue')) ? base64_decode(urldecode($req->cookie('continue'))) : '/dashboard';
        $this->referer = !empty($req->session()->get('continue')) ? base64_decode(urldecode($req->session()->get('continue'))) : '/dashboard';
        if ($req->session()->has('continue')) {
            $req->session()->forget('continue');
        }

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return 'error';
        }
        
        if($req->session()->get('action') === 'register') {
            $reg = $this->register($user, $provider);
            $resend = route('auth.activate.resend');

            if ($reg) {
                return redirect()->route('login')->withSuccess('Selamat, Anda telah terdaftar sebagai member SudutNegeri. -- <strong>Aktivasi Akun diperlukan</strong>.<br> Anda harus terlebih dahulu melakukan aktivasi akun untuk dapat masuk ke sistem SudutNegeri. Kami telah mengirimkan email aktivasi ke <strong>'.$user->email.'</strong>, mohon untuk memeriksa juga folder spam email Anda. Jika Anda tidak menerima email aktivasi, dapat kami <a class="btn btn-link p-0" href="'.$resend.'">kirim ulang email aktivasi</a>');
            } else {
                return redirect()->route('login')->withdanger("Terjadi kesalahan, silahkan coba lagi. Silahkan hubungi administrator jika tetap gagal setelah beberapa kali percobaan");
            }
        }

        // if($req->cookie('action') === 'login') {
        if($req->session()->get('action') === 'login') {
            // $authUser = $this->findOrCreate($user, $provider);
            $login = $this->login($user, $provider);
            $resend = route('auth.activate.resend');
            
            if ($login !== false) {
                Auth::login($login, true);
            } else {
                return redirect()->route('login')
                                 ->withdanger('Akun Anda belum terdaftar atau belum aktif. Email aktivasi akan Anda dapatkan sesaat setelah proses pendaftran berhasil. Mohon periksa folder spam apabila tidak ditemukan email di kotak masuk. Anda dapat meminta sistem mengirimkan ulang email aktivasi dengan klik pada menu <a class="alert-link" href="'.$resend.'">Kirim saya email aktivasi</a> pada halaman login');
            }

        }

        // if($req->cookie('action') === 'connect'){
        if($req->session()->get('action') === 'connect') {
            $this->connect($user->getId(), $provider);
            return redirect($this->referer)->withSuccess("Selamat ! koneksi ke akun $provider Anda berhasil dilakukan. Kini Anda dapat login dengan menggunakan Akun $provider Anda.");
        }

        if ($req->session()->has('action')) {
            $req->session()->forget('action');
        }

        return redirect($this->referer);        
    }

    public function login($providerUser, $provider){
        $account = SocialAccount::where('provider_name', $provider)
                   ->where('provider_id', $providerUser->getId())
                   ->first();

        if ($account) {
            if ($account->user->active) {
                return $account->user;
            }
        } else {
            $user = User::where('email', $providerUser->getEmail())->first();
            if ($user) {
                return $user;
            }
        }

        return false;
    }

    public function register($providerUser, $provider){
        $user = User::create([  
            'email' => $providerUser->getEmail(),
            'activation_token' => str_random(150)
        ]);

        $user->profile()->create([
            'name'  => $providerUser->getName(),
        ]);

        $user->profile->address()->create([
            'user_profile_id' => $user->profile->id,
        ]);

        $user->socialAccounts()->create([
            'provider_id'   => $providerUser->getId(),
            'provider_name' => $provider,
        ]);

        $when = now()->addSeconds(10);
        $user->notify((new ActivationEmail($user))->delay($when));

        return true;
    }

    public function findOrCreate($providerUser, $provider){
        $account = SocialAccount::where('provider_name', $provider)
                   ->where('provider_id', $providerUser->getId())
                   ->first();

        if ($account) {
            return $account->user;
        } else {

            $user = User::where('email', $providerUser->getEmail())->first();
            if (! $user) {
                $user = User::create([  
                    'email' => $providerUser->getEmail(),
                ]);
            }

            $user->profile()->create([
                'name'  => $providerUser->getName(),
            ]);

            $user->profile->address()->create([
                'user_profile_id' => $user->profile->id,
            ]);

            $user->socialAccounts()->create([
                'provider_id'   => $providerUser->getId(),
                'provider_name' => $provider,
            ]);

            return $user;
        }
    }

    public function createPassword(Request $request) {
        $rules = [
            "new_pass" => 'required|string|min:6|confirmed',
            "new_pass_confirmation" => 'required',
        ];

        $messages = [
            "new_pass.required" => "Kolom :attribute tidak boleh kosong",
            "new_pass.string"   => "Isikan kolom :attribute dengan huruf, angka, dan karakter apapun (boleh termasuk spasi)",
            "new_pass.min"      => "Password minimal tidak kurang dari :min karakter",
            "new_pass.confirmed"=> "Password konfirmasi harus sama",
            "new_pass_confirmation.required" => "Kolom :attribute tidak boleh kosong",
        ];

        $attributes = [
            "new_pass" => 'password',
            "new_pass_confirmation" => 'konformasi password',        
        ];

        $data = $request->data;
        // die(var_dump($email));

        $validator = Validator::make($data, $rules, $messages, $attributes);

        if ($validator->fails()) {
            $return = ["errors" => $validator->messages()];
        } else {
            $password = Hash::make($request->data['new_pass']);
            $email = $request->data['email'];

            $store = User::where('email', $email)->update(['password' => $password]);
            if($store) {
                $return = ["success" => "Password baru berhasil dibuat"];
            } else {
                $return = ["errors" => "Terjadi Kesalahan. Gagal membuat password baru."];
            }
        }

        return response()->json($return);
    }

    public function connect($provider_id, $provider) {
        $user = auth()->user();

        $user->socialAccounts()->create([
            'provider_id'   => $provider_id,
            'provider_name' => $provider,
        ]);
    }

    public function disconnect($provider, $continue) {
        $user = auth()->user();
        $user->socialAccounts()->where('provider_name', $provider)->delete();

        return redirect(base64_decode(urldecode($continue)))->withSuccess("Pemutusan koneksi ke akun $provider Anda berhasil dilakukan.");
    }
}
