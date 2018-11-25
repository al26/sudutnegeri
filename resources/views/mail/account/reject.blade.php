@component('mail::message')
# Hai, {{ucwords($verification->profile->name)}}

Kami mengalami kendala dalam proses verifikasi akun Anda. Silahkan lakukan verifikasi ulang di <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'verify'])}}">sini</a>. Mohon gunakan file foto yang jelas dan sesuai dengan identitas Anda.

Jika verifikasi kembali gagal, pihak Sudut Negeri akan menghubungi Anda secara langsung untuk mendiskusikan masalah yang ada.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
