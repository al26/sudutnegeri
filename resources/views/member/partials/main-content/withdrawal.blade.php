@php
    $total_withdrawal = Auth::user()->withdrawals()->where('status', 'processed')->sum('amount');
    $saldo_keseluruhan = Auth::user()->projects->sum('collected_funds') - $total_withdrawal;
    $project_list = Auth::user()->projects()->where('collected_funds', '>', 0)->get();
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Pencairan Dana Proyek</h4>
    </div>
    <div class="card-body">
        <div class="row section-content">
            <div class="col-12 col-lg-6 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary">{{Idnme::print_rupiah($saldo_keseluruhan, false, true)}}</h3>
                        <p class="text-secondary">Saldo Keseluruhan</p>
                    </div>
                    {{-- <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div> --}}
                </div>
            </div>
            <div class="col-12 col-lg-6 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary">{{Idnme::print_rupiah($total_withdrawal, false, true)}}</h3>
                        <p class="text-secondary">Total Dana Dicairkan</p>
                    </div>
                    {{-- <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="form-section mt-3">
            <div class="fs-head clearfix">
                <span class="fs-head-text float-left p-0">Riwayat Pencairan</span>
                {{-- <p class="m-0 p-0 float-left"></p> --}}
                @if ($saldo_keseluruhan > 0)
                    <a class="btn btn-sm btn-primary float-right" data-toggle="pjax" data-pjax="main-content" href="{{route('withdrawal.create')}}" onclick="javascript:$(this).setBackUrl();"><i class="fas fa-reply fa-rotate-270"></i> Ajukan Pencairan</a>
                @else
                    <span class="btn btn-sm btn-primary float-right disabled"><i class="fas fa-reply fa-rotate-270"></i> Ajukan Pencairan</span>
                @endif
            </div>
        </div>
        <div class="row section-content">
            <div class="col-12 table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Pengajuan</th>
                            <th>Proyek</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Auth::user()->withdrawals as $w)
                            @php
                                $wd = $w->where('status', 'processed')->sum('amount');
                                switch ($w->status) {
                                    case 'pending':
                                        $status = 'Dalam proses';
                                        $badge = 'warning';
                                        break;
                                    case 'processed':
                                        $status = 'Pencairan telah diproses';
                                        $badge = 'success';
                                        break;
                                    default:
                                        $status = 'Dalam proses';
                                        $badge = 'warning';
                                        break;
                                }
                            @endphp
                            <tr>
                                <td>{{Idnme::print_date($w->created_at, true)}}</td>
                                <td>{{$w->project->project_name}}</td>
                                <td>{{Idnme::print_rupiah($w->amount, false, true)}}</td>
                                <td><span class="badge badge-{{$badge}}">{{$status}}</span></td>
                                {{-- <td>
                                    <a class="btn btn-sm btn-primary" data-toggle="pjax" data-pjax="main-content" href="{{route('withdrawal.create', ['slug' => $p->project_slug])}}" onclick="javascript:$(this).setBackUrl();"><i class="fas fa-cloud-upload-alt"></i> Cairkan Dana</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>