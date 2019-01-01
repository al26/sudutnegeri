@php
    // $donations = $donations->where('transfer_receipt', '!=', '');
@endphp
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header text-left border-bottom bg-lighten clearfix d-flex flex-row justify-content-between align-items-center">
                <h4 class="m-0 p-0">Daftar Investasi Masuk</h4>
            </div>
            <div class="card-body table-responsive">
                <table id="example" class="table table-striped table-bordered" data-order='{"col":5, "sort":"asc"}'>
                    <thead>
                        <tr>
                            <th>Judul Proyek</th>
                            <th>Donatur</th>
                            <th>Donasi</th>
                            <th>Bank</th>
                            <th>Kode Bayar</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($donations as $donation)
                            @php
                                switch ($donation->status) {
                                    case 'pending':
                                        $status = 'Perlu Verifikasi';
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
                                        $status = 'Perlu Verifikasi';
                                        $badge = 'warning';
                                        break;
                                }
                            @endphp    
                            <tr>
                                <td><a href="{{route('project.show', ['slug' => $donation->project->project_slug])}}" class="btn-link text-black" target="_blank">{{$donation->project->project_name}}</a></td>
                                <td>{{$donation->user->profile->name}}</td>
                                <td>{{$donation->amount}}</td>
                                <td>{{$donation->bank->bank_name}}</td>
                                <td>{{$donation->payment_code}}</td>
                                <td>
                                    @if (!empty($donation->transfer_receipt))
                                        <span class="badge badge-{{$badge}}">{{$status}}</span></td>
                                    @else
                                        <span class="badge badge-secondary">Menunggu bukti transfer</span></td>
                                    @endif
                                <td>
                                    @if (!empty($donation->transfer_receipt) && $donation->status === 'pending')
                                        <a href="{{route('donation.verify', ['id' => encrypt($donation->id)])}}" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Verifikasi Donasi", "lg":true,"cancel":"Batalkan", "no":"Tolak" ,"yes":"Verifikasi","yesUrl":"{{route('donation.verified', ['id' => encrypt($donation->id),'code'=>'verified'])}}","noUrl":"{{route('donation.verified', ['id' => encrypt($donation->id),'code'=>'unverified'])}}", "redirectAfter":"{{route('admin.dashboard', ['menu' => 'donations'])}}", "pjax-container":"#ac"}'><i class="far fa-check-circle"></i> Verifikasi</a>
                                    @else
                                        <span class="btn btn-sm btn-primary text-white disabled" disabled><i class="far fa-check-circle"></i> Verifikasi</span>
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