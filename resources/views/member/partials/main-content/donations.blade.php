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
            <div class="text-center">
                <div class="my-3">
                    <i class="fas fa-heart fa-10x" data-fa-transform="shrink-6 up-1" data-fa-mask="fas fa-donate"></i>
                </div>
                <span class="font-weight-bold">Anda belum berinvestasi ke proyek manapun!!</span><br>
                
                @if ($featured->count() <= 0)
                    <span class=""><a href="{{route('project.browse', ['category' => 'all'])}}">Mulai Investasi</a></span>
                @endif
            </div>
            @if ($featured->count() > 0)
                <div class="row section-content">
                    @foreach ($featured as $project)
                        @php
                            $progressDana = round(($project->funding_progress / $project->funding_target) * 100);
                            $progressRelawan = round(($project->registered_volunteer / $project->volunteer_quota) * 100);
            
                            date_default_timezone_set('Asia/Jakarta');
            
                            $today = new DateTime('now');
                            $deadline = new DateTime($project->project_deadline);
                            $remainingDays = $today->diff($deadline)->format('%d hari'); 
                            $remainingHours = $today->diff($deadline)->format('%h jam'); 
            
                            if($remainingDays <= 0) {
                                $remainingDays = $remainingHours;
                            }
                            if($remainingDays <= 0 && $remainingHours < 0) {
                                $remainingDays = "Proyek berakhir";
                            }
                        @endphp
                        <div class="d-campaigns col-12 col-sm-6 col-lg-4 card-deck">
                            <div class="card m-0 mb-3 border">
                                <img class="card-img-top rounded-0" src="{{asset($project->project_banner)}}" alt="Project Image">
                                <div class="card-body py-0 px-3 pt-3" style="top:0">
                                    <h5 class="card-title text-danger">{{$project->project_name}}</h5>
                                    <p class="card-text">{!!$project->project_description!!}</p>
                                </div>
                                <div class="project-needs">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Dana
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{$progressDana}}%;" aria-valuenow="{{$progressDana}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                <small class="progress-capt">{{$progressDana}} %</small>
                                            </div>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            Relawan
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: {{$progressRelawan}}%;" aria-valuenow="{{$progressRelawan}}" aria-valuemin="0" aria-valuemax="100"></div>
                                                <small class="progress-capt">{{$progressRelawan}}%</small>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-footer px-3">
                                    <div class="row">
                                        <div class="col-6 text-left">
                                            <p class="mb-0"><small>Lokasi</small></p>
                                            <p class="mb-0">{{$project->project_location}}</p>
                                        </div>
                                        <div class="col-6 text-right">
                                            <p class="mb-0"><small>Sisa Waktu</small></p>
                                            <p class="mb-0" id="remainingTime">{{$remainingDays}}</p>
                                        </div>
                                    </div>				      	
                                </div>
                                <a class="cml text-white" data-toggle="pjax" data-pjax="main-content" href="{{route('project.show', ['slug' => $project->project_slug])}}">
                                    <span>
                                        <i class="fas fa-external-link-alt fa-2x"></i><br>
                                        Lihat <br>Project
                                    </span>
                                </a>        
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
                            <h3 class="text-secondary">{{Idnme::print_rupiah($total)}}</h3>
                            <p class="text-secondary">Total Investasi : <b>{{$investments->count()}}</b></p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-hands"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 px-2 info-box-parent">
                    <div class="info-box">
                        <div class="info-box-inner">
                            <h3 class="text-secondary">{{Idnme::print_rupiah($verified_total)}}</h3>
                            <p class="text-secondary">Investasi Terverifikasi : <b>{{$verified_investments->count()}}</b></p>
                        </div>
                        <div class="info-box-icon">
                            <i class="fas fa-hands"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-section mt-3">
                <div class="fs-head"><span class="fs-head-text">Investasi Saya</span></div>
            </div>
            <div class="row section-content">
                <div class="col-12">
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
                                        case 'being verified':
                                            $badge = 'warning';
                                            break;
                                        case 'verified':
                                            $badge = 'success';
                                            break;
                                        default:
                                            $badge = 'danger';
                                            break;
                                    }
                                @endphp
                                <tr>
                                    <td>{{$i->project->project_name}}</td>
                                    <td>{{Idnme::print_rupiah($i->amount + $i->payment_code)}}</td>
                                    <td>{{Idnme::print_date($i->created_at, true)}}</td>
                                    <td><span class="badge badge-{{$badge}}">{{$i->status}}</span></td>
                                    <td>
                                        @if(empty($i->transfer_receipt))
                                            <a class="btn btn-sm btn-primary" data-toggle="pjax" data-pjax="main-content" href="{{route('donation.upreceipt', ['id' => $i->id])}}" onclick="javascript:$(this).setBackUrl();"><i class="fas fa-cloud-upload-alt"></i> Upload Bukti Transfer</a>
                                        @else
                                            <a href="{{URL::to('/').'/'.$i->transfer_receipt}}" class="btn btn-sm btn-link" target="_blank"> Lihat Bukti Transfer</a>
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