@component('mail::message')
# Hai, {{ucwords($withdrawal->user->profile->name)}}

Mohon maaf, untuk saat ini kami tidak dapat memproses pengajuan pencairan dana Anda sejumlah {{Idnme::print_rupiah($withdrawal->amount, false, true)}} untuk proyek {{$withdrawal->project->project_name}} karena beberapa hal.

Kami akan menghubingi Anda melalui nomor ponsel Anda yang terdaftar di akun Sudut Negeri atau Anda dapat menghubungi kami terlebih dahulu jika belum ada kejelasan dalam waktu 1x24 jam.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
