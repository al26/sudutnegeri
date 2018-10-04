@php
    $saldo_keseluruhan = Auth::user()->projects->sum('collected_funds');
    $total_withdrawal = Auth::user()->withdrawals->sum('amount');
    $project_list = Auth::user()->where('collected_funds', '>', 0)->get();
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
                        <h3 class="text-secondary">{{Idnme::print_rupiah($saldo_keseluruhan)}}</h3>
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
                        <h3 class="text-secondary">{{Idnme::print_rupiah($total_withdrawal)}}</h3>
                        <p class="text-secondary">Investasi Terverifikasi</p>
                    </div>
                    {{-- <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="form-section mt-3">
            <div class="fs-head"><span class="fs-head-text">Saldo per Proyek</span></div>
        </div>
        <div class="row section-content">
            <div class="col-12 table-responsive">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Proyek</th>
                            <th>Saldo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($project_list as $p)
                            <tr>
                                <td>{{$p->project_name}}</td>
                                <td>{{Idnme::print_rupiah($p->collected_funds)}}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" data-toggle="pjax" data-pjax="main-content" href="{{route('withdrawal.create', ['slug' => $p->project_slug])}}" onclick="javascript:$(this).setBackUrl();"><i class="fas fa-cloud-upload-alt"></i> Cairkan Dana</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</div>