@component('mail::message')
# Aktivasi Akun Sudut Negeri

Hai, <strong>{{$user->profile->name}}</strong>,<br>
Terima kasih telah bergabung bersama Sudut Negeri. Aktifkan akun Anda dengan klik pada tombol di bawah ini

@component('mail::button', ['url' => route('auth.activate', ['token' => $user->activation_token, 'email' => encrypt($user->email)])])
Aktifkan Akun Saya
@endcomponent

Abaikan Email ini jika Anda merasa tidak melakukan pendaftaran ke website SudutNegeri

Salam,<br>
{{ config('app.name') }}

<hr>
<small>
    Sebagai antisipasi jika tombol di atas tidak berfungsi, silahkan <i>copy &amp; paste</i> tautan berikut pada peramban Anda.

    {{route('auth.activate', ['token' => $user->activation_token, 'email' => encrypt($user->email)])}}
</small>
@endcomponent
