@component('mail::message')
# Selamat, {{ucwords($verification->profile->name)}}

Akun Anda berhasil diverifikasi. Kini Anda dapat <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}">memulai</a> dan mengelola proyek Anda sendiri.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
