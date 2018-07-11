<div class="card">
    <div class="card-body">
        <div class="form-section">
            <div class="fs-head">
                <span class="fs-head-text">Proyek Saya</span>
                {{-- <a href="#" class="btn btn-sm btn-primary float-right" onclick="history.back();return false;"><i class="fas fw fa-arrow-left"></i> Kembali</a> --}}
            </div>
        </div>
        <div class="row section-content">
            <div class="d-campaigns col-12 col-sm-6 col-lg-4 card-deck">
                <div class="card m-0 mb-3">
                    <a class="cal" href="{{route('project.create')}}" data-toggle="modal" data-target="#modal" data-backdrop="static" data-keyboard="false" data-modal='{"title":"Buat Project Baru","add":"Buat Project","cancel":"Batal","lg":true, "actionUrl":"{{route('project.store')}}"}'>
                        <span>
                            <i class="fas fa-plus fa-2x"></i><br>
                            Project <br>Baru
                        </span>
                    </a>        
                </div>
            </div>
            @foreach ($user_projects as $project)    
                @php
                    $progressDana = round(($project->funding_progress / $project->funding_target) * 100);
                    $progressRelawan = round(($project->volunteer_applied / $project->volunteer_spot) * 100);
                    $now = time();
                    $deadline = strtotime($project->deadline);
                    $remainingDays = round(($deadline - $now) / (60 * 60 * 24));
                    $remainingHours = round(($deadline - $now) / (60 * 60));
                    if($remainingDays < 0) {
                        $remainingDays = "Proyek Selesai";
                    }
                @endphp
                <div class="d-campaigns col-12 col-sm-6 col-lg-4 card-deck">
                    <div class="card m-0 mb-3 border">
                        <img class="card-img-top rounded-0" src="https://via.placeholder.com/600x400" alt="Card image cap">
                        <div class="card-body py-0 px-3 pt-3" style="top:0">
                            <h5 class="card-title text-danger">{{$project->project_name}}</h5>
                            <p class="card-text">{!!$project->description!!}</p>
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
                                    <p class="mb-0">{{$project->location}}</p>
                                </div>
                                <div class="col-6 text-right">
                                    <p class="mb-0"><small>Sisa Hari</small></p>
                                    <p class="mb-0">{{$remainingDays}}</p>
                                </div>
                            </div>				      	
                        </div>
                        <a class="cml text-white" data-toggle="pjax" data-pjax="main-content" href="{{route('manage.project', ['slug' => $project->project_slug])}}">
                            <span>
                                <i class="fas fa-cogs fa-2x"></i><br>
                                Kelola <br>Project
                            </span>
                        </a>        
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row section-content float-right p-0 px-3">
            {{ $user_projects->links() }}
        </div>
    </div>
</div>
