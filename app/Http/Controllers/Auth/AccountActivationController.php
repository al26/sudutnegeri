<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ActivationEmail;

class AccountActivationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function activateAccount (Request $request) {
        $where = [
            'activation_token' => $request->token,
            'email' => decrypt($request->email)
            // 'email' => $request->email
        ];

        $user = User::where($where)->firstOrFail();

        $up = $user->update([
            'active' => true,
            'activation_token' => null,
        ]);

        if ($up) {
            Auth::loginUsingId($user->id);

            if ($request->continue) {
                $ret = base64_decode(urldecode($request->continue));
                return redirect($ret)->withSuccess('Aktivasi berhasil. Kini Anda dapat menikmati seluruh fasilitas Sudut Negeri.');
            }

            return redirect('/dashboard/overview')->withSuccess('Aktivasi berhasil. Kini Anda dapat menikmati seluruh fasilitas Sudut Negeri.');
        } else {
            $user->update([
                'active' => false,
                'activation_token' => str_random(150),
            ]);
            return redirect()->route('login')->withError('Terjadi kesalahan. Silahkan lakukan resend activation email dan lakukan ulang proses aktivasi');
        }

    }

    public function showResendActivationEmailForm() {
        return view('auth.activation.resend');
    }

    public function resendActivationEmail(Request $request) {
        $this->validateResendRequest($request);

        $user = User::where('email', $request->email)->first();

        $when = now()->addSeconds(10);
        $user->notify((new ActivationEmail($user))->delay($when));

        return redirect()->route('login')->withSuccess("Email aktivasi berhasil dikirimkan ke $user->email. Silahkan cek email Anda dan lakukan aktivasi akun");
    }

    protected function validateResendRequest(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Kolom email harus diisi.',
            'email.email' => 'Mohon masukkan alamat email yang valid.',
            'email.exists' => 'Email yang Anda masukkan tidak terdaftar'
        ]);
    }
}
