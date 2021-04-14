@component('mail::message')
Hai, <strong>{{ucwords($user->profile->name)}}</strong><br>
Terima kasih telah berinvestasi ke proyek {{$project->project_name}}. Berikut adalah faktur investasi Anda :

@component('mail::table')
|**Jumlah Investasi**                                 |**Kode Bayar**             |**Total**                                                                      |
|:----------------------------------------------------|:-------------------------:|------------------------------------------------------------------------------:|
|{{Idnme::print_rupiah($donation->amount,false,true)}}|{{$donation->payment_code}}|{{Idnme::print_rupiah($donation->amount + $donation->payment_code,false,true)}}|
@endcomponent

Silahkan lakukan transfer ke rekening Sudut Negeri sesuai dengan ketentuan berikut :
{{-- ![logo]
[logo]:{{secure_asset($donation->bank->logo)}} --}}
@component('mail::table')
|**Bank Tujuan**                       |**Kode Bank**                 |**No. Rekening**                                     |**Atas nama**                                      |
|:-------------------------------------|:----------------------------:|:---------------------------------------------------:|--------------------------------------------------:|
|{{"Bank ".$donation->bank->bank_name}}|{{$donation->bank->bank_code}}|{{$donation->bank->bank_accounts[0]->account_number}}|{{$donation->bank->bank_accounts[0]->account_name}}|
@endcomponent

@slot('subcopy')
Catatan :
Mohon transfer sesuai total nominal yang tercantum diatas (**{{Idnme::print_rupiah($donation->amount + $donation->payment_code,false,true)}}**) untuk mempermudah proses verifikasi.

Transfer dapat dilakukan menggunakan chanel apapun (ATM, Mobile Banking, Internet Banking, SMS Banking, maupun Teller).
@endslot

Terimakasih,<br>
<strong>{{ config('app.name') }}</strong>

@endcomponent
