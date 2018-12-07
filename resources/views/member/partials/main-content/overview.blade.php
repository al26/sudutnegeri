@php
    function chop_string($string,$x=200) {
        // $string = strip_tags(stripslashes($string)); // convert to plaintext
        return substr($string, 0, strpos(wordwrap($string, $x), "."));
    }
    $prop = Auth::user()->profile->toArray();
    $check = in_array(null, $prop);
    // dd($featured);
@endphp
<div class="card mb-3 d-block d-lg-none" style="min-height:0 !important;">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Informasi Personal</h4>
    </div>
    @if ($check)
        <div class="card-body">
            <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" class="card-link" data-toggle="pjax" data-pjax="menu">Lengkapi profil Anda</a>
        </div>
    @else
        <div class="card-body">
            @if (Auth::user()->profile->biography !== "")
                <p class="card-text">{{Auth::user()->profile->biography}}</p>
            @else
                <a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" class="card-link" data-toggle="pjax" data-pjax="menu">tambah biografi</a>
            @endif
        </div>
        <ul class="list-group list-group-flush">
            @if(Auth::user()->profile->profession !== "")
                <li class="list-group-item text-capitalize"><i class="fas fa-briefcase fw mr-3"></i> {{Auth::user()->profile->profession}}</li>
            @else
                <li class="list-group-item text-capitalize"><a href="{{route('dashboard', ['menu' => 'setting', 'section' => 'profile'])}}" data-toggle="pjax" data-pjax="menu" class="card-link"><i class="fas fa-briefcase fw mr-3"></i> tambah profesi</a></li>
            @endif
            
            @if(Auth::user()->profile->skills !== "")
                <li class="list-group-item text-capitalize"><i class="fas fa-puzzle-piece fw mr-3"></i> {{Auth::user()->profile->skills}}</li>
            @else
                <li class="list-group-item text-capitalize"><a href="" class="card-link"><i class="fas fa-puzzle-piece fw mr-3"></i> tambah keahlian</a></li>
            @endif
            @if(Auth::user()->profile->address->regency->name !== "")
                <li class="list-group-item text-capitalize"><i class="fas fa-map-marker-alt fw mr-3"></i> {{strtolower(Auth::user()->profile->address->regency->name)}}</li>
            @else
                <li class="list-group-item text-capitalize"><a href="" class="card-link"><i class="fas fa-map-marker-alt fw mr-3"></i> tambah alamat</a></li>
            @endif
        </ul>
    @endif
</div>
<div class="card">
    <div class="card-header text-left border-bottom bg-lighten">
        <h4 class="m-0">Informasi terkini</h4>
    </div>
    <div class="card-body">
        @if ($updates->count() > 0)
            @foreach ($updates as $key => $item)
                <div class="update-list">
                    <h3><a href="{{route('project.show', ['slug' => $item->project->project_slug, 'menu' => 'history'])}}" class="decoration-none text-secondary">{{$item->title}}</a></h3>
                    <span class="--text _sub mb-2">ditulis oleh {{ucwords(strtolower($item->user->profile->name))}} pada {{Idnme::print_date($item->created_at)}} dari proyek <a href="{{route('project.show', ['slug' => $item->project->project_slug])}}" class="text-primary decoration-none">{{ucwords($item->project->project_name)}}</a> </span>
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
        @else
            <div class="text-center">
                <div class="my-3">
                    <i class="fas fa-chalkboard fa-10x"></i>
                </div>
                <span class="font-weight-bold">Belum ada update informasi untuk Anda!!</span><br>
                
            </div>
        @endif
    </div>
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
                                    <span class="--text text-capitalize">target {{Idnme::print_rupiah($project->funding_target, false, true)}}</span>
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
        </div>
    </div>
@endif