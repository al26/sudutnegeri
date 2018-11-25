<div class="row">
  <div class="col-12 col-lg-12 mb-3">
    <p class="mb-2 text-center">Faktur Donasi X Bukti Transfer </p>
    <h4 class="mb-0 text-center">{{$donation->project->project_name}}</h4>
  </div>
</div>
<div class="row">
  <div class="col-12 col-lg-6">
    <div class="container mt-3">
        <div class="justify-content-center">

                {{-- <p class="mb-2 text-center">Faktur Donasi Project </p>
                <h4 class="mb-0 text-center">{nama project}</h4> --}}

                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row"><h5 class="font-weight-bold">Penerima</h5></th>
                                <td class="">{{$donation->bank->bank_accounts[0]->account_name}}</td>
                            </tr>
                            <tr>
                                <th scope="row"><h5 class="font-weight-bold">Rek. Penerima</h5></th>
                                <td class="">{{$donation->bank->bank_accounts[0]->account_number}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jumlah Donasi</th>
                                <td class="">{{Idnme::print_rupiah($donation->amount,false,true)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Bayar</th>
                                <td class="">{{$donation->payment_code}}</td>
                            </tr>
                            <tr>
                                <th scope="row"><h5 class="font-weight-bold">Pengirim</h5></th>
                                <td class="">{{$donation->user->profile->name}}</td>
                            </tr>
                            <tr>
                                <th scope="row"><h5 class="font-weight-bold">Bank</h5></th>
                                <td>
                                    <img class="align-self-center ml-auto" src="{{asset($donation->bank->logo)}}" height="50" alt="Logo {{$donation->bank->bank_name}}">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
  </div>
  <div class="col-12 col-lg-6">
    {{-- <p class="mb-2 text-center">Bukti Transfer</p>
    <h4 class="mb-0 text-center">{nama project}</h4> --}}
    <img class="align-self-center ml-auto img-fluid" src="{{asset($donation->transfer_receipt)}}" alt="receipt">

  </div>
</div>
