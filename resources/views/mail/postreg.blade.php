@component('mail::message')
# Selamat, {{ucwords($project->user->profile->name)}}

Formulir pendaftaran Anda **berhasil** dikirimkan ke pengelola proyek **{{$project->project_name}}** untuk selanjutnya dilakukan proses seleksi oleh pihak terkait.

Informasi mengenai **hasil seleksi dapat diketahui melalui alamat email Anda ({{$volunteer->email}})**. Informasi tersebut juga dapat Anda ketahui melalui website Sudut Negeri pada <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'activity'])}}">dashboard</a> akun Anda.

Mohon untuk menunggu sampai proses seleksi berakhir.
        
Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
