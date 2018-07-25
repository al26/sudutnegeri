<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\SocialAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Socialite;
use Auth;
use Exception;
use Validator;

class SocialAccountController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return Response
     */
    protected $redirectBack = '';
    
    public function redirectToProvider($provider)
    {
        // $this->$redirectBack = $prev;
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request, $provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }    

        $authUser = $this->findOrCreate($user, $provider);

        Auth::login($authUser, true);

        return redirect('/dashboard');
        
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

                // switch ($provider) {
                //     case 'facebook':
                //         $link = $providerUser->getLink()
                //         break;
                    
                //     default:
                //         # code...
                //         break;
                // }
            }

            $user->profile()->create([
                'name'  => $providerUser->getName(),
            ]);

            // dd($user->profile->id);
            $user->profile->address()->create([
                'user_profile_id' => $user->profile->id,
            ]);

            $user->socialAccounts()->create([
                'provider_id'   => $providerUser->getId(),
                'provider_name' => $provider,
                // 'link'          => $link,
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

    public function connect(Request $request, $provider) {
        try {
            $providerUser = Socialite::driver($provider)->user();
            dd($providerUser);
        } catch (Exception $e) {
            return "Tidak dapat terhubung ke $provider";
        }    

        // $user = User::where('email', $request->data['email'])->first();
        // if (! $user) {
        //     return "terjadi kesalahan. Silahkan coba lagi";
        // }

        // $user->socialAccounts()->create([
        //     'provider_id'   => $providerUser->getId(),
        //     'provider_name' => $provider,
        // ]);

        // return $user;
    }
}
