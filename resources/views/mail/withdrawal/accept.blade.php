@component('mail::message')
# Hai, {{ucwords($withdrawal->user->profile->name)}}

Pengajuan pencairan dana Anda untuk proyek {{$withdrawal->project->project_name}} sejumlah {{Idnme::print_rupiah($withdrawal->amount, false, true)}} telah kami proses. 

Bukti transfer dapat dilihat <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'withdrawal'])}}">pada menu pencairan dana</a> dashboard akun Sudut Negeri Anda atau dilihat langsung di <a href="{{route('file.view', ['path' => $withdrawal->receipt])}}">sini</a>

Mohon cek rekening Anda untuk memastikan dana pencairan telah masuk. Hubungi admin Sudut Negeri jika ditemui ketidaksesuaian.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
