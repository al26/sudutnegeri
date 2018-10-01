@php
    $total = $investments->sum('amount');
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Aktivitas Saya</h4>
    </div>
    <div class="card-body">
        <div class="row section-content">
            <div class="col-4 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary">{{$total}}</h3>
                        <p class="text-secondary">Total Aktivitas</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                </div>
            </div>
            {{-- <div class="col-4 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary"></h3>
                        <p class="text-secondary">Lencana</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                </div>
            </div>
            <div class="col-4 px-2 info-box-parent">
                <div class="info-box">
                    <div class="info-box-inner">
                        <h3 class="text-secondary"></h3>
                        <p class="text-secondary">Total Waktu Pengabdian</p>
                    </div>
                    <div class="info-box-icon">
                        <i class="fas fa-hands"></i>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="form-section mt-3">
            <div class="fs-head"><span class="fs-head-text">Aktivitas Saat Ini</span></div>
        </div>
        <div class="form-section mt-3">
            <div class="fs-head"><span class="fs-head-text">Aktivitas Saya</span></div>
        </div>
        <div class="row section-content">
            <div class="col-12">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Proyek</th>
                            <th>Tanggal Pelaksanaan</th>
                            <th>Status</th>
                            <th>Data Historis</th>
                            {{-- masuk ke list data historis ke proyek terkait, 
                            ada menu edit pake modal --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($investments as $i)
                            <tr>
                                <td>{{$i->project->project_name}}</td>
                                <td>xx</td>
                                <td>pending</td>
                                <td>
                                    @if(empty($i->transfer_receipt))
                                        <a href="" class="btn btn-sm btn-primary"><i class="fas fa-cloud-upload-alt"></i> Upload Bukti Transfer</a>
                                    @else
                                        <a href="" class="btn btn-sm btn-link"> Lihat Bukti Transfer</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                menu create data historis (create otomatis ke project yang sedang aktif diikuti)
                <br>
                ada riwayat per data historis (bisa edit)
            </div>
        </div>
    </div>
</div>