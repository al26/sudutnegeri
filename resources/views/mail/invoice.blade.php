@component('mail::message')
Hai, <strong>{{$user->profile->name}}</strong><br>
Terima kasih telah berinvestasi ke proyek {{$project->project_name}}.  Anda.

@component('mail::table')
|**Jumlah Investasi**                                 |**Kode Bayar**             |**Total**                                                                      |
|:----------------------------------------------------|:-------------------------:|------------------------------------------------------------------------------:|
|{{Idnme::print_rupiah($donation->amount,false,true)}}|{{$donation->payment_code}}|{{Idnme::print_rupiah($donation->amount + $donation->payment_code,false,true)}}|
@endcomponent

Silahkan tranfer ke
@component('mail::table')
|**No. Rekening**                                     |**Atas nama**                                      |**Bank**                      |
|:----------------------------------------------------|:-------------------------------------------------:|-----------------------------:|
|{{$donation->bank->bank_accounts[0]->account_number}}|{{$donation->bank->bank_accounts[0]->account_name}}|{{$donation->bank->bank_name}}|
@endcomponent

@slot('subcopy')
Catatan :
Mohon transfer sesuai total nominal yang tercantum diatas (**{{Idnme::print_rupiah($donation->amount + $donation->payment_code,false,true)}}**) untuk mempermudah proses verifikasi.

Transfer dapat dilakukan menggunakan chanel apapun (ATM, Mobile Banking, Internet Banking, SMS Banking, maupun Teller).
@endslot

Salam,<br>
<strong>{{ config('app.name') }}</strong>

@endcomponent
