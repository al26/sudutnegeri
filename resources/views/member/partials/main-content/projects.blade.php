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
                    <span class="">Mohon <a href="{{route('dashboard', ['menu' => 'sudut', 'section' => 'verify'])}}" data-toggle="pjax" data-pjax="menu" onclick="javascript:$(this).setBackUrl();">verifikasi akun</a> Anda untuk dapat memulai proyek baru.</span>
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
                <div class="d-campaigns col-12 col-sm-6 col-xl-4 card-deck mb-3">
                    <div class="card m-0">
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
                    @endphp
                    <div class="d-campaigns col-12 col-sm-6 col-xl-4 card-deck mb-3">
                        <div class="card card-shadow p-0 m-0 border-0">
                            <div class="category-flag">
                                <p>{{$project->category->category}}</p>
                            </div>
                            <img class="card-img-top img-fit" src="{{secure_asset($project->project_banner)}}" alt="Card image cap">
                            <div class="media campaigner">
                                <img class="mr-3" src="{{secure_asset($project->user->profile->profile_picture)}}" alt="Profile Picture">
                                <div class="media-body">
                                    {{$project->user->profile->name}}
                                </div>
                            </div>
                            <div class="card-header px-3 bg-white font-weight-bold">
                                <h5 class="card-title m-0 card-link project-title">{{$project->project_name}}</h5>
                            </div>
                            <div class="card-body pb-0 pt-4 px-3 _project-progress">
                                <div class="info-donasi">
                                    <span class="--text text-capitalize">investasi terkumpul {{$progressDana}}%</span>
                                    <span class="--text font-weight-bold text-capitalize">{{Idnme::print_rupiah($project->collected_funds, false, true)}}</span>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: {{$progressDana}}%"></div>
                                    </div>
                                    <span class="--text text-capitalize">target {{Idnme::print_rupiah($project->funding_target, false, true)}}</span>
                                </div>
                                <hr class="mt-1 mb-2">
                                <div class="info-relawan">
                                    <span class="--text "><b>{{empty($project->registered_volunteer) ? "0" : $project->registered_volunteer}}</b> relawan tergabung dari target <b>{{$project->volunteer_quota}}</b> relawan</span>
                                </div>
                            </div>
                            {{-- <a class="cml text-white" data-toggle="pjax" data-pjax="main-content" href="{{route('project.manage', ['slug' => $project->project_slug])}}" onclick="javascript:$(this).setBackUrl();">
                                <span>
                                    <i class="fas fa-cogs fa-2x"></i><br>
                                    Kelola <br>Project
                                </span>
                            </a> --}}
                            <div class="cml text-white">
                                @if ($project->project_status === 'finished')
                                    <p class="w-100 my-2 text-white display-5">Proyek ini telah berakhir</p>
                                    
                                    <a href="{{route('project.show', ['slug' => $project->project_slug])}}" target="_blank" class="btn btn-lg btn-light text-secondary"><i class="fas fa-external-link-alt"></i> Lihat Proyek</a>
                                @else
                                    <a class="btn btn-lg btn-light text-secondary py-5 w-100 my-2" data-toggle="pjax" data-pjax="main-content" href="{{route('project.manage', ['slug' => $project->project_slug])}}" onclick="javascript:$(this).setBackUrl();"><i class="fas fa-cogs"></i> Kelola Proyek</a>

                                    @if ($project->project_status === 'rejected')
                                        <div class="alert alert-danger">
                                            <small class="--text _sub text-justify">Pengajuan proyek ini ditolak. Silahkan perbarui dokumen verifikasi sesuai arahan yang dikirmkan ke email Anda agar dapat diverifikasi ulang. <br>
                                                <a href="{{route('project.edit-doc', ['id' => encrypt($project->id)])}}" class="btn btn-sm btn-success my-2" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Unggah ulang dokumen verifikasi proyek", "cancel":"batal", "edit":"Unggah Dokumen", "actionUrl":"{{route('project.update-doc', ['id' => encrypt($project->id)])}}","redirectAfter":"{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}","pjax-reload":["#mr"]}'><i class="fas fa-edit"></i> Perbarui dokumen verifikasi</a> 
                                            </small>
                                        </div>
                                    @else
                                        <a class="btn btn-lg btn-danger py-5 w-100 my-2" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Akhiri Proyek","text":"Akhiri proyek {{$project->project_name}} ?", "yesUrl":"{{route('project.finish', ["id" => encrypt($project->id)])}}","yes":"Akhiri Proyek", "cancel":"Batalkan","redirectAfter":"{{route('dashboard', ['menu' => 'sudut', 'section' => 'projects'])}}","pjax-container":"#mr"}'><i class="fas fa-power-off"></i> Akhiri Proyek</a>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row section-content float-right p-0 px-3">
                {{ $user_projects->links() }}
            </div>
        </div>
    @endif
</div>