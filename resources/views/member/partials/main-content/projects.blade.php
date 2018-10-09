<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Proyek Saya</h4>
    </div>
    @if (Auth::user()->profile->verification->status !== 'verified')
        <div class="card-body">
            <div class="text-center p-5 my-auto">
                @if (Auth::user()->profile->verification->status === 'pending')                    
                    <div class="mb-5">
                        <i class="fas fa-ellipsis-h animated infinite jello fa-10x"></i>
                    </div>
                    <span class="font-weight-bold">Verifikasi akun Anda sedang kami proses,</span><br>
                    <span>Jika dalam 1 x 24 jam akun Anda belum terverifikasi, silahkan hubungi administrator Sudut Negeri untuk penanganan lebih lanjut.</span>
                @endif
                @if (Auth::user()->profile->verification->status === 'unverified')
                    <div class="my-3">
                        <i class="fas fa-exclamation-triangle fa-10x text-danger"></i>
                    </div>
                    <span class="font-weight-bold">Akun Anda belum terverifikasi !</span><br>
                    <span class="">Mohon <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'verify'])}}" data-toggle="pjax" data-pjax="menu">verifikasi akun</a> Anda untuk dapat memulai proyek baru.</span>
                @endif
            </div>
        </div>
    @else
        <div class="card-body">
            {{-- <div class="form-section">
                <div class="fs-head">
                    <span class="fs-head-text">Proyek Saya</span>
                </div>
            </div> --}}
            <div class="row section-content">
                <div class="d-campaigns col-12 col-sm-6 col-lg-4 card-deck">
                    <div class="card m-0 mb-3">
                        {{-- <a class="cal" href="{{route('project.create')}}" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Buat Project Baru","add":"Buat Project","cancel":"Batal","lg":true, "actionUrl":"{{route('project.store')}}"}'> --}}
                        <a class="cal" href="{{route('project.create')}}" data-toggle="pjax" data-pjax="main-content" onclick="javascript:$(this).setBackUrl();">
                            <span>
                                <i class="fas fa-plus fa-2x"></i><br>
                                Project <br>Baru
                            </span>
                        </a>        
                    </div>
                </div>
                @foreach ($user_projects as $project)    
                    @php
                        $progressDana = round(($project->collected_funds / $project->funding_target) * 100);
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
                        <div class="cml-conteiner">
                            <div class="card card-shadow p-0 m-0 border-0">
                                <div class="category-flag">
                                    <p>{{$project->category->category}}</p>
                                </div>
                                <img class="card-img-top" src="{{asset($project->project_banner)}}" alt="Card image cap">
                                <div class="media campaigner">
                                    <img class="mr-3" src="{{asset($project->user->profile->profile_picture)}}" alt="Profile Picture">
                                    <div class="media-body">
                                        {{$project->user->profile->name}}
                                    </div>
                                </div>
                                <div class="card-header px-3 bg-white font-weight-bold">
                                    <h5 class="card-title m-0 card-link">{{$project->project_name}}</h5>
                                </div>
                                <div class="card-body pb-0 pt-4 px-3 _project-progress">
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
                                <a class="cml text-white" data-toggle="pjax" data-pjax="main-content" href="{{route('project.manage', ['slug' => $project->project_slug])}}" onclick="javascript:$(this).setBackUrl();">
                                    <span>
                                        <i class="fas fa-cogs fa-2x"></i><br>
                                        Kelola <br>Project
                                    </span>
                                </a>
                            </div>
                        </div>
                        {{-- <div class="card m-0 mb-3 border">
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
                            <a class="cml text-white" data-toggle="pjax" data-pjax="main-content" href="{{route('project.manage', ['slug' => $project->project_slug])}}" onclick="javascript:$(this).setBackUrl();">
                                <span>
                                    <i class="fas fa-cogs fa-2x"></i><br>
                                    Kelola <br>Project
                                </span>
                            </a>        
                        </div> --}}
                    </div>
                @endforeach
            </div>
            <div class="row section-content float-right p-0 px-3">
                {{ $user_projects->links() }}
            </div>
        </div>
    @endif
</div>