@component('mail::message')
# Hai, {{ucwords($project->user->profile->name)}}

Pengajuan proyek {{$project->project_name}} Anda ditolak karena beberapa hal terkait dokumen versifikasi yang Anda sertakan.
Silahkan hubungi admin Sudut Negeri untuk mengetahui detail kesalahan dalam pengajuan proyek tersebut.

Jangan lupa untuk memperbarui dan mengunggah ulang dokumen verifikasi sesuai petunjuk yang diberikan Admin Sudut Negeri.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
