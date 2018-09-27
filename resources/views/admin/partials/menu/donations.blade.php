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
                                    <a href="" class="btn btn-sm btn-primary"><i class="far fa-check-circle"></i> Verifikasi</a>
                                    <a class="btn btn-sm btn-danger" href=""><i class="fas fa-ban"></i> Batalkan</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>