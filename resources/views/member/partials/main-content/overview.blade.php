@php
    function chop_string($string,$x=200) {
        // $string = strip_tags(stripslashes($string)); // convert to plaintext
        return substr($string, 0, strpos(wordwrap($string, $x), "."));
    }
@endphp
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Informasi terkini</h4>
    </div>
    @if (!empty($updates))
        <div class="card-body">
            @foreach ($updates as $key => $item)
                <div class="update-list">
                    <h3><a href="{{route('project.show', ['slug' => $item->project->project_slug, 'menu' => 'history'])}}" class="decoration-none text-secondary">{{$item->title}}</a></h3>
                    <span class="--text _sub">ditulis oleh : {{$item->user->profile->name}} | {{Idnme::print_date($item->created_at)}}</span>
                    <div class="update-list-item _less my-2" id="upless-{{$key}}">
                        {!!chop_string($item->body)!!}... 
                    </div>
                    <div class="update-list-item _complete hidden mb-2" id="upmore-{{$key}}">
                        {!!$item->body!!}
                    </div>
                    <button class="update-list-btn btn btn-secondary btn-sm" onclick='javascript:toggleMoreLess(this, "#upless-{{$key}}", "#upmore-{{$key}}", "Tampilkan Sebagian", "Selengkapnya");' data-action="more">Selengkapnya</button>
                </div>
                <hr>
            @endforeach
        </div>
    @endif
</div>
@if ($featured->count() > 0)
    <div class="card mt-3">
        <div class="card-header text-left border-bottom bg-lighten">
            <h4 class="m-0">Rekomendasi Proyek untuk Anda</h4>
        </div>
        <div class="card-body">
            {{-- <div class="form-section">
                <div class="fs-head">
                    <span class="fs-head-text">Rekomendasi Proyek untuk Anda</span>
                </div>
            </div> --}}
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
        </div>
    </div>
@endif