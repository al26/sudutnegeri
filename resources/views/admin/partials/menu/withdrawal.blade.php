<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-left border-bottom bg-lighten clearfix d-flex flex-row justify-content-between align-items-center">
                <h4 class="m-0 p-0">Daftar Pengajuan Pencairan Dana Proyek</h4>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal Pengajuan</th>
                            <th>Pemohon</th>
                            <th>Proyek</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawals as $w)
                            @php
                                switch ($w->status) {
                                    case 'pending':
                                        $status = 'Menunggu Pencairan';
                                        $badge = 'warning';
                                        break;
                                    case 'processed':
                                        $status = 'Pencairan telah diproses';
                                        $badge = 'success';
                                        break;
                                    default:
                                        $status = 'Menunggu Pencairan';
                                        $badge = 'warning';
                                        break;
                                }
                            @endphp
                            <tr>
                                <td>{{Idnme::print_date($w->created_at, true)}}</td>
                                <td>{{$w->user->profile->name}}</td>
                                <td>{{$w->project->project_name}}</td>
                                <td>{{Idnme::print_rupiah($w->amount, false, true)}}</td>
                                <td><span class="badge badge-{{$badge}}">{{$status}}</span></td>
                                <td>
                                    @if($w->status === 'processed')
                                        <span class="btn btn-sm btn-primary disabled" disabled>Proses Pencairan</span>
                                    @else
                                        <a href="{{route('withdrawal.show', ['id' => encrypt($w->id)])}}" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Pencairan Dana Proyek", "lg":true,"cancel":"Batal", "no":"Tolak" ,"edit":"Upload Bukti Tranfer","actionUrl":"{{route('withdrawal.proceed', ['id' => encrypt($w->id),'code'=>'verified'])}}","noUrl":"{{route('withdrawal.reject', ['id' => encrypt($w->id),'code'=>'unverified'])}}", "redirectAfter":"{{route('admin.dashboard', ['menu' => 'withdrawal'])}}", "pjax-reload":["#ac"]}'>Proses Pencairan</a>
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