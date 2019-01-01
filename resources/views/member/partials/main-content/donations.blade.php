@php
    $total = $investments->sum('amount');
    $total += $investments->sum('payment_code');

    $verified_total = $verified_investments->sum('amount');
    $verified_total += $verified_investments->sum('payment_code');
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Investasi Saya</h4>
    </div>
    @if ($investments->count() <= 0)
        <div class="card-body">    
            <div class="text-center mb-3">
                <div class="my-3">
                    <i class="fas fa-coins fa-10x"></i>
                </div>
                <span class="font-weight-bold">Anda belum berinvestasi ke proyek manapun!!</span><br>
                @if ($featured->count() <= 0)
                    <span class=""><a href="{{route('project.browse', ['category' => 'all'])}}">Mulai Investasi</a></span>
                @else
                    <span class="">Mulai investasi ke proyek rekomendasi berikut atau <a href="{{route('project.browse', ['category' => 'all'])}}">cari proyek lain</a></span>
                @endif
            </div>
            {{-- <span class="--text text-center mt-3 mb-5">Rekomendasi proyek untuk Anda</span> --}}
            @if ($featured->count() > 0)
                <div class="row section-content">
                    @foreach ($featured as $project)
                        @php
                            $progressDana = round(($project->collected_funds / $project->funding_target) * 100);
                            $progressRelawan = round(($project->registered_volunteer / $project->volunteer_quota) * 100);
                        @endphp
                        <div class="d-campaigns col-12 col-sm-6 col-xl-4 card-deck">
                            <div class="card card-shadow m-0 border-0 mb-3" style="min-height:485px">
                                <div class="category-flag">
                                    <p>{{$project->category->category}}</p>
                                </div>
                                <img class="card-img-top img-fit" src="{{asset($project->project_banner)}}" alt="Card image cap">
                                <div class="media campaigner">
                                    <img class="mr-3" src="{{asset($project->user->profile->profile_picture)}}" alt="Profile Picture">
                                    <div class="media-body">
                                        {{$project->user->profile->name}}
                                    </div>
                                </div>
                                <div class="card-header bg-white font-weight-bold">
                                    <a href="{{route('project.show', ['slug' => $project->project_slug])}}" class="card-link"><h5 class="card-title m-0 project-title">{{$project->project_name}}</h5></a>
                                </div>
                                <div class="card-body pb-0 pt-4 _project-info hidden" id="info-{{$project->project_slug}}">
                                    <div class="row m-0">
                                        <span class="col-12 --text p-0">Lokasi</span>
                                        <span class="col-12 --text p-0 mb-2 font-weight-bold">{{ucwords(strtolower($project->location->name))}}</span>
                                        
                                        <span class="col-12 --text p-0">Batas Pendaftaran Relawan</span>
                                        <span class="col-12 --text p-0 mb-2 font-weight-bold">{{Idnme::print_date($project->close_reg)}}</span>
                                        
                                        <span class="col-12 --text p-0">Batas Penerimaan Investasi</span>
                                        <span class="col-12 --text p-0 m-0 font-weight-bold">{{Idnme::print_date($project->close_donation)}}</span>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-4 _project-progress" id="progress-{{$project->project_slug}}">
                                    <div class="info-donasi">
                                        <span class="--text text-capitalize">investasi terkumpul {{$progressDana}}%</span>
                                        <span class="--text font-weight-bold text-capitalize">{{Idnme::print_rupiah($project->collected_funds, false, true)}}</span>
                                        <div class="progress">
                                            <div class="progress-bar" style="width: {{$progressDana}}%"></div>
                                        </div>
                                        <span class="--text text-capitalize">target {{Idnme::print_rupiah($project->funding_target)}}</span>
                                    </div>
                                    <hr class="mt-1 mb-2">
                                    <div class="info-relawan">
                                        <span class="--text "><b>{{empty($project->registered_volunteer) ? "0" : $project->registered_volunteer}}</b> relawan tergabung dari target <b>{{$project->volunteer_quota}}</b> relawan</span>
                                    </div>
                                </div>
                                <div class="card-footer bg-lighten">
                                    <button class="btn btn-link text-secondary-black decoration-none w-100 p-0" onclick="javascript:showAndHide(this, '#progress-{{$project->project_slug}}', '#info-{{$project->project_slug}}', 'Lihat Progress', 'Lihat Detail Proyek');" data-action="hide">Lihat Detail Proyek</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="btn btn-secondary btn-sm" href="{{route('project.browse', ['category' => 'all'])}}">Lebih banyak proyek</a>
            @endif
        </div>
    @else
        <div class="card-body">
            <div class="row section-content">
                <div class="col-12 col-lg-6 px-2 info-box-parent">
                    <div class="info-box">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">{{Idnme::print_rupiah($total, false, true)}}</h3>
                            <p class="text-secondary">Total Investasi : <b>{{$investments->count()}}</b></p>
                        </div>
                        {{-- <div class="info-box-icon">
                            <i class="fas fa-hands"></i>
                        </div> --}}
                    </div>
                </div>
                <div class="col-12 col-lg-6 px-2 info-box-parent">
                    <div class="info-box">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">{{Idnme::print_rupiah($verified_total, false, true)}}</h3>
                            <p class="text-secondary">Investasi Terverifikasi : <b>{{$verified_investments->count()}}</b></p>
                        </div>
                        {{-- <div class="info-box-icon">
                            <i class="fas fa-hands"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="form-section mt-3">
                <div class="fs-head"><span class="fs-head-text">Investasi Saya</span></div>
            </div>
            <div class="row section-content">
                <div class="col-12 table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Proyek</th>
                                <th>Jumlah Investasi</th>
                                <th>Tanggal Investasi</th>
                                <th>Status</th>
                                <th>Bukti Transfer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($investments as $i)
                                @php
                                    switch ($i->status) {
                                        case 'pending':
                                            $status = "perlu verifikasi";
                                            $badge = 'warning';
                                            break;
                                        case 'verified':
                                            $status = "terverifikasi";
                                            $badge = 'success';
                                            break;
                                        default:
                                            $status = "tidak terverifikasi";
                                            $badge = 'danger';
                                            break;
                                    }
                                @endphp
                                <tr>
                                    <td>{{$i->project->project_name}}</td>
                                    <td>{{Idnme::print_rupiah($i->amount + $i->payment_code, false, true)}}</td>
                                    <td>{{Idnme::print_date($i->created_at, true)}}</td>
                                    <td><span class="badge badge-{{$badge}} text-white">{{$status}}</span></td>
                                    <td>
                                        @if(empty($i->transfer_receipt))
                                            <a class="btn btn-sm btn-primary" data-toggle="pjax" data-pjax="main-content" href="{{route('donation.upreceipt', ['id' => encrypt($i->id)])}}" onclick="javascript:$(this).setBackUrl();"><i class="fas fa-cloud-upload-alt"></i> Upload Bukti Transfer</a>
                                        @else
                                            <div class="d-flex flex-row justify-content-around align-items-center">
                                                <a href="{{route('file.view', ['path' => $i->transfer_receipt])}}" class="btn btn-sm btn-success mr-1" target="_blank"><i class="far fa-eye"></i> Lihat</a>
                                                @if ($i->status !== 'verified')
                                                    <a class="btn btn-sm btn-secondary" data-toggle="pjax" data-pjax="main-content" href="{{route('donation.upreceipt', ['id' => encrypt($i->id)])}}"><i class="fas fa-redo-alt"></i> Upload Ulang</a>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>