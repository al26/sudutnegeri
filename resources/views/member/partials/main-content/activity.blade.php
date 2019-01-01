@php
    function getStatus($status) {
        $return = array();
        if ($status === 'pending') {
            $return[0] = 'warning';
            $return[1] = 'Baru Daftar';
        }
        if ($status === 'accepted') {
            $return[0] = 'success';
            $return[1] = 'Diterima / Aktif';
        }  
        if ($status === 'rejected') {
            $return[0] = 'danger';
            $return[1] = 'Tidak Diterima';
        }  
        if ($status === 'finished') {
            $return[0] = 'secondary';
            $return[1] = 'Selesai';
        }

        return $return;
    }
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Aktivitas Saya</h4>
    </div>
    @if (Auth::user()->volunteers->count() <= 0)
    <div class="card-body">
        <div class="text-center pt-5 mb-3">
            <div class="my-3">
                <i class="fas fa-hand-holding-heart fa-10x"></i>
            </div>
            <span class="font-weight-bold">Belum ada aktivitas kerelawanan !</span><br>
            @if ($featured->count() <= 0)
                <span class=""><a href="{{route('project.browse')}}" data-toggle="pjax" data-pjax="menu">Pilih proyek</a> dan buat aktivitas kerelawanan Anda.</span>
            @else
                <span class="">Pilih proyek rekomendasi berikut atau <a href="{{route('project.browse')}}" data-toggle="pjax" data-pjax="menu">cari proyek lain</a></span>
            @endif
        </div>
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
            @if (!empty($current_activity) && $current_activity->status !== 'finished')
                <div class="form-section">
                    <div class="fs-head">
                        <span class="fs-head-text">Aktivitas Saat Ini</span>
                    </div>
                </div>
                <div class="row section-content mb-5">
                    <div class="card col">
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <img src="{{asset($current_activity->project->project_banner)}}" class="img-fluid mb-3 mb-md-0 img-thumbnail" alt="Project Banner">
                            </div>
                            <div class="col-12 col-md-7">
                                <div class="card-block px-2">
                                    <a href="{{route('project.show', ['slug' => $current_activity->project->project_slug])}}" class="decoration-none"><h4 class="card-title">{{$current_activity->project->project_name}}</h4></a>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item dv-menu py-2"><i class="fas fw fa-tag mr-2"></i> {{$current_activity->project->category->category}}</li>
                                        <li class="list-group-item dv-menu py-2"><i class="fas fw fa-user mr-2"></i> {{$current_activity->project->user->profile->name}}</li>
                                        <li class="list-group-item dv-menu py-2"><i class="fas fw fa-map-marker-alt mr-2"></i> {{$current_activity->project->location->name}}</li>
                                        <li class="list-group-item dv-menu py-2">
                                            <div class="d-flex flex-row justify-content-between align-items-center">
                                                <p class="m-0">Status <span class="badge badge-{{getStatus($current_activity->status)[0]}}">{{getStatus($current_activity->status)[1]}}</span></p>
                                                @if ($current_activity->status === 'accepted')
                                                    <a href="{{route('history.manage', ['slug' => $current_activity->project->project_slug])}}" class="btn btn-sm btn-secondary float-right" data-toggle="pjax" data-pjax="main-content">Kelola Data Historis</a>
                                                @endif
                                            </div>    
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="form-section">
                <div class="fs-head"><span class="fs-head-text">Semua Aktivitas</span></div>
            </div>
            <div class="row section-content">
                <div class="col table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Proyek</th>
                                {{-- <th>Tanggal Pelaksanaan</th> --}}
                                <th>Status</th>
                                <th>Data Historis</th>
                                {{-- masuk ke list data historis ke proyek terkait, 
                                ada menu edit pake modal --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user_activity as $i)
                                <tr>
                                    <td><a href="{{route('project.show', ['slug' => $i->project->project_slug])}}" class="decoration-none">{{$i->project->project_name}}</a></td>
                                    {{-- <td>xx</td> --}}
                                    <td><span class="badge badge-{{getStatus($i->status)[0]}}">{{getStatus($i->status)[1]}}</span></td>
                                    <td>
                                        @if ($i->status === 'accepted' || $i->status === 'finished')
                                            <a href="{{route('history.manage', ['slug' => $i->project->project_slug])}}" class="btn btn-sm btn-secondary" data-toggle="pjax" data-pjax="main-content"> Kelola Data Historis</a>
                                        @else
                                            <span class="btn btn-sm btn-secondary disabled"> Kelola Data Historis</span>
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