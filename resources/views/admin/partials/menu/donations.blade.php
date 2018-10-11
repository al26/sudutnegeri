<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-left border-bottom bg-lighten clearfix d-flex flex-row justify-content-between align-items-center">
                <h4 class="m-0 p-0">Daftar Investasi Masuk</h4>
            </div>
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
                                        <span class="badge badge-secondary">Sudah Diverifikasi</span>
                                    @else
                                        <a href="{{route('donation.verify', ['id' => encrypt($donation->id)])}}" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Verifikasi Donasi", "lg":true,"cancel":"Batalkan", "no":"Tolak" ,"yes":"Verifikasi","yesUrl":"{{route('donation.verified', ['id' => encrypt($donation->id),'code'=>'verified'])}}","noUrl":"{{route('donation.verified', ['id' => encrypt($donation->id),'code'=>'unverified'])}}", "redirectAfter":"{{route('admin.dashboard', ['menu' => 'donations'])}}", "pjax-container":"#ac"}'><i class="far fa-check-circle"></i> Verifikasi</a>
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