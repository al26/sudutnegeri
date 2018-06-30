<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\SocialAccount;
use Socialite;
use Auth;
use Exception;

class SocialAccountController extends Controller
{
    /**
     * Redirect the user to the Provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }    

        $authUser = $this->findOrCreate($user, $provider);

        Auth::login($authUser, true);

        return redirect()->route('dashboard', ['menu' => 'overview']);
        
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

            $user->socialAccounts()->create([
                'provider_id'   => $providerUser->getId(),
                'provider_name' => $provider,
                'link'          => $link,
            ]);

            return $user;
        }
    }
}
