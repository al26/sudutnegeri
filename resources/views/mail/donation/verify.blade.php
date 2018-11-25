@component('mail::message')
# Selamat, {{ucwords($donation->user->profile->name)}}

Investasi Anda ke proyek {{$donation->project->project_name}} sejumlah {{Idnme::print_rupiah($donation->amount+$donation->payment_code, false, true)}} yang dilakukan pada tanggal {{Idnme::print_date($donation->created_at)}} berhasil terverifikasi.

Anda dapat melihat riwayat investasi Anda di <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}">sini</a>.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
