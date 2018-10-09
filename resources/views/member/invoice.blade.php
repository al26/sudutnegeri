@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <p class="mb-2 text-center">Faktur donasi Anda untuk proyek</p>
            <h4 class="mb-0 text-center">{{$donation->project->project_name}}</h4>
            
            <div class="table-responsive mt-3">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scope="row">Jumlah Donasi</th>
                            <td class="text-right">Rp</td>
                            <td class="text-right">{{Idnme::print_rupiah($donation->amount)}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Kode Bayar</th>
                            <td class="text-right"></td>
                            <td class="text-right">{{$donation->payment_code}}</td>
                        </tr>
                        <tr>
                            <th scope="row"><h5 class="font-weight-bold">Total</h5></th>
                            <td><h5 class="font-weight-bold text-right">Rp</h5></td>
                            <td><h5 class="font-weight-bold text-right">{{Idnme::print_rupiah($donation->amount + $donation->payment_code)}}</h5></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="media">
                <div class="media-body">
                    <p class="mt-0">Silahkan transfer ke :</p>
                    <h4 class=""><b>{{$donation->bank->bank_accounts[0]->account_number}}</b></h4>
                    <p class="mb-1">Atas nama : {{$donation->bank->bank_accounts[0]->account_name}}</p>
                    <p class="mb-1">Cabang : {{$donation->bank->bank_accounts[0]->bank_address}}</p>
                </div>
                <img class="align-self-center ml-auto img-fluid" src="{{asset($donation->bank->logo)}}" alt="Logo {{$donation->bank->bank_name}}">
            </div>
        
            <div class="col-12 px-0 mt-2">
                <h5 class="font-weight-bold">Catatan :</h5>
                <p class="text-justify">Mohon transfer sesuai total nominal yang tercantum diatas (<b>{{Idnme::print_rupiah($donation->amount + $donation->payment_code, false, true)}}</b>) untuk mempermudah proses verifikasi.</p> 
                <p class="text-justify">Transfer dapat dilakukan menggunakan chanel apapun (ATM, Mobile Banking, Internet Banking, SMS Banking, maupun Teller).</p>
            </div>

            <div class="d-flex">
                <a href="{{route('project.show', ['slug' => $donation->project->project_slug])}}" class="btn btn-secondary w-50 m-0 mr-1">Kembali ke halaman proyek</a>
                <a href="{{route('project.browse', ['category' => 'all'])}}" class="btn btn-primary w-50 m-0 ml-1">Cari proyek lain</a>
            </div>
        </div>
    </div>

    
</div>
@endsection
