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

                              <td class="text-right">{{$donation->bank->bank_accounts[0]->account_name}}</td>
                          </tr>
                          <tr>
                              <th scope="row"><h5 class="font-weight-bold">Rek. Penerima</h5></th>

                              <td class="text-right">{{$donation->bank->bank_accounts[0]->account_number}}</td>
                          </tr>
                            <tr>
                                <th scope="row">Jumlah Donasi</th>

                                <td class="text-right">{{Idnme::print_rupiah($donation->amount,false,true)}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Kode Bayar</th>

                                <td class="text-right">{{$donation->payment_code}}</td>
                            </tr>
                            <tr>
                                <th scope="row"><h5 class="font-weight-bold">Pengirim</h5></th>

                                <td class="text-right">{{$donation->user->profile->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="media">
                    <div class="media-body">
                        <p>Nama Bank</p>
                    </div>
                    <img class="align-self-center ml-auto img-fluid" src="{{asset($donation->bank->logo)}}" alt="Logo {{$donation->bank->bank_name}}">
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
