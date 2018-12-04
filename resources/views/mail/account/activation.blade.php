@component('mail::message')
Hai, <strong>{{$user->profile->name}}</strong><br>
Terima kasih telah bergabung bersama Sudut Negeri. Klik tombol di bawah untuk aktivasi akun Anda.

@component('mail::button', ['url' => route('auth.activate', ['token' => $user->activation_token, 'email' => encrypt($user->email)])])
Aktifkan Akun Saya
@endcomponent

Abaikan email ini jika Anda merasa tidak melakukan pendaftaran ke website Sudut Negeri

Salam,<br>
<strong>{{ config('app.name') }}</strong>

@slot('subcopy')
Sebagai antisipasi jika tombol di atas tidak berfungsi, silahkan <i>copy &amp; paste</i> tautan berikut pada peramban Anda : {{route('auth.activate', ['token' => $user->activation_token, 'email' => encrypt($user->email)])}}
@endslot
@endcomponent
