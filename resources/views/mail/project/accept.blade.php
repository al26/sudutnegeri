@component('mail::message')
# Selamat, {{ucwords($project->user->profile->name)}}

Pengajuan proyek {{$project->project_name}} Anda telah disetujui dan proyek tersebut telah dipublikasikan.
Silahkan cek pada situs <a href="{{url('/')}}">Sudut Negeri</a>. Hubungi Admin Sudut Negeri bila proyek Anda ternyata belum terpublikasi.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
