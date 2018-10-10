<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Judul Proyek</th>
                            <th>Donatur</th>
                            <th>Donasi</th>
                            <th>Bank</th>
                            <th>Kode Bayar</th>
                            <th>Bukti Transfer</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donations as $donation)
                            <tr>
                                <td><a href="{{route('project.show', ['slug' => $donation->project->project_slug])}}" class="btn-link text-black" target="_blank">{{$donation->project->project_name}}</a></td>
                                <td>{{$donation->user->profile->name}}</td>
                                <td>{{$donation->amount}}</td>
                                <td>{{$donation->bank->bank_name}}</td>
                                <td>{{$donation->payment_code}}</td>
                                <td>
                                    @if(empty($donation->transfer_receipt))
                                        Belum Ada
                                    @else
                                    <a href="{{asset($donation->transfer_receipt)}}" target="_blank"><i class="fas fa-external-link-alt"></i> Lihat</a>
                                    @endif
                                </td>
                                <td>
                                  @if ($donation->status!="pending")
                                    <h3><span class="badge badge-secondary">Sudah Diverifikasi</span></h3>
                                  @else
                                    <a href="{{route('donation.verify', ['id' => encrypt($donation->id)])}}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Verifikasi Donasi", "lg":true,"cancel":"Batalkan", "no":"rejected" ,"yes":"verifikasi","yesUrl":"{{route('donation.verified', ['id' => encrypt($donation->id),'code'=>'verified'])}}","noUrl":"{{route('donation.verified', ['id' => encrypt($donation->id),'code'=>'unverified'])}}", "pjax-reload":false}'><i class="far fa-check-circle"></i> Verifikasi</a>
                                  @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
