<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-left border-bottom bg-lighten clearfix d-flex flex-row justify-content-between align-items-center">
                <h4 class="m-0 p-0">Daftar Pengguna</h4>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered" data-order='{"col":6, "sort":"asc"}'>
                    <thead>
                        <tr>
                            <th>No. Identitas</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Profesi</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php
                                switch ($user->verification->status) {
                                    case 'pending':
                                        $status = 'Belum Diverifikasi';
                                        $badge = 'warning';
                                        break;
                                    case 'verified':
                                        $status = 'Terverifikasi';
                                        $badge = 'success';
                                        break;
                                    case 'unverified':
                                        $status = 'Tidak Terverifikasi';
                                        $badge = 'danger';
                                        break;
                                    default:
                                        $status = 'Belum Diverifikasi';
                                        $badge = 'warning';
                                        break;
                                }
                            @endphp    
                            <tr>
                                <td>{{$user->identity_number}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{Idnme::print_date($user->dob, false)}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->address->exact_location}}</td>
                                <td>{{$user->profession}}</td>
                                <td>
                                    <span class="badge badge-{{$badge}}">{{$status}}</span>
                                </td>
                                <td>
                                    @if ($user->verification->status !== "pending")
                                        <span class="btn btn-sm btn-primary text-white disabled"><i class="far fa-check-circle"></i> Verifikasi</span>
                                    @else
                                        <a href="{{route('user.verification', ['id' => encrypt($user->verification->id)])}}" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Verifikasi Pengguna", "lg":true, "cancel":"Batalkan", "no":"Tolak" ,"yes":"Verifikasi","yesUrl":"{{route('user.verify', ['id' => encrypt($user->verification->id),'action'=>'verify'])}}","noUrl":"{{route('user.verify', ['id' => encrypt($user->verification->id),'action'=>'reject'])}}", "redirectAfter":"{{route('admin.dashboard', ['menu' => 'users'])}}", "pjax-container":"#ac"}'><i class="far fa-check-circle"></i> Verifikasi</a>
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