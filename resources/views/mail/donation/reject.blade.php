@component('mail::message')
# Hai, {{ucwords($donation->user->profile->name)}}

Kami mengalami kendala dalam proses verifikasi investasi Anda ke proyek {{$donation->project->project_name}} sejumlah {{Idnme::print_rupiah($donation->amount+$donation->payment_code, false, true)}} yang Anda lakukan pada tanggal {{Idnme::print_date($donation->created_at)}}.

Mohon upload ulang bukti transfer Anda di <a href="{{route('dashboard', ['menu' => 'negeri', 'section' => 'donations'])}}">sini</a> dengan kualitas gambar yang lebih baik dan pastikan bukti tersebut adalah bukti transaksi untuk investasi terkait.

Jika verifikasi kembali gagal, pihak Sudut Negeri akan menghubungi Anda secara langsung untuk mendiskusikan masalah yang ada.

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>
@endcomponent
